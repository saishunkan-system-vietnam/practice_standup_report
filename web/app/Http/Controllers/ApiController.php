<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\DailyReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;

class ApiController extends Controller
{
    public function postLogin(Request $request)
    {
        $dataLogin = $request->data;
        $arrResponse = [];
        if( Auth::attempt(['username' => $dataLogin['username'], 'password' => $dataLogin['password']])) {
            $arrResponse = [
                'status' => 'Success',
                'level' => Auth::user()->level,
                'user_cd' => Auth::user()->user_cd,
            ];
        } else {
            $arrResponse = [
                'status' => 'Fail'
            ];
        }
        return $arrResponse;
    }

    public function saveDailyReport(Request $request)
    {
        $allRequest  = $request->data;
        $validator = $this->validatorDailyReport($allRequest);
        $arrResponse = [];
        if ($validator->fails()) {
            $arrResponse = [
                'status' => 'ErrorValidate',
                'error_valid' => $validator->errors()
            ];
        } else {
            if( $this->createDailyReport($allRequest)) {
                $arrResponse = [
                    'status' => 'Success',
                ];
            } else {
                $arrResponse = [
                    'status' => 'Fail',
                ];
            }
        }
        return $arrResponse;
    }

    protected function validatorDailyReport(array $data)
    {
        return Validator::make($data,
            [
                'what_plan' => 'required|string|max:255',
                'how_plan' => 'required|string|max:255',
                'when_plan' => 'required|string|max:255',
                'trouble_plan' => 'required|string|max:255'
            ],
            [
                'what_plan.required' => 'Mục này là trường bắt buộc',
                'what_plan.max' => 'Mục này nhập không được quá 255 ký tự',
                'how_plan.required' => 'Mục này là trường bắt buộc',
                'how_plan.max' => 'Mục này nhập không được quá 255 ký tự',
                'when_plan.required' => 'Mục này là trường bắt buộc',
                'when_plan.max' => 'Mục này nhập không được quá 255 ký tự',
                'trouble_plan.required' => 'Mục này là trường bắt buộc',
                'trouble_plan.max' => 'Mục này nhập không được quá 255 ký tự',
            ]
        );
    }

    protected function validatorEmployeeReport(array $data)
    {
        return Validator::make($data,
            [
                'employee_cd' => 'string|max:30',
            ],
            [
                'employee_cd.max' => 'Mục này nhập không được quá 30 ký tự',
            ]
        );
    }

    public function getDataReport(Request $request) {
        $arrResponse = [];
        $data = $this->funcGetDataReport();
        if (isset($data[0])) {
            $arrResponse = [
                'status' => 'Success',
                'listReport' => $data
            ];
        } elseif (!isset($data[0])) {
            $arrResponse = [
                'status' => 'NotFoundData',
            ];
        } else {
            $arrResponse = [
                'status' => 'Fail',
            ];
        }
        return $arrResponse;
    }

    public function funcGetDataReport()
    {
        $data = DB::table('daily_report')
        ->leftJoin('users', 'daily_report.user_cd', '=', 'users.user_cd')
        ->select(
                'daily_report.id AS daily_report_id',
                'daily_report.user_cd AS daily_report_user_cd',
                'daily_report.what_plan',
                'daily_report.how_plan',
                'daily_report.when_plan',
                'daily_report.created_at',
                'daily_report.updated_at as time_report_detail',
                'users.id AS user_id',
                'users.user_cd',
                'users.username')
        ->where('users.del_flag', 0)
        ->whereDate('daily_report.updated_at', '=', Carbon::today()->toDateString())
        ->get();

        return $data;
    }
    
    protected function createDailyReport(array $data)
    {
        return DailyReport::create([
            'user_cd' => $data['user_cd'],
            'what_plan' => $data['what_plan'],
            'how_plan' => $data['how_plan'],
            'when_plan' => $data['when_plan'],
            'trouble_plan' => $data['trouble_plan'],
        ]);
    }

    public function searchReport(Request $request)
    {
        $allRequest  = $request->data;
        $validator = $this->validatorEmployeeReport($allRequest);
        $arrResponse = [];
        
        $isValid = $validator->fails();
        $isValid = false;
        if ($isValid) {
            $arrResponse = [
                'status' => 'ErrorValidate',
                'error_valid' => $validator->errors()
            ];
        } else {
            $data = [];
            $result = $this->funcSearchReport($allRequest);
            if (isset($result['status']) && $result['status'] == 'NotFoundDataUsers') {
                $arrResponse = [
                    'status' => 'NotFoundDataUsers',
                ];
                return $arrResponse;
            }
            $page_num = $allRequest['page_num'];
            $page_range = 5;
            $page_total = count($result);
            $count_page = ceil($page_total/$page_range);
            $from_record = ($page_num - 1) * $page_range;
            $to_record = $from_record + $page_range;

            if ($page_total == 1 && isset($result[0])) {
                array_push($data, $result[0]);
            } else {
                for ($i = 0; $i < $page_total; $i++) {
                    if ($i >= $from_record && $i < $to_record) {
                        array_push($data, $result[$i]);
                    }
                }
            }

            if (isset($data[0])) {
                $arrResponse = [
                    'status' => 'Success',
                    'listReport' => $data,
                    'countPage' => $count_page
                ];
            } elseif (!isset($data[0])) {
                $arrResponse = [
                    'status' => 'NotFoundData',
                ];
            } else {
                $arrResponse = [
                    'status' => 'Fail',
                ];
            }
        }
        return $arrResponse;
    }

