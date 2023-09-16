@extends('admin.admin_layout')

@push('select2')
  <link href="{{ asset('public/assets/backend') }}/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="{{ asset('public/assets/backend') }}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endpush

@push('styles')
  <link href="{{ asset('public/assets/backend') }}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/plugins/toastrjs/toastr.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/plugins/bootstrap-datetime/css/bootstrap-datetimepicker.css">
  <style>
    .academic-detail{
      white-space: normal;
      width: 500px;
    }
    table>tbody>tr>td {
      vertical-align: middle;
    }
    .action{
      text-align: center;
    }
  </style>
@endpush

@section('content')
  @section('breadcrumb',trans('cruds.course.title'))
  <div class="card">
    <form id="frmCrudObject" action="{{ route('admin.'.$crudRoutePath.'.store') }}" method="post">
      {{ csrf_field() }}
      <div class="card-header bg-primary text-white">
        <h5 class="card-title">{{trans('cruds.course.title')}}</h5>
      </div>
      <div class="card-body">
        <input type="hidden" name="object_id" id="object_id">
        <input type="hidden" name="status" id="status" value="1">
        <input type="hidden" name="crudRoutePath" id="crudRoutePath" value="{{ $crudRoutePath }}">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-3">
            <div class="form-group mb-3 mt-3">
              <label class="form-label">{{ trans('cruds.course.fields.academic') }}</label>
              <div class="input-group">
                <select class="single-select form-select" id="academic_id" name="academic_id" data-placeholder="Choose {{ trans('cruds.course.fields.academic') }}">
                  @foreach ($academics as $row)
                    <option value="{{$row->academic_id}}">{{$row->academic}}</option>
                  @endforeach
                </select>
                <button class="btn btn-outline-primary" type="button" id="add_more_academic">
                  <i class="fadeIn animated bx bx-plus-circle"></i>
                </button>
              </div>
              <span class="text-danger error-text academic_id_error"></span>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-sm-4">
            <div class="mb-3 mt-3">
              <label class="form-label">{{ trans('cruds.course.fields.course') }}</label>
              <div class="input-group">
                <select class="single-select form-select" id="program_id" name="program_id">
                  <option value="">----------------------------</option>
                  @foreach ($programs as $row)
                    <option value="{{$row->program_id}}">{{$row->program}}</option>
                  @endforeach
                </select>
                <button class="btn btn-outline-primary" type="button" id="add_more_course">
                  <i class="fadeIn animated bx bx-plus-circle"></i>
                </button>
              </div>
              <span class="text-danger error-text program_id_error"></span>
            </div>
          </div>
          <div class="col-xl-5 col-lg-5 col-sm-5">
            <div class="mb-3 mt-3">
              <label class="form-label">{{ trans('cruds.course.fields.level') }}</label>
              <div class="input-group">
                <select class="form-control" id="level_id" name="level_id">
                </select>
                <button class="btn btn-outline-primary" type="button" id="add_more_level">
                  <i class="fadeIn animated bx bx-plus-circle"></i>
                </button>
              </div>
              <span class="text-danger error-text level_id_error"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-3">
            <div class="mb-3 mt-3">
              <label class="form-label">{{ trans('cruds.course.fields.shift') }}</label>
              <div class="input-group">
                <select class="single-select form-select" id="shift_id" name="shift_id">
                  @foreach ($shifts as $row)
                    <option value="{{$row->shift_id}}">{{$row->shift}}</option>
                  @endforeach
                </select>
                <button class="btn btn-outline-primary" type="button" id="add_more_shift">
                  <i class="fadeIn animated bx bx-plus-circle"></i>
                </button>
              </div>
              <span class="text-danger error-text shift_id_error"></span>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-sm-4">
            <div class="mb-3 mt-3">
              <label class="form-label">{{ trans('cruds.course.fields.time') }}</label>
              <div class="input-group">
                <select class="single-select form-select" id="time_id" name="time_id">
                  @foreach ($times as $row)
                    <option value="{{$row->time_id}}">{{$row->time}}</option>
                  @endforeach
                </select>
                <button class="btn btn-outline-primary" type="button" id="add_more_time">
                  <i class="fadeIn animated bx bx-plus-circle"></i>
                </button>
              </div>
              <span class="text-danger error-text time_id_error"></span>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-3">
            <div class="mb-3 mt-3">
              <label class="form-label">{{ trans('cruds.course.fields.batch') }}</label>
              <div class="input-group">
                <select class="single-select form-select" id="batch_id" name="batch_id">
                  @foreach ($batchs as $row)
                    <option value="{{$row->batch_id}}">{{$row->batch}}</option>
                  @endforeach
                </select>
                <button class="btn btn-outline-primary" type="button" id="add_more_batch">
                  <i class="fadeIn animated bx bx-plus-circle"></i>
                </button>
              </div>
              <span class="text-danger error-text batch_id_error"></span>
            </div>
          </div>
          <div class="col-xl-2 col-lg-2 col-sm-2">
            <div class="mb-3 mt-3">
              <label class="form-label">{{ trans('cruds.course.fields.group') }}</label>
              <div class="input-group">
                <select class="single-select form-select" id="group_id" name="group_id">
                  @foreach ($groups as $row)
                    <option value="{{$row->group_id}}">{{$row->group}}</option>
                  @endforeach
                </select>
                <button class="btn btn-outline-primary" type="button" id="add_more_group">
                  <i class="fadeIn animated bx bx-plus-circle"></i>
                </button>
              </div>
            </div>
            <span class="text-danger error-text group_id_error"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-3">
            <div class="form-group mb-2">
              <label for="start_date" class="form-control-label mb-2">{{ trans('cruds.course.fields.start_date') }}: <span class="text-danger">*</span></label>
              <div class="input-group mb-2">
                <input  id="start_date" name="start_date" type="text" class="form-control" placeholder="{{ trans('cruds.course.fields.start_date') }}" aria-label="{{ trans('cruds.course.fields.start_date') }}" aria-describedby="basic-addon2"> <span class="input-group-text" id="basic-addon2"><i class="fadeIn animated bx bx-calendar-exclamation"></i></span>
              </div>
              <span class="text-danger error-text start_date_error"></span>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-sm-4">
            <div class="form-group mb-2">
              <label for="end_date" class="form-control-label mb-2">{{ trans('cruds.course.fields.end_date') }}: <span class="text-danger">*</span></label>
              <div class="input-group mb-2">
                <input  id="end_date" name="end_date" type="text" class="form-control" placeholder="{{ trans('cruds.course.fields.end_date') }}" aria-label="{{ trans('cruds.course.fields.end_date') }}" aria-describedby="basic-addon2"> <span class="input-group-text" id="basic-addon2"><i class="fadeIn animated bx bx-calendar-exclamation"></i></span>
              </div>
              <span class="text-danger error-text end_date_error"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-center">
        <button id="btnSaveCourse" type="submit" class="btn btn-sm btn-outline-primary px-3 radius-30"><strong><i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('cruds.course.fields.create_course') }}</strong></button>
      </div>
    </form>
  </div>
  <div class="card">
    <div class="card-header bg-success text-white">
      <h4>Class Information</h4>
    </div>
    <div class="card-body" id="add_class_info">

    </div>
  </div>
  @include('admin.courses.popup.academic')
  @include('admin.courses.popup.program')
  @include('admin.courses.popup.level')
  @include('admin.courses.popup.shift')
  @include('admin.courses.popup.time')
  @include('admin.courses.popup.batch')
  @include('admin.courses.popup.group')
