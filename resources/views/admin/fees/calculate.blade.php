{{-- <script>
  $(document).on('change keyup','#Amount',function(e){
    var fee = $('#Fee').val();
    var amount = $('#Amount').val();
    var paid = $('#Paid').val($('#Amount').val());
    var discount = 0;
    if(paid!='' && amount !='')
    {
      paid = parseFloat($('#Amount').val())
      var discount = (((parseFloat(fee) - parseFloat(paid)) *100) / fee);
      $('#Lack').val(parseFloat(amount) - parseFloat(paid));
    }
    if(amount=='' && paid=='')
    {
      $('#Paid').val();
      $('#Discount').val();
    }
    if(parseFloat(amount)>parseFloat(fee))
    {
      $('#Discount').css('color','red');
    } else {
      $('#Discount').css('color','black');
    }
    $('#Discount').val(parseInt(discount));
  });
  // ==================================================
  $(document).on('change keyup','#Discount',function(e){
    var fee = $('#Fee').val();
    var discount = 0;
    discount = ((fee *  parseFloat($(this).val())))/100;
    var amount = fee - discount;
    $('#Paid').val(parseInt(amount));
    $('#amount').val(parseInt(amount));
  });
  // ==================================================
  $(document).on('change keyup','#Paid',function(e){
    var amt = $('#Amount').val();
    var pay = $('#Paid').val();
    if(pay == ''){$('#Lack').val(0)};
    if(pay!=''){
      paid = parseFloat($('#Paid').val());
    }
    if(pay!='' && amt !='')
    {
      var lack = parseFloat(amt)-parseFloat(paid)
      $('#Lack').val(parseInt(lack));
    }
    if($('#Lack').val()<0)
    {
      $('#Lack').css('color','red');
    } else {
      $('#Lack').css('color','black');
    }
  });
</script> --}}

<script type="text/javascript">
	// ==============================================================//
	$(document).on("change keyup","#Amount",function(){
		var fee = $('#Fee').val();
		var amt = $('#Amount').val();
		var paid = $('#Paid').val($('#Amount').val());
		var dis = 0;
		if(paid!='' && amt !='')
		{
			paid = parseFloat($('#Amount').val());
			var dis = (((parseFloat(fee) - parseFloat(paid)) * 100) /fee);
			$('#Lack').val(parseFloat(amt)-parseFloat(paid));
		}
		if(amt=='' && paid=='')
		{
			$('#Paid').val();
			$('#Discount').val();
		}
		if(parseFloat(amt)>parseFloat(fee))
		{
			$('#discount').css({'color':'red'})
		}	else {
			$('#Discount').css({'color':'black'})
		}
		$('#Discount').val(parseFloat(dis));
	});
// ===============================================================//
	$(document).on("change keyup","#Discount",function(){
		var fee = parseFloat($('#Fee').val());
		var dis = 0;
		dis =((fee * parseFloat($(this).val()))) /100;
		var amt = fee -dis;
		$('#Paid').val(parseFloat(amt))
		$('#Amount').val(parseFloat(amt))
	});
// ==============================================================//
	$(document).on("change keyup","#Paid",function(){
		var b = $('#Amount').val();
		var pay = $('#Paid').val();
		if(pay==''){
			$('#Lack').val(0);
		};
		if(pay!=''){
			var paid = parseFloat($('#Paid').val());
		}
		if (pay !='' && b !='')
		{
			var lack = parseFloat(b) - parseFloat(paid)
			$('#Lack').val(parseFloat(lack))
		}
		if($('#Lack').val()<0)
		{
			$('#Lack').css({'color':'red'})
		} else{
			$('#Lack').css({'color':'black'})
		}
	});
// ==========================================================//
	$(document).on("change keyup","#Pay",function(){
		var b = $('#b').val();
		var pay = $('#Pay').val();
		if(pay=='')
		{
			$('#Lack').val(0);
		}
		if(pay !='')
		{
		  var paid = parseFloat($('#Pay').val());
		}
		if(pay !='' && b !='')
		{
			var lack = parseFloat(b)- parseFloat(paid);
			$('#Lack').val(parseFloat(lack));
		}
		if($('#Lack').val()<0)
		{
			$('#Lack').css({'color':'red'})
		} else {
			$('#Lack').css({'color':'black'})
		}
	});
</script>
