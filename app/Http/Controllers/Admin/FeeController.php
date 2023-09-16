<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fee;
use App\Models\Time;
use App\Models\Batch;
use App\Models\Group;
use App\Models\Level;
use App\Models\Shift;
use App\Models\Status;
use App\Models\FeeType;
use App\Models\Program;
use App\Models\Receipt;
use App\Models\Academic;
use App\Models\StudentFee;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ReceiptDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MyClass;

class FeeController extends Controller
{
  public $prefix = 'fee_';

  public $crudRoutePath = 'fees';

  public function getPayment()
  {
    $data['prefix'] = $this->prefix;
    $data['crudRoutePath'] = $this->crudRoutePath;
    $data['academics'] = Academic::orderBy('academic_id','DESC')->get();
    $data['programs'] = Program::all();
    $data['shifts'] = Shift::all();
    $data['times'] = Time::all();
    $data['batches'] = Batch::all();
    $data['groups'] = Group::all();
    return view('admin.fees.searchPayment');
  }

  public function student_status($student_id)
  {
    return Status::latest('statuses.status_id')
          ->join('students','students.student_id','=','statuses.student_id')
          ->join('classes','classes.class_id','=','statuses.class_id')
          ->join('academics','academics.academic_id','=','classes.academic_id')
          ->join('shifts','shifts.shift_id','=','classes.shift_id')
          ->join('times','times.time_id','=','classes.time_id')
          ->join('groups','groups.group_id','=','classes.group_id')
          ->join('batches','batches.batch_id','=','classes.batch_id')
          ->join('levels','levels.level_id','=','classes.level_id')
          ->join('programs','programs.program_id','=','classes.program_id')
          ->where('students.student_id',$student_id);
  }

  public function show_school_fee($level_id)
  {
    return Fee::join('academics','academics.academic_id','=','fees.academic_id')
              ->join('levels','levels.level_id','=','fees.level_id')
              ->join('programs','programs.program_id','=','levels.program_id')
              ->join('fee_types','fee_types.fee_type_id','=','fees.fee_type_id')
              ->where('levels.level_id',$level_id)
              ->orderBy('fees.amount','DESC');
  }

  public function read_student_fee($student_id)
  {
    return StudentFee::join('fees','fees.fee_id','=','student_fees.fee_id')
                      ->join('students','students.student_id','=','student_fees.student_id')
                      ->join('levels','levels.level_id','=','student_fees.level_id')
                      ->join('programs','programs.program_id','=','levels.program_id')
                      ->select('programs.program',
                              'levels.level_id',
                              'levels.level',
                              'fees.amount as school_fee',
                              'students.student_id',
                              'student_fees.s_fee_id',
                              'student_fees.amount as student_amount',
                              'student_fees.discount')
                      ->where('students.student_id',$student_id)
                      ->orderBy('student_fees.s_fee_id','ASC');
  }

  public function read_student_transaction($student_id)
  {
    return ReceiptDetail::join('receipts','receipts.receipt_id','=','receipt_details.receipt_id')
                        ->join('students','students.student_id','=','receipt_details.student_id')
                        ->join('transactions','transactions.transaction_id','=','receipt_details.transaction_id')
                        ->join('fees','fees.fee_id','=','transactions.fee_id')
                        ->join('users','users.id','=','transactions.user_id')
                        ->where('students.student_id',$student_id);
  }

  public function total_transaction($student_id)
  {
    return ReceiptDetail::join('receipts','receipts.receipt_id','=','receipt_details.receipt_id')
                          ->join('students','students.student_id','=','receipt_details.student_id')
                          ->join('transactions','transactions.transaction_id','=','receipt_details.transaction_id')
                          ->join('fees','fees.fee_id','=','transactions.fee_id')
                          ->join('users','users.id','=','transactions.user_id')
                          ->select(DB::raw('SUM(transactions.paid) as total_transaction',
                          'transactions.s_fee_id'))
                          ->where('students.student_id',$student_id)
                          ->groupBy('transactions.s_fee_id');
  }

  public function payment($viewName,$student_id)
  {
    $data['feetypes'] = FeeType::all();
    $data['status'] = $this->student_status($student_id)->first();
    $data['programs'] = Program::where('program_id',$data['status']->program_id)->get();
    $data['levels'] = Level::where('program_id',$data['status']->program_id)->get();
    $data['studentfee'] = $this->show_school_fee($data['status']->level_id)->first();
    $data['readStudentFee'] = $this->read_student_fee($student_id)->get();
    $data['readStudentTransaction'] = $this->read_student_transaction($student_id)->get();
    $data['receipt_id'] = ReceiptDetail::where('student_id',$student_id)->max('receipt_id');
    return view($viewName,$data)->with(['student_id' => $student_id]);
  }

  public function showStudentPayment(Request $request)
  {
    $student_id = $request->student_id;
    return $this->payment('admin.fees.payment',$student_id);
  }

