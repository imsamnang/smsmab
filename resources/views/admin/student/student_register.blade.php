@extends('admin.admin_layout')

@push('select2')
  <link href="{{ asset('public/assets/backend') }}/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="{{ asset('public/assets/backend') }}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endpush

@push('styles')
  <link href="{{ asset('public/assets/backend') }}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/css/toggle.css">
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/plugins/toastrjs/toastr.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets/backend') }}/plugins/jquery-datetime/jquery.datetimepicker.min.css">
  <style>
    input.ace-switch.ace-switch-yesno:checked::before {
      content: "{{trans('global.yes')}}";
    }
    input.ace-switch.ace-switch-yesno::before {
      content: "{{trans('global.no')}}";
    }
    input.ace-switch.ace-switch-onoff:checked::before {
      content: "{{trans('global.on')}}";
    }
    input.ace-switch.ace-switch-onoff::before {
      content: "{{trans('global.off')}}";
    }
  </style>
  <style type="text/css" media="screen">
    .student-photo{
      height: 160px;
      padding-left: 1px;
      padding-right: 1px;
      border: 1px solid #ccc;
      background: #eee;
      width: 180px;
      margin: 0 auto;
    }
    .photo > input[type='file']{
      display: none;
    }
    .photo {
      width: 30px;
      height: 30px;
      border-radius: 100%;
    }
    .student-id{
      background-repeat: repeat-x;
      border-color: #ccc;
      padding: 5px;
      text-align: center;
      background: #eee;
      border-bottom: 1px solid #ccc;
    }
    .btn-browse{
      border-color: #ccc;
      padding: 5px;
      text-align: center;
      background: #eee;
      border-bottom: 1px solid #ccc;
    }
    fieldset{
      margin-top: 5px;
    }
    fieldset legend {
      display: block;
      width: 100%;
      padding:0;
      font-size: 15px;
      line-height: inherit;
      color: #797979;
      border:0;
      border-bottom: 1px solid #e5e5e5;
    }
  </style>
  <style>
    .academic-detail{
      white-space: normal;
      width: 350px !important;
    }
    .academic_detail{
      text-align: center;
      font-size: 16px;
      font-weight: 500;
      color: #ff0000
    }
    table>tbody>tr>td {
      vertical-align: middle;
    }
    .action{
      text-align: center;
    }
    .accordion-button:not(.collapsed)::after{
      background-image: url("../../public/images/plus-icon.png");
    }
  </style>
@endpush

