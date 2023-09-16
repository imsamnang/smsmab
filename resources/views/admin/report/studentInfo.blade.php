<table class="table table-bordered table-hover table-striped table-condensed" id="student-info">
  <legend>{{ $classes[0]->program }}</legend>
  <thead>
    <tr>
      <td>#</td>
      <td>Student ID</td>
      <td>Name</td>
      <td>Sex</td>
      <td>Birth Date</td>
    </tr>
  </thead>
  <tbody>
    @foreach ($classes as $key => $c)
      <tr>
        <td>{{ ++$key }}</td>
        <td>{{ sprintf("%05d",$c->student_id) }}</td>
        <td>{{ $c->name }}</td>
        <td>{{ $c->sex }}</td>
        <td>{{ $c->dob }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<script type="text/javaScript">
  $(document).ready(function() {
    $(function() {
      "use strict";
      $(document).ready(function() {
        var table = $('#student-info').DataTable( {
          lengthChange: false,
          buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
        table.buttons().container().appendTo( '#student-info_wrapper .col-md-6:eq(0)' );
      });
    });
  });
</script>
