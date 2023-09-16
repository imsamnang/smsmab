<style type="text/css">
	.table-free{
		border: none;
	}
	.table-fee tr, td ,th{
		border:none;
	}
</style>

<div class="modal fade" id="createFeeOpup" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <form action="{{ route('admin.students.createFee') }}" method="POST" id="frmFee">
        {{csrf_field()}}
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">
          Create School Fee
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="table-responsive">
            {{-- -----------Start Table------------ --}}
            <table id="datatable" class="table table-bordered mt-3">
              <tr>
                <td>
                  <label for="feetype" class="form-control-label">
                    {{-- {{ trans('cruds.customer.fields.customer_code') }} --}}
                    Fee Type
                  </label>
                </td>
                <td>
                  <div class="form-group">
                    <select class="single-select form-select" name="fee_type_id" id="fee_type_id" readonly="true">
                      @foreach ($feetypes as $key => $ft)
                        <option value="{{$ft->fee_type_id}}">{{$ft->fee_type}}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="feeheading" class="form-control-label">
                    {{-- {{ trans('cruds.customer.fields.customer_code') }} --}}
                    Fee Heading
                  </label>
                </td>
                <td>
                  <input value="School Fees" disabled="true" class="form-control" type="text">
                  <input type="hidden" name="fee_heading" id="fee_heading" value="School Fees" readonly="true">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="academicyear" class="form-control-label">
                    {{-- {{ trans('cruds.customer.fields.customer_code') }} --}}
                    Academic Year
                  </label>
                </td>
                <td>
                  <input type="text" value="{{$status->academic}}" class="form-control" disabled="true">
                  <input type="hidden" name="academic_id" id="academic_id" value="{{$status->academic_id}}">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="program" class="form-control-label">
                    {{-- {{ trans('cruds.customer.fields.customer_code') }} --}}
                    Program
                  </label>
                </td>
                <td>
                  <input type="text" value="{{$status->program}}" class="form-control" disabled="true">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="level" class="form-control-label">
                    {{-- {{ trans('crLeveluds.customer.fields.customer_code') }} --}}
                    Level
                  </label>
                </td>
                <td>
                  <input type="text" value="{{$status->level}}" class="form-control" disabled="true">
                  <input type="hidden" name="level_id" value="{{ $status->level_id}}" readonly="true">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="schoolfee" class="form-control-label">
                    {{-- {{ trans('crLeveluds.customer.fields.customer_code') }} --}}
                    School Fee($)
                  </label>
                </td>
                <td>
                  <input type="text" name="amount" id="amount" autocomplete="off" class="form-control" placeholder="Amount" required>
                </td>
              </tr>
            </table>
            {{-- ------------------End Table---------------- --}}
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        @include('admin.templates.button')
      </div>
      </form>
    </div>
	</div>
</div>
