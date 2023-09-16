<?php

namespace App\Http\Controllers\Admin;

use App\Models\Time;
use App\Models\Batch;
use App\Models\Group;
use App\Models\Level;
use App\Models\Shift;
use App\Models\Status;
use App\Models\Program;
use App\Models\Student;
use App\Models\Academic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
  public function getStudentList()
	{
		$academics = Academic::orderBy('academic_id', 'asc')->get();
		$programs = Program::all();
		$levels = Level::all();
		$shifts = Shift::all();
		$times = Time::all();
		$batches = Batch::all();
		$groups = Group::all();
		$student_id = Student::max('student_id');
		return view('admin.report.studentlist',compact('programs','academics','levels','shifts','times','batches','groups','student_id'));
	}

	public function showStudentInfo(Request $request)
	{
		$classes = $this->info()->select(DB::raw('students.student_id,
																		 CONCAT(students.first_name," ",students.last_name) as name,
																		 (CASE WHEN students.sex=0 THEN "Male" ELSE "Female" END) as sex,
																		 students.dob,
																		 CONCAT(programs.program," / ",
																		 levels.level," / ",shifts.shift," / ",
																		 times.time," / ","Start-",classes.start_date," / ",
																		 "End-",classes.end_date) as program
																		'))
										->where('classes.class_id',$request->class_id)
										->get();
		return view('admin.report.studentInfo',compact('classes'));
	}

	public function info()
	{
		$status = Status::join('classes','classes.class_id','=','statuses.class_id')
										->join('students','students.student_id','=','statuses.student_id')
										->join('levels','levels.level_id','=','classes.level_id')
										->join('programs','programs.program_id','=','levels.program_id')
										->join('academics','academics.academic_id','=','classes.academic_id')
										->join('shifts','shifts.shift_id','=','classes.shift_id')
										->join('times','times.time_id','=','classes.time_id')
										->join('batches','batches.batch_id','=','classes.batch_id')
										->join('groups','groups.group_id','=','classes.group_id');

		return $status;
	}

	public function getStudentListMultiClass()
	{
		$academics = Academic::orderBy('academic_id', 'asc')->get();
		$programs = Program::all();
		$levels = Level::all();
		$shifts = Shift::all();
		$times = Time::all();
		$batches = Batch::all();
		$groups = Group::all();
		$student_id = Student::max('student_id');
		return view('admin.report.studentlistMultiClass', compact('programs', 'academics', 'levels', 'shifts', 'times', 'batches', 'groups', 'student_id'));
	}

	public function showStudentListMultClass(Request $request)
	{
		if($request->ajax()){
      if(!empty($request['chk'])){
        $classes = $this->info()
                        ->select(DB::raw('students.student_id,
                                          CONCAT(students.first_name," ",students.last_name) as name,
                                          (CASE WHEN students.sex=0 THEN "Male" ELSE "Female" END) as sex,
                                          students.dob,
                                          CONCAT(programs.program," / ",
                                          levels.level," / ",
                                          shifts.shift," / ",
                                          times.time," / ","Start-",classes.start_date," / ",
                                          "End-",classes.end_date) as program,
                                          levels.level,
                                          shifts.shift,
                                          batches.batch,
                                          groups.group
                                          '))
                                ->whereIn('classes.class_id',$request['chk'])
                                ->get();
        return view('admin.report.studentInfoMultiClass',compact('classes'));
			}
		}
	}

	public function getNewStudentRegister()
	{
		// $students = Student::where(DB::raw("(DATE_FORMAT(dateregistered,'%Y'))"),date('Y'))
		// 			->select('dateregistered as created_at')
		// 			->get();
		// $chart = Charts::database($students, 'bar', 'highcharts')
		// 		->title("Monthly new Register Students")
		// 		->elementLabel("Total Students")
		// 		->dimensions(1000, 500)
		// 		->responsive(false)
		// 		->groupByMonth(date('Y'), true);
		// return view('report.newStudentRegister',compact('chart'));
	}
}
