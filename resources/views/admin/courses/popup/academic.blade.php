<div class="modal fade" id="academicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="frmAcademic" action="{{ route('admin.'.$crudRoutePath.'.storeAcademic') }}" method="post">
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
                <label for="academic" class="form-control-label mb-1">{{ trans('cruds.course.fields.academic') }}: <span class="text-danger">*</span></label>
                <input id="academic" name="academic" class="form-control" type="text" placeholder="{{ trans('cruds.course.fields.academic') }} {{ trans('cruds.course.title_singular') }}">
                <span class="text-danger error-text academic_error"></span>
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
