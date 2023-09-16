<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Student Invoice</title>
  <style>
    html,body {
      padding: 0;
      margin: 0;
      width: 100%;
      background: #fff;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 11pt;
    }
    table {    width: 700px;
      margin: 0 auto;
      text-align: left;
      border-collapse: collapse;
    }
    th { padding-left: 2px;  }
    td { padding: 2px; }
    .aeu{
      text-align: right;
      padding-right: 10px;
      font-family: 'Khmer OS Muol Light', 'Times New Roman';
    }
    .line-top{
      border-left: 1px solid;
      padding-left: 10px;
      font-family: 'Times New Roman', 'Khmer Os Moul Light';
    }
    .verify {
      font-family: 'Times New Roman', 'Khmer Os Moul Light';
    }
    .imageAeu{width: 50px; height: 70px;}
    .th{
      background-color: #e7d8d8;
      border: 1px solid;
      text-align: center;
    }
    .line-row{
      background-color: #fff;
      border: 1px solid;
      text-align: center;
    }
    .container{
      width: 100%;
      margin: 0 auto;
    }
    .khm-os{font-family: 'Times New Roman', Times, serif}
    .divide{width: 100%;margin: 0 auto;}
    hr {
      width: 100%;
      margin-right: 0;
      margin-left: 0;
      padding: 0;
      margin-top: 35px;
      margin-bottom: 20px;
      border: 0 none;
      border-top: 1px dashed #322f32;
      background: none;
      height: 0;
    }
    button{
      margin: 0 auto;
      text-align: center;
      height: 100%;
      width: 100%;
      cursor: pointer;
      font-weight: bold;
    }
    .lenght-limit{max-height: 350px; min-height: 350px;}
    .div-button{
      width: 100%;
      margin-top: 0;
      height: 50px;
      text-align: center;
      margin-bottom: 10px;
      border-bottom: 1px solid;
      background: #ccc;
    }
  </style>
</head>
<body>
<div class="div-button">
  <button onclick="printContent('divide')">Print</button>
  <div id="divide">
    <?php for($i=0;$i<2;$i++){ ?>
    <div id="container">
      <div class="lenght-limit">
        <table>
          <tr>
            <td style="padding-left: 40px;width: 50px;"><img src="{{ asset('public/images/logo.png') }}" class="imageAeu"></td>
            <td class="aeu">
              <b style="font-weight: normal;">សាលារៀនអាមេរិកកាំង</b>
              <br>
              <b>American School</b>
            </td>
            <td class="line-top">
              <b class="aeu" style="font-weight: normal;">បង្កាន់ដៃ</b>
              <br>
              <b>RECEIPT</b>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: right;"></td>
            <td colspan="0" style="text-align: right; padding-left: 80px;">
            <b>Receipt N<sup>o</sup>:{{sprintf("%05d",$invoice->receipt_id)}}</b>
            </td>
          </tr>
        </table>
        <table>
          <tr>
            <td style="padding: 5px 0px;width: 120px;">
              StudentID : <b>{{sprintf("%05d",$invoice->student_id)}}</b>
            </td>
            <td style="padding: 5px 0px;width: 200px;">
              First name : <b>{{$invoice->first_name}}</b>
            </td>
            <td style="padding: 5px 0px;width: 200px;">
              First name : <b>{{$invoice->last_name}}</b>
            </td>
            <td>Gender :
              <b>{{$invoice->sex==0?'Male':'Female'}}</b>
            </td>
          </tr>
        </table>
        <table>
         <thead>
           <tr>
             <th class="th" style="text-align: left">Description</th>
             <th style="width: 70px" class="th">Fee</th>
             <th style="width: 70px" class="th">Dis</th>
             <th style="width: 70px" class="th">Amount</th>
             <th style="width: 70px" class="th">Pay</th>
             <th style="width: 70px" class="th">Balance</th>
           </tr>
         </thead>
         <tbody>
           <td class="line-row" style="text-align: left"> {{$status->detail}}</td>
           <td class="line-row">${{number_format($invoice->school_fee,2)}}</td>
           <td class="line-row">{{$studentFee->discount}}%</td>
            <td class="line-row">${{number_format($studentFee->amount,2)}}</td>
           <td class="line-row">${{number_format($studentPaid->paid,2)}}</td>
           <td class="line-row">${{number_format($studentFee->amount-$totalPaid,2)}}</td>
           {{-- <td class="line-row">${{number_format($studentFee->amount-($totalPaid+(($invoice->school_fee*$invoice->discount)/100)),2)}}</td> --}}
         </tbody>
        </table>
        <table>
          <tr>
            <td class="verify">
              <b>Note:</b>
              <p style="display: inline-block">
                All payments are not refundable or traferable
              </p>
            </td>
            <td>
              <b style="margin-bottom: 5px;">Cashier: {{$invoice->name}}</b>
              <br><br>
              Printed: {{date('d-M-Y g:i:s A')}}
            </td>
            <td style="vertical-align: top; " >
              Printed By: {{ Auth::user()->name}}
            </td>
          </tr>
        </table>
        <br><br><br><br><br>
        <table>
          <tr>
            <td style="font-size: 11px;text-align: center">
              #254, Mondol III Village, Slorkram Commune, Siemreap District, Siem Reap Province, Postal Code:17252
            </td>
          </tr>
          <tr>
            <td style="font-size: 11px; text-align: center">
              Phone:(855) 23 78 343 143 / 70 393 143/ Email: applephagna@gmail.com
            </td>
          </tr>
        </table>
      </div>
    </div>
    @if ($i==0)
      <br>
      <hr>
    @endif
  <?php } ?>
  </div>
</div>
<script type="text/Javascript">
  function printContent(el) {
    var restorepage = document.body.innerHTML;
    var printContent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = restorepage;
    window.close();
  }
</script>
</body>
</html>