@section('content')
  @section('breadcrumb','Student Registration')
  <form id="frmCrudObject" action="{{route('admin.students.studentStore')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="card-header">
        <h4 class="mb-0 text-primary"><i class="bx bxs-user me-1 font-22 text-primary"></i>{{ trans('cruds.student.title') }}</h4>
        <div class="accordion mt-3" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button id="show_class_info" class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                Choose Academic
              </button>
            </h2>
            <div class="accordion-collapse" aria-labelledby="headingOne">
              <div class="accordion-body">
                <div class="academic_detail">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <input type="hidden" name="class_id" id="class_id" class="form-control">
        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id()}}" class="form-control">
        <input type="hidden" name="dateregistered" id="dateregistered" value="{{date('Y-m-d')}}" class="form-control">
        <div class="row">
          <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
            {{-- ------------------Start Student Infor-----------------------}}
            <div class="row">
              <!-- ------------First Name-------------- -->
              <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="fistname">First Name</label>
                  <input type="text" name="first_name" id="first_name" class="form-control" required="required" placeholder="First Name" title="First Name">
                </div>
              </div>
              <!-- ------------Last Name-------------- -->
              <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" name="last_name" id="last_name" class="form-control" required="required" placeholder="Last Name" title="Last Name">
                </div>
              </div>
              <!-- ------------Gender Name-------------- -->
              <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="sex">Gender</label>
                  <select id="sex" name="sex" class="form-select mb-3" aria-label="Default select example">
                    <option selected="">Select Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ------------Date of birth-------------- -->
              <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="dob">Birth Date</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar studentdob"></i>
                    </div>
                    <input type="text" name="dob" id="dob" class="form-control" placeholder="yyyy/mm/dd" required>
                  </div>
                </div>
              </div>
              <!-- ------------National Card-------------- -->
              <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="national_card">National Card</label>
                  <input type="text" name="national_card" id="national_card" class="form-control" placeholder="National Card">
                </div>
              </div>
              <!-- ------------Status-------------- -->
              <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="status">Status</label>
                  <select id="status" name="status" class="form-select mb-3" aria-label="Default select example">
                    <option selected="">Select Status</option>
                    <option value="0">Dis Active</option>
                    <option value="1">Active</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ------------Nationality-------------- -->
              <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="nationality">Nationality</label>
                  <input type="text" name="nationality" id="nationality" class="form-control" placeholder="Nationality">
                </div>
              </div>
              <!-- ------------Rac-------------- -->
              <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="rac">Rac</label>
                  <input type="text" name="rac" id="rac" class="form-control" placeholder="Rac">
                </div>
              </div>
              <!-- ------------Passport-------------- -->
              <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="passport">Passport</label>
                  <input type="text" name="passport" id="passport" class="form-control" placeholder="Passport">
                </div>
              </div>
            </div>
            <div class="row">
                <!-- ------------Phone-------------- -->
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                  </div>
                </div>
                <!-- ------------Email-------------- -->
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                  </div>
                </div>
            </div>
            {{-----------End Row------------------ --}}
          </div>
          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
            <!-- ------------Photo-------------- -->
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group form-group-login">
                <table style="margin: 0 auto;">
                  <thead>
                    <tr class="info">
                      <th class="student-id">{{sprintf('%05d',$student_id+1)}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="photo">
                        <img src="{{asset('public/images/simple.png')}}" class="student-photo" id="showPhoto" alt="">
                        <input type="file" name="photo" id="photo" accept="image/x-png,image/png,image/jpg,image/jpeg">
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align: center;background: #ddd;">
                        <input type="button" name="browse_file" id="browse_file" class="form-control btn-browse" value="Browse">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- ------------End Photo-------------- -->
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4 class="mb-0 text-secondary"><i class="bx bxs-user me-1 font-22 text-primary"></i>
          Address
        </h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
              <label for="village">Village</label>
              <input type="text" name="village" id="village" class="form-control" placeholder="Village">
            </div>
          </div>

          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
              <label for="commune">Commune</label>
              <input type="text" name="commune" id="commune" class="form-control" placeholder="Commune">
            </div>
          </div>

          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
              <label for="district">District</label>
              <input type="text" name="district" id="district" class="form-control" placeholder="District">
            </div>
          </div>

          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
              <label for="province">Province</label>
              <input type="text" name="province" id="province" class="form-control" placeholder="Province">
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <label for="current_address">Current Address</label>
              <input type="text" name="current_address" id="current_address" class="form-control" placeholder="Current Address">
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-center">
        <button type="submit" class="btn btn-outline-primary">Submit</button>
      </div>
    </div>
  </form>
  @include('admin.class.classPopup')
@endsection

@push('scripts')
  <script src="{{ asset('public/assets/backend') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/select2/js/select2.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/toastrjs/toastr.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/momentjs/moment.min.js"></script>
  <script src="{{ asset('public/assets/backend') }}/plugins/jquery-datetime/jquery.datetimepicker.full.min.js"></script>
  <script>
    var today_date = new Date();
    var yy = today_date.getFullYear();
    var dd = today_date.getDate().toString().padStart(2, "0");
    var mm =  (today_date.getMonth() + 1).toString().padStart(2, "0");
    var hh = today_date.getHours().toString().padStart(2, "0");
    var mn = today_date.getMinutes().toString().padStart(2, "0");
    var ss = today_date.getSeconds().toString().padStart(2, "0");
    var today = dd + '-' + mm + '-' + yy + " " + hh + ":" + mn + ":" + ss;
    $(function() {
      "use strict";
      $(document).ready(function() {
        var table = $('#datatable').DataTable( {
          lengthChange: false,
          buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
        table.buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
        $('[data-bs-toggle="tooltip"]').tooltip();
      });
    });
  </script>
  <script type="text/javaScript">
    // -------------Browse photo------------------
    $('#browse_file').on('click',function(e){
      $('#photo').click();
    })
    $('#photo').on('change',function(e){
      showFile(this,'#showPhoto');
    })
    // ======================================
    function showFile(fileInput,img,showName){
      if (fileInput.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
          $(img).attr('src',e.target.result);
        }
        reader.readAsDataURL(fileInput.files[0]);
      }
      $(showName).text(fileInput.files[0].name)
    };
    $('#dob').datetimepicker({
      format:"d-M-Y",
      timepicker:false
    });
  </script>
  {{-- crud script --}}
  <script>
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
        $('#frm-multi-class #btn-go').addClass('d-none');
      });

      $(document).on('click','a#editCourse',function(e){
        e.preventDefault();
        var class_id = $(this).data('id');
        $('#class_id').val(class_id);
        $('.academic_detail').append($(this).text());
        $('#classPopupModal').modal('hide');
      });

      // $('#frmCrudObject').on('submit',function(e){
      //   e.preventDefault();
      //   $('#frmCrudObject').find('span.text-danger').removeClass('d-none');
      //   var actionUrl = $(this).attr('action');
      //   var method = $(this).attr('method')
      //   $('#btnObjectSave').html('Processing..');
      //   $('#btnObjectUpdate').html('Processing..');
      //   $.ajax({
      //     type: method,
      //     url: actionUrl,
      //     data: new FormData(this),
      //     dataType:'json',
      //     contentType:false,
      //     cache:false,
      //     processData:false,
      //     beforeSend:function(){
      //       $(document).find('span.error-text').text('');
      //     },
      //     success: function (res) {
      //       console.log(res);
      //       var url = "{{ route('admin.students.gotoPayment',"") }}"+'/'+res.data.student_id;
      //       window.open(url);
      //     //   console.log(res)
      //       // if(res.status==400){
      //       //   $.each(res.error, function(prefix, val){
      //       //     $('span.'+prefix+'_error').text(val[0]);
      //       //   });
      //       // } else {
      //       //   var $html =res.html;
      //       //   if(res.type == 'store-object'){
      //       //     $('tbody#objectList').append($html);
      //       //   }else{
      //       //     $("#tr_object_id_" + res.data.id).replaceWith($html);
      //       //   }
      //       //   $('#frmCrudObject').trigger("reset");
      //       //   $('#crudObjectModal').modal('hide');
      //       //   $('#btnObjectSave').html('{{ trans('global.save') }}');
      //       //   $('#btnObjectUpdate').html('{{ trans('global.update') }}');
      //       //   toastr.success(res.success);
      //       // }
      //     },
      //     error: function (error) {
      //       console.log('Error:', error);
      //       $('#btnObjectSave').html('{{ trans('global.save')}}');
      //       $('#btnObjectUpdate').html('{{ trans('global.update') }}');
      //     }
      //   });
      // });

      $('body').on('click', 'a#objectEdit', function (e) {
        e.preventDefault();
        $('#frmCrudObject').find('#btnObjectSave').addClass('d-none');
        $('#frmCrudObject').find('#btnObjectUpdate').removeClass('d-none');
        $('#frmCrudObject').find('#btnObjectUpdate').html('<i class="fadeIn animated bx bx-edit"></i>&nbsp;{{ trans('global.update') }}');
        $('#frmCrudObject').trigger('reset');
        var object_id = $(this).data('id');
        var form = $('#frmCrudObject');
        var modal = $('#crudObjectModal');
        var actionUrl = $('#crudRoutePath').val();
        modal.find('.modal-title').html('{{ trans('global.edit') }} {{ trans('cruds.customer.title_singular') }}');
        $.get( actionUrl +'/' +object_id+'/edit', function (res) {
          form.find('#object_id').val(res.data.id);
          if ($('#frmCrudObject #province_id').find("option[value='" + res.data.province_id + "']").length) {
            $('#province_id').val(res.data.province_id).trigger('change');
          }
          $('#district_id').attr('selectData',res.data.district_id);
          $('#commune_id').attr('selectData',res.data.commune_id);
          $('#village_id').attr('selectData',res.data.village_id);
          form.find('#customer_code').val(res.data.customer_code);
          form.find('#name').val(res.data.name);
          if ($('#frmCrudObject #sex').find("option[value='" + res.data.sex + "']").length) {
            $('#sex').val(res.data.sex).trigger('change');
          }
          form.find('#age').val(res.data.age);
          form.find('#dob').val(res.data.dob);
          form.find('#phone_no').val(res.data.phone_no);
          form.find('#old_image').val(res.data.photo);
          if(res.data.photo==null){
            form.find('#preview').attr('src',"{{ asset('public/images/avatar3.png') }}");
          } else {
            form.find('#preview').attr('src',"{{ asset('public/uploads/customer/') }}"+'/'+res.data.photo);
          }
          form.find('#register_date').val(res.data.register_date);
          if(res.data.status==1){
            form.find('#status').prop('checked',true);
          } else {
            form.find('#status').prop('checked',false);
          }
          modal.modal('show');
        })
      });

      $('body').on('click', '.objectDelete', function (e) {
        e.preventDefault();
        var object_id = $(this).data("id");
        var link = $(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              type: "DELETE",
              url:link,
              success: function (data) {
                $("#tr_object_id_" + object_id).remove();
                toastr.success(data.success);
              },
              error: function (data) {
                console.log('Error:', data);
              }
            });
          }
        })
      });

      $('#btnObjectClose').on('click',function(e){
        e.preventDefault();
        $('#frmCrudObject').find('#preview').attr('src',"{{ asset('public/images/avatar3.png') }}");
        $('#frmCrudObject').find('#btnObjectSave').removeClass('d-none');
        $('#frmCrudObject').find('#btnObjectUpdate').addClass('d-none');
        $('#crudObjectModal').find('.modal-title').html('{{ trans('global.add') }} {{ trans('cruds.customer.title_singular') }}');
        $('#frmCrudObject').trigger('reset');
      });

      $('body').on('change','.ace-switch',function(e){
        var object_id = $(this).data('id');
        var status = $(this).prop('checked')==true ? 1 :0 ;
        $.ajax({
          type : 'GET',
          dataType: 'JSON',
          url :'',
          data: {
            'status':status,
            'object_id':object_id
          },
          success:function(res){
            toastr.success(res.success);
          },
          error:function(err){
            console.log(err);
          }
        })
      });
    });
  </script>
@endpush
