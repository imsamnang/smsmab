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
  <style>
    .academic_detail{
      text-align: center;
      font-size: 16px;
      font-weight: 500;
      color: #ff0000
    }
    .hiddenRow {
    	padding: 0 !important;
    	margin: 0 !important;
		}
  </style>
@endpush

@section('content')
  @section('breadcrumb','Student Registration')

  <div class="card border-end">
    <div class="card-header">
      <h4 class="mb-0 text-primary"><i class="bx bxs-user me-1 font-22 text-primary"></i>{{ trans('cruds.student.title') }}
      </h4>
      <div class="row my-3">
        <div class="col-xl-3 col-lg-3">
          <form id="frmCrudObject" action="{{route('admin.students.showStudentPayment')}}" method="get">
            <div class="form-group">
              <input  id="student_id" value="{{ $student_id }}" name="student_id" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.id') }}" />
            </div>
          </form>
        </div>
        <div class="col-xl-3 col-lg-3">
          <div class="form-group">
            <div class="row">
              <label for="student_name" class="form-control-label mt-1 col-xl-3 col-lg-3"><strong>{{ trans('cruds.student.fields.name') }}:</strong></label>
              <div class="col-xl-9 col-lg-9">
                <label for="student_name" class="form-control-label mt-1">
                  <strong>{{ $status->first_name .' '. $status->last_name }}</strong>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3">
          <div class="form-group">
            <div class="row">
              <label for="payment_date" class="form-control-label mt-1 col-xl-3 col-lg-3"><strong>{{ trans('cruds.student.fields.date') }}:</strong></label>
              <div class="col-xl-9 col-lg-9">
                <label for="payment_date" class="form-control-label mt-1">
                  {{ date('d-M-Y') }}
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3">
          <div class="form-group">
            <div class="row">
              <label for="invoice_number" class="form-control-label mt-1 col-xl-4 col-lg-4"><strong>{{ trans('cruds.student.fields.receipt') }}:</strong></label>
              <div class="col-xl-8 col-lg-8">
                <label for="invoice_number" class="form-control-label mt-1">
                  {{ sprintf('%05d',$receipt_id) }}
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form id="frmPayment" action="{{ count($readStudentFee)!=0 ? route('admin.students.extra_pay'):route('admin.students.savePayment') }}" method="POST">
      @csrf
      <div class="card-body">
        <div class="table-responsive">
          <div class="academic_detail">
            {{ $status->program }} / Level: {{ $status->level }} /
            Shift: {{ $status->shift }} / Time: {{ $status->time }} /
            Batch: {{ $status->batch }} / Group: {{ $status->group }}
          </div>
          <table id="datatable" class="table table-striped table-bordered mt-3">
            <thead>
              <tr class="text-center">
                <th>{{ trans('cruds.course.fields.program') }}</th>
                <th>{{ trans('cruds.course.fields.level') }}</th>
                <th>{{ trans('cruds.fee.fields.student_fee') }}($)</th>
                <th>{{ trans('cruds.fee.fields.amount') }}($)</th>
                <th>{{ trans('cruds.fee.fields.discount') }}(%)</th>
                <th>{{ trans('cruds.fee.fields.paid') }}($)</th>
                <th>{{ trans('cruds.fee.fields.amount_lack') }}($)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="form-group">
                    <select class="form-control d" name="program_id" id="Program_ID">
                      <option value="">----------------------------</option>
                      @foreach ($programs as $row)
                        <option value="{{$row->program_id}}" {{ $row->program_id==$status->program_id ?'selected':'' }} >{{$row->program}}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <select class="form-control d" name="level_id" id="Level_ID">
                      <option value="">----------------------------</option>
                      @foreach ($levels as $row)
                        <option value="{{$row->level_id}}" {{ $row->level_id==$status->level_id ?'selected':'' }}>{{$row->level}}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
                <td>
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text create-fee" id="create-fee" title="Create Fee" style="cursor: pointer;color: blue; padding: 0px 10px; border-right: none;">$</span>
                    <input value="{{ $studentfee->amount??null }}" readonly="true"  id="Fee" name="student_fee" type="text" class="form-control d" placeholder="{{ trans('cruds.fee.fields.student_fee') }}($)" aria-label="{{ trans('cruds.fee.fields.student_fee') }}" aria-describedby="addon-wrapping">
                    <input type="hidden" value="{{ $studentfee->fee_id ?? null}}" name="fee_id" id="FeeID">
                    <input type="hidden" value="{{ $status->student_id }}" name="student_id" id="student_id">
                    <input type="hidden" value="{{ $status->level_id ?? null}}" name="level_id" id="LevelID">
                    <input type="hidden" value="{{ Auth::id() }}" name="user_id" id="user_id">
                    <input type="hidden" value="{{ date('Y-m-d H:i:s') }}" name="transaction_date" id="transaction_date">
                    <input type="hidden" value="" name="s_fee_id" id="s_fee_id">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input  id="Amount" name="amount" type="text" class="form-control d" placeholder="{{ trans('cruds.fee.fields.amount') }}($)" />
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input  id="Discount" name="discount" type="text" class="form-control d" placeholder="{{ trans('cruds.fee.fields.discount') }}(%)" />
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input  id="Paid" name="paid" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.paid') }}($)" />
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input  id="Lack" name="lack" readonly="true" type="text" class="form-control" placeholder="{{ trans('cruds.fee.fields.amount_lack') }}($)" />
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
      <div class="card-footer mb-3">
        <div class="form-group text-center mb-3">
          <div class="d-flex align-items-center gap-2 fs-6">
            <button id="btnObjectReset" type="button" value="Reset" class="btn btn-sm btn-outline-success px-3 radius-30 float-end">
              <i class="fa-regular fa-pen-to-square"></i>&nbsp;{{ trans('global.reset') }}
            </button>
            <button id="btnObjectSave" type="submit" class="btn btn-sm btn-outline-primary px-3 radius-30 float-start">
              <i class="fa-regular fa-circle-plus"></i></i>&nbsp;{{ count($readStudentFee)!=0? trans('global.extra_pay'): trans('global.save') }}
            </button>
            @if (count($readStudentFee)!=0)
              <a id="objectPrint" href="{{ route('admin.students.printAllInvoice',$receipt_id) }}" target="_blank" class="btn  btn-sm btn-primary px-3 radius-30 text-white" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Print" aria-label="Views">
                <i class="fa-regular fa-print"></i> Print
              </a>
            @endif
          </div>
        </div>
      </div>
    </form>
  </div>

  @if (count($readStudentFee)!=0)
    @include('admin.fees.studentfee_list')
    <input type="hidden" value="0" id="disabled">
  @endif
  @include('admin.fees.createFeeModal')
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
  @include('admin.fees.calculate')
  @include('admin.fees.payment_script')
@endpush
