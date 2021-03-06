import Vue from 'vue'
import axios from 'axios'

import App from './App'
import router from './router'
import store from './store'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);

import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);
import Datepicker from 'vuejs-datepicker';
Vue.component('datepicker', Datepicker);
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import moment from 'moment'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)
if (!process.env.IS_WEB) Vue.use(require('vue-electron'))
Vue.http = Vue.prototype.$http = axios
Vue.config.productionTip = false

Vue.mixin({
  methods: {
    // call API
    async requestApi(url, method, data){
      if (method == 'GET') {
        return axios.get(url, data);
      }
      if (method == 'POST') {
        return axios.post(url, data);
      }
    },
    //redirect page
    redirect(url){
        window.location.href = url;
	},
	customFormatter(date) {
		return moment(date).format('YYYY-MM-DD');
	},
	
    // show message
    flashMessageBox(statusMsg, textMsg) {
		if(statusMsg == 'success') {
			this.flashMessage.success({
				title: 'Hiển thị thông báo: ',
				message: textMsg
			});
		}

		if(statusMsg == 'info') {
			this.flashMessage.info({
				title: 'Info Message Title',
				message: textMsg
			});
		}

		if(statusMsg == 'warning') {
			this.flashMessage.warning({
				title: 'Warning Message Title',
    			message: textMsg
			});
		}

		if(statusMsg == 'error') {
			this.flashMessage.error({
				title: 'Hiển thị thông báo:',
    			message: textMsg
			});
		}
    }
  }
});


/* eslint-disable no-new */
new Vue({
  components: { 
	  App, 
	  Datepicker,
  },
  router,
  store,
  template: '<App/>'
}).$mount('#app')