  public function gotoPayment($student_id)
  {
    return $this->payment('admin.fees.payment',$student_id);
  }

  public function savePayment(Request $request)
  {
    $studentFee = StudentFee::create([
      'fee_id' => $request->fee_id,
      'student_id' => $request->student_id,
      'level_id' => $request->level_id,
      'amount' => $request->amount,
      'discount' => $request->discount,
      'fee_id' => $request->fee_id,
    ]);
    $transact = Transaction::create([
      'transaction_date' => $request->transaction_date,
      'fee_id' => $request->fee_id,
      'user_id' => $request->user_id,
      'student_id' => $request->student_id,
      'student_id' => $request->student_id,
      's_fee_id' => $studentFee->s_fee_id,
      'paid' => $request->paid,
      'remark' => $request->remark,
      'description' => $request->description,
    ]);
    $receipt_id = Receipt::autoNumber();
    ReceiptDetail::create([
      'receipt_id' => $receipt_id,
      'student_id' => $request->student_id,
      'transaction_id'=> $transact->transaction_id
    ]);
    return back();
    // return redirect()->route('admin.students.getPayment');
  }

  public function createFee(Request $request)
  {
    if($request->ajax())
    {
      $fee = Fee::create($request->all());
      return response()->json($fee);
    }
  }

  public function pay(Request $request)
  {
    if($request->ajax()){
      // return response()->json($request);
      $studentFee =  StudentFee::join('levels','levels.level_id','=','student_fees.level_id')
                ->join('programs','programs.program_id','=','levels.program_id')
                ->join('fees','fees.fee_id','=','student_fees.fee_id')
                ->join('students','students.student_id','=','student_fees.student_id')
                ->select('levels.level_id',
                         'levels.level',
                         'programs.program_id',
                         'programs.program',
                         'fees.fee_id',
                         'students.student_id',
                         'student_fees.s_fee_id',
                         'fees.amount as school_fee',
                         'student_fees.amount as student_amount',
                         'student_fees.discount')
                         ->where('student_fees.s_fee_id',$request->s_fee_id)
                         ->first();
      return response()->json($studentFee);
    }
  }

  public function extraPay(Request $request)
  {
    // dd ($request->all());
    $transact = Transaction::create($request->except('level_id','lack'));
    if($transact)
    {
      $transaction_id = $transact->transaction_id;
      $student_id = $transact->student_id;
      $receipt_id = Receipt::autoNumber();
      ReceiptDetail::create([
        'receipt_id' => $receipt_id,
        'student_id' => $student_id,
        'transaction_id' => $transaction_id
      ]);
      return back();
    }
  }