@endsection

@push('scripts')
  <script src="{{ asset('public/assets/backend') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/select2/js/select2.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/toastrjs/toastr.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/momentjs/moment.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/bootstrap-datetime/js/bootstrap-datetimepicker.min.js"></script>
  <script>
    var today_date = new Date();
    var yy = today_date.getFullYear();
    var mm =  (today_date.getMonth() + 1).toString().padStart(2, "0");
    var dd = today_date.getDate().toString().padStart(2, "0");
    $(function() {
      "use strict";
      $(document).ready(function() {
        var table = $('#datatable').DataTable( {
          lengthChange: false,
          buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
        table.buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
        $('[data-bs-toggle="tooltip"]').tooltip();
        $('#start_date').datetimepicker({
          format: 'YYYY-MM-DD',
          sideBySide: true,
          icons: {
            up: 'bx bx-chevron-up-circle',
            down: 'bx bx-chevron-down-circle',
            previous: 'bx bx-chevron-left-circle',
            next: 'bx bx-chevron-right-circle'
          }
        }).on('dp.change', function(e){
          if( !e.oldDate || !e.date.isSame(e.oldDate, 'day')){
            $(this).data('DateTimePicker').hide();
          }
        });
        var today = yy + '-' + mm + '-'+ dd;
        $('#start_date').val(today);
        $('#end_date').datetimepicker({
          format: 'YYYY-MM-DD',
          sideBySide: true,
          icons: {
            up: 'bx bx-chevron-up-circle',
            down: 'bx bx-chevron-down-circle',
            previous: 'bx bx-chevron-left-circle',
            next: 'bx bx-chevron-right-circle'
          }
        }).on('dp.change', function(e){
          if( !e.oldDate || !e.date.isSame(e.oldDate, 'day')){
            $(this).data('DateTimePicker').hide();
          }
        });
        var today = yy + '-' + mm + '-'+ dd;
        $('#end_date').val(today);
      });
    });
  </script>
  {{-- crud script --}}
  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      showClassInfo();

      $('#add_more_academic').on('click',function(e){
        e.preventDefault();
        $('#academicModal').find('.modal-title').html('{{ trans('global.add') }} {{ trans('cruds.course.fields.academic') }}');
        $('#frmAcademic').find('#object_id').val('');
        $('#frmAcademic').trigger('reset');
        $('#frmAcademic').find('span.level_error').addClass('d-none');
        $('#academicModal').modal('show');
      });
      $('#frmAcademic').on('submit',function(e){
        e.preventDefault();
        $('#frmAcademic').find('span.text-danger').removeClass('d-none');
        var actionUrl = $(this).attr('action');
        var method = $(this).attr('method')
        $('#btnObjectSave').html('Processing..');
        $('#btnObjectUpdate').html('Processing..');
        var academic = $('#academic').val();
        $.post(actionUrl,{academic:academic},function(res){
          if(res.status==400){
            $.each(res.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          } else {
            $('#academic_id').append($("<option/>",{
              value:res.data.academic_id,
              text :res.data.academic
            }));
            if ($('#frmCrudObject #academic_id').find("option[value='" + res.data.academic_id + "']").length) {
              $('#academic_id').val(res.data.academic_id).trigger('change');
            }
            $('#frmAcademic').trigger("reset");
            $('#academicModal').modal('hide');
            $('#btnObjectSave').html('{{ trans('global.save') }}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
            toastr.success(res.success);
          }
        });
      });
      $('#academic_id').on('change',function(e){
        showClassInfo();
      });

      $('#add_more_course').on('click',function(e){
        e.preventDefault();
        $('#courseModal').find('.modal-title').html('{{ trans('global.add') }} {{ trans('cruds.course.fields.course') }}');
        $('#frmCourse').find('#object_id').val('');
        $('#frmCourse').find('#btnObjectSave').html('<i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('global.save') }}');
        $('#frmCourse').find('#btnObjectSave').removeClass('d-none');
        $('#frmCourse').find('#btnObjectUpdate').addClass('d-none');
        $('#frmCourse').trigger('reset');
        $('#frmCourse').find('span.level_error').addClass('d-none');
        $('#courseModal').modal('show');
      });
      $('#frmCourse').on('submit',function(e){
        e.preventDefault();
        $('#frmCourse').find('span.text-danger').removeClass('d-none');
        var actionUrl = $(this).attr('action');
        var method = $(this).attr('method')
        $('#btnObjectSave').html('Processing..');
        $('#btnObjectUpdate').html('Processing..');
        var program = $('#program').val();
        var description = $('#description').val();
        $.post(actionUrl,{
          program:program,
          description:description
        },function(res){
          if(res.status==400){
            $.each(res.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          } else {
            $('#program_id').append($("<option/>",{
              value:res.data.program_id,
              text :res.data.program
            }));
            if ($('#frmCrudObject #program_id').find("option[value='" + res.data.program_id + "']").length) {
              $('#program_id').val(res.data.program_id).trigger('change');
            }
            $('#frmCourse').trigger("reset");
            $('#courseModal').modal('hide');
            $('#btnObjectSave').html('{{ trans('global.save') }}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
            toastr.success(res.success);
          }
        });
      });

      $('#program_id').on('change',function(e){
        e.preventDefault();
        var program_id = $(this).val();
        $('#level_id').empty();
        $.get("{{route('admin.courses.showLevel')}}",{
          program_id:program_id},function(res){
            $.each(res,function(i,v){
              $('#level_id').append($("<option/>",{
                value:v.level_id,
                text :v.level
              }));
            })
          })
        showClassInfo();
      })

      $('#add_more_level').on('click',function(e){
        e.preventDefault();
        $('#levelModal').find('.modal-title').html('{{ trans('global.add') }} {{ trans('cruds.course.fields.level') }}');
        $('#frmLevel').find('#object_id').val('');
        $('#frmLevel').find('#btnObjectSave').html('<i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('global.save') }}');
        $('#frmLevel').find('#btnObjectSave').removeClass('d-none');
        $('#frmLevel').find('#btnObjectUpdate').addClass('d-none');
        $('#frmLevel').trigger('reset');
        $('#frmLevel').find('span.level_error').addClass('d-none');
        var programs = $('#program_id option');
        var program = $('#frmLevel').find('#new_program');
        $(program).empty();
        $.each(programs,function(i,pro){
          $(program).append($("<option/>",{
            value : $(pro).val(),
            text  : $(pro).text()
          }))
        })
        $('#levelModal').modal('show');
      });
      $('#frmLevel').on('submit',function(e){
        e.preventDefault();
        $('#frmLevel').find('span.text-danger').removeClass('d-none');
        var actionUrl = $(this).attr('action');
        var method = $(this).attr('method')
        $('#btnObjectSave').html('Processing..');
        $('#btnObjectUpdate').html('Processing..');
        var level = $('#level').val();
        var description = $('#frmLevel #description').val();
        var program_id = $('#frmLevel #new_program').val();
        $.post(actionUrl,{
          program_id:program_id,
          level:level,
          description:description,
        },function(res){
          if(res.status==400){
            $.each(res.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          } else {
            $('#level_id').append($("<option/>",{
              value:res.data.level_id,
              text :res.data.level
            }));
            $('#frmLevel').trigger("reset");
            $('#levelModal').modal('hide');
            $('#btnObjectSave').html('{{ trans('global.save') }}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
            toastr.success(res.success);
          }
        });
      });
      $('#level_id').on('change',function(e){
        showClassInfo();
      });

      $('#add_more_shift').on('click',function(e){
        e.preventDefault();
        $('#shiftModal').find('.modal-title').html('{{ trans('global.add') }} {{ trans('cruds.course.fields.shift') }}');
        $('#frmshift').find('#object_id').val('');
        $('#frmshift').find('#btnObjectSave').html('<i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('global.save') }}');
        $('#frmshift').find('#btnObjectSave').removeClass('d-none');
        $('#frmshift').find('#btnObjectUpdate').addClass('d-none');
        $('#frmshift').trigger('reset');
        $('#frmshift').find('span.shift_error').addClass('d-none');
        $('#shiftModal').modal('show');
      });
      $('#frmShift').on('submit',function(e){
        e.preventDefault();
        $('#frmShift').find('span.text-danger').removeClass('d-none');
        var actionUrl = $(this).attr('action');
        var method = $(this).attr('method')
        $('#btnObjectSave').html('Processing..');
        $('#btnObjectUpdate').html('Processing..');
        var shift = $('#shift').val();
        $.post(actionUrl,{
          shift:shift,
        },function(res){
          if(res.status==400){
            $.each(res.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          } else {
            $('#shift_id').append($("<option/>",{
              value:res.data.shift_id,
              text :res.data.shift
            }));
            if ($('#frmCrudObject #shift_id').find("option[value='" + res.data.shift_id + "']").length) {
              $('#shift_id').val(res.data.shift_id).trigger('change');
            }
            $('#frmShift').trigger("reset");
            $('#shiftModal').modal('hide');
            $('#btnObjectSave').html('{{ trans('global.save') }}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
            toastr.success(res.success);
          }
        });
      });
      $('#shift_id').on('change',function(e){
        showClassInfo();
      });

      $('#add_more_time').on('click',function(e){
        e.preventDefault();
        $('#timeModal').find('.modal-title').html('{{ trans('global.add') }} {{ trans('cruds.course.fields.time') }}');
        $('#frmtime').find('#object_id').val('');
        $('#frmtime').find('#btnObjectSave').html('<i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('global.save') }}');
        $('#frmtime').find('#btnObjectSave').removeClass('d-none');
        $('#frmtime').find('#btnObjectUpdate').addClass('d-none');
        $('#frmtime').trigger('reset');
        $('#frmtime').find('span.text-danger').addClass('d-none');
        $('#timeModal').modal('show');
      });
      $('#frmTime').on('submit',function(e){
        e.preventDefault();
        $('#frmTime').find('span.text-danger').removeClass('d-none');
        var actionUrl = $(this).attr('action');
        var method = $(this).attr('method')
        $('#btnObjectSave').html('Processing..');
        $('#btnObjectUpdate').html('Processing..');
        var time = $('#time').val();
        $.post(actionUrl,{
          time:time,
        },function(res){
          if(res.status==400){
            $.each(res.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          } else {
            $('#time_id').append($("<option/>",{
              value:res.data.time_id,
              text :res.data.time
            }));
            if ($('#frmCrudObject #time_id').find("option[value='" + res.data.time_id + "']").length) {
              $('#time_id').val(res.data.time_id).trigger('change');
            }
            $('#frmTime').trigger("reset");
            $('#timeModal').modal('hide');
            $('#btnObjectSave').html('{{ trans('global.save') }}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
            toastr.success(res.success);
          }
        });
      });
      $('#time_id').on('change',function(e){
        showClassInfo();
      });

      $('#add_more_batch').on('click',function(e){
        e.preventDefault();
        $('#batchModal').find('.modal-title').html('{{ trans('global.add') }} {{ trans('cruds.course.fields.batch') }}');
        $('#frmbatch').find('#object_id').val('');
        $('#frmbatch').find('#btnObjectSave').html('<i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('global.save') }}');
        $('#frmbatch').find('#btnObjectSave').removeClass('d-none');
        $('#frmbatch').find('#btnObjectUpdate').addClass('d-none');
        $('#frmbatch').trigger('reset');
        $('#frmbatch').find('span.text-danger').addClass('d-none');
        $('#batchModal').modal('show');
      });
      $('#frmBatch').on('submit',function(e){
        e.preventDefault();
        $('#frmBatch').find('span.text-danger').removeClass('d-none');
        var actionUrl = $(this).attr('action');
        var method = $(this).attr('method')
        $('#btnObjectSave').html('Processing..');
        $('#btnObjectUpdate').html('Processing..');
        var batch = $('#batch').val();
        $.post(actionUrl,{
          batch:batch,
        },function(res){
          if(res.status==400){
            $.each(res.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          } else {
            $('#batch_id').append($("<option/>",{
              value:res.data.batch_id,
              text :res.data.batch
            }));
            if ($('#frmCrudObject #batch_id').find("option[value='" + res.data.batch_id + "']").length) {
              $('#batch_id').val(res.data.batch_id).trigger('change');
            }
            $('#frmBatch').trigger("reset");
            $('#batchModal').modal('hide');
            $('#btnObjectSave').html('{{ trans('global.save') }}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
            toastr.success(res.success);
          }
        });
      });
      $('#batch_id').on('change',function(e){
        showClassInfo();
      });

      $('#add_more_group').on('click',function(e){
        e.preventDefault();
        $('#groupModal').find('.modal-title').html('{{ trans('global.add') }} {{ trans('cruds.course.fields.group') }}');
        $('#frmgroup').find('#object_id').val('');
        $('#frmgroup').find('#btnObjectSave').html('<i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('global.save') }}');
        $('#frmgroup').find('#btnObjectSave').removeClass('d-none');
        $('#frmgroup').find('#btnObjectUpdate').addClass('d-none');
        $('#frmgroup').trigger('reset');
        $('#frmgroup').find('span.text-danger').addClass('d-none');
        $('#groupModal').modal('show');
      });
      $('#frmGroup').on('submit',function(e){
        e.preventDefault();
        $('#frmGroup').find('span.text-danger').removeClass('d-none');
        var actionUrl = $(this).attr('action');
        var method = $(this).attr('method')
        $('#btnObjectSave').html('Processing..');
        $('#btnObjectUpdate').html('Processing..');
        var group = $('#group').val();
        $.post(actionUrl,{
          group:group,
        },function(res){
          if(res.status==400){
            $.each(res.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          } else {
            $('#group_id').append($("<option/>",{
              value:res.data.group_id,
              text :res.data.group
            }));
            if ($('#frmCrudObject #group_id').find("option[value='" + res.data.group_id + "']").length) {
              $('#group_id').val(res.data.group_id).trigger('change');
            }
            $('#frmGroup').trigger("reset");
            $('#groupModal').modal('hide');
            $('#btnObjectSave').html('{{ trans('global.save') }}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
            toastr.success(res.success);
          }
        });
      });
      $('#group_id').on('change',function(e){
        showClassInfo();
      });

      $('#frmCrudObject').on('submit',function(e){
        e.preventDefault();
        $('#frmCrudObject').find('span.text-danger').removeClass('d-none');
        var actionUrl = $(this).attr('action');
        var method = $(this).attr('method')
        $('#btnObjectSave').html('Processing..');
        $('#btnObjectUpdate').html('Processing..');
        $.ajax({
          type: method,
          url: actionUrl,
          data: new FormData(this),
          dataType:'json',
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            $(document).find('span.error-text').text('');
          },
          success: function (res) {
            if(res.status==400){
              $.each(res.error, function(prefix, val){
                $('span.'+prefix+'_error').text(val[0]);
              });
            } else {
              if(res.type == 'store-object'){
                showClassInfo();
              }else{
                showClassInfo();
                form.find('#object_id').val('');
              }
              $('#frmCrudObject').trigger("reset");
              $('#crudObjectModal').modal('hide');
              $('#btnObjectSave').html('{{ trans('global.save') }}');
              $('#btnObjectUpdate').html('{{ trans('global.update') }}');
              toastr.success(res.success);
            }
          },
          error: function (error) {
            console.log('Error:', error);
            $('#btnObjectSave').html('{{ trans('global.save')}}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
          }
        });
      });

      $('body').on('click', '.objectDelete', function (e) {
        e.preventDefault();
        var object_id = $(this).data("id");
        var link = $(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              type: "DELETE",
              url:link,
              success: function (res) {
                $("#tr_object_id_" + object_id).remove();
                toastr.success(res.success);
              },
              error: function (res) {
                console.log('Error:', res);
              }
            });
          }
        })
      });

      $('body').on('click', 'a#editCourse', function (e) {
        e.preventDefault();
        $('#frmCrudObject').find('#btnObjectSave').addClass('d-none');
        $('#frmCrudObject').find('#btnObjectUpdate').removeClass('d-none');
        $('#frmCrudObject').find('#btnObjectUpdate').html('<i class="fadeIn animated bx bx-edit"></i>&nbsp;{{ trans('global.update') }}');
        $('#frmCrudObject').trigger('reset');
        var object_id = $(this).data('id');
        var form = $('#frmCrudObject');
        var modal = $('#crudObjectModal');
        var actionUrl = $(this).attr('href');
        modal.find('.modal-title').html('{{ trans('global.edit') }} {{ trans('cruds.course.title_singular') }}');
        $.get(actionUrl, function (res) {
          console.log(res)
          form.find('#object_id').val(res.data.class_id);
          $('#academic_id').val(res.data.academic_id);
          $('#program_id').val(res.data.program_id);
          $('#level_id').empty().append($('<option/>',{
            value :res.data.level_id,
            text : res.data.level
          }));
          $('#shift_id').val(res.data.shift_id);
          $('#time_id').val(res.data.time_id);
          $('#batch_id').val(res.data.batch_id);
          $('#group_id').val(res.data.group_id);
          $('#start_date').val(res.data.start_date);
          $('#end_date').val(res.data.end_date);
          modal.modal('show');
        })
      });

      function showClassInfo(){
        var data = $('#frmCrudObject').serialize();
        $.get("{{route('admin.courses.showClassInformation')}}",data,function(res){
          $('#add_class_info').empty().append(res);
          mergeCommonRows($('#table_class_info'));
        });
      }

      function mergeCommonRows(table){
        var firstColumnBrakers = [];
        $.each(table.find('th'),function(i){
          var previous = null, cellToExtend = null,rowspan =1;
          table.find("td:nth-child(" + i + ")").each(function(index, e){
          var jthis= $(this), content = jthis.text();
            if(previous == content && content !=="" && $.inArray(index,firstColumnBrakers)=== -1 ){
              jthis.addClass('hidden');
              cellToExtend.attr("rowspan",(rowspan=rowspan+1));
            } else {
              if(i==-1) firstColumnBrakers.push(index);
              rowspan=1;
              previous = content;
              cellToExtend = jthis;
            }
          });
        });
        $('td.hidden').remove();
      }
    });
  </script>
@endpush
