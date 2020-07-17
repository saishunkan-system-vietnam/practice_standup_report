<template>
  <div>

    <div class="area-daily-report">
    <h2>BÁO CÁO HÀNG NGÀY</h2>
      <form id="daily_report" action="#" method="post" v-on:submit.prevent="onSubmit">
        <p>Kế hoạch làm việc hôm nay là gì?</p>
        <textarea id="w3review" name="what_plan" v-model.trim="$v.daily_report.what_plan.$model" :class="status($v.daily_report.what_plan)" rows="4"></textarea>
		<ul>
			<li class="error" v-if="$v.daily_report.what_plan.$error && !$v.daily_report.what_plan.required">Mục này bắt buộc phải nhập</li>
			<li class="error" v-if="$v.daily_report.what_plan.$error && !$v.daily_report.what_plan.maxLength">Tên đăng nhập chỉ tối đa 255 ký tự</li>
		</ul>
        <p>Dự định sẽ thực hiện công việc như thế nào?</p>
        <textarea id="w3review" name="how_plan" rows="4"></textarea>
        <p>Dự định thời gian khi nào sẽ hoàn thành?</p>
        <textarea id="w3review" name="when_plan" rows="4"></textarea>
        <p>Khó khăn công việc ngày hôm qua gặp phải là gì?</p>
        <textarea id="w3review" name="trouble_plan" rows="4"></textarea>
        <div class="aitssendbuttonw3ls">
			  <p>Hiển thị param: {{ userCd }}</p>
          <input type="submit" @click="sendReport()" value="Gửi">
          <div class="clear"></div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { required, minLength, maxLength, between } from 'vuelidate/lib/validators'
  export default {
    data () {
      return {
              userCd: this.$route.params.userCd,
          }
    },
    validations: {
		daily_report: {
			what_plan: {
				required,
				maxLength: maxLength(5)
			},
			// how_plan: {
			// 	required,
			// 	maxLength: maxLength(255)
			// }
		}
	},
    methods: {
      status(validation) {
        return {
          error: validation.$error,
          dirty: validation.$dirty
        }
	  },
	  sendReport: async function(e) {
			let self = this;
			this.$v.$touch();
			if(this.$v.$invalid) {
				return;
			}

			let objData = { data: this.daily_report }
			this.errors = [];

			this.requestApi('http://appstandupreport.com/api/login','POST', objData)
			.then(response => {
				if (response.data.status == 'Success') {
					if (response.data.level == 1) {
						//this.$router.push('/manage-job');
						//this.$router.push({ name: 'ManageJob', params: { userCd: response.data.user_cd }});
					}
					if (response.data.level == 3) {
						//this.$router.push('/daily-report');
						//this.$router.push({ name: 'DailyReport', params: { userCd: response.data.user_cd }});
					}
				}
				if (response.data.status == 'Fail') {
					this.flashMessageBox('error','Username hoặc password không đúng.');
				}
			})
			.catch(errorResponse => {
				this.errors.push(errorResponse.error);
			})
			.finally(() => this.loading = false);
			
      } //end checkAccount
    }
  }
</script>

<style scoped>

</style>


