@extends('../../layout')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin/member/member_list.css')}}">
@stop
@section('javascript')
    <script src="{{ asset('js/admin/member/member_list.js')}}"></script>
@stop
@section('content')
@if (Auth::check())
    @if( Auth::user()->level == 1)
    <div class="member-status mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="member-status-wrap">
                        <h4>Danh sách nhân viên</h4>
                        <div class="add-member">
                            <a href="{{ asset('admin/member-add') }}">Đăng ký nhân viên</a>
                        </div>
                        <table>
                            <tr>
                                <th>STT</th>
                                <th>Tên đăng nhập</th>
                                <th>Mã nhân viên</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th>Cấp độ</th>
                                <th>Xử lý</th>
                            </tr>
                            @if(isset($users[0]))
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->user_cd }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->telephone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->birthday }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->level }}</td>
                                    <td>
                                        <a href="{{ asset('admin/member-edit').'/'.$user->user_cd}}"><button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed memberDel" user_cd="{{ $user->user_cd }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </table>

                        <?php
                            // config
                            $link_limit = 100; // maximum number of links
                        ?>
                        <div class="custom-pagination">
                        @if ($users->lastPage() > 1)
                        <ul class="pagination">
                            <li class="{{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $users->url(1) }}">First</a>
                            </li>
                            @for ($i = 1; $i <= $users->lastPage(); $i++)
                                <?php
                                $half_total_links = floor($link_limit / 2);
                                $from = $users->currentPage() - $half_total_links;
                                $to = $users->currentPage() + $half_total_links;
                                if ($users->currentPage() < $half_total_links) {
                                $to += $half_total_links - $users->currentPage();
                                }
                                if ($users->lastPage() - $users->currentPage() < $half_total_links) {
                                    $from -= $half_total_links - ($users->lastPage() - $users->currentPage()) - 1;
                                }
                                ?>
                                @if ($from < $i && $i < $to)
                                    <li class="{{ ($users->currentPage() == $i) ? ' active' : '' }}" {{ ($users->currentPage() == $i) ? 'aria-current="page"' : '' }}>
                                        @if ($users->currentPage() == $i)
                                                <span class="page-link" href="{{ $users->url($i) }}">{{ $i }}</span>
                                        @else
                                                <a href="{{ $users->url($i) }}">{{ $i }}</a>
                                        @endif
                                    </li>
                                @endif
                            @endfor
                            <li class="{{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $users->url($users->lastPage()) }}">Last</a>
                            </li>
                        </ul>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if( Auth::user()->level != 1)
        <p style="color:white">Bạn không có quyền truy cập</p>
    @endif
@endif
@stop
