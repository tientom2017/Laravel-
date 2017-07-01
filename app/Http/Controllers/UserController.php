<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function getDanhSach()
    {
    	$user = User::all();
    	return view('admin.user.danhsach', compact("user"));
    }

    public function getThem()
    {
    	return view('admin.user.them');
    }

    public function postThem(Request $request)
    {
    	/*$this->validate($request,
    		[
				'email'	=> 'unique:users,email|required',
				'name'	=> 'required',
				'password'	=> 'required'
    		],
    		[
    			'email.unique'	=>	'Không được trùng email!',
    			'email.required'=>	'Không được bỏ trống',
    			'name.required'=>	'Không được bỏ trống',
    			'password.required'=>	'Không được bỏ trống',
    		]);*/
    	$user = new User;
    	$user->name = $request->ten;
    	$user->email = $request->email;
    	$user->quyen = $request->quyen;
    	$user->password= bcrypt($request->password);
    	$user->save();
    	return redirect('admin/user/danhsach')->with('thongbao', 'User đã được thêm thành công!');
    }

    public function getSua($id)
    {
    	$user = User::find($id);
    	return view('admin.user.sua', compact("user"));
    }

    public function postSua(Request $request, $id)
    {
    	$user = User::find($id);
    	/*$this->validate($request,
    		[
				'email'	=> 'unique:users,email|required',
				'name'	=> 'required',
				'password'	=> 'required'
    		],
    		[
    			'email.unique'	=>	'Không được trùng email!',
    			'email.required'=>	'Không được bỏ trống',
    			'name.required'=>	'Không được bỏ trống',
    			'password.required'=>	'Không được bỏ trống',
    		]);*/
    	$user->name = $request->ten;
    	$user->email = $request->email;
    	$user->quyen = $request->quyen;
    	$user->password= bcrypt($request->password);
    	$user->save();
    	return redirect('admin/user/danhsach')->with('thongbao', 'user đã sửa thành công!');
    }

    public function getXoa($id)
    {
    	$user = User::find($id);
    	$user->delete();
    	return redirect('admin/user/danhsach')->with('thongbao', 'user đã xóa thành công!');
    }

    public function getDangnhapAdmin()
    {
    	return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request)
    {
    	if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password]))
    	{
    		return redirect('admin/user/danhsach')->with('thongbao', 'Đăng nhập thành công!');
    	}else{
    		return redirect('admin/dangnhap')->with('thongbao', 'Đăng nhập không thành công!');
    	}
    }

    public function getDangXuatAdmin()
    {
    	Auth::logout();
    	return redirect('admin/dangnhap')->with('thongbao', 'Đăng xuất thành công!');
    }

    public function getDangNhap()
    {
        return view('pages.dangnhap');
    }

    public function postDangNhap(Request $request)
    {
        /*    $this->validate($request, [], [])*/
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('trangchu')->with('thongbao', 'Đăng nhập thành công!');
        }else{
            return redirect('dangnhap')->with('thongbao', 'Đăng nhập không thành công!');
        }
    }

    public function getDangXuat()
    {
        Auth::logout();
        return redirect('dangnhap')->with('thongbao', 'Đăng xuất thành công!');
    }
}
