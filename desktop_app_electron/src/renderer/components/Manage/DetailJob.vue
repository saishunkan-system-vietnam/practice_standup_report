<template>
  <div>
    <h1>HỆ THỐNG QUẢN LÝ</h1>
	<div class="manage_job">
	<h2>Chi tiết công việc</h2>
		<form id="detail_job" action="#" method="post">
            <div class="row">
                <div class="col-sm-12">
					<div class="col-sm-3">
						<label for="employee">Mã nhân viên:</label>
					</div>
					<div class="col-sm-11 show-answer">
						VN0042
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-3">
						<label for="employee">Tên nhân viên:</label>
					</div>
					<div class="col-sm-11 show-answer">
						Nguyễn Bá Quyền
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-3">
						<label for="employee">Kế hoạch công việc sẽ làm:</label>
					</div>
					<div class="col-sm-11 show-answer">
						Thực hiện task A, thực hiện task B Thực hiện task A, thực hiện task B Thực hiện task A, thực hiện task B Thực hiện task A, thực hiện task B 
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-3">
						<label for="employee">Dự định công việc sẽ làm:</label>
					</div>
					<div class="col-sm-11 show-answer">
						Việc A sẽ làm ABC, việc B sẽ làm CDE Việc A sẽ làm ABC, việc B sẽ làm CDE Việc A sẽ làm ABC, việc B sẽ làm CDE Việc A sẽ làm ABC, việc B sẽ làm CDE
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-3">
						<label for="employee">Dự định thời gian hoàn thành</label>
					</div>
					<div class="col-sm-11 show-answer">
						Sẽ hoàn thành vào lúc 17h30 chiều cùng ngày
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-3">
						<label for="employee">Khó khăn công việc ngày hôm qua</label>
					</div>
					<div class="col-sm-11 show-answer">
						Không gặp phải khó khăn gì
					</div>
				</div>
                <div class="col-sm-12">
					<input type="button" class="btn btn-secondary" value="Quay lại" />
					<input type="button" class="btn btn-secondary" value="Đóng" />
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
