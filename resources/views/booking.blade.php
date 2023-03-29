@extends('layouts.app-nohead')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Đăng ký học Cabin') }}</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-group" id="alert-group">
                    </div>
                    <div class="form-group">
                        <h6>Ngày đăng ký</h6> <div id="alert-date"></div>
                        <input class="form-control" id="date-register" name="date_register" value="{{ date('Y-m-d') }}" type="date" placeholder="Thời gian học">
                    </div>
                    <div class="form-group">
                        <h6>Họ tên học viên</h6> <div id="alert-name"></div>
                        <input class="form-control" id="name-register" name="name_register" type="text" placeholder="Họ tên học viên">
                    </div>
                    <div class="form-group">
                        <h6>Email học viên (nếu có)</h6> <div id="alert-email"></div>
                        <input class="form-control" type="email" id="email-register" name="email_register" placeholder="Email học viên">
                    </div>
                    <div class="form-group">
                        <h6>Số điện thoại học viên</h6> <div id="alert-telephone"></div>
                        <input class="form-control" type="telephone" id="telephone-register" name="telephone_register" placeholder="Số điện thoại học viên">
                    </div>
                    <div class="form-group">
                        <h6>Cabin</h6> <div id="alert-cabin"></div>
                        <ul class="list-cabin" id="cabin-register">
                            @foreach ($cabins as $cabin)
                                <li>
                                    <a href="javascript:void(0);" class="btn btn-primary" html-value={{ $cabin['id'] }}>{{ $cabin['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <input name="cabin_number" id="cabin-number" type="hidden" />
                    </div>
                    <div class="form-group">
                      <h6>Thời gian học</h6> <div id="alert-time"></div>
                      <div id="time-register">
                        <swiper-container>
                          @foreach($time_books as $time_book)
                          <swiper-slide>
                              <div class="slide-item">
                                  @foreach($time_book as $books)
                                      <div class="btn-item">
                                          @foreach($books as $book)
                                              <button html-value="{{ $book['time_id'] }}" type="button" class="btn btn-info mt-1">
                                                  {{ $book['time_value'] }}
                                              </button>
                                          @endforeach
                                      </div>
                                  @endforeach
                              </div>
                          </swiper-slide>
                          @endforeach
                        </swiper-container>
                        <input id="time-choose" name="time_choose" type="hidden">
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
    $(document).ready(()=>{
        let err_message = '';
        $('#date-register').on('click',function(){
            $('#date-register').addClass('is-valid');
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
        $('#name-register').on('change',function(e){
            let name_register = $(this).val();
            if(name_register.length > 3){
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $('#alert-name *').remove();
            }else{
                $(this).removeClass('is-valid');
                $('#alert-name *').remove();
                $('#alert-name').html('<label class="text-danger">Vui lòng nhập đầy đủ họ tên</label>');
                $('#name-register').addClass('is-invalid');
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
                  $('#alert-email').html('<label class="text-danger">Vui lòng kiểm tra lại email</label>');
                  $('#email-register').addClass('is-invalid');
                  return;
              }
            }
        })
        $('#telephone-register').on('change',function(e){
            let telephone = $(this).val();
            if(validatePhone(telephone)){
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $('#alert-telephone *').remove();
            }else{
                $(this).removeClass('is-valid');
                $('#alert-telephone *').remove();
                $('#alert-telephone').html('<label class="text-danger">Vui lòng kiểm tra lại số điện thoại</label>');
                $('#telephone-register').addClass('is-invalid');
                return;
            }
        })
        $('.btn-item button').on('click',function(){
            let buttons = document.querySelectorAll('.btn-item button');
            let this_val = $(this).attr('html-value');
            let value_choose = '';
            
            if($(this).hasClass('btn-default')){
                Swal.fire({
                    title: 'Chú ý!',
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
        
        $('.list-cabin a').on('click',function(){
            let buttons = document.querySelectorAll('.list-cabin a');
            let this_val = $(this).attr('html-value');
            let value_choose = '';
            buttons.forEach(element => {
                if(this_val != element.getAttribute('html-value') && element.classList.contains('btn-success')){
                    element.classList.remove("btn-success");
                    element.classList.add("btn-primary");
                }else if(this_val == element.getAttribute('html-value')){
                    if(element.classList.contains('btn-success')){
                        element.classList.remove("btn-success");
                        element.classList.add("btn-primary");
                        value_choose = '';
                    }else{
                        element.classList.add("btn-success");
                        element.classList.remove("btn-primary");
                        value_choose = this_val;
                    }
                }
            });
            $('#cabin-number').val(value_choose);
        });
        $('#btn-booking').on('click',function(e){
            e.stopPropagation();
            let cabin_val = $('#cabin-number').val();
            let time_val = $('#time-choose').val();
            let date_val = $('#date-register').val();
            let date_check =  new Date().toJSON().slice(0,10);
            if(date_val < date_check){
                $('#alert-date').html('<div class="text-danger">Ngày đăng ký không hợp lệ vui lòng chọn lại</div>');
                Swal.fire({
                    title: 'Chú ý!',
                    text: 'Ngày đăng ký không hợp lệ vui lòng chọn lại',
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
            if(name_val == '' || cabin_val == '' || date_val == '' || time_val == '' || telephone_val == ''){
                $('#alert-group').html('<div class="text-danger">Vui lòng điền đẩy đủ thông tin</div>');
                if(name_val == ''){
                  if(name_val.length > 3){
                    $(this).addClass('is-valid');
                    $('#alert-name *').remove();
                  }else{
                    Swal.fire({
                        title: 'Chú ý!',
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
                      title: 'Chú ý!',
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
                      title: 'Chú ý!',
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
                      title: 'Chú ý!',
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
