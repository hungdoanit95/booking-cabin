@extends('layouts.app-nohead')

@section('content')
<style>
    .content{
        padding: 15px;
        background-color: #f5f5f5;
        background-clip: border-box;
        border: 0 solid #dfe3e7;
        border-radius: 0.267rem;
        box-shadow: -8px 12px 18px 0 rgba(25,42,70,.13);
        margin-bottom: 2.2rem;
    }
    .content h2{
        font-size: 20px;
        font-weight: bold;
    }
    .list-result p{
        margin-bottom: 5px;
    }
    .card-header h2{
        font-size: 22px;
    }
    #search-booking{
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
        background: transparent;
    }
  #search-booking span {
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
  #search-booking span:nth-child(1) {
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
  #search-booking span:nth-child(2) {
    -webkit-transform: rotateX(0deg);
    -moz-transform: rotateX(0deg);
    transform: rotateX(0deg);
    -webkit-transform-origin: 50% 50% -20px;
    -moz-transform-origin: 50% 50% -20px;
    transform-origin: 50% 50% -20px;
  }
  #search-booking:hover span:nth-child(1) {
    box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
     7px 7px 20px 0px rgba(0,0,0,.1),
     4px 4px 5px 0px rgba(0,0,0,.1);
    -webkit-transform: rotateX(0deg);
    -moz-transform: rotateX(0deg);
    transform: rotateX(0deg);
  }
  #search-booking:hover span:nth-child(2) {
    box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
     7px 7px 20px 0px rgba(0,0,0,.1),
     4px 4px 5px 0px rgba(0,0,0,.1);
   color: transparent;
    -webkit-transform: rotateX(-90deg);
    -moz-transform: rotateX(-90deg);
    transform: rotateX(-90deg);
  }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Tra cứu lịch học') }}</h2></div>

                <div class="card-body">
                    <div class="form-group" id="alert-group">
                    </div>
                    <div class="form-group">
                        <h6>Ngày học:</h6> <div id="alert-date"></div>
                        <input class="form-control" id="date-register" name="date_register" value="{{ date('Y-m-d') }}" type="date" placeholder="Thời gian học">
                    </div>
                    <div class="form-group">
                        <h6>Số điện thoại</h6> <div id="alert-name"></div>
                        <input class="form-control" id="keywords" name="keywords" type="text" placeholder="Nhập số điện thoại tìm kiếm">
                    </div>
                    <div class="form-group">
                        <h6>Otp</h6> <div id="alert-name"></div>
                        <input class="form-control" id="keywords" name="keywords" type="text" placeholder="Nhập mã otp đã được gửi trước đó">
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-success" type="button" id="search-booking"><span>Tìm kiếm</span><span>Tra cứu</span></button>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="result-find">
            </div>
        </div>
    </div>
</div>
<script>
    $('#search-booking').click(function(){
        let date_register = $('#date-register').val();
        let keywords = $('#keywords').val();
        $.ajax({
            url: '{{ route("find.bookings") }}',
            method: 'POST',
            data: {
                date_register: date_register,
                keywords: keywords,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response){
                console.log(response);
                if(response.status){
                    let data_html = `
                        <div class="content">
                            <h2>Kết quả tìm kiếm</h2>
                            <ul class="list-result" style="padding:0">` + 
                                response.data.map((item)=>{
                                    let status_label = (item?.status == 2)?'<span style="padding: 5px 10px; border-radius: 5; background: #249300">Đã xác nhận</span>':'<span style="padding: 5px 10px; border-radius: 5, background: #f00">Chưa xác nhận</span>';
                                    return (`<li class="item">` + 
                                    `<p>Học viên: `+item.name_booking+`</p>` + 
                                    `<p>Điện thoại: `+item.telephone_booking+`</p>` + 
                                    `<p>Ngày học: `+item.date_booking+`</p>` + 
                                    `<p>Thời gian học: `+item.time_value+`</p>`+
                                    `<p>Tình trạng: `+status_label+`</p></li>`
                                )});
                            + `</ul>
                        </div>
                    `;
                    $('#result-find').html(data_html);
                }else{
                    let data_html = `
                        <div class="content">
                            <h2>Kết quả tìm kiếm</h2>
                            <div class="list-result text-center"> Không có lịch nào được đặt</div>
                        </div>
                    `;
                    $('#result-find').html(data_html);
                }
            }
        });
    });
</script>
<style>
    .list-result li{
        background: #dfdfdf;
        padding: 15px;
        border-radius: 10px;
        color: #000;
        list-style: none;
    }
    .list-result li span{
        background: #f00;
        padding: 5px;
        color: #fff;
        border-radius: 5px;
        font-size: 12px;
        box-shadow: 2px 2px 10px #fff;
    }
</style>
@endsection
