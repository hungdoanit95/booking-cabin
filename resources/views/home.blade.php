@extends('layouts.app')
<style>
    .table>:not(caption)>*>*{
        padding: 5px 10px !important;
    }
    #table-booking{
        font-family: Arial;
    }
    #table-booking .btn-info,#table-booking .btn-danger{
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
    #table-booking tr:focus{
        background: #ecf3fb
    }
    table select{
      border: 1px solid #a3a3a3;
      padding: 2px;
      border-radius: 4px;
      background: #fdfdfd;
      box-shadow: 2px 2px 5px #afaeae;
      outline: none;
    }
    table select:disabled{
      border: none;
      background: transparent;
      -webkit-appearance: none;
      -moz-appearance: none;
      text-indent: 1px;
      text-overflow: '';
      padding: 2px;
      border-radius: 4px;
      box-shadow: unset;
    }
    .row-delete td{
      text-decoration: line-through;
    }
    #loc-danh-sach select{
      -moz-appearance:auto; /* Firefox */
      -webkit-appearance:auto; /* Safari and Chrome */
      appearance:auto;
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
                            <div class="col-sm-3">
                                <h3>Danh sách lịch học Cabin</h3>
                                <select style="margin-top: 35px;" class="form-control" id="view-type">
                                  <option {{isset($filter['typeview']) && $filter['typeview'] == '*'?'selected':''}} value="*">--- Chế độ xem ---</option>
                                  <option {{isset($filter['typeview']) && $filter['typeview'] == 1?'selected':''}} value="1">Ngày học (Mới -> Cũ)</option>
                                  <option {{isset($filter['typeview']) && $filter['typeview'] == 2?'selected':''}} value="2">Ngày học (Cũ -> Mới)</option>
                                  <option {{isset($filter['typeview']) && $filter['typeview'] == 3?'selected':''}} value="3">Ngày đặt (Mới -> cũ)</option>
                                  <option {{isset($filter['typeview']) && $filter['typeview'] == 4?'selected':''}} value="4">Ngày đặt (Cũ -> Mới)</option>
                                </select>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                              <div class="bg-filter">
                                <h3>Lọc tìm kiếm</h3>
                                <form action="" method="GET">
                                  <div class="row">
                                    <div class="col-sm-4">
                                        <label>Mã học viên / Số điện thoại</label>
                                        <input name="student_phonecode" value="{{$filter['student_phonecode']}}" placeholder="Mã học viên / Số điện thoại" class="form-control" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Ngày đăng ký</label>
                                        <input name="date_booking" value="{{$filter['date_booking']}}" placeholder="Mã học viên / Sdt" type="date" class="form-control" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Trạng thái</label>
                                        <select name="status" class="form-control">
                                            <option {{isset($filter['status']) && $filter['status'] == 0?'selected':''}} value="0">--- Lựa chọn ---</option>
                                            <option {{isset($filter['status']) && $filter['status'] == 1?'selected':''}} value="1">Chưa duyệt</option>
                                            <option {{isset($filter['status']) && $filter['status'] == 2?'selected':''}} value="2">Đã duyệt</option>
                                            <option {{isset($filter['status']) && $filter['status'] == 3?'selected':''}} value="3">Đã Hủy</option>
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
                        <div style="overflow: auto">
                            <table class="table table-bordered">
                              @if($user_login->group_id == 1)
                                <thead>
                                    <th>Mã khóa học</th>
                                    <th>Mã học viên</th>
                                    <th>Họ tên học viên</th>
                                    <th>Số điện thoại học viên</th>
                                    <th>Ngày</th>
                                    <th>Thời gian</th>
                                    <th>Ghi chú của Hv</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </thead>
                              @elseif($user_login->group_id == 2)
                              <thead>
                                  <th>Mã khóa học</th>
                                  <th>Mã học viên</th>
                                  <th>Họ tên học viên</th>
                                  <th>Số điện thoại học viên</th>
                                  <th>Ngày</th>
                                  <th>Thời gian</th>
                                  <th>Ghi chú của Hv</th>
                                  <th>Học phí</th>
                                  <th>Học phí đã đóng</th>
                                  <th>Học phí còn thiếu</th>
                                  <th>Học phí Cabin</th>
                                  <th>Ngày nộp Hp Cabin</th>
                                  <th>Địa chỉ</th>
                                  <th>Trạng thái</th>
                                  <th></th>
                              </thead>
                              @endif
                                <tbody>
                                    @if(!empty($datas) && count($datas) > 0)
                                        @foreach($datas as $data)
                                          @if($user_login->group_id == 1)
                                            <tr {!! ((!empty($data['status']) && !in_array($data['status'],[1,2]) && $data['status'] == 3))?'class="row-delete"':''; !!} id="row-{{$data['id']}}">
                                                <td><b>{{$data['course_code']}}</b></td>
                                                <td>{{$data['student_code']}}</td>
                                                <td>{{$data['name_booking']}}</td>
                                                <td>{{$data['telephone_booking']}}</td>
                                                <td>{{$data['date_booking']}}</td>
                                                <td>{{$data['time_value']}}</td>
                                                <td>{{$data['notes_booking']}}</td>
                                                <td>{!! ($data['address_id'] == 1)?'Bình Thạnh':'Tân Bình' !!}</td>
                                                <td {!! (!empty($data['status']) && !in_array($data['status'],[1,2]) && $data['status'] == 3)?'style="text-decoration: unset;':'' !!}>
                                                  @if(!empty($data['status']) && in_array($data['status'],[1,2]))
                                                  <select html-value="{{ $data['status'] }}" disabled name="status" class="{!! $data['status'] == 1?'text-warning':($data['status'] == 2?'text-success':'text-danger') !!}" id="status">
                                                    <option {!! $data['status'] == 1?'selected':'' !!} value="1" class="text-warning">Chờ duyệt</option>
                                                    <option {!! $data['status'] == 2?'selected':'' !!} value="2">Đã duyệt</option>
                                                  </select>
                                                  @endif
                                                  
                                                  @if(!empty($data['status']) && !in_array($data['status'],[1,2]) && $data['status'] == 3)
                                                  <span style="padding: 2px" class="text-danger">Đã hủy</span>
                                                  @endif
                                                  @if(!empty($data['status']) && !in_array($data['status'],[1,2]) && $data['status'] == 4)
                                                  <span style="padding: 2px" class="text-default">Chưa xác định</span>
                                                  @endif
                                                </td>
                                                <td>
                                                    @if(!in_array($data['status'],[2,3]))
                                                      <button html-value="{{$data['id']}}" class="btn btn-info btn-save-build hidden"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                                      <button class="btn btn-info btn-edit-build"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                      <button class="btn btn-danger" onClick="deleteBookingId({{$data['id']}})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                          @elseif($user_login->group_id == 2)
                                            <tr {!! ((!empty($data['status']) && !in_array($data['status'],[1,2]) && $data['status'] == 3))?'class="row-delete"':''; !!} id="row-{{$data['id']}}">
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
                                              <td>{!! ($data['address_id'] == 1)?'Bình Thạnh':'Tân Bình' !!}</td>
                                              <td {!! (!empty($data['status']) && !in_array($data['status'],[1,2]) && $data['status'] == 3)?'style="text-decoration: unset;':'' !!}>
                                                @if(!empty($data['status']) && in_array($data['status'],[1,2]))
                                                <select html-value="{{ $data['status'] }}" disabled name="status" class="{!! $data['status'] == 1?'text-warning':($data['status'] == 2?'text-success':'text-danger') !!}" id="status">
                                                  <option {!! $data['status'] == 1?'selected':'' !!} value="1" class="text-warning">Chờ duyệt</option>
                                                  <option {!! $data['status'] == 2?'selected':'' !!} value="2">Đã duyệt</option>
                                                </select>
                                                @endif
                                                
                                                @if(!empty($data['status']) && !in_array($data['status'],[1,2]) && $data['status'] == 3)
                                                <span style="padding: 2px" class="text-danger">Đã hủy</span>
                                                @endif
                                                @if(!empty($data['status']) && !in_array($data['status'],[1,2]) && $data['status'] == 4)
                                                <span style="padding: 2px" class="text-default">Chưa xác định</span>
                                                @endif
                                              </td>
                                              <td>
                                                  @if(!in_array($data['status'],[2,3]))
                                                    <button html-value="{{$data['id']}}" class="btn btn-info btn-save-build hidden"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                                    <button class="btn btn-info btn-edit-build"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                    <button class="btn btn-danger" onClick="deleteBookingId({{$data['id']}})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                  @endif
                                              </td>
                                            </tr>
                                          @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function deleteBookingId(bookingId){
      $.ajax({
          url: '{{route("admin.delete.booking")}}',
          method: 'POST',
          data: {
              'booking_id':bookingId
          },
          dataType: 'JSON',
          success: function(res){
            if(res.status){
              Swal.fire({
                title: 'Thành công!',
                text: res.message,
                icon: 'success'
              }).then(function(){
                  window.location.reload();
              })
            }else{
              Swal.fire({
                title: 'Thất bại!',
                text: res.message,
                icon: 'error'
              })
            }
          }
      });
    }
    
    $('.btn-edit-build').on('click', function(){
      $(this).closest('tr').find('select').removeAttr("disabled");
      $(this).addClass('hidden');
      $(this).parent().find('.btn-save-build').removeClass('hidden');
    });
    $('.btn-save-build').on('click', function(){
      $(this).closest('tr').find('select').attr("disabled","disabled");
      let id_status = $(this).closest('tr').find('select').val();
      let booking_id = $(this).attr('html-value');
      $.ajax({
        url: '{{ route("admin.update.booking") }}',
        method: 'POST',
        data: {
          id_status: id_status,
          booking_id: booking_id
        },
        dataType: 'JSON',
        success: function (res){
          if(res.status){
            Swal.fire({
              title: 'Thành công!',
              text: res.message,
              icon: 'success'
            }).then(function(){
                window.location.reload();
            })
          }else{
            Swal.fire({
              title: 'Thất bại!',
              text: res.message,
              icon: 'error'
            })
          }
        }
      });
      $(this).addClass('hidden');
      $(this).parent().find('.btn-edit-build').removeClass('hidden');
    });
</script>
<script>
  $(document).ready(function(){
    $('#view-type').on('change',function(){
      let view_type = $('#view-type').val();
      if(view_type !== '*'){
        window.location.href = '/danh-sach?typeview='+view_type;
      }else{
        window.location.href = '/danh-sach';
      }
    });
  });
</script>
@endsection
