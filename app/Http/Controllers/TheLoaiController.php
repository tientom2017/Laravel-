<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach', ['theloai'=>$theloai]);	
    }

    public function getThem()
    {
    	return view('admin.theloai.them');
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'ten'	=>	'required|min:3|max:15'
    		],
    		[
    			'ten.required'  => 'Không được bỏ trống!',
    			'ten.min'		=>	'Tối thiểu 3 ký tự',
    			'ten.max'		=>	'Tối đa 15 ký tự'
    		]);
    	$theloai = new TheLoai;
    	$theloai->Ten = $request->ten;
    	$theloai->TenKhongDau = changeTitle($request->ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao', 'Thêm Thành Công!');
    }

    public function getXoa($id)
    {
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao', 'Đã Xóa Thành Công!');
    }

    public function getSua($id)
    {
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',/* compact('theloai')*/['theloai' => $theloai]);
    }

    public function postSua(Request $request, $id)
    {
        $theloai = TheLoai::find($id);
        $this->validate($request, 
                            [
                                'ten'   =>  'required|min:3|max:15|unique:TheLoai,Ten'
                            ],
                            [
                                'ten.required'  =>  'Không được bỏ trống!',
                                'ten.min'       =>  'Tối thiểu 3 ký tự',
                                'ten.max'       =>  'Tối đa 15 ký tự',
                                'ten.unique'    =>  'Không được trùng với bản ghi có sẵn!'
                            ]);

        $theloai->Ten = $request->ten;
        $theloai->TenKhongDau = changeTitle($request->ten);
        $theloai->save();
        return redirect('admin/theloai/danhsach')->with('thongbao', 'Sửa thành công!');
    }
}
