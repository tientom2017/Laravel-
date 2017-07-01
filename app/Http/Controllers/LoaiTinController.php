<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {
    	$loaitin = LoaiTin::all();
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.danhsach', compact('loaitin'), compact('theloai'));
    }

    public function getThem()
    {
    	$loaitin = LoaiTin::all();
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.them', compact('theloai'));
    }

    public function postThem(Request $request)
    {
    	$loaitin = new LoaiTin;
    	$this->validate($request, 
    		[
    			'ten'		=>	'required|min:3|max:15|unique:LoaiTin,Ten',
    			'theloai'	=>	'required'
    		], 
			[
				'ten.required'  => 'Không được bỏ trống!',
    			'ten.min'		=>	'Tối thiểu 3 ký tự',
    			'ten.max'		=>	'Tối đa 15 ký tự',
    			'ten.unique'	=>	'Không được trùng!',
    			'theloai.required' => 'Không được bỏ trống!'
			]);
    	$loaitin->idTheLoai = $request->theloai;
    	$loaitin->Ten = $request->ten;
    	$loaitin->TenKhongDau = changeTitle($request->ten);
    	$loaitin->save();

    	return redirect('admin/loaitin/them')->with('thongbao', 'Loại tin đã được thêm thành công!');
    }

    public function getXoa($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$loaitin->delete();
    	return redirect('admin/loaitin/danhsach')->with('thongbao', 'Loại tin đã được xóa thành công!');
    }

    public function getSua($id)
    {
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::find($id);
    	return view('admin.loaitin.sua', ['loaitin'=>$loaitin, 'theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id)
    {
    	$loaitin = LoaiTin::find($id);
    	$this->validate($request, 
    		[
    			'theloai'	=>	'required',
    			'ten'		=>	'required|min:3|max:15|unique:LoaiTin,Ten'
    		], 
			[
				'theloai.required'	=>	'không được bỏ trống',
				'ten.required'		=>	'không được bỏ trống',
				'ten.min'			=>	'tối thiểu 3 ký tự',
				'ten.max'			=>	'tối đa 15 ký tự',
				'ten.unique'		=>	'Loại tin đã tồn tại'
			]);
    	$loaitin->idTheLoai = $request->theloai;
    	$loaitin->Ten 		= $request->ten;
    	$loaitin->TenKhongDau= changeTitle($request->ten);
    	$loaitin->save();

    	return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công!');
    }
}
