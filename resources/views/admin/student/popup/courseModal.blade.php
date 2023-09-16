<div class="modal fade" id="batchModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
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
                      @foreach ($batches as $row)
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
    </div>
  </div>
</div>
