<template>
  <div>
    <div class="area-daily-report">
    <h2>BÁO CÁO HÀNG NGÀY</h2>
	  <div class="message-info">
		  <div v-html="error_description" style="color:red; text-align: left"></div>
	  </div>
      <form id="daily_report">
        <p>Kế hoạch làm việc hôm nay là gì?</p>
        <textarea id="w3review" name="what_plan" v-model.trim="$v.daily_report.what_plan.$model" :class="status($v.daily_report.what_plan)" rows="4"></textarea>
		<ul>
			<li class="error" v-if="$v.daily_report.what_plan.$error && !$v.daily_report.what_plan.required">Mục này bắt buộc phải nhập</li>
			<li class="error" v-if="!$v.daily_report.what_plan.maxLength">Mục này chỉ nhập tối đa 255 ký tự</li>
		</ul>
		<p>Dự định sẽ thực hiện công việc như thế nào?</p>
		<textarea id="w3review" name="how_plan" v-model.trim="$v.daily_report.how_plan.$model" :class="status($v.daily_report.how_plan)" rows="4"></textarea>
		<ul>
			<li class="error" v-if="$v.daily_report.how_plan.$error && !$v.daily_report.how_plan.required">Mục này bắt buộc phải nhập</li>
			<li class="error" v-if="!$v.daily_report.how_plan.maxLength">Mục này chỉ nhập chỉ tối đa 255 ký tự</li>
		</ul>
		<p>Dự định thời gian khi nào sẽ hoàn thành?</p>
		<textarea id="w3review" name="when_plan" rows="4" v-model.trim="$v.daily_report.when_plan.$model" :class="status($v.daily_report.when_plan)"></textarea>
		<ul>
			<li class="error" v-if="$v.daily_report.when_plan.$error && !$v.daily_report.when_plan.required">Mục này bắt buộc phải nhập</li>
			<li class="error" v-if="!$v.daily_report.when_plan.maxLength">Mục này chỉ nhập chỉ tối đa 255 ký tự</li>
		</ul>
        <p>Khó khăn công việc ngày hôm qua gặp phải là gì?</p>
        <textarea id="w3review" name="trouble_plan" rows="4" v-model.trim="$v.daily_report.trouble_plan.$model" :class="status($v.daily_report.trouble_plan)"></textarea>
		<ul>
			<li class="error" v-if="$v.daily_report.trouble_plan.$error && !$v.daily_report.trouble_plan.required">Mục này bắt buộc phải nhập</li>
			<li class="error" v-if="!$v.daily_report.trouble_plan.maxLength">Mục này chỉ nhập chỉ tối đa 255 ký tự</li>
		</ul>
        <div class="aitssendbuttonw3ls">
          <input type="submit" @click.prevent="sendReport()" value="Gửi">
          <div class="clear"></div>
        </div>
		<FlashMessage :position="'right top'"></FlashMessage>
      </form>
    </div>
  </div>
</template>

<script>
import { required, minLength, maxLength, between } from 'vuelidate/lib/validators'
  export default {
    data () {
      return {
		 	errors : [],
			daily_report: {
				//user_cd: isset(this.$route.params.userCd)? this.$route.params.userCd : 'VN0001',
				user_cd: 'VN0042',
				what_plan: '',
				how_plan: '',
				when_plan: '',
				trouble_plan: ''
			},
			error_description: ''
		}
	},
	validations: {
		daily_report: {
			what_plan: {
				required,
				maxLength: maxLength(255)
			},
			how_plan: {
				required,
				maxLength: maxLength(255)
			},
			when_plan: {
				required,
				maxLength: maxLength(255)
			},
			trouble_plan: {
				required,
				maxLength: maxLength(255)
			}
		}
	},
	methods: {
		status(validation) {
			return {
				error: validation.$error,
				dirty: validation.$dirty
			}
		},
		sendReport: async function() {
			let self = this;
			this.$v.$touch();
			if(this.$v.$invalid) {
				return;
			}

			let objData = { data: this.daily_report }
			this.errors = [];

			this.requestApi('http://appstandupreport.com/api/save-daily-report','POST', objData)
			.then(response => {
				if (response.data.status == 'ErrorValidate') {
					let objError = response.data.error_valid;
					let mgs = '';
					for (const items in objError) {
						mgs += (`${items}: ${objError[items]} <br/>`);
					}
					self.error_description = mgs;

					this.flashMessageBox('error','Thông tin nhập chưa hợp lệ');
				}
				if (response.data.status == 'Success') {
					this.flashMessageBox('success','Lưu thông tin thành công');
				}
				if (response.data.status == 'Fail') {
					this.flashMessageBox('error','Lưu thông tin thất bại');
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


