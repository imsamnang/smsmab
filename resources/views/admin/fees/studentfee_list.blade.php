<div class="card">
  <div class="card-header">
    <h4 class="mb-0 text-primary">
      <i class="bx bxs-user me-1 font-22 text-primary"></i>{{ trans('cruds.fee.fields.pay_list') }}
    </h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="datatable" class="table table-striped table-bordered mt-3">
        <thead class="bg-info text-black">
          <tr class="text-center">
            <th>{{ trans('cruds.fee.fields.id') }}</th>
            <th>{{ trans('cruds.course.fields.program') }}</th>
            <th>{{ trans('cruds.transaction.fields.level_id') }}</th>
            <th>{{ trans('cruds.fee.fields.student_fee') }}($)</th>
            <th>{{ trans('cruds.fee.fields.amount') }}($)</th>
            <th>{{ trans('cruds.fee.fields.discount') }}(%)</th>
            <th>{{ trans('cruds.fee.fields.paid') }}($)</th>
            <th>{{ trans('cruds.transaction.fields.balance') }}($)</th>
            <th>{{ trans('global.action') }}</th>
          </tr>
        </thead>
        <tbody id="student_fees">
          @foreach ($readStudentFee as $key => $row)
            <tr data-id="" id="sfeeId" class="text-center">
              <td>{{ $key+1 }}</td>
              <td>{{ $row->program }}</td>
              <td>{{ $row->level }}</td>
              <td>$ {{number_format($row->school_fee,2)}}</td>
              <td>$ {{ number_format($row->student_amount,2) }}</td>
              <td>{{ $row->discount }}%</td>
              <td>
                $ {{number_format($readStudentTransaction->where('s_fee_id',$row->s_fee_id)->sum('paid'),2) }}
                <input type="hidden" name="b" id="b">
              </td>
              <td style="text-align: center;color: red;">
                $ {{number_format($row->student_amount-$readStudentTransaction->where('s_fee_id',$row->s_fee_id)->sum('paid'),2)}}
              </td>
              <td>
                <div class="d-flex align-items-center gap-2 fs-6">
                  <a id="objectEdit" data-id-update-student-fee="{{ $row->s_fee_id }}" href="" class="text-success" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  <a id="objectDelete" data-id-paid="{{ $row->s_fee_id }}" data-value=" {{$row->student_amount-$readStudentTransaction->where('s_fee_id',$row->s_fee_id)->sum('paid')}}" href="" class="objectDelete text-danger btn-paid" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Paid-{{$row->student_amount-$readStudentTransaction->where('s_fee_id',$row->s_fee_id)->sum('paid')}}" aria-label="Paid">
                    <i class="fa-regular fa-circle-dollar"></i>
                  </a>
                  <a id="objectShow" data-bs-toggle="collapse" data-bs-target="#detail{{$key }}" class="accordion-toggle objectShow text-primary" data-id="{{ $row->id }}" href="javascript:void(0)" style="cursor: pointer; }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="9" class="hiddenRow">
                @include('admin.fees.transaction_list')
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer">

  </div>
</div>
