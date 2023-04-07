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
    #time-register .btn-default{
        border: 1px solid;
        text-decoration: line-through;
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
                  <div id="info-booking">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-group" id="alert-group">
                    </div>
                    <div class="form-group">
                        <h6>Thông tin học viên</h6> <div id="alert-name"></div>
                        <input  class="form-control" readonly id="name-register" name="name_register" type="text" placeholder="Thông tin học viên">
                    </div>
                    <div class="form-group">
                        <h6>Ngày đăng ký <span style="color: #f00">(*)</span></h6> <div id="alert-date"></div>
                        <?php $current_date = date("Y-m-d"); ?>
                        <input class="form-control" id="date-register" name="date_register" min="{{ date('Y-m-d', strtotime($current_date. ' + 2 days')) }}" value="{{ date('Y-m-d', strtotime($current_date. ' + 2 days')) }}" type="date" placeholder="Thời gian học">
                    </div>
                    <div class="form-group">
                      <h6>Thời gian học <span style="color: #f00">(*)</span></h6> <div id="alert-time"></div>
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
                        <button class="btn btn-success" style="width: 100%" type="button" id="btn-booking">Đặt lịch</button>
                    </div>
                  </div>
                  <div id="filter-student">
                    <div class="col-sm-12">
                      <label for="search-student">Tìm kiếm học viên</label>
                      <input id="search-student" placeholder="Tìm từ khóa liên quan đến học viên" />
                    </div>
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
        
        function startTimer(duration, display) {
          var timer = duration, seconds;
          if(timer > 0){
            let check_value = 0;
            let interval_id = setInterval(function () {
              seconds = parseInt(timer % 60, 10);
              document.getElementById('get-OTP').classList.add('block-btn');
              display.text(seconds);

              if (--timer < 0) {
                clearInterval(interval_id);
                document.getElementById('get-OTP').classList.remove('block-btn');
                display.text('Lấy mã OTP');
              }
            }, 1000);
          }
        }
        var i = 0;
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
            if(name_val == '' || cabin_val == '' || date_val == '' || time_val == '' || telephone_val == '' || !$('#ckx-confirm').is(':checked')){
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