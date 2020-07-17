<template>
  <div>
    <h1>HỆ THỐNG QUẢN LÝ</h1>
	<div class="manage_job">
	<h2>Quản lý báo cáo của các nhân viên</h2>
		<form id="manage_job" action="#" method="post">
            <div class="row">
                <div class="col-sm-4 aitssendbuttonw3ls">
                    <input type="button" class="btn btn-secondary" value="Lọc các nhân viên chưa báo cáo ngày hôm nay" />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p>Tìm kiếm thông tin</p>
                </div>
                <div class="col-sm-4">
                    <label for="employee">Mã nhân viên/ Tên nhân viên</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-sm-4">
                    <label for="start_time">Thời gian bắt đầu</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-sm-4">
                    <label for="end_time">Thời gian kết thúc</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-sm-12">
                    <input type="button" class="btn btn-secondary" value="Tìm kiếm" />
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th class="center">STT</th>
                            <th>Mã nhân viên</th>
                            <th>Tên nhân viên</th>
                            <th>Thời gian báo cáo</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>1</td>
                            <td>VN0042</td>
                            <td>Nguyễn Bá Quyền</td>
                            <td>1993/08/01</td>
                            <td><a href="#">Xem chi tiết</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>VN0043</td>
                                <td>Nguyễn Minh Thuận</td>
                                <td>1992/08/03</td>
                                <td><a href="#">Xem chi tiết</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>VN0044</td>
                                <td>Ngô Hoàng Kiên</td>
                                <td>1998/09/03</td>
                                <td><a href="#">Xem chi tiết</a></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</form>
	</div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        //msg : "Message Login"
      }
    }
  }
</script>

<style scoped>

</style>
