<?php
  use Illuminate\Support\Facades\Route;

  Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>['auth']],function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('permissions/changeStatus',[App\Http\Controllers\Admin\PermissionController::class,'changeStatus'])->name('permissions.changeStatus');
    Route::resource('permissions', App\Http\Controllers\Admin\PermissionController::class)->except('create','update');
    Route::get('roles/changeStatus',[App\Http\Controllers\Admin\RoleController::class,'changeStatus'])->name('roles.changeStatus');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)->except('create','update');
    Route::get('users/changeStatus',[App\Http\Controllers\Admin\UserController::class,'changeStatus'])->name('users.changeStatus');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except('create','update');

    Route::controller(App\Http\Controllers\Admin\CourseController::class)->group(function () {
      Route::get('manage/course','index')->name('courses.manage');
      Route::post('manage/course','store')->name('courses.store');
      Route::get('manage/course/showClassInformation','showClassInformation')->name('courses.showClassInformation');
      Route::get('manage/course/{id}/edit','edit')->name('courses.edit');
      Route::delete('manage/course/{id}/destroy','destroy')->name('courses.destroy');
      Route::post('manage/course/storeAcademic','storeAcademic')->name('courses.storeAcademic');
      Route::post('manage/course/storeProgram','storeProgram')->name('courses.storeProgram');
      Route::post('manage/course/storeLevel','storeLevel')->name('courses.storeLevel');
      Route::post('manage/course/storeShift','storeShift')->name('courses.storeShift');
      Route::post('manage/course/storeTime','storeTime')->name('courses.storeTime');
      Route::post('manage/course/storeBatch','storeBatch')->name('courses.storeBatch');
      Route::post('manage/course/storeGroup','storeGroup')->name('courses.storeGroup');
      Route::get('manage/course/showLevel','showLevel')->name('courses.showLevel');
    });

    Route::controller(App\Http\Controllers\Admin\StudentController::class)->group(function () {
      Route::get('students/register','studentRegister')->name('students.register');
      Route::post('students/store','studentStore')->name('students.studentStore');
    });
    Route::controller(App\Http\Controllers\Admin\FeeController::class)->group(function () {
      Route::get('students/show/payment','getPayment')->name('students.getPayment');
      Route::get('students/payment','showStudentPayment')->name('students.showStudentPayment');
      Route::get('students/go/to/payment/{student_id}','gotoPayment')->name('students.gotoPayment');
      Route::post('students/save/payment','savePayment')->name('students.savePayment');

      Route::post('students/fee/createFee','createFee')->name('students.createFee');
      Route::get('students/fee/student/pay','pay')->name('students.pay');
      Route::post('students/fee/student/extra/pay','extraPay')->name('students.extra_pay');
      Route::get('students/fee/student/print/invoice/{receipt}','printInvoice')->name('students.printInvoice');
      Route::get('students/fee/student/print/invoice_all/{receipt}','printAllInvoice')->name('students.printAllInvoice');
      Route::get('students/create/student/level','createStudentLevel')->name('students.createStudentLevel');
      Route::get('students/fee/student/transact/delete/{transaction_id}','deleteTransact')->name('students.deleteTransact');
      Route::get('students/fee/student/show/level','showLevelStudent')->name('students.showLevelStudent');

      Route::get('/fee/report','getFeeReport')->name('students.getFeeReport');
      Route::get('/fee/show/report','showFeeReport')->name('students.showFeeReport');
    });

    // Student Report
    Route::controller(App\Http\Controllers\Admin\ReportController::class)->group(function () {
      Route::get('/report/student-list','getStudentList')->name('students.getStudentList');
      Route::get('/report/student-info','showStudentInfo')->name('students.showStudentInfo');
      Route::get('/report/student-multi-class','getStudentListMultiClass')->name('students.getStudentListMultiClass');
      Route::get('/report/student-info-multi-class','showStudentListMultClass')->name('students.showStudentListMultClass');
      Route::get('/student/new/register','getNewStudentRegister')->name('students.getNewStudentRegister');
    });
  });
