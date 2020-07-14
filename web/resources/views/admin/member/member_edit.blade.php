@extends('../../layout')
@section('javascript')
    <script src="{{ asset('js/admin/member/member_edit.js')}}"></script>
@stop
@section('content')
@if (Auth::check())
    @if( Auth::user()->level == 1)
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
                    @if ( Session::has('success') )
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    @endif
                    @if ( Session::has('error') )
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>{{ Session::get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    @endif

                        <form action="{{ asset('admin/member-add')}}" method="post" id="registerFormMember">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Tên đăng nhập <span>(*)</span></label>
                                    <input type="text" name="username" class="form-control" value="{{ $user->username}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Mã nhân viên <span>(*)</span></label>
                                    <input type="text" name="user_cd" class="form-control" value="{{ $user->user_cd}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Tên nhân viên <span>(*)</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Địa chỉ email <span>(*)</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Năm sinh</label>
                                    <input type="text" name="birthday" id="datepicker" class="form-control" value="{{ $user->birthday}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Địa chỉ</label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->address}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="telephone" class="form-control" value="{{ $user->telephone}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="level">Level</label>
                                    <select name="level" class="form-control" id="level">
                                        <option value="1" {{ $user->level == 1 ? 'selected' : ''}}>Supper admin</option>
                                        <option value="2" {{ $user->level == 2 ? 'selected' : ''}}>Admin</option>
                                        <option value="3" {{ $user->level == 3 ? 'selected' : ''}}>Thành viên</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success loginbtn">Cập nhật</button>
                                <button class="btn btn-default clear">Làm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
        </div>
    @endif
    @if( Auth::user()->level != 1)
        <p style="color:white">Bạn không có quyền truy cập</p>
    @endif
@endif


@stop