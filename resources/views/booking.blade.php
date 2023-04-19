@extends('layouts.app-nohead')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
<link rel="stylesheet" href="{{asset('assets/lib-datetime/themes/default.css')}}">
<link rel="stylesheet" href="{{asset('assets/lib-datetime/themes/default.date.css')}}">
<link rel="stylesheet" href="{{asset('assets/lib-datetime/themes/default.time.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<style>
    .btn-search{
        position: absolute;
        top: 0;
        right: 0;
        padding: 6px 15px;
        z-index: 2;
    }
    .btn-search {
      background: #00cfdd;
      background: linear-gradient(0deg, #269ec4 0%, #00cfdd 100%);
      color: #fff;
      border: none;
      transition: all 0.3s ease;
      overflow: hidden;
    }
    .btn-search:after {
      position: absolute;
      content: " ";
      top: 0;
      left: 0;
      z-index: -1;
      width: 100%;
      height: 100%;
      transition: all 0.3s ease;
      -webkit-transform: scale(.1);
      transform: scale(.1);
    }
    .btn-search:hover {
      color: #fff;
      border: none;
      background: transparent;
    }
    .btn-search:hover:after {
      background: rgb(0 177 255);
    background: linear-gradient(0deg, rgb(2 225 251) 0%,  rgb(0 194 255)100%);
      -webkit-transform: scale(1);
      transform: scale(1);
    }
    #btn-booking {
      width: 130px;
      height: 40px;
      color: #fff;
      border-radius: 5px;
      padding: 10px 25px;
      font-family: 'Lato', sans-serif;
      font-weight: 500;
      background: transparent;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      display: inline-block;
      box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
      7px 7px 20px 0px rgba(0,0,0,.1),
      4px 4px 5px 0px rgba(0,0,0,.1);
      outline: none;
    }
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
      right: 3px;
      padding: 6px;
      background: #ebebeb;
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
    #time-register button:after {
    position: absolute;
    content: "";
    width: 0;
    height: 100%;
    top: 0;
    left: 0;
    direction: rtl;
    z-index: -1;
    box-shadow:
     -7px -7px 20px 0px #fff9,
     -4px -4px 5px 0px #fff9,
     7px 7px 20px 0px #0002,
     4px 4px 5px 0px #0001;
    transition: all 0.3s ease;
  }
  #time-register button{
    position: relative;
  }
  #time-register button:hover {
    color: #ebfac1;
  }
  #time-register button:hover:after {
    left: auto;
    right: 0;
    width: 100%;
    z-index: 999;
  }
  #time-register button:active {
    top: 2px;
  }
  #btn-booking{
    position: relative;
    right: 20px;
    bottom: 20px;
    border:none;
    box-shadow: none;
    width: 130px;
    height: 40px;
    line-height: 42px;
    -webkit-perspective: 230px;
    perspective: 230px;
  }
  #btn-booking span {
    background: rgb(0,172,238);
  background: linear-gradient(0deg, rgba(0,172,238,1) 0%, rgba(2,126,251,1) 100%);
    display: block;
    position: absolute;
    width: 130px;
    height: 40px;
    box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
     7px 7px 20px 0px rgba(0,0,0,.1),
     4px 4px 5px 0px rgba(0,0,0,.1);
    border-radius: 5px;
    margin:0;
    text-align: center;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition: all .3s;
    transition: all .3s;
  }
  #btn-booking span:nth-child(1) {
    box-shadow:
     -7px -7px 20px 0px #fff9,
     -4px -4px 5px 0px #fff9,
     7px 7px 20px 0px #0002,
     4px 4px 5px 0px #0001;
    -webkit-transform: rotateX(90deg);
    -moz-transform: rotateX(90deg);
    transform: rotateX(90deg);
    -webkit-transform-origin: 50% 50% -20px;
    -moz-transform-origin: 50% 50% -20px;
    transform-origin: 50% 50% -20px;
  }
  #btn-booking span:nth-child(2) {
    -webkit-transform: rotateX(0deg);
    -moz-transform: rotateX(0deg);
    transform: rotateX(0deg);
    -webkit-transform-origin: 50% 50% -20px;
    -moz-transform-origin: 50% 50% -20px;
    transform-origin: 50% 50% -20px;
  }
  #btn-booking:hover span:nth-child(1) {
    box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
     7px 7px 20px 0px rgba(0,0,0,.1),
     4px 4px 5px 0px rgba(0,0,0,.1);
    -webkit-transform: rotateX(0deg);
    -moz-transform: rotateX(0deg);
    transform: rotateX(0deg);
  }
  #btn-booking:hover span:nth-child(2) {
    box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
     7px 7px 20px 0px rgba(0,0,0,.1),
     4px 4px 5px 0px rgba(0,0,0,.1);
   color: transparent;
    -webkit-transform: rotateX(-90deg);
    -moz-transform: rotateX(-90deg);
    transform: rotateX(-90deg);
  }
  #address-register select{
    -webkit-appearance: auto;
    -moz-appearance: auto;
    appearance: auto;
    border-radius: 0;
  }
  @media (max-width: 768px){
    .card{
      border: 10px solid #1f3c5f;
    }
    .card .card-header, .card .card-header~.card-body{
      padding: 10px;
    }
    .card-header h2{
      font-size: 18px;
      font-weight: bold;
      margin-top: 10px;
    }
    .title-otp{
      margin-top: 12px;
    }
    .group-otp input{
      margin-bottom: 5px;
    }
  }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h2>{{ __('Đăng ký trải nghiệm Cabin') }}</h2>
                    <p>140 Cộng Hòa, P.4, Q. Tân Bình, Hồ Chí Minh (Tầng 10 - Trường ĐH Văn Hóa Nghệ Thuật Quân Đội - phía sau Nhà hát Quân Đội)</p>
                    {{-- <p>180/28/23 Nguyễn Hữu Cảnh, Phường 22, Bình Thạnh, Thành phố Hồ Chí Minh</p> --}}
                    <a href="/tim-kiem" class="btn btn-info btn-search"><i class="fa fa-search" aria-hidden="true"></i></a>
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
                            <div class="col-sm-3 group-otp">
                                <h6 class="title-otp">Mã OTP <span style="color: #f00">(*)</span></h6> <div id="alert-otp"></div>
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
                    <div class="form-group">
                      <h6>Địa chỉ trải nghiệm</h6>
                      <div id="address-register">
                        <select class="form-control is-valid">
                          {{-- <option value="1">Bình Thạnh</option> --}}
                          <option value="2">Tân Bình</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                        <h6>Ngày trải nghiệm <span style="color: #f00">(*)</span></h6> <div id="alert-date"></div>
                        <?php $current_date = date("Y-m-d"); ?>
                        <input class="form-control" id="date-register" name="date_register" min="{{ date('Y-m-d') }}" type="date" placeholder="Thời gian">
                    </div>
                    <div class="form-group">
                      <h6>Thời gian <span style="color: #f00">(*)</span></h6> <div id="alert-time"></div>
                      <div id="time-register">
                          @foreach($time_books as $time_book)
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
                          @endforeach
                        <input id="time-choose" name="time_choose" type="hidden">
                      </div>
                    </div>
                    <div id="input-price" class="form-group">
                      <h6>Phí trải nghiệm</h6>
                      <input id="price" type="text" style="font-weight: bold" class="form-control" value="Miễn phí">
                    </div>
                    <div class="form-group">
                        <h6>Ghi chú</h6>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <p style="color: #f00; font-family: Arial">Lưu ý: Học viên đăng ký trải nghiệm Cabin nhưng không đến được vui lòng hủy lịch trước 24h. 
                            <br/>Trường hợp không hủy hoặc không được hủy, thời gian trải nghiệm vẫn được tính chi phí cho học viên
                         </p>
                        <div class="confirm-box">
                          <p style="color: #000;display: flex;vertical-align: middle;"><input id="ckx-confirm" type="checkbox" /> <label style="font-size: 13px; margin-left: 5px;" for="ckx-confirm">Tôi đồng ý với lưu ý trên</label></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-success" type="button" id="btn-booking"><span>Đặt lịch</span><span>Xác nhận</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
      let address_id = $('#address-register select').val();
      if(date_register !== ''){
        let list_times_register = document.querySelectorAll('#time-register button');
        list_times_register?.forEach((btn_time)=>{
            btn_time.classList.remove('btn-default');
            btn_time.classList.add('btn-info');
        });
        $.ajax({
            url: '{{ route("check.time.cabin") }}',
            data: {
                'date_booking': date_register,
                'address_id': address_id
            },
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success: function (res){
              let date_check =  new Date().toJSON().slice(0,10);
              let hour_check =  new Date().toLocaleString().slice(0,2);
              if(date_check == date_register){
                let count_time = 6;
                list_times_register?.forEach((btn_time)=>{
                  if((parseInt(hour_check) + 2) > parseInt(count_time)){
                    btn_time.classList.add('btn-default');
                    if(btn_time.classList.contains('btn-info')){
                      btn_time.classList.remove('btn-info');
                    }
                  }
                  count_time++;
                });
              }
              if(res?.data?.length > 0){
                res?.data?.map((i_time)=>{
                  list_times_register?.forEach((btn_time)=>{
                      if(Object.keys(i_time.time_id) && (i_time.time_id.split(',').includes(btn_time.getAttribute('html-value')))){
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
        $('#address-register select').on('focus',function(){
          $('#address-register select').addClass('is-valid');
          checkTimeCabin();
        });
        $('#address-register select').on('change',function(){
          $('#address-register select').addClass('is-valid');
          checkTimeCabin();
        });
        $('#date-register').on('change',function(){
          console.log($('#address-register select').val());
          if(!$('#address-register select').hasClass('is-valid')){
            Swal.fire({
              title: 'Lưu ý!',
              text: 'Vui lòng chọn địa chỉ trước',
              icon: 'error'
            })
            return;
          }else{
            $('#date-register').addClass('is-valid');
            checkTimeCabin();
          }
        })
        $('#date-register').on('change',function(e){
          if(!$('#address-register select').hasClass('is-valid')){
            Swal.fire({
              title: 'Lưu ý!',
              text: 'Vui lòng chọn địa chỉ trước',
              icon: 'error'
            })
            return;
          }
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


        // $('#email-register').on('change',function(e){
        //     email = $(this).val();
        //     if(email != ''){
        //       if(validateEmail(email)){
        //           $(this).removeClass('is-invalid');
        //           $(this).addClass('is-valid');
        //           $('#alert-email *').remove();
        //       }else{
        //           $(this).removeClass('is-valid');
        //           $('#alert-email *').remove();
        //           $('#alert-email').html('<p class="alert alert-danger">Vui lòng kiểm tra lại email</p>');
        //           $('#email-register').addClass('is-invalid');
        //           return;
        //       }
        //     }
        // })

        //Check số điện thoại
        $('#telephone-register').on('change',function(e){
            let telephone = $(this).val();
            let otp_val = $('#name-otp').val();
            if(validatePhone(telephone)){
              $(this).removeClass('is-invalid');
              $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('check.otp.sms')}}",
                method: 'POST',
                data: {
                    'telephone': telephone,
                    'otp_code': otp_val
                },
                dataType: 'JSON',
                success: function (res){
                  if(res.status){
                    $('#name-otp').removeClass('is-invalid');
                    $('#name-otp').addClass('is-valid');
                    if(res.data){
                      $('#name-register').val(res.data.student_name);
                      $('#name-register').addClass('is-valid');
                    }
                  }else{
                    $('#name-otp').removeClass('is-valid');
                    $('#name-register').val('');
                    $('#name-register').removeClass('is-valid');
                  }
                }
              });
              $(this).addClass('is-valid');
              $('#alert-telephone *').remove();
            }else{
              $(this).removeClass('is-valid');
              $('#alert-telephone *').remove();
              $('#alert-telephone').html('<p class="alert alert-danger">Vui lòng kiểm tra lại số điện thoại</p>');
              $('#telephone-register').addClass('is-invalid');
              return;
            }
        })
        var value_choose = [];
        var i_count = 0;
        $('.btn-item button').on('click',function(){
          value_choose = value_choose;
          if($('#date-register').val() == ''){
            Swal.fire({
                title: 'Lưu ý!',
                text: 'Vui lòng chọn ngày trải nghiệm trước!',
                icon: 'error'
            })
            return;
          }
          let buttons = document.querySelectorAll('.btn-item button');
          let this_val = $(this).attr('html-value');
          let time_register = document.querySelectorAll('#time-register .btn');
          var check_click_cabin = 0;
          time_register.forEach((item)=>{
              if(item.classList.contains('btn-success')){
                check_click_cabin = check_click_cabin + 1;
              }
          });

          if(this_val != ''){
            if(!value_choose.includes(this_val)){
              if(i_count < 3 && !$(this).hasClass('btn-default')){
                value_choose.push(this_val);
                i_count++;
              }
            }else{
              --i_count;
              value_choose = value_choose.filter(item => item !== this_val);
            }
            if(i_count > 0){
              $('#date-register').attr('readonly','readonly');
              $('#input-price input').addClass('is-valid');
              if(i_count > 1 && i_count <= 3){
                let price_default = 320000;
                let price_text = (price_default * i_count - price_default).toLocaleString('vi-VN', {
                  style: 'currency',
                  currency: 'VND',
                });
                $('#input-price input').val(price_text);
              }else{
                $('#input-price input').val('Miễn phí');
              }
            }else{
              $('#date-register').removeAttr('readonly','readonly');
              $('#input-price input').removeClass('is-valid');
            }
          }
          
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
              if(check_click_cabin > 3){
                // element.classList.remove("btn-success");
                // element.classList.add("btn-info");
                Swal.fire({
                    title: 'Cảnh báo!',
                    text: 'Bạn chỉ có thể đặt tối đa 3 giờ học!',
                    icon: 'error'
                })
                return;
              }
            }else if(this_val == element.getAttribute('html-value')){
              if(element.classList.contains('btn-success')){
                element.classList.remove("btn-success");
                element.classList.add("btn-info");
              }else{
                if(check_click_cabin < 3){
                  element.classList.add("btn-success");
                  element.classList.remove("btn-info");
                }
              }
            }
          });
          $('#time-choose').val(value_choose.toString());
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
                  Swal.fire({
                      title: 'Cảnh báo!',
                      text: response.message,
                      icon: 'error'
                  })
                  $('#alert-telephone').html('<p class="alert alert-danger">Cảnh báo: '+response.message+'</p>');
                  return;
                }
                if(response.status){
                  Swal.fire({
                      title: 'Thành công!',
                      text: response.message,
                      icon: 'success'
                  })
                  $('#alert-telephone').html('<p class="alert alert-success">'+response.message+'</p>');
                }else{
                  Swal.fire({
                      title: 'Lưu ý!',
                      text: response.message,
                      icon: 'error'
                  })
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
        });
        $('#btn-booking').on('click',function(e){
            e.stopPropagation();
            let cabin_val = $('#cabin-number').val();
            let time_val = $('#time-choose').val();
            let date_val = $('#date-register').val();
            let address_id = $('#address-register select').val();
            let date_check =  new Date().toJSON().slice(0,10);
            if(date_val < date_check){
                $('#alert-date').html('<div class="text-danger">Ngày trải nghiệm không hợp lệ vui lòng chọn lại</div>');
                Swal.fire({
                    title: 'Lưu ý!',
                    text: 'Ngày trải nghiệm không hợp lệ vui lòng chọn lại',
                    icon: 'error'
                })
                $('#date-register').addClass('is-invalid');
            }else{
                $('#alert-date *').remove();
                $('#date-register').addClass('is-valid');
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
                    'address_id': address_id,
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
                      html: data.message,
                      icon: 'success'
                    }).then(function(isConfirm) {
                      window.location.reload(false);
                    });
                  }else{
                    $('#alert-group').html('<div class="text-danger">'+data.message+'</div>');
                    Swal.fire({
                      title: 'Thất bại!',
                      html: data.message,
                      icon: 'error'
                    })
                  }
                }
            });
        });
    });
</script>
<script>
  $(document).ready(function() {
    
    $('#time-register .btn').click(function(){
      if(!$('#address-register select').hasClass('is-valid')){
        Swal.fire({
          title: 'Lưu ý!',
          text: 'Vui lòng chọn địa điểm trải nghiệm',
          icon: 'error'
        })
        return;
      }
    });
    var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', '{{ asset("assets/mp3/ting.mp3") }}');
    
    $('#time-register .btn, #btn-booking').click(function() {
      if($(this).hasClass('btn-success')){
        audioElement.play();
        setTimeout(function(){
          audioElement.pause();
          audioElement.currentTime = 0;
        },500);
      }
    });
    
    // $('#pause').click(function() {
    //     audioElement.pause();
    // });
    
    // $('#restart').click(function() {
    //     audioElement.currentTime = 0;
    // });
});
</script>
<script src="{{asset('assets/lib-datetime/picker.js')}}"></script>
<script src="{{asset('assets/lib-datetime/picker.date.js')}}"></script>
<script src="{{asset('assets/lib-datetime/picker.time.js')}}"></script>
<script src="{{asset('assets/lib-datetime/legacy.js')}}"></script>
@endsection
