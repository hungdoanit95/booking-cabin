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
                        <h6>Từ khoá</h6> <div id="alert-name"></div>
                        <input class="form-control" id="keywords" name="keywords" type="text" placeholder="Nhập học tên hoặc số điện thoại tìm kiếm">
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-success" type="button" id="search-booking">Tra cứu</button>
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
                            <ul class="list-result">` + 
                                response.data.map((item)=>(`<li class="item">` + 
                                    `<p>Học viên: `+item.name_booking+`</p>` + 
                                    `<p>Điện thoại: `+item.telephone_booking+`</p>` + 
                                    `<p>Email: `+item.email_booking+`</p>` + 
                                    `<p>Ngày học: `+item.date_booking+`</p>` + 
                                    `<p>Thời gian học: `+item.time_value+`</p>`+
                                    `<p>Cabin: `+item.name+`</p></li>`
                                ));
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
@endsection
