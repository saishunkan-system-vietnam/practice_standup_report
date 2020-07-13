@extends('../../layout')

@section('content')
    <div class="color-line"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="back-link back-backend">
                    <a href="{{ asset('admin/member-list') }}" class="btn btn-primary">Trở về danh sách nhân viên</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
            <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">
                <div class="text-center custom-login">
                    <h3>Cập nhật tài khoản</h3>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Tên đăng nhập</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Địa chỉ email</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Năm sinh</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Quê quán</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Số điện thoại</label>
                                    <input class="form-control">
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success loginbtn">Cập nhật</button>
                                <button class="btn btn-default">Hủy bỏ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
        </div>
@stop