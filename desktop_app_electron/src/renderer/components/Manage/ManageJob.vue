<template>
  <div>
	<div class="manage_job">
	<h2>Quản lý báo cáo của các nhân viên</h2>
		<form id="manage_job" action="#" method="post">
            <div class="row">
                <div class="col-sm-4 aitssendbuttonw3ls">
                    <input type="button" class="btn btn-secondary" value="Lọc các nhân viên chưa báo cáo ngày hôm nay" @click="filterReportToDay()" />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p>Tìm kiếm thông tin</p>
                </div>
                <div class="col-sm-4">
                    <label for="employee">Mã nhân viên/ Tên nhân viên</label>
                    <input type="text" class="form-control" name="employee_cd" v-model="$v.report.employee_cd.$model" :class="status($v.report.employee_cd)">
                     <ul>
                        <li class="error" v-if="!$v.report.employee_cd.maxLength">Mục này chỉ nhập chỉ tối đa 30 ký tự</li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <label for="start_time">Thời gian bắt đầu</label>
                    <datepicker :format="this.customFormatter" name="start_time" class="start_time" v-model="$v.report.start_time.$model"></datepicker>
                    <ul>
                        <li class="error" v-if="!$v.report.start_time.maxLength">Mục này chỉ nhập chỉ tối đa 30 ký tự</li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <label for="end_time">Thời gian kết thúc</label>
                    <datepicker :format="this.customFormatter" name="end_time" class="end_time" v-model="$v.report.end_time.$model"></datepicker>
                    <ul>
                        <li class="error" v-if="!$v.report.end_time.maxLength">Mục này chỉ nhập chỉ tối đa 30 ký tự</li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <input type="button" class="btn btn-secondary" @click.prevent="searchEmployee('search')" value="Tìm kiếm" />
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Mã nhân viên</th>
                            <th class="text-center">Tên nhân viên</th>
                            <th class="text-center">Ngày báo cáo</th>
                            <th class="text-center">Thời gian đã báo cáo</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Hiển thị để Test</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in listReport" :key="item.daily_report_id">
                                <td class="text-center"> {{ index+1 }}</td>
                                <td class="text-center"> {{ item.user_cd }}</td>
                                <td class="text-center"> {{ item.username }}</td>
                                <td class="text-center"> {{ item.time_report }}</td>
                                <td class="text-center"> {{ item.time_report_detail }}</td>
                                <td class="text-center reported" v-if="item.status_report == 1"> {{ 'Đã báo cáo' }}</td>
                                <td class="text-center not-reported" v-if="item.status_report == 0"> {{ 'Chưa báo cáo' }}</td>
                                <td class="text-center"> {{ item.what_plan }}</td>
                                <td class="text-center" v-if="item.status_report == 1">
                                    <router-link :to="{ name: 'DetailJob', params: { user_cd: item.user_cd, time_report_detail: item.time_report_detail }}">Xem chi tiết</router-link>
                                </td>
                                <td class="text-center" v-if="item.status_report == 0">

                                </td>
                            </tr>
                        </tbody>
                        </table>

                        <paginate
                            :page-count="countPage"
                            :click-handler="searchEmployee"
                            :prev-text="'Prev'"
                            :next-text="'Next'"
                            :container-class="'pagination'"
                            :page-class="'page-item'">
                        </paginate>
                        <FlashMessage :position="'right top'"></FlashMessage>
                    </div>
                </div>
            </div>
		</form>
	</div>
  </div>
</template>

<script>
import { required, minLength, maxLength, between } from 'vuelidate/lib/validators'
import moment from 'moment'


  export default {
    data () {
      return {
            countPage: 5,
            page: 2,
            errors : [],
			report: {
                employee_cd: '',
                start_time: '',
                end_time: '',
                page_num: 1
            },
            listReport: [],
      }
    },
    validations: {
        report: {
            employee_cd: {
                maxLength: maxLength(30)
            },
            start_time: {
                maxLength: maxLength(30)
            },
            end_time: {
                maxLength: maxLength(30)
            }
        }

    },
    created() {
        
    },
    mounted() {
        //alert('show mounted');
        this.searchEmployee();
    },
    methods: {
        status(validation) {
            return {
                error: validation.$error,
                dirty: validation.$dirty
            }
        },
        filterReportToDay() {
            this.searchEmployee('today');
        },
        searchEmployee: async function(pageNum) {
            const date = new Date();
            const today = moment(date).format('YYYY-MM-DD');
            let start_time = '';
            let end_time = '';
            if (typeof pageNum == 'undefined' || pageNum == 'today') {
                pageNum = 1;
                start_time = today;
                end_time = today;
            }
            else if (pageNum =='search') {
                pageNum = 1;
                start_time = this.customFormatter(this.report.start_time);
                end_time = this.customFormatter(this.report.end_time);
            } else {
                start_time = this.customFormatter(this.report.start_time);
                end_time = this.customFormatter(this.report.end_time);
            }
            let self = this;
            this.$v.$touch();
            
            if(this.$v.$invalid) {
                return;
            }
            this.report.start_time = start_time;
            this.report.end_time = end_time;
            this.report.page_num = pageNum;
            let objData = { data: this.report }
            this.errors = [];
            this.requestApi('http://appstandupreport.com/api/search-report','POST', objData)
            .then(response => {
                //  console.log(response);
                //  debugger;
                if (response.data.status == 'Success') {
                    self.listReport = response.data.listReport;
                    let numberRecord = response.data.listReport.length;
                    
                    self.countPage = response.data.countPage;
                    
                    this.flashMessageBox('success','Kết quả tìm kiếm là ' + numberRecord + ' bản ghi');
                }

                if (response.data.status == 'NotFoundData') {
                    this.flashMessageBox('error','Không tìm thấy kết quả nào');
                    self.listReport = [];
                }

                if (response.data.status == 'NotFoundDataUsers') {
                    this.flashMessageBox('error','Không tồn tại user nào trong database');
                    self.listReport = [];
                }

                if (response.data.status == 'Fail') {
					this.flashMessageBox('error','Tìm kiếm thông tin thất bại');
                }
            })
            .catch(errorResponse => {
                this.errors.push(errorResponse.error);
            })
            .finally(() => this.loading = false);
        }, //end sendReport
    }
  }
</script>

<style scoped>
    table th,tr {
        color:white
    }

    .not_found_data {
        display: none;
    }

    a { cursor: pointer; }
    .pagination {
        justify-content: center;
        flex-wrap: wrap;
    }

    .reported {
        color: #537b35;
    }

    .not-reported {
        color: grey;
    }
</style>
