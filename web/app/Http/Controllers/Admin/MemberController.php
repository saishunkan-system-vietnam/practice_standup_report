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
    	// $this->middleware('auth');
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
        $validator = $this->validator($allRequest);
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

    protected function validator(array $data)
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

    public function editMember()
    {
        $user = DB::table('users')
            ->where([
                'user_cd' => 'nv0092',
                'del_flag' => 0])
            ->first();

        return view('admin/member/member_edit', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
