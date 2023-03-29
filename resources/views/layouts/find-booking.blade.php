@extends('layouts.app-nohead')

@section('content')
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
        </div>
    </div>
</div>
@endsection
