<?php

namespace App\Http\Controllers\Admin;

use App\Models\Time;
use App\Models\Batch;
use App\Models\Group;
use App\Models\Shift;
use App\Models\Program;
use App\Models\Student;
use App\Models\Academic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use App\Models\Status;

class StudentController extends Controller
{
  public $prefix = 'student_';

  public $crudRoutePath = 'students';

  public function studentRegister()
  {
    $data['prefix'] = $this->prefix;
    $data['crudRoutePath'] = $this->crudRoutePath;
    $data['academics'] = Academic::orderBy('academic_id','asc')->get();
    $data['programs'] = Program::all();
    $data['shifts'] = Shift::all();
    $data['times'] = Time::all();
    $data['batches'] = Batch::all();
    $data['groups'] = Group::all();
    $data['student_id'] = Student::max('student_id');
    return view('admin.student.student_register',$data);
  }

  public function studentStore(Request $request)
  {
      $all_data = [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'sex' => $request->sex,
        'dob' => date('Y-m-d',strtotime($request->dob)),
        'rac' => $request->rac,
        'status' => $request->status,
        'nationality' => $request->nationality,
        'national_card' => $request->national_card,
        'passport' => $request->passport,
        'phone' => $request->phone,
        'village' => $request->village,
        'commune' => $request->commune,
        'district' => $request->district,
        'province' => $request->province,
        'current_address' => $request->current_address,
        'dateregistered' => $request->dateregistered,
        'user_id' => $request->user_id,
        'photo' => FileUpload::photo($request,'photo'),
      ];
      if($student = Student::create($all_data)){
        Status::insert([
          'student_id' => $student->student_id,
          'class_id' => $request->class_id
        ]);
      }
      return redirect()->route('admin.students.gotoPayment',$student->student_id);
  }
}
