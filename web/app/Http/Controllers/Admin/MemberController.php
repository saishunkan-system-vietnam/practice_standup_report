<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use Illuminate\Support\Facades\DB;
class MemberController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('layout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listMember()
    {
        $users = DB::table('users')->where('del_flag', 0)->paginate(2);
        foreach ($users as $row) {
            if ($row->level == 1) {
                $row->level = 'SuperAdmin';
            } elseif ($row->level == 2) {
                $row->level = 'Admin';
            } else {
                $row->level = 'Member';
            }
        }
       
        return view('admin/member/member_list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerMember()
    {
        return view('admin/member/member_register');
    }

    public function postRegisterMember(Request $request) {
        $allRequest  = $request->all();
        $validator = $this->validatorRegister($allRequest);
        if ($validator->fails()) {
            return redirect('admin/member-add')->withErrors($validator)->withInput();
        } else {
            if( $this->createMember($allRequest)) {
                Session::flash('success', 'Đăng ký thành viên thành công!');
                return redirect('admin/member-add');
            } else {
                Session::flash('error', 'Đăng ký thành viên thất bại!');
                return redirect('admin/member-add');
            }
        }
    }

    protected function validatorRegister(array $data)
    {
        return Validator::make($data,
            [
                'username' => 'required|string|max:15',
                'password' => 'required|string|min:6|confirmed',
                'user_cd' => 'required|string|max:8',
                'name' => 'required|string|max:22',
                'email' => 'required|string|email|max:255|unique:users',
                'email' => 'required|string|max:30|unique:users',
            ],
            [
                'username.required' => 'Tên đăng nhập là trường bắt buộc',
                'username.max' => 'Tên đăng nhập không quá 15 ký tự',
                'user_cd.required' => 'Mã nhân viên là trường bắt buộc',
                'user_cd.max' => 'Mã nhân viên không quá 8 ký tự',
                'password.required' => 'Mật khẩu là trường bắt buộc',
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng',
                'name.required' => 'Tên nhân viên là trường bắt buộc',
                'name.max' => 'Tên nhân viên không quá 22 ký tự',
                'email.required' => 'Email là trường bắt buộc',
                'email.email' => 'Email không đúng định dạng',
                'email.max' => 'Email không quá 255 ký tự',
                'email.unique' => 'Email đã tồn tại',
            ]
        );
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data,
            [
                'username' => 'required|string|max:15',
                'name' => 'required|string|max:22',
                'email' => 'required|string|email|max:255',
            ],
            [
                'username.required' => 'Tên đăng nhập là trường bắt buộc',
                'username.max' => 'Tên đăng nhập không quá 15 ký tự',
                'name.required' => 'Tên nhân viên là trường bắt buộc',
                'name.max' => 'Tên nhân viên không quá 22 ký tự',
                'email.required' => 'Email là trường bắt buộc',
                'email.email' => 'Email không đúng định dạng',
                'email.max' => 'Email không quá 255 ký tự',
            ]
        );
    }

    protected function createMember(array $data)
    {
        $birthday = date('Y-m-d', strtotime($data['birthday']));
        return User::create([
            'user_cd' => $data['user_cd'],
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'birthday' => $birthday,
            'telephone' => $data['telephone'],
            'address' => $data['address'],
            'password' => bcrypt($data['password']),
            'level' => $data['level']
        ]);
    }

    public function editMember($user_cd)
    {
        $user = DB::table('users')
            ->where([
                'user_cd' => $user_cd,
                'del_flag' => 0])
            ->first();
        $user->birthday = date('m/d/Y', strtotime($user->birthday));
        return view('admin/member/member_edit', ['user' => $user]);
    }

    public function postUpdateMember(Request $request) {
        $data  = $request->all();
        $validator = $this->validatorUpdate($data);
        if ($validator->fails()) {
            return redirect('admin/member-edit/'.$data['user_cd'])->withErrors($validator)->withInput();
        } else {
            if ($this->updateMember($data)) {
                Session::flash('success', 'Update thành viên thành công!');
                return redirect('admin/member-edit/'.$data['user_cd']);
            } else {
                Session::flash('error', 'Update thành viên thất bại!');
                return redirect('admin/member-edit/'.$data['user_cd']);
            }
        }
    }

    protected function updateMember(array $data)
    {
        $birthday = date('Y-m-d', strtotime($data['birthday']));
        $result = DB::table('users')
            ->where([
                "users.user_cd" => $data['user_cd'],
                "users.del_flag" => 0
            ])
            ->update([
                'username' => $data['username'],
                'name' => $data['name'],
                'email' => $data['email'],
                'birthday' => $birthday,
                'telephone' => $data['telephone'],
                'address' => $data['address'],
                'level' => $data['level']
            ]);
        return $result;
    }

    protected function deleteMember(Request $request)
    {
        $user_cd = $request->user_cd;
        $result = DB::table('users')
            ->where([
                "users.user_cd" => $user_cd,
            ])
            ->update([
                "users.del_flag" => 1
            ]);
        return response()->json([
            'status' => 'Success',
        ]);
    }

}