    public function funcSearchReport($data) {
        $employee_cd = $data['employee_cd'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];

        if ($start_time == 'Invalid date') {
            $start_time = '';
        }

        if ($end_time == 'Invalid date') {
            $end_time = '';
        }

        $infoUser = $this->getInfoUser($employee_cd);
        if(count($infoUser) == 0) {
            $arrResponse = [
                'status' => 'NotFoundDataUsers',
            ];
            return $arrResponse;
        }
        
        $arrEmptyDaily = [];
        $day = CarbonPeriod::create($start_time, '1 days', $end_time); 
        foreach ($day as $days) {
            $datetime = $days->format('Y-m-d');
            $arrEmptyDaily[$datetime] = $infoUser;
        } //end for day

        $listDailyReport = array();
        foreach($arrEmptyDaily as $key => $record) {
            foreach($record as $rows) {
                $keyDailyReport  = rand();
                $listDailyReport[$keyDailyReport]['user_cd'] = $rows->user_cd;
                $listDailyReport[$keyDailyReport]['username'] = $rows->username;
                $listDailyReport[$keyDailyReport]['time_report'] = $key;
            }
        }
        $infoDailyReport = $this->getInfoDailyReport($employee_cd, $data['start_time'], $data['end_time']);

        //format date yyyy-mm-dd
        foreach($infoDailyReport as $row) {
                $row->time_report_detail = $row->time_report;
                $dt = Carbon::create($row->time_report);
                $row->time_report = $dt->toDateString();
                
        }
        
        foreach($listDailyReport as $keyDaily => $record) {
            $record = (array)$record;
            foreach($infoDailyReport as $row) {
                $listDailyReport[$keyDaily]['status_report'] = 0;
                $listDailyReport[$keyDaily]['what_plan'] = '';
                $listDailyReport[$keyDaily]['how_plan'] = '';
                $listDailyReport[$keyDaily]['when_plan'] = '';
                $listDailyReport[$keyDaily]['trouble_plan'] = '';
                $listDailyReport[$keyDaily]['time_report_detail'] = '';
                if($record['user_cd'] == $row->user_cd && $record['time_report'] == $row->time_report) {
                        $listDailyReport[$keyDaily]['status_report'] = 1;
                        $listDailyReport[$keyDaily]['what_plan'] = $row->what_plan;
                        $listDailyReport[$keyDaily]['how_plan'] = $row->how_plan;
                        $listDailyReport[$keyDaily]['when_plan'] = $row->when_plan;
                        $listDailyReport[$keyDaily]['trouble_plan'] = $row->trouble_plan;
                        $listDailyReport[$keyDaily]['time_report_detail'] = $row->time_report_detail;
                        break;
                }
                $listDailyReport[$keyDaily]['username'] = $row->username;
                $listDailyReport[$keyDaily]['time_report'] = $row->time_report;
            }
        }
       
        $result = [];
        foreach($listDailyReport as $record) {
            $result[] = $record;
        }

        return $result;
    }

    public function getInfoUser($employee_cd)
    {
        $dataUser = DB::table('users')
            ->select(
                'users.user_cd'
            ,   'users.username'  
            )
            ->where(function($query) use ($employee_cd) {
                $query->where('users.user_cd','like',"%{$employee_cd}%")
                    ->orWhere('users.username','like',"%{$employee_cd}%");
            })
            ->where('users.del_flag', 0)
            ->orderBy('users.id','ASC')
            ->get();
       return $dataUser;
    }

    public function getInfoDailyReport($employee_cd, $start_time, $end_time)
    {
        $dataDailyReport = DB::table('daily_report')
            ->leftJoin('users', 'daily_report.user_cd', '=', 'users.user_cd')
            ->select(
                'daily_report.id'
            ,   'daily_report.user_cd'
            ,   'users.username'
            ,   'daily_report.updated_at AS time_report'
            ,   'daily_report.what_plan'
            ,   'daily_report.how_plan'
            ,   'daily_report.when_plan'
            ,   'daily_report.trouble_plan'
            )
            ->whereDate('daily_report.updated_at', ' >= ', $start_time)
            ->whereDate('daily_report.updated_at', ' <= ', $end_time)
            ->orderBy('daily_report.id','ASC')
            ->get();
       return $dataDailyReport;
    }

    public function getInfoDetailReport(Request $request)
    {
        $data  = $request->data;
        $arrResponse = [];
        $data = $this->funcGetInfoDetailReport($data['user_cd'], $data['time_report_detail']);
        if (isset($data->user_cd)) {
            $arrResponse = [
                'status' => 'Success',
                'detailReport' => $data
            ];
        } elseif (!isset($data->user_cd)) {
            $arrResponse = [
                'status' => 'NotFoundData',
            ];
        } else {
            $arrResponse = [
                'status' => 'Fail',
            ];
        }
        return $arrResponse;
    }

    public function funcGetInfoDetailReport($user_cd, $time_report)
    {
        $data = DB::table('daily_report')
        ->leftJoin('users', 'daily_report.user_cd', '=', 'users.user_cd')
        ->select(
            'daily_report.user_cd',
            'daily_report.what_plan',
            'daily_report.how_plan',
            'daily_report.when_plan',
            'daily_report.trouble_plan',
            'daily_report.created_at',
            'daily_report.updated_at AS time_report',
            'users.username',
        )
        ->where([
            'daily_report.user_cd' => $user_cd, 
            'daily_report.updated_at' => $time_report,
            'users.del_flag' => 0
            ])
        ->first();
        return $data;
    }

}