  public function printInvoice($receipt_id)
  {
    $invoice = ReceiptDetail::join('receipts','receipts.receipt_id','=','receipt_details.receipt_id')
                              ->join('transactions','transactions.transaction_id','=','receipt_details.transaction_id')
                              ->join('students','students.student_id','=','receipt_details.student_id')
                              ->join('fees','fees.fee_id','transactions.fee_id')
                              ->join('users','users.id','transactions.user_id')
                              ->join('levels','levels.level_id','=','fees.level_id')
                              ->join('programs','programs.program_id','=','levels.program_id')
                              //  ->join('statuses','statuses.student_id','=','students.student_id')
                              ->where('receipts.receipt_id',$receipt_id)
                              ->select('students.student_id',
                                      'students.first_name',
                                      'students.last_name',
                                      'students.sex',
                                      'users.name',
                                      'fees.amount as school_fee',
                                      'transactions.transaction_date',
                                      'transactions.paid',
                                      'receipts.receipt_id',
                                      'transactions.s_fee_id',
                                      'transactions.transaction_id',
                                      'levels.level_id'
                                      )
                              ->first();
    $status = MyClass::join('levels', 'levels.level_id', '=', 'classes.level_id')
                        ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                        ->join('times', 'times.time_id', '=', 'classes.time_id')
                        ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                        ->join('groups', 'groups.group_id', '=', 'classes.group_id')
                        ->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                        ->join('programs','programs.program_id','=','levels.program_id')
                        ->join('statuses','statuses.class_id','=','classes.class_id')
                        ->where('levels.level_id', $invoice->level_id)
                        ->where('statuses.student_id',$invoice->student_id)
                        ->select(DB::raw('CONCAT(programs.program,
                                          "/ Level-",levels.level,
                                          "/ Shift-",shifts.shift,
                                          "/ Times-",times.time,
                                          "/ Group-",groups.group,
                                          "/ Batch-",batches.batch,
                                          "/ Academic-",academics.academic,
                                          "/ Start Date-",classes.start_date,
                                          "/ End Date-",classes.end_date
                                          ) As detail'))
                        ->first();
    $studentFee = StudentFee::where('s_fee_id',$invoice->s_fee_id)->first();
    $totalPaid = Transaction::where('s_fee_id',$invoice->s_fee_id)->sum('paid');
    $studentPaid = Transaction::where('s_fee_id',$invoice->s_fee_id)
                               ->where('transaction_id',$invoice->transaction_id)->first();
    return view('admin.invoice.invoice',compact('invoice','status','totalPaid','studentFee','studentPaid'));
  }
  public function printAllInvoice($receipt_id)
  {
    $invoice = ReceiptDetail::join('receipts','receipts.receipt_id','=','receipt_details.receipt_id')
                              ->join('transactions','transactions.transaction_id','=','receipt_details.transaction_id')
                              ->join('students','students.student_id','=','receipt_details.student_id')
                              ->join('fees','fees.fee_id','transactions.fee_id')
                              ->join('users','users.id','transactions.user_id')
                              ->join('levels','levels.level_id','=','fees.level_id')
                              ->join('programs','programs.program_id','=','levels.program_id')
                              //  ->join('statuses','statuses.student_id','=','students.student_id')
                              ->where('receipts.receipt_id',$receipt_id)
                              ->select('students.student_id',
                                      'students.first_name',
                                      'students.last_name',
                                      'students.sex',
                                      'users.name',
                                      'fees.amount as school_fee',
                                      'transactions.transaction_date',
                                      'transactions.paid',
                                      'receipts.receipt_id',
                                      'transactions.s_fee_id',
                                      'transactions.transaction_id',
                                      'levels.level_id'
                                      )
                              ->first();
    $status = MyClass::join('levels', 'levels.level_id', '=', 'classes.level_id')
                        ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                        ->join('times', 'times.time_id', '=', 'classes.time_id')
                        ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                        ->join('groups', 'groups.group_id', '=', 'classes.group_id')
                        ->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                        ->join('programs','programs.program_id','=','levels.program_id')
                        ->join('statuses','statuses.class_id','=','classes.class_id')
                        ->where('levels.level_id', $invoice->level_id)
                        ->where('statuses.student_id',$invoice->student_id)
                        ->select(DB::raw('CONCAT(programs.program,
                                          "/ Level-",levels.level,
                                          "/ Shift-",shifts.shift,
                                          "/ Times-",times.time,
                                          "/ Group-",groups.group,
                                          "/ Batch-",batches.batch,
                                          "/ Academic-",academics.academic,
                                          "/ Start Date-",classes.start_date,
                                          "/ End Date-",classes.end_date
                                          ) As detail'))
                        ->first();
    $studentFee = StudentFee::where('s_fee_id',$invoice->s_fee_id)->first();
    $totalPaid = Transaction::where('s_fee_id',$invoice->s_fee_id)->sum('paid');
    return view('admin.invoice.invoice_all',compact('invoice','status','totalPaid','studentFee'));
  }

  public function deleteTransact($transact_id)
  {
    $transact = Transaction::findOrFail($transact_id);
    $transact->delete();
    return back();
  }

  public function showLevelStudent(Request $request)
  {
    $status = MyClass::join('levels', 'levels.level_id', '=', 'classes.level_id')
                            ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                            ->join('times', 'times.time_id', '=', 'classes.time_id')
                            ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                            ->join('groups', 'groups.group_id', '=', 'classes.group_id')
                            ->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                            ->join('programs','programs.program_id','=','levels.program_id')
                            ->join('statuses','statuses.class_id','=','classes.class_id')
                            ->where('levels.level_id', $request->level_id)
                            ->where('statuses.student_id',$request->student_id)
                            ->select(DB::raw('CONCAT(programs.program,
                                              "/ Level-",levels.level,
                                              "/ Shift-",shifts.shift,
                                              "/ Times-",times.time,
                                              "/ Group-",groups.group,
                                              "/ Batch-",batches.batch,
                                              "/ Academic-",academics.academic
                                              ) As detail'))
                            ->first();
    return response($status);
  }

  public function createStudentLevel()
  {
    Status::insert(['student_id'=>2,'class_id'=>1]);
  }

  public function getFeeReport()
  {
    return view('fees.feeReport');
  }

  public function showFeeReport(Request $request)
  {
    $fees = $this->feeInfo()->whereDate('transactions.transact_date','>=',$request->from)
                            ->whereDate('transactions.transact_date','<=',$request->to)
                            ->orderBy('students.student_id')
                            ->get();
    return view('fees.feeList',compact('fees'));
  }

  public function feeInfo()
  {
    return Transaction::join('fees','fees.fee_id','=','transactions.fee_id')
                ->join('students','students.student_id','=','transactions.student_id')
                ->join('studentfees','studentfees.s_fee_id','transactions.s_fee_id')
                ->join('users','users.id','=','transactions.user_id')
                ->select('students.student_id',
                         'students.first_name',
                         'students.last_name',
                         'users.name',
                         'fees.amount as school_fee',
                         'studentfees.discount',
                         'studentfees.amount as student_fee',
                         'transactions.paid',
                         'transactions.transact_date'
                        );
  }
}
