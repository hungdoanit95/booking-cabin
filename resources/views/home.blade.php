@extends('layouts.app')
<style>
    .table>:not(caption)>*>*{
        padding: 5px 10px !important;
    }
    #table-booking{
        font-family: Arial;
    }
    #table-booking .btn-info{
        padding: 8px 10px;
    }
    #table-booking .btn-info i{
        line-height: 16px;
    }
    #table-booking h3{
        font-size: 16px;
    }
    #table-booking thead th{
        font-size: 13px;
        background: #0a2b46;
        color: #fff;
        text-transform: unset;
        padding: 12px 10px !important;
    }
    #table-booking table td{
        font-size: 13px;
    }
    #table-booking table tbody > tr:nth-child(2n){
        background: #ecf3fb;
    }
    .bg-filter{
      margin-bottom: 25px;
    }
</style>
@section('content')
<div class="container-fluid">
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
                        <div id="loc-danh-sach" class="row">
                            <div class="col-sm-6">
                                <h3>Danh sách lịch học Cabin</h3>
                            </div>
                            <div class="col-sm-6">
                              <div class="bg-filter">
                                <h3>Lọc tìm kiếm</h3>
                                <form action="" method="GET">
                                  <div class="row">
                                    <div class="col-sm-4">
                                        <label>Mã học viên / Số điện thoại</label>
                                        <input placeholder="Mã học viên / Số điện thoại" class="form-control" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Ngày đăng ký</label>
                                        <input placeholder="Mã học viên / Sdt" type="date" class="form-control" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Trạng thái</label>
                                        <select class="form-control">
                                            <option value="0">--- Lựa chọn ---</option>
                                            <option value="1">Chưa duyệt</option>
                                            <option value="2">Đã duyệt</option>
                                            <option value="3">Đã Hủy</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label style="display: inline-block;width: 100%">&ensp;</label>
                                        <button class="btn btn-info"><i class="fa fa-search"></i></button>
                                    </div>
                                  </div>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                </form>
                              </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <th>Mã khóa học</th>
                                <th>Mã học viên</th>
                                <th>Họ tên học viên</th>
                                <th>Số điện thoại viên</th>
                                <th>Ngày Dky trải nghiệm</th>
                                <th>Thời gian Dky</th>
                                <th>Ghi chú của Hv</th>
                                <th>Học phí</th>
                                <th>Học phí đã đóng</th>
                                <th>Học phí còn thiếu</th>
                                <th>Học phí Cabin</th>
                                <th>Ngày nộp Hp Cabin</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @if(!empty($datas) && count($datas) > 0)
                                    @foreach($datas as $data)
                                        <tr>
                                            <td><b>{{$data['course_code']}}</b></td>
                                            <td>{{$data['student_code']}}</td>
                                            <td>{{$data['name_booking']}}</td>
                                            <td>{{$data['telephone_booking']}}</td>
                                            <td>{{$data['date_booking']}}</td>
                                            <td>{{$data['time_value']}}</td>
                                            <td>{{$data['notes_booking']}}</td>
                                            <td>{{$data['tuition_total']}}</td>
                                            <td>{{$data['tuition_paid']}}</td>
                                            <td>{{$data['tuition_unpaid']}}</td>
                                            <td>{{$data['date_payout']}}</td>
                                            <td>{{$data['cabin_money']}}</td>
                                            <td>{!! $data['status'] == 1?'Chờ duyệt':($data['status'] == 2?'Đã duyệt':($data['status'] == 3?'Đã hủy':'Chưa xác định')) !!}</td>
                                            <td><button class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                                        </tr>
                                    @endforeach
                                @else
                                  <tr>
                                    <td colspan="13">
                                      <p>Chưa có dữ liệu</p>
                                    </td>
                                  </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- <button class="btn btn-info">Lấy dữ liệu</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
