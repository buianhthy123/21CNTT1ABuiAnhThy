@extends('admin.bill.layouts.master')
@section('content3')
<div class="container">
    @isset($contactsdetail)
        @php
            $i=1;
        @endphp
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 30%;" >Chủ đề</th>
                    <th style="width: 70%;">Nội dung</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tên khách hàng</td>
                    <td>{{$contactsdetail[0]->name}}</td>
                </tr>
                <tr>
                    <td>Giới tính</td>
                    <td>{{$contactsdetail[0]->gender}}</td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>{{$contactsdetail[0]->address}}</td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>{{$contactsdetail[0]->phone_number}}</td>
                </tr>
                <tr>
                    <td>Ghi chú</td>
                    <td>{{$contactsdetail[0]->note}}</td>
                </tr>
                
                
                <form action="{{ route('admin.updateLhStatusAjax', ['id' => $contactsdetail[0]->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <tr>
                        <td >Trang thái</td>
                        <td>
                            <select class="form-control" style="width: 30%;" name="status" id="">
                                @if($contactsdetail[0]->status == "Chưa liên hệ")
                                <option value="Đã liên hệ" selected>Đã liên hệ</option>
                                <option value="Chưa liên hệ">Chưa liên hệ</option>
                                @elseif($contactsdetail[0]->status == "Đã liên hệ")
                                <option value="Đã liên hệ" selected>Đã liên hệ</option>
                                <option value="Chưa liên hệ">Chưa liên hệ</option>
                                @else
                                <option value="Đã liên hệ" selected>Đã liên hệ</option>
                                <option value="Chưa liên hệ">Chưa liên hệ</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" class="btn btn-primary">Xác nhận</button></td>
                    </tr>
                </form>
            </tbody>
        </table>
    @endisset
</div>
@endsection