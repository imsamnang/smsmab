<div class="table-responsive">
  <table id="table_class_info" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>{{ trans('cruds.course.fields.id') }}</th>
        <th>{{ trans('cruds.course.fields.program') }}</th>
        <th>{{ trans('cruds.course.fields.level') }}</th>
        <th>{{ trans('cruds.course.fields.shift') }}</th>
        <th>{{ trans('cruds.course.fields.time') }}</th>
        {{-- <th>{{ trans('cruds.course.fields.batch') }}</th>
        <th>{{ trans('cruds.course.fields.group') }}</th> --}}
        <th>{{ trans('cruds.course.fields.detail') }}</th>
        <th id="hidden">{{ trans('global.action') }}</th>
        <th>
          <input type="checkbox" name="checkall" id="checkall">
        </th>
      </tr>
    </thead>
    <tbody id="objectList">
      @foreach ($classes as $row)
        <tr id="tr_object_id_{{ $row->class_id }}">
          <td>{{ $row->class_id }}</td>
          <td>{{ $row->program }}</td>
          <td>{{ $row->level }}</td>
          <td>{{$row->shift}}</td>
          <td>{{ $row->time }}</td>
          {{-- <td>{{ $row->batch }}</td>
          <td>{{ $row->group }}</td> --}}
          <td class="academic-detail">
            <a href="{{route('admin.courses.edit',$row->class_id)}}" data-id="{{$row->class_id}}" id="editCourse">
              {{trans('cruds.course.fields.program')}}:{{$row->program}}/
              {{trans('cruds.course.fields.level')}}:{{$row->level}}/
              {{trans('cruds.course.fields.shift')}}:{{$row->shift}}/
              {{trans('cruds.course.fields.time')}}:{{$row->time}}/
              {{-- {{trans('cruds.course.fields.batch')}}:{{$row->batch}}/
              {{trans('cruds.course.fields.group')}}:{{$row->group}}/ --}}
              {{trans('cruds.course.fields.start_date')}}:{{$row->start_date}}/
              {{trans('cruds.course.fields.end_date')}}:{{$row->end_date}}
            </a>
          </td>
          <td class="action">
            <div class="gap-3 fs-6">
              @can($prefix.'delete')
                <a id="objectDelete" data-id="{{ $row->class_id }}" href="{{ route('admin.'.$crudRoutePath.'.destroy',$row->class_id) }}" class="objectDelete text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
              @endcan
            </div>
          </td>
          <td>
            <input type="checkbox" name="chk[]" id="chk" class="chk" value="{{ $row->class_id }}">
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
