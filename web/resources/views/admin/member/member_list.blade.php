@extends('../../layout')

@section('content')
    <div class="product-status mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Danh sách nhân viên</h4>
                        <div class="add-product">
                            <a href="{{ asset('admin/member-add') }}">Đăng ký nhân viên</a>
                        </div>
                        <table>
                            <tr>
                                <th>STT</th>
                                <th>Mã nhân viên</th>
                                <th>Tên nhân viên</th>
                                <th>Email</th>
                                <th>Ngày sinh</th>
                                <th>Quê quán</th>
                                <th>Xử lý</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>VN0040</td>
                                <td>Nguyễn Văn Đức</td>
                                <td>nguyenduc22@gmail.com</td>
                                <td>1992/01/02</td>
                                <td>Hà Nội</td>
                                <td>
                                    <a href="{{ asset('admin/member-edit') }}"><button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>VN0041</td>
                                <td>Lê Duy Phương</td>
                                <td>duyphuong556@@gmail.com</td>
                                <td>1991/02/02</td>
                                <td>Hà Nội</td>
                                <td>
                                    <a href="{{ asset('admin/member-edit') }}"><button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>VN0042</td>
                                <td>Trần Bá Tùng</td>
                                <td>batung32@@gmail.com</td>
                                <td>1882/02/02</td>
                                <td>Hòa Bình</td>
                                <td>
                                    <a href="{{ asset('admin/member-edit') }}"><button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td><img src="../img/new-product/6-small.jpg" alt="" /></td>
                                <td>Product Title 2</td>
                                <td>
                                    <button class="ps-setting">Paused</button>
                                </td>
                                <td>60</td>
                                <td>$1020</td>
                                <td>In Stock</td>
                                <td>$17</td>
                                <td>
                                    <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </td>
                            </tr> -->
                           
                        </table>
                        <div class="custom-pagination">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
