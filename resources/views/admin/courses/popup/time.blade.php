<div class="modal fade" id="timeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="frmTime" action="{{ route('admin.'.$crudRoutePath.'.storeTime') }}" method="post">
        {{ csrf_field() }}
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="object_id" id="object_id">
          {{-- <input type="hidden" name="crudRoutePath" id="crudRoutePath" value="{{ $crudRoutePath }}"> --}}
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label for="time" class="form-control-label">{{ trans('cruds.course.fields.time') }}: <span class="text-danger">*</span></label>
                <input id="time" name="time" class="form-control" type="text" placeholder="{{ trans('cruds.course.fields.time') }} {{ trans('cruds.course.title_singular') }}">
                <span class="text-danger error-text time_error"></span>
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
