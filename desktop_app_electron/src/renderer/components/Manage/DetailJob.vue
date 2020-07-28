<template>
  <div>
	<div class="manage_job text_color">
	<h2>Chi tiết công việc</h2>
		<form id="detail_job" action="#" method="post">
			<div class="row">
				<div class="col-sm-3">
					<label for="employee">Mã nhân viên:</label>
				</div>
				<div class="col-sm-8">
					{{ detail_job.user_cd }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<label for="employee">Tên nhân viên:</label>
				</div>
				<div class="col-sm-8 show-answer">
					{{ detail_job.username }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<label for="employee">Kế hoạch công việc sẽ làm:</label>
				</div>
				<div class="col-sm-8 show-answer">
					{{ detail_job.what_plan }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<label for="employee">Dự định công việc sẽ làm:</label>
				</div>
				<div class="col-sm-8 show-answer">
					{{ detail_job.how_plan }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<label for="employee">Dự định thời gian hoàn thành:</label>
				</div>
				<div class="col-sm-8 show-answer">
					{{ detail_job.when_plan }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<label for="employee" style="text-">Khó khăn công việc ngày hôm qua:</label>
				</div>
				<div class="col-sm-8 show-answer">
					{{ detail_job.trouble_plan }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<label for="employee">Thời gian báo cáo:</label>
				</div>
				<div class="col-sm-8 show-answer">
					{{ detail_job.time_report }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input type="button" class="btn btn-secondary" @click="back" value="Quay lại" />
					<input type="button" class="btn btn-secondary" value="Đóng" @click="close"/>
				</div>
			</div>
            <FlashMessage :position="'right top'"></FlashMessage>
		</form>
	</div>
  </div>
</template>

<script>
  const electron = require('electron');
  const remote = electron.remote;
  export default {
    data () {
      return {
		  //this.$route.params.user_cd
		detail_job: {
			user_cd: this.$route.params.user_cd,
			username: '',
			what_plan: '',
			how_plan: '',
			when_plan: '',
			trouble_plan: '',
			time_report: '',
			time_report_detail: this.$route.params.time_report_detail
		}
      }
	},
	methods: {
		getInfoDetailReport: async function() {
			let self = this;
			let objData = { data: this.detail_job }
			this.errors = [];
			this.requestApi('http://appstandupreport.com/api/get-info-detail-report','POST', objData)
			.then(response => {
				console.log(response);
				debugger;
				if (response.data.status == 'Success') {
                    self.detail_job = response.data.detailReport;
                    this.flashMessageBox('success','Hiển thị thông tin chi tiết báo cáo');
				}

                if (response.data.status == 'NotFoundData') {
                    this.flashMessageBox('success','Không tìm thấy kết quả nào');
                }

                if (response.data.status == 'Fail') {
					this.flashMessageBox('success','Tìm kiếm thông tin thất bại');
                }
			})
			.catch(errorResponse => {
				this.errors.push(errorResponse.error);
			})
			.finally(() => this.loading = false);
	  	}, //end getInfoDetailReport
		back() {
			this.$router.push({ name: 'ManageJob' });
		},
		close() {
			var window = remote.getCurrentWindow();
    		window.close();
		}
	},
	mounted() {
		this.getInfoDetailReport()
	}

  }
</script>

<style scoped>

</style>
