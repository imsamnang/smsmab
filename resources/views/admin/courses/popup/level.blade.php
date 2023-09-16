<div class="modal fade" id="levelModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="frmLevel" action="{{ route('admin.'.$crudRoutePath.'.storeLevel') }}" method="post">
        {{ csrf_field() }}
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="object_id" id="object_id">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <div class="form-group mb-2">
                <label class="form-label">{{ trans('cruds.course.fields.course') }}:<span class="text-danger">*</span></label>
                <select id="new_program" name="new_program" class="single-select form-select form-control" style="width: 100%">
                  <option value="">{{ trans('global.select') }} {{ trans('cruds.course.fields.course') }}</option>
                </select>
                <span class="text-danger error-text program_id_error"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <div class="form-group mb-2">
                <label for="level" class="form-control-label mb-1">{{ trans('cruds.course.fields.level') }}: <span class="text-danger">*</span></label>
                <input id="level" name="level" class="form-control" type="text" placeholder="{{ trans('cruds.course.fields.level') }} {{ trans('cruds.course.title_singular') }}">
                <span class="text-danger error-text level_error"></span>
              </div>
            </div><!-- col-xl-12 -->
          </div>
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <div class="form-group mb-2">
                <label for="description" class="form-control-label mb-1">{{ trans('cruds.course.fields.description') }}:</label>
                <input id="description" name="description" class="form-control" type="text" placeholder="{{ trans('cruds.course.fields.description') }} {{ trans('cruds.course.title_singular') }}">
                <span class="text-danger error-text description_error"></span>
              </div>
            </div><!-- col-xl-12 -->
          </div>
        </div>
        <div class="modal-footer">
          @include('admin.templates.button')
        </div>
      </form>
    </div>
  </div>
</div>
