@extends('layouts.app')
<style>
    .table>:not(caption)>*>*{
        padding: 5px 10px !important;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id="table-booking">
                        <h3>Danh sách lịch học Cabin</h3>
                        <table class="table table-bordered">
                            <thead>
                                <th>Họ tên học viên</th>
                                <th>Số điện thoại viên</th>
                                <th>Email học viên</th>
                                <th>Thời gian học</th>
                                <th>Ghi chú của học viên</th>
                                <th>Học phí</th>
                                <th>Học phí đã đóng</th>
                                <th>Học phí còn thiếu</th>
                                <th>Học phí Cabin</th>
                                <th>Ngày nộp Hp Cabin</th>
                                <th>Trạng thái</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-info">Lấy dữ liệu</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
