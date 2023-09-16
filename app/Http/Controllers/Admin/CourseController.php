<?php

namespace App\Http\Controllers\Admin;

use App\Models\Academic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Group;
use App\Models\Level;
use App\Models\MyClass;
use App\Models\Program;
use App\Models\Shift;
use App\Models\Time;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
  public $prefix = 'course_';

  public $crudRoutePath = 'courses';

  public function index()
  {
    $data['prefix'] = $this->prefix;
    $data['crudRoutePath'] = $this->crudRoutePath;
    $data['academics'] = Academic::orderBy('academic_id','asc');
    $data['programs'] = Program::all();
    $data['levels'] = Level::all();
    $data['shifts'] = Shift::all();
    $data['times'] = Time::all();
    $data['batchs'] = Batch::all();
    $data['groups'] = Group::all();
    return view('admin.courses.manageCourse',$data);
  }

  public function store(Request $request)
  {
    // abort_if(Gate::denies($this->prefix.'create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // if($request->status){
    //   $status = true;
    // } else {
    //   $status = false;
    // }
    $object_id= $request->object_id;
    $validator = Validator::make($request->all(),[
      'academic_id' => ['required'],
      'program_id' => ['required'],
      'level_id' => ['required'],
      'shift_id' => ['required'],
      'time_id' => ['required'],
      'group_id' => ['required'],
      'batch_id' => ['required'],
      'start_date' => ['required'],
      'end_date' => ['required'],
    ]);
    if($validator->fails()){
      $response = [
        'status' => 400,
        'error'  => $validator->errors()->toArray()
      ];
      return response()->json($response);
    } else {
      $all_data =[
        'academic_id'=>$request->academic_id,
        'program_id'=>$request->program_id,
        'level_id'=>$request->level_id,
        'shift_id'=>$request->shift_id,
        'time_id'=>$request->time_id,
        'group_id'=>$request->group_id,
        'batch_id'=>$request->batch_id,
        'start_date'=>$request->start_date,
        'end_date'=>$request->end_date,
        'status'=>$request->status,
      ];
      $datas   =   MyClass::updateOrCreate([
        'class_id' => $object_id],
        $all_data);
      if($object_id){
        $type = 'update-object';
        $success = 'Academic has been Updated Successfully!';
      } else {
        $type = 'store-object';
        $success = 'Academic has been inserted Successfully!';
      }
      $response = [
        'status'  => 200,
        'type'    => $type,
        'success' => $success,
        'data'    => $datas,
        // 'html'    => view('admin.courses.templates.ajax_tr',[
        //   'row'=> $datas,
        //   'prefix'=>$this->prefix,
        //   'crudRoutePath'=> $this->crudRoutePath])
        //   ->render(),
      ];
      return response()->json($response);
    }
  }

  public function showClassInformation(Request $request)
  {
    // return $request->all();
    if($request->academic_id !="" && $request->program_id==""){
      $criterial = array('academics.academic_id'=>$request->academic_id);
    }elseif($request->academic_id !="" && $request->program_id!="" &&  $request->level_id ==""){
      $criterial = ['academics.academic_id'=>$request->academic_id,'programs.program_id'=>$request->program_id];
    } elseif($request->academic_id!="" &&
             $request->program_id !="" &&
             $request->level_id !="" &&
             $request->shift_id !="" &&
             $request->time_id !="" &&
             $request->batch_id !=""&&
             $request->group_id !="")
    {
      $criterial = array('academics.academic_id'=>$request->academic_id,
                        'programs.program_id'=>$request->program_id,
                        'levels.level_id'=>$request->level_id,
                        'shifts.shift_id'=>$request->shift_id,
                        'times.time_id'=>$request->time_id,
                        'batches.batch_id'=>$request->batch_id,
                        'groups.group_id'=>$request->group_id);
    }
    $data['prefix'] = $this->prefix;
    $data['crudRoutePath'] = $this->crudRoutePath;
    $data['classes'] = $this->classInformation($criterial)->get();
    return view('admin.class.classInfo',$data);
  }

  public function classInformation($criterial)
  {
    return MyClass::join('academics','academics.academic_id','=','classes.academic_id')
                        ->join('levels','levels.level_id','=','classes.level_id')
                        ->join('programs','programs.program_id','=','levels.program_id')
                        ->join('shifts','shifts.shift_id','=','classes.shift_id')
                        ->join('times','times.time_id','=','classes.time_id')
                        ->join('batches','batches.batch_id','=','classes.batch_id')
                        ->join('groups','groups.group_id','=','classes.group_id')
                        ->where($criterial)
                        ->orderBy('classes.class_id','DESC');
  }

  public function edit(Request $request,$id)
  {
    $response = [
      'data' => MyClass::join('levels','levels.level_id','=','classes.level_id')
                       ->where('class_id','=',$id)->first()
    ];
    return response()->json($response);
  }

  public function destroy($id)
  {
    $class = MyClass::findOrFail($id);
    $class->delete();
    $response = [
      'data' => $class,
      'success' => "Class has been deleted successfull!"
    ];
    return response()->json($response);
  }

  public function storeAcademic(Request $request)
  {
    // abort_if(Gate::denies($this->prefix.'create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // if($request->status){
    //   $status = true;
    // } else {
    //   $status = false;
    // }
    $object_id= $request->object_id;
    $validator = Validator::make($request->all(),[
      'academic' => ['required','string'],
    ]);
    if($validator->fails()){
      $response = [
        'status' => 400,
        'error'  => $validator->errors()->toArray()
      ];
      return response()->json($response);
    } else {
      $datas   =   Academic::updateOrCreate([
        'academic_id' => $object_id],
        [
          'academic' => $request->academic,
        ]);
      if($object_id){
        $type = 'update-object';
        $success = 'Academic has been Updated Successfully!';
      } else {
        $type = 'store-object';
        $success = 'Academic has been inserted Successfully!';
      }
      $response = [
        'status'  => 200,
        'type'    => $type,
        'success' => $success,
        'data'    => $datas,
        // 'html'    => view('admin.courses.templates.ajax_tr',[
        //   'row'=> $datas,
        //   'prefix'=>$this->prefix,
        //   'crudRoutePath'=> $this->crudRoutePath])
        //   ->render(),
      ];
    }
    return response()->json($response);
  }

  public function storeProgram(Request $request)
  {
    // abort_if(Gate::denies($this->prefix.'create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // if($request->status){
    //   $status = true;
    // } else {
    //   $status = false;
    // }
    $object_id= $request->object_id;
    $validator = Validator::make($request->all(),[
      'program' => ['required','string'],
    ]);
    if($validator->fails()){
      $response = [
        'status' => 400,
        'error'  => $validator->errors()->toArray()
      ];
      return response()->json($response);
    } else {
      $datas   =   Program::updateOrCreate([
        'program_id' => $object_id],
        [
          'program' => $request->program,
          'description' => $request->description,
        ]);
      if($object_id){
        $type = 'update-object';
        $success = 'Program has been Updated Successfully!';
      } else {
        $type = 'store-object';
        $success = 'Program has been inserted Successfully!';
      }
      $response = [
        'status'  => 200,
        'type'    => $type,
        'success' => $success,
        'data'    => $datas,
        // 'html'    => view('admin.courses.templates.ajax_tr',[
        //   'row'=> $datas,
        //   'prefix'=>$this->prefix,
        //   'crudRoutePath'=> $this->crudRoutePath])
        //   ->render(),
      ];
    }
    return response()->json($response);
  }

  public function showLevel(Request $request)
  {
    $response = Level::where('program_id',$request->program_id)->get();
    return response()->json($response);
  }

  public function storeLevel(Request $request)
  {
    // abort_if(Gate::denies($this->prefix.'create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // if($request->status){
    //   $status = true;
    // } else {
    //   $status = false;
    // }
    $object_id= $request->object_id;
    $validator = Validator::make($request->all(),[
      'level' => ['required','string'],
      'program_id' => ['required','integer'],
    ]);
    if($validator->fails()){
      $response = [
        'status' => 400,
        'error'  => $validator->errors()->toArray()
      ];
      return response()->json($response);
    } else {
      $datas   =   Level::updateOrCreate([
        'level_id' => $object_id],
        [
          'program_id' => $request->program_id,
          'level' => $request->level,
          'description' => $request->description,
        ]);
      if($object_id){
        $type = 'update-object';
        $success = 'Level has been Updated Successfully!';
      } else {
        $type = 'store-object';
        $success = 'Level has been inserted Successfully!';
      }
      $response = [
        'status'  => 200,
        'type'    => $type,
        'success' => $success,
        'data'    => $datas,
        // 'html'    => view('admin.courses.templates.ajax_tr',[
        //   'row'=> $datas,
        //   'prefix'=>$this->prefix,
        //   'crudRoutePath'=> $this->crudRoutePath])
        //   ->render(),
      ];
    }
    return response()->json($response);
  }

  public function storeShift(Request $request)
  {
    // abort_if(Gate::denies($this->prefix.'create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // if($request->status){
    //   $status = true;
    // } else {
    //   $status = false;
    // }
    $object_id= $request->object_id;
    $validator = Validator::make($request->all(),[
      'shift' => ['required','string'],
    ]);
    if($validator->fails()){
      $response = [
        'status' => 400,
        'error'  => $validator->errors()->toArray()
      ];
      return response()->json($response);
    } else {
      $datas   =   Shift::updateOrCreate([
        'shift_id' => $object_id],
        [
          'shift' => $request->shift,
        ]);
      if($object_id){
        $type = 'update-object';
        $success = 'Shift has been Updated Successfully!';
      } else {
        $type = 'store-object';
        $success = 'Shift has been inserted Successfully!';
      }
      $response = [
        'status'  => 200,
        'type'    => $type,
        'success' => $success,
        'data'    => $datas,
        // 'html'    => view('admin.courses.templates.ajax_tr',[
        //   'row'=> $datas,
        //   'prefix'=>$this->prefix,
        //   'crudRoutePath'=> $this->crudRoutePath])
        //   ->render(),
      ];
    }
    return response()->json($response);
  }

  public function storeTime(Request $request)
  {
    // abort_if(Gate::denies($this->prefix.'create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // if($request->status){
    //   $status = true;
    // } else {
    //   $status = false;
    // }
    $object_id= $request->object_id;
    $validator = Validator::make($request->all(),[
      'time' => ['required','string'],
    ]);
    if($validator->fails()){
      $response = [
        'status' => 400,
        'error'  => $validator->errors()->toArray()
      ];
      return response()->json($response);
    } else {
      $datas   =   Time::updateOrCreate([
        'time_id' => $object_id],
        [
          'time' => $request->time,
        ]);
      if($object_id){
        $type = 'update-object';
        $success = 'Time has been Updated Successfully!';
      } else {
        $type = 'store-object';
        $success = 'Time has been inserted Successfully!';
      }
      $response = [
        'status'  => 200,
        'type'    => $type,
        'success' => $success,
        'data'    => $datas,
        // 'html'    => view('admin.courses.templates.ajax_tr',[
        //   'row'=> $datas,
        //   'prefix'=>$this->prefix,
        //   'crudRoutePath'=> $this->crudRoutePath])
        //   ->render(),
      ];
    }
    return response()->json($response);
  }

  public function storeBatch(Request $request)
  {
    // abort_if(Gate::denies($this->prefix.'create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // if($request->status){
    //   $status = true;
    // } else {
    //   $status = false;
    // }
    $object_id= $request->object_id;
    $validator = Validator::make($request->all(),[
      'batch' => ['required','string'],
    ]);
    if($validator->fails()){
      $response = [
        'status' => 400,
        'error'  => $validator->errors()->toArray()
      ];
      return response()->json($response);
    } else {
      $datas   =   Batch::updateOrCreate([
        'batch_id' => $object_id],
        [
          'batch' => $request->batch,
        ]);
      if($object_id){
        $type = 'update-object';
        $success = 'Batch has been Updated Successfully!';
      } else {
        $type = 'store-object';
        $success = 'Batch has been inserted Successfully!';
      }
      $response = [
        'status'  => 200,
        'type'    => $type,
        'success' => $success,
        'data'    => $datas,
        // 'html'    => view('admin.courses.templates.ajax_tr',[
        //   'row'=> $datas,
        //   'prefix'=>$this->prefix,
        //   'crudRoutePath'=> $this->crudRoutePath])
        //   ->render(),
      ];
    }
    return response()->json($response);
  }

  public function storeGroup(Request $request)
  {
    // abort_if(Gate::denies($this->prefix.'create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // if($request->status){
    //   $status = true;
    // } else {
    //   $status = false;
    // }
    $object_id= $request->object_id;
    $validator = Validator::make($request->all(),[
      'group' => ['required','string'],
    ]);
    if($validator->fails()){
      $response = [
        'status' => 400,
        'error'  => $validator->errors()->toArray()
      ];
      return response()->json($response);
    } else {
      $datas   =   Group::updateOrCreate([
        'group_id' => $object_id],
        [
          'group' => $request->group,
        ]);
      if($object_id){
        $type = 'update-object';
        $success = 'Group has been Updated Successfully!';
      } else {
        $type = 'store-object';
        $success = 'Group has been inserted Successfully!';
      }
      $response = [
        'status'  => 200,
        'type'    => $type,
        'success' => $success,
        'data'    => $datas,
        // 'html'    => view('admin.courses.templates.ajax_tr',[
        //   'row'=> $datas,
        //   'prefix'=>$this->prefix,
        //   'crudRoutePath'=> $this->crudRoutePath])
        //   ->render(),
      ];
    }
    return response()->json($response);
  }

}
