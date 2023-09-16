@extends('admin.admin_layout')

@push('select2')
  <link href="{{ asset('public/assets/backend') }}/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="{{ asset('public/assets/backend') }}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endpush

@push('styles')
  <link href="{{ asset('public/assets/backend') }}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/css/toggle.css">
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/plugins/toastrjs/toastr.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/plugins/jquery-datetime/jquery.datetimepicker.min.css">
  <style type="text/css" media="screen">
    .student-photo{
      height: 160px;
      padding-left: 1px;
      padding-right: 1px;
      border: 1px solid #ccc;
      background: #eee;
      width: 180px;
      margin: 0 auto;
    }
    .photo > input[type='file']{
      display: none;
    }
    .photo {
      width: 30px;
      height: 30px;
      border-radius: 100%;
    }
    .student-id{
      background-repeat: repeat-x;
      border-color: #ccc;
      padding: 5px;
      text-align: center;
      background: #eee;
      border-bottom: 1px solid #ccc;
    }
    .btn-browse{
      border-color: #ccc;
      padding: 5px;
      text-align: center;
      background: #eee;
      border-bottom: 1px solid #ccc;
    }
    fieldset{
      margin-top: 5px;
    }
    fieldset legend {
      display: block;
      width: 100%;
      padding:0;
      font-size: 15px;
      line-height: inherit;
      color: #797979;
      border:0;
      border-bottom: 1px solid #e5e5e5;
    }
  </style>
  <style>
    .academic-detail{
      white-space: normal;
      width: 350px !important;
    }
    table>tbody>tr>td {
      vertical-align: middle;
    }
    .action{
      text-align: center;
    }
    .accordion-button:not(.collapsed)::after{
      background-image: url("../../public/images/plus-icon.png");
    }
  </style>
@endpush

@section('content')
  @section('breadcrumb','Student Registration')
    <div class="card">
      <div class="card-header">
        <h4 class="mb-0 text-primary"><i class="bx bxs-user me-1 font-22 text-primary"></i>{{ trans('cruds.student.title') }}
        </h4>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <form id="frmCrudObject" action="{{route('admin.students.showStudentPayment')}}" method="get">
            <div class="col-xl-3 col-lg-3">
              <div class="form-group">
                <input  id="student_id" name="student_id" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.id') }}" />
              </div>
            </div>
          </form>
          <div class="col-xl-3 col-lg-3">
            <div class="form-group">
              <div class="row">
                <label for="start_date" class="form-control-label mt-1 col-xl-3 col-lg-3"><strong>{{ trans('cruds.student.fields.name') }}</strong></label>
                <div class="col-xl-9 col-lg-9">
                  <label for="start_date" class="form-control-label mt-1">
                    Samnang Oudompanha
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3">
            <div class="form-group">
              <div class="row">
                <label for="start_date" class="form-control-label mt-1 col-xl-3 col-lg-3"><strong>{{ trans('cruds.student.fields.date') }}</strong></label>
                <div class="col-xl-9 col-lg-9">
                  <label for="start_date" class="form-control-label mt-1">
                    {{ date('d-M-Y') }}
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3">
            <div class="form-group">
              <div class="row">
                <label for="start_date" class="form-control-label mt-1 col-xl-3 col-lg-3"><strong>{{ trans('cruds.student.fields.receipt') }}</strong></label>
                <div class="col-xl-9 col-lg-9">
                  <label for="start_date" class="form-control-label mt-1">
                    {{ date('d-M-Y') }}
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="fee_id" id="FeeID">
        <input type="hidden" name="student_id" id="studentID">
        <input type="hidden" name="level_id" id="levelID">
        <input type="hidden" name="user_id" id="userID">
        <input type="hidden" name="transaction_date" id="transactionDate">
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr class="text-center">
                <th>{{ trans('cruds.course.fields.program') }}</th>
                <th>{{ trans('cruds.course.fields.level') }}</th>
                <th>{{ trans('cruds.fee.fields.student_fee') }}</th>
                <th>{{ trans('cruds.fee.fields.amount') }}</th>
                <th>{{ trans('cruds.fee.fields.discount') }}</th>
                <th>{{ trans('cruds.fee.fields.paid') }}</th>
                <th>{{ trans('cruds.fee.fields.amount_lack') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="form-group">
                    <select class="single-select form-select" id="AcademicID" name="academic_id">
                      <option value="">----------------------------</option>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <select class="single-select form-select" id="level_id" name="level_id">
                      <option value="">----------------------------</option>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input readonly="true"  id="student_fee" name="student_fee" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.student_fee') }}" />
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input  id="Amount" name="amount" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.amount') }}" />
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input  id="Discount" name="discount" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.discount') }}" />
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input  id="Paid" name="paid" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.paid') }}" />
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input  id="Lack" name="lack" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.amount_lack') }}" />
                  </div>
                </td>
              </tr>
            </tbody>
            <thead>
              <tr class="text-center">
                <th colspan="3">{{ trans('cruds.fee.fields.remark') }}</th>
                <th colspan="4">{{ trans('cruds.fee.fields.description') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="3">
                  <div class="form-group">
                    <input  id="remark" name="remark" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.remark') }}" />
                  </div>
                </td>
                <td colspan="4">
                  <div class="form-group">
                    <input  id="description" name="description" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.description') }}" />
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
  <script src="{{ asset('public/assets/backend') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/select2/js/select2.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/toastrjs/toastr.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/momentjs/moment.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/jquery-datetime/jquery.datetimepicker.full.min.js"></script>
  <script>
    var today_date = new Date();
    var yy = today_date.getFullYear();
    var dd = today_date.getDate().toString().padStart(2, "0");
    var mm =  (today_date.getMonth() + 1).toString().padStart(2, "0");
    var hh = today_date.getHours().toString().padStart(2, "0");
    var mn = today_date.getMinutes().toString().padStart(2, "0");
    var ss = today_date.getSeconds().toString().padStart(2, "0");
    var today = dd + '-' + mm + '-' + yy + " " + hh + ":" + mn + ":" + ss;
  </script>

@endpush
