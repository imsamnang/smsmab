<script type="text/Javascript">
  $(document).ready(function () {
    showClassInfo()
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#academic_id').on('change',function(e){
      showClassInfo();
    });
    $('#program_id').on('change',function(e){
      e.preventDefault();
      var program_id = $(this).val();
      $('#level_id').empty();
      $.get("{{route('admin.courses.showLevel')}}",{
        program_id:program_id},function(res){
          $.each(res,function(i,v){
            $('#level_id').append($("<option/>",{
              value:v.level_id,
              text :v.level
            }));
          })
        })
      showClassInfo();
    });
    $('#level_id').on('change',function(e){
      showClassInfo();
    });
    $('#shift_id').on('change',function(e){
      showClassInfo();
    });
    $('#time_id').on('change',function(e){
      showClassInfo();
    });
    $('#batch_id').on('change',function(e){
      showClassInfo();
    });
    $('#group_id').on('change',function(e){
      showClassInfo();
    });

    function showClassInfo(){
      var data = $('#frm_view_class').serialize();
      $.get("{{route('admin.courses.showClassInformation')}}",data,function(res){
        $('#add_class_info').empty().append(res);
        $('td.action').addClass('d-none');
        $('th#hidden').addClass('d-none');
        mergeCommonRows($('#table_class_info'));
      });
    }
    function mergeCommonRows(table){
      var firstColumnBrakers = [];
      $.each(table.find('th'),function(i){
        var previous = null, cellToExtend = null,rowspan =1;
        table.find("td:nth-child(" + i + ")").each(function(index, e){
        var jthis= $(this), content = jthis.text();
          if(previous == content && content !=="" && $.inArray(index,firstColumnBrakers)=== -1 ){
            jthis.addClass('hidden');
            cellToExtend.attr("rowspan",(rowspan=rowspan+1));
          } else {
            if(i==-1) firstColumnBrakers.push(index);
            rowspan=1;
            previous = content;
            cellToExtend = jthis;
          }
        });
      });
      $('td.hidden').remove();
    }

    $('#show_class_info').on('click',function(e){
      e.preventDefault();
      showClassInfo()
      $('#classPopupModal').modal('show');
    });

  });
</script>
