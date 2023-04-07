@extends('layouts.app')

@section('content')
<style>
    .card-header h2{
        font-size: 22px;
        margin-top: 30px;
    }
    .list-cabin{
        justify-content: center;
    }
    .list-cabin li{
        margin-right: 10px;
        padding: 10px 5px;
        width: 45%
    }
    .list-cabin li a{
        font-size: 12px;
        width: 100%;
    }
    #get-OTP{
      position: absolute;
      top: calc(50%);
      transform: translateY(-50%);
      right: 38px;
      padding: 6px;
      background: #ddd;
      cursor: pointer;
      border-radius: 5px;
      font-size: 12px;
    }
    .alert-danger{
        margin: 0;
    }
    #alert-telephone{
        font-size: 12px;
    }
    #alert-telephone p{
        padding: 7px 10px;
    }
    .block-btn{
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        padding: 0 !important;
        border-radius: 50%;
        color: #000;
    }
    .alert-warning{
        color: #000 !important;
    }
    .confirm-box.error-alert{
      padding: 5px;
      height: auto;
    }
    .confirm-box.error-alert p{
      margin-bottom: 0
    }
    .btn-item{
        flex-wrap: wrap;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h2>{{ __('Đặt lịch hộ học viên') }}</h2>
                    <p>Đặt lịch trực tiếp hộ học viên</p>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-group" id="alert-group">
                    </div>
                    <div class="form-group" style="position: relative">
                        <div class="row">
                            <div class="col-sm-9">
                                <h6>Số điện thoại học viên <span style="color: #f00">(*)</span></h6>
                                <div style="position: relative;">
                                    <input class="form-control" type="telephone" id="telephone-register" name="telephone_register" placeholder="Số điện thoại học viên">
                                    <span id="get-OTP">Lấy mã OTP</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <h6>Mã OTP <span style="color: #f00">(*)</span></h6> <div id="alert-otp"></div>
                                <input class="form-control" id="name-otp" name="otp_register" type="text" placeholder="Nhập mã OTP">
                                <div class="row">
                                    <div class="col-sm-12 group-alert"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p style="margin-bottom: 0">Nhập đúng số điện thoại khi đăng ký hồ sơ <br/> Học viên lưu lại mã OTP để dùng xuyên suốt quá trình học.</p>
                                <div id="alert-telephone"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h6>Họ tên học viên</h6> <div id="alert-name"></div>
                        <input  class="form-control" readonly id="name-register" name="name_register" type="text" placeholder="Họ tên học viên">
                    </div>
                    {{-- <div class="form-group">
                        <h6>Email học viên (nếu có)</h6> <div id="alert-email"></div>
                        <input class="form-control" type="email" id="email-register" name="email_register" placeholder="Email học viên">
                    </div> --}}
                    {{-- <div class="form-group">
                        <h6>Điểm thi lúc đăng ký <span style="color: #f00">(*)</span></h6> <div id="alert-cabin"></div>
                        <ul class="list-cabin" id="cabin-register">
                            @foreach ($cabins as $cabin)
                                <li>
                                    <a href="javascript:void(0);" class="btn btn-primary" html-value={{ $cabin['id'] }}>{{ $cabin['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <input name="cabin_number" id="cabin-number" type="hidden" />
                    </div> --}}
                    <div class="form-group">
                        <h6>Ngày đăng ký <span style="color: #f00">(*)</span></h6> <div id="alert-date"></div>
                        <?php $current_date = date("Y-m-d"); ?>
                        <input class="form-control" id="date-register" name="date_register" min="{{ date('Y-m-d', strtotime($current_date. ' + 2 days')) }}" value="{{ date('Y-m-d', strtotime($current_date. ' + 2 days')) }}" type="date" placeholder="Thời gian học">
                    </div>
                    <div class="form-group">
                      <h6>Thời gian học <span style="color: #f00">(*)</span></h6> <div id="alert-time"></div>
                      <div id="time-register">
                        {{-- <swiper-container> --}}
                          @foreach($time_books as $time_book)
                          {{-- <swiper-slide> --}}
                              <div class="slide-item">
                                <div class="btn-item">
                                  @foreach($time_book as $books)
                                    @foreach($books as $book)
                                        <button html-value="{{ $book['time_id'] }}" type="button" class="btn btn-info mt-1">
                                            {{ $book['time_value'] }}
                                        </button>
                                    @endforeach
                                  @endforeach
                                </div>
                              </div>
                          {{-- </swiper-slide> --}}
                          @endforeach
                        {{-- </swiper-container> --}}
                        <input id="time-choose" name="time_choose" type="hidden">
                      </div>
                    </div>
                    <div class="form-group">
                        <h6>Ghi chú</h6>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <p style="color: #f00; font-family: Arial">Lưu ý: Học viên đăng ký trải nghiệm Cabin nhưng không đến được vui lòng hủy lịch trước 48h. 
                            <br/>Trường hợp không hủy hoặc không được hủy, thời gian trải nghiệm vẫn được tính chi phí cho học viên
                         </p>
                        <div class="confirm-box">
                          <p style="color: #000;display: flex;vertical-align: middle;"><input id="ckx-confirm" type="checkbox" /> <label style="font-size: 13px; margin-left: 5px;" for="ckx-confirm">Tôi đồng ý với lưu ý trên</label></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-success" type="button" id="btn-booking">Đặt lịch</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
<script>
    const validateEmail = (email) => {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };
    const validatePhone = (telephone) => {
        return telephone.match(
            /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im
        );
    }
    function checkTimeCabin (){
      // xét lại thời gian
      let date_register = $('#date-register').val();
      if(date_register !== ''){
        let list_times_register = document.querySelectorAll('#time-register button');
        list_times_register?.forEach((btn_time)=>{
            btn_time.classList.remove('btn-default');
            btn_time.classList.add('btn-info');
        });
        $.ajax({
            url: '{{ route("check.time.cabin") }}',
            data: {
                'date_booking': date_register
            },
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success: function (res){
                if(res?.data?.length > 0){
                    res?.data?.map((i_time)=>{
                        list_times_register?.forEach((btn_time)=>{
                            if(i_time.time_id == btn_time.getAttribute('html-value')){
                                btn_time.classList.add('btn-default');
                                if(btn_time.classList.contains('btn-info')){
                                    btn_time.classList.remove('btn-info');
                                }
                            }
                        });
                    });
                }
            }
        });
      }
    }
    $(document).ready(()=>{
        checkTimeCabin();
        let err_message = '';
        $('#date-register').on('focus',function(){
          $('#date-register').addClass('is-valid');
          checkTimeCabin();
        })
        $('#date-register').on('change',function(e){
            let date_register = $(this).val();
            let date_check =  new Date().toJSON().slice(0,10);
            if(date_register >= date_check){
                $(this).addClass('is-valid');
                $(this).removeClass('is-invalid');
                $('#alert-date *').remove();
            }else{
                $(this).removeClass('is-valid');
                $('#alert-date *').remove();
                $('#alert-date').html('<label class="text-danger">Ngày lựa chọn không hợp lệ</label>');
                $('#date-register').addClass('is-invalid');
                return;
            }
        })
        // $('#name-register').on('change',function(e){
        //     let name_register = $(this).val();
        //     if(name_register.length > 3){
        //         $(this).removeClass('is-invalid');
        //         $(this).addClass('is-valid');
        //         $('#alert-name *').remove();
        //     }else{
        //         $(this).removeClass('is-valid');
        //         $('#alert-name *').remove();
        //         $('#alert-name').html('<label class="text-danger">Vui lòng nhập đầy đủ họ tên</label>');
        //         $('#name-register').addClass('is-invalid');
        //         return;
        //     }
        // })
        $('#email-register').on('change',function(e){
            email = $(this).val();
            if(email != ''){
              if(validateEmail(email)){
                  $(this).removeClass('is-invalid');
                  $(this).addClass('is-valid');
                  $('#alert-email *').remove();
              }else{
                  $(this).removeClass('is-valid');
                  $('#alert-email *').remove();
                  $('#alert-email').html('<p class="alert alert-danger">Vui lòng kiểm tra lại email</p>');
                  $('#email-register').addClass('is-invalid');
                  return;
              }
            }
        })
        $('.btn-item button').on('click',function(){
            let buttons = document.querySelectorAll('.btn-item button');
            let this_val = $(this).attr('html-value');
            let value_choose = '';

            let cabin_register = document.querySelectorAll('#cabin-register .btn');
            let check_click_cabin = 0;
            cabin_register.forEach((item)=>{
                if(item.classList.contains('btn-success')){
                    check_click_cabin = check_click_cabin + 1;
                }
            });
            
            if($(this).hasClass('btn-default')){
                Swal.fire({
                    title: 'Lưu ý!',
                    text: 'Khung giờ đã có học viên đặt trước',
                    icon: 'error'
                })
                return;
            }
            buttons.forEach(element => {
                if(this_val != element.getAttribute('html-value') && element.classList.contains('btn-success')){
                    element.classList.remove("btn-success");
                    element.classList.add("btn-info");
                }else if(this_val == element.getAttribute('html-value')){
                    if(element.classList.contains('btn-success')){
                        element.classList.remove("btn-success");
                        element.classList.add("btn-info");
                        value_choose = '';
                    }else{
                        element.classList.add("btn-success");
                        element.classList.remove("btn-info");
                        value_choose = this_val;
                    }
                }
            });
            $('#time-choose').val(value_choose);
        });
        
        // $('.list-cabin a').on('click',function(){
        //     let buttons = document.querySelectorAll('.list-cabin a');
        //     let this_val = $(this).attr('html-value');
        //     let value_choose = '';
        //     buttons.forEach(element => {
        //         if(this_val != element.getAttribute('html-value') && element.classList.contains('btn-success')){
        //             element.classList.remove("btn-success");
        //             element.classList.add("btn-primary");
        //         }else if(this_val == element.getAttribute('html-value')){
        //             if(element.classList.contains('btn-success')){
        //                 element.classList.remove("btn-success");
        //                 element.classList.add("btn-primary");
        //                 value_choose = '';
        //             }else{
        //                 element.classList.add("btn-success");
        //                 element.classList.remove("btn-primary");
        //                 value_choose = this_val;
        //             }
        //         }
        //     });
        //     $('#cabin-number').val(value_choose);
        //     // xét lại thời gian
        //     checkTimeCabin();
        // });
        function startTimer(duration, display) {
          var timer = duration, seconds;
          if(timer > 0){
            let check_value = 0;
            let interval_id = setInterval(function () {
              seconds = parseInt(timer % 60, 10);
              // seconds = seconds < 10 ? "0" + seconds : seconds;
              document.getElementById('get-OTP').classList.add('block-btn');
              display.text(seconds);

              if (--timer < 0) {
                // timer = duration;
                clearInterval(interval_id);
                document.getElementById('get-OTP').classList.remove('block-btn');
                display.text('Lấy mã OTP');
              }
            }, 1000);
          }
        }
            var i = 0;
        $('#get-OTP').click(function(){
          if(!$(this).hasClass('block-btn')){
            let telephone_val = $('#telephone-register').val();
            if(telephone_val === ''){
              $('#alert-telephone').html('<p class="alert alert-danger">Vui lòng nhập số điện thoại</p>');
              return;
            }
            if(!validatePhone(telephone_val)){
              $('#alert-telephone').html('<p class="alert alert-danger">Vui lòng nhập số điện thoại</p>');
              return;
            }
            display = $('#get-OTP');
            let duration = 30;
            startTimer(duration, display);
            $.ajax({
              url: '{{ route("set.otp.sms") }}',
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                  'telephone': telephone_val
              },
              dataType: 'JSON',
              success: function(response){
                if(response.status == '-1'){
                  $('#alert-telephone').html('<p class="alert alert-danger">Cảnh báo: '+response.message+'</p>');
                  return;
                }
                if(response.status){
                  $('#alert-telephone').html('<p class="alert alert-success">'+response.message+'</p>');
                }else{
                  $('#alert-telephone').html('<p class="alert alert-warning">'+response.message+'</p>');
                }
                if(response.error_description){
                  console.log('Lỗi trên hệ thống SMS' + response.error_description);
                }
              }
            });
          }
        });
        $('#name-otp').on('change',function(){
          let otp_val = $(this).val();
          let telephone_register = $('#telephone-register').val();
          $('#name-register').val('');
          $('#name-otp').removeClass('is-invalid');
          $('#name-otp').removeClass('is-valid');
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('check.otp.sms')}}",
            method: 'POST',
            data: {
                'telephone': telephone_register,
                'otp_code': otp_val
            },
            dataType: 'JSON',
            success: function (res){
              if(res.status){
                $('#name-otp').removeClass('is-invalid');
                $('#name-otp').addClass('is-valid');
                if(res.data && res.data != null){
                  $('#name-register').val(res.data.student_name);
                  $('#name-register').addClass('is-valid');
                  $('#name-register').attr('readonly','readonly');
                }else{
                  $('#name-register').removeAttr('readonly');
                }
              }else{
                  $('#name-register').attr('readonly','readonly');
                $('#name-otp').addClass('is-invalid');
                $('#name-otp').removeClass('is-valid');
                $('#name-register').val('');
                $('#name-register').removeClass('is-valid');
              }
            }
          });
        })
        $('#btn-booking').on('click',function(e){
            e.stopPropagation();
            let cabin_val = $('#cabin-number').val();
            let time_val = $('#time-choose').val();
            let date_val = $('#date-register').val();
            let date_check =  new Date().toJSON().slice(0,10);
            if(date_val < date_check){
                $('#alert-date').html('<div class="text-danger">Ngày đăng ký không hợp lệ vui lòng chọn lại</div>');
                Swal.fire({
                    title: 'Lưu ý!',
                    text: 'Ngày đăng ký không hợp lệ vui lòng chọn lại',
                    icon: 'error'
                })
                $('#date-register').addClass('is-invalid');
            }else{
                $('#alert-date *').remove();
                $('#date-register').addClass('is-valid');
            }
            let has_readonly = $('#name-register').attr('readonly');
            if(has_readonly !== undefined){
              has_readonly = 2;
            }else{
              has_readonly = 1;
            }
            let name_val = $('#name-register').val();
            let email_val = $('#email-register').val();
            let telephone_val = $('#telephone-register').val();
            let opt_val = $('#name-otp').val();
            if(name_val == '' || cabin_val == '' || date_val == '' || time_val == '' || telephone_val == '' || opt_val == '' || !$('#ckx-confirm').is(':checked')){
                $('#alert-group').html('<div class="text-danger">Vui lòng điền đẩy đủ thông tin</div>');
                if(!$('#ckx-confirm').is(':checked')){
                  $('.confirm-box').addClass('error-alert');
                }else{
                  $('.confirm-box').removeClass('error-alert');
                }
                if(name_val == ''){
                  if(name_val.length > 3){
                    $(this).addClass('is-valid');
                    $('#alert-name *').remove();
                  }else{
                    Swal.fire({
                        title: 'Lưu ý!',
                        text: 'Vui lòng nhập đầy đủ họ tên',
                        icon: 'error'
                    })
                    $(this).removeClass('is-valid');
                    $('#alert-name *').remove();
                    $('#alert-name').html('<label class="text-danger">Vui lòng nhập đầy đủ họ tên</label>');
                    $('#name-register').addClass('is-invalid');
                  }
                }
                if(cabin_val == ''){
                  Swal.fire({
                      title: 'Lưu ý!',
                      text: 'Vui lòng chọn Cabin muốn đăng ký',
                      icon: 'error'
                  })
                  $('#cabin-register').removeClass('is-valid');
                  $('#alert-cabin *').remove();
                  $('#alert-cabin').html('<label class="text-danger">Vui lòng chọn Cabin muốn đăng ký</label>');
                  $('#cabin-register').addClass('is-invalid');
                }
                if(time_val == ''){
                  Swal.fire({
                      title: 'Lưu ý!',
                      text: 'Vui lòng chọn thời gian muốn đăng ký học',
                      icon: 'error'
                  })
                  $('#time-register').removeClass('is-valid');
                  $('#alert-time *').remove();
                  $('#alert-time').html('<label class="text-danger">Vui lòng chọn thời gian muốn đăng ký học</label>');
                  $('#time-register').addClass('is-invalid');
                }
                
                
                if(opt_val == ''){
                  $('#name-otp').addClass('is-invalid');
                  $('#name-otp').removeClass('is-valid');
                }else{
                  $('#name-otp').removeClass('is-invalid');
                  $('#name-otp').addClass('is-valid');
                }

                if(telephone_val == ''){
                  Swal.fire({
                      title: 'Lưu ý!',
                      text: 'Vui lòng kiểm tra lại số điện thoại',
                      icon: 'error'
                  })
                  $(this).removeClass('is-valid');
                  $('#alert-telephone *').remove();
                  $('#alert-telephone').html('<label class="text-danger">Vui lòng kiểm tra lại số điện thoại</label>');
                  $('#telephone-register').addClass('is-invalid');
                }
                if(cabin_val != ''){
                  $('#cabin-register').removeClass('is-invalid');
                  $('#cabin-register').addClass('is-valid');
                  $('#alert-cabin *').remove();
                }
                if(time_val != ''){
                  $('#time-register').removeClass('is-invalid');
                  $('#time-register').addClass('is-valid');
                  $('#alert-time *').remove();
                }
                if(telephone_val != ''){
                  $(this).removeClass('is-invalid');
                  $(this).addClass('is-valid');
                  $('#alert-telephone *').remove();
                }
                 return;
            }else{
              if(cabin_val != ''){
                $('#cabin-register').removeClass('is-invalid');
                $('#cabin-register').addClass('is-valid');
                $('#alert-cabin *').remove();
              }
              if(time_val != ''){
                $('#time-register').removeClass('is-invalid');
                $('#time-register').addClass('is-valid');
                $('#alert-time *').remove();
              }
              if(telephone_val != ''){
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $('#alert-telephone *').remove();
              }
            }
            $.ajax({
                url: '{{ route("creater.or.update")}}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'cabin_val': cabin_val,
                    'time_val': time_val,
                    'date_val': date_val,
                    'date_check': date_check,
                    'name_val': name_val,
                    'email_val': email_val,
                    'telephone_val': telephone_val,
                    'status': has_readonly
                },
                dataType: 'json',
                success: function (data){
                    if(data.status){
                      $('#cabin-number').val('');
                      $('#time-choose').val('');
                      $('#date-register').val(date_check);
                      $('#name-register').val('');
                      $('#email-register').val('');
                      $('#telephone-register').val('');
                      $('#alert-group').html('<div class="text-success">'+data.message+'</div>');
                      Swal.fire({
                          title: 'Thành công!',
                          text: 'Bạn đã đặt lịch học cabin thành công',
                          icon: 'success'
                      })
                    }else{
                        $('#alert-group').html('<div class="text-danger">'+data.message+'</div>');
                        Swal.fire({
                            title: 'Thất bại!',
                            text: 'Đặt lịch học cabin không thành công',
                            icon: 'error'
                        })
                    }
                }
            });
        });
    });
</script>
@endsection