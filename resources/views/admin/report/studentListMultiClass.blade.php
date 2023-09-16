@extends('admin.admin_layout')

@section('pagetitle','Student Report')

@push('styles')
  <link href="{{ asset('public/assets/backend') }}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <style>
    .academic-detail{
      white-space: normal;
      width: 350px !important;
    }
    legend {
      text-align: center;
      font-size: 16px;
      font-weight: 500;
      color: #0000ff;
    }
    .accordion-button:not(.collapsed)::after{
      background-image: url("../../public/images/plus-icon.png");
    }
  </style>
@endpush

@section('content')
  @section('breadcrumb','Student Report')
  <div class="card">
    <div class="card-header">
      <h4 class="mb-0 text-primary">
        <i class="bx bxs-user me-1 font-22 text-primary"></i>
        {{ trans('cruds.report.fields.student_multi_class') }} {{ trans('cruds.report.title') }}
      </h4>
      <div class="accordion mt-3" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button id="show_class_info" class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
              Student Information
            </button>
          </h2>
        </div>
      </div>
    </div>
    <div class="card-body" style="padding-bottom: 4px;">
      <div class="show-student-info">
      </div>
    </div>
  </div>
  @include('admin.class.classPopup')
@endsection

@push('scripts')
  <script src="{{ asset('public/assets/backend') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  @include('admin.script.scriptClassPopup')
  <script>
    $('#frm-multi-class #btn-go').removeClass('d-none');
    $(document).on('click','#btn-go',function(e){
      e.preventDefault();
      var data = $('#frm-multi-class').serialize();
      $.get("{{ route('admin.students.showStudentListMultClass') }}", data, function (res) {
          $('.show-student-info').empty().append(res);
          $('#classPopupModal').modal('hide');
        }
      );
    })
    // check all
    $(document).on('click','#checkall',function(e){
      $(':checkbox.chk').prop('checked',this.checked);
    })
  </script>
@endpush
