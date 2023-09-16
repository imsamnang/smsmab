<script type="text/javascript">

	var n = $('#disabled').val();
	$('.create-fee').on('click',function(e){
		$('#createFeeOpup').modal('show')
	});
// --------------Create Fee------------------
	$('#frmFee').on('submit',function(e){
		e.preventDefault();
		enableFormElement($(this));
		var data = $('#frmFee').serialize();
		var lv = $('#level_id').val();
		var pr = $('#program_id').val();
		var url = $(this).attr('action');
		$.post(url,data,function(data){
      console.log(data)
			location.reload();
		})
	})
// ----------Function to Enable Element------------
	function enableFormElement(frmName)
	{
		$.each($(frmName).find('input','select'), function(i,element){
			$(element).attr('disabled',false).css({'background':'#fff',
																							'border':'1px solid #ccc',
																							'color':'#9e9e9e'});
		})
	}
//extra paid
	$('.btn-paid').on('click',function(e){
		e.preventDefault();
		s_fee_id = $(this).data('id-paid');
		balance = $(this).data('value');
		$.get("{{route('admin.students.pay')}}", {s_fee_id:s_fee_id}, function (data) {
      console.log(data);
				$('#Paid').attr('id','Pay');
				$('#s_fee_id').val(data.s_fee_id);
				$('#LevelID').val(data.level_id);
				$('#Fee').val(data.school_fee);
				$('#FeeID').val(data.fee_id);
				$('#Amount').val(data.student_amount);
				$('#Discount').val(data.discount);
				$('#Pay').val(balance);
				$('#Pay').focus();
				$('#Pay').select();
				$('#b').val(balance);
				addItem(data);
				showStudentLevel();
			}
		);
	});
// addItem
  function addItem(data) {
    $('#Program_ID').empty().append($("<option/>",{
      value	:	data.program_id,
      text	:	data.program
    }))
    $('#Level_ID').empty().append($("<option/>",{
      value:data.level_id,
      text:data.level
    }))
  }
// show student level
	function showStudentLevel() {
		level_id = $('#LevelID').val();
		student_id = $('#student_id').val();
			$.get("{{ route('admin.students.showLevelStudent') }}", {level_id:level_id, student_id:student_id},
				function (data) {
					console.log(data)
					$('.academic_detail').text(data.detail)
				}
			);
	}
//reset
	$('#btnObjectReset').on('click',function(e){
		e.preventDefault();
		var caption = $(this).val();
		if(caption == "Reset")
		{
			$(this).val('Cancel');
			$('#btnObjectSave').html('<i class="fa-regular fa-circle-plus"></i>&nbsp;{{ trans('global.save') }}');
			$('#btnObjectReset').html('<i class="fa-regular fa-pen-to-square"></i>&nbsp;{{ trans('global.cancel') }}');
			$('#Pay').attr('id','Paid');
			$('#frmPayment').attr('action',"{{route('admin.students.savePayment')}}");
			enableFormElement('#frmPayment');
			return;
		}
		// location.reload();
	});

// disable input
	function disabled_input() {
		$.each($('body').find('.d'), function (index, item) {
			 $(item).attr('disabled',true).css({'background':'#f5f5f5','border':'1px solid #ccc'});
			 $(item).attr('readonly',false);
		});
	}
	$(document).ready(function(){
		if(n==0){
			disabled_input();
		} else {
			return false;
		}
	});
</script>
