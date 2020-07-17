<template>
  <div>
    <div class="w3layoutscontaineragileits formLogin">
    <h2>Đăng nhập tài khoản</h2>
      <form>
        <input type="text" name="username" v-model.trim="$v.account.username.$model" :class="status($v.account.username)" placeholder="Tên đăng nhập" required="">
		<ul>
			<li class="error" v-if="$v.account.username.$error && !$v.account.username.required">Tên đăng nhập bắt buộc phải nhập</li>
  			<li class="error" v-if="!$v.account.username.minLength">Tên đăng nhập phải tối thiểu 5 ký tự</li>
			<li class="error" v-if="!$v.account.username.maxLength">Tên đăng nhập chỉ tối đa 25 ký tự</li>
		</ul>
        <input type="password" name="password" v-model.trim="$v.account.password.$model" :class="status($v.account.password)" placeholder="Mật khẩu" required="">
		 <ul>
			<li class="error" v-if="$v.account.password.$error && !$v.account.password.required">Mật khẩu bắt buộc phải nhập</li>
  			<li class="error" v-if="!$v.account.password.minLength">Mật khẩu phải tối thiểu 5 ký tự</li>
			<li class="error" v-if="!$v.account.password.maxLength">Mật khẩu chỉ tối đa 25 ký tự</li>
		</ul>
		
        <div class="aitssendbuttonw3ls">
          <input type="submit" @click.prevent="checkAccount()" value="ĐĂNG NHẬP">
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
        errors:[],
        account: {
              username: '',
              password: '',
        }
      }
	},
	validations: {
		account: {
			username: {
				required,
				minLength: minLength(5),
				maxLength: maxLength(25)
			},
			password: {
				required,
				minLength: minLength(5),
				maxLength: maxLength(25)
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
		checkAccount: async function(e) {
			let self = this;
			this.$v.$touch();
			if(this.$v.$invalid) {
				return;
			}

			let objData = { data: this.account }
			this.errors = [];

			this.requestApi('http://appstandupreport.com/api/login','POST', objData)
			.then(response => {
				if (response.data.status == 'Success') {
					if (response.data.level == 1) {
						//this.$router.push('/manage-job');
						this.$router.push({ name: 'ManageJob', params: { userCd: response.data.user_cd }});
					}
					if (response.data.level == 3) {
						//this.$router.push('/daily-report');
						this.$router.push({ name: 'DailyReport', params: { userCd: response.data.user_cd }});
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
       
    } //end method
    
  }
</script>

<style scoped>
	/* input {
		border: 1px solid silver;
		border-radius: 4px;
		background: white;
		padding: 5px 10px;
	} */
	
</style>
