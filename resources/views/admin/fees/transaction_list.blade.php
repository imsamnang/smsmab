  <div class="accordian-body collapse {{ $key==0 ? null : 'collapsed' }}" id="detail{{ $key }}">
    <div class="table-responsive">
      <table id="more_detail" class="table table-striped table-bordered">
        <thead class="bg-secondary text-white">
          <tr class="text-center">
            <th style="text-align: center;">{{ trans('cruds.transaction.fields.id') }}</th>
            <th>{{ trans('cruds.transaction.fields.transaction_date') }}</th>
            <th>{{ trans('cruds.transaction.fields.user_id') }}</th>
            <th>{{ trans('cruds.transaction.fields.paid') }}</th>
            <th>{{ trans('cruds.transaction.fields.remark') }}</th>
            <th>{{ trans('cruds.transaction.fields.description') }}</th>
            <th style="text-align: center;">{{ trans('global.action') }}</th>
          </tr>
        </thead>
        <tbody id="transaction_detail">
          @foreach ($readStudentTransaction->where('s_fee_id',$row->s_fee_id) as $num => $detail)
            <tr>
              <td style="text-align: center;">{{++$num}}</td>
              <td>{{ $detail->transaction_date}}</td>
              <td>{{ $detail->name}}</td>
              <td>$ {{number_format($detail->paid)}}</td>
              <td>{{$detail->remark}}</td>
              <td>{{$detail->description}}</td>
              <td>
                <div class="d-flex align-items-center gap-2 fs-6">
                  {{-- @can($prefix.'show') --}}
                    {{-- <a id="objectShow" data-id="{{ $detail->id }}" href="#" class="objectShow text-primary" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a> --}}
                  {{-- @endcan
                  @can($prefix.'edit') --}}
                    <a id="objectEdit" data-id="{{ $detail->id }}" href="#" class="objectEdit text-warning" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                  {{-- @endcan
                  @can($prefix.'delete') --}}
                    <a id="objectDelete" href="{{ route('admin.students.deleteTransact',$detail->transaction_id) }}" class="objectDelete text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete Transaction{{ $detail->receipt_id }}" aria-label="Delete">
                      <i class="fa-regular fa-trash-can"></i>
                    </a>
                  {{-- @endcan --}}
                  <a id="objectPrint" href="{{ route('admin.students.printInvoice',$detail->receipt_id) }}"  target="_blank" class="objectShow text-primary" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Print Invoice{{ $detail->receipt_id }}" aria-label="Views">
                    <i class="fa-regular fa-print"></i>
                  </a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
