<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;

class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
    	$tintuc = TinTuc::orderBy('id', 'DESC')->get();
    	return view('admin.tintuc.danhsach', ['tintuc'=>$tintuc]);
    }

    public function getThem()
    {
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them', ['theloai'=>$theloai], ['loaitin'=>$loaitin]);
    }

    public function postThem(Request $request)
    {
    	$tintuc = new TinTuc;
    	$this->validate($request, 
    		[
    			'loaitin'	=>	'required',
    			'tieude'	=>	'required|unique:TinTuc,TieuDe|min:3|max:1000',
    			'tomtat'	=>	'required|min:3|max:1000',
    			'noidung'	=>	'required|min:3|max:10000'
    		], 
    		[
    			'loaitin.required'	=>	'Không được trống!',
    			'tieude.required'	=>	'Tiêu đề Không được trống!',
    			'tieude.min'		=>	'Tối thiểu 3 ký tự',
    			'tieude.max'		=>	'Tối đa 1000 ký tự',
    			'tieude.unique'		=>	'Tiêu đề đã tồn tại',
    			'tomtat.required'	=>	'Tóm tắt Không được trống!',
    			'tomtat.min'		=>	'Tối thiểu 3 ký tự',
    			'tomtat.max'		=>	'Tối đa 1000 ký tự',
    			'noidung.required'	=>	'Nội dung Không được trống!',
    			'noidung.min'		=>	'Tối thiểu 3 ký tự',
    			'noidung.max'		=>	'Tối đa 10000 ký tự',
    		]);
    	$tintuc->TieuDe = $request->tieude;
    	$tintuc->TieuDeKhongDau = changeTitle($request->tieude);
    	$tintuc->TomTat = $request->tomtat;
    	$tintuc->NoiDung = $request->noidung;
    	$tintuc->idLoaiTin = $request->loaitin;
    	$tintuc->NoiBat = $request->noibat;
    	if($request->hasFile('hinhanh'))
    	{
    		$file = $request->file('hinhanh');
    		$duoi = $file->getClientOriginalExtension();
    		if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'JPG' && $duoi != 'PNG' && $duoi != 'JPEG') {
    				return redirect('admin/tintuc/them')->with('thongbao', 'Kiểu file không đúng! Xin Vui Lòng Thử Lại');
    		}
    		$name = $file->getClientOriginalName();
    		$Hinh = str_random(4)."_".$name;
    		while (file_exists("upload/tintuc/".$Hinh)) {
    			$Hinh = str_random(4)."_".$name;
    		}
    		$file->move("upload/tintuc", $Hinh);
    		$tintuc->Hinh = $Hinh;
    	}else{
    		$tintuc->Hinh = "";
    	}
    	$tintuc->save();
    	return redirect('admin/tintuc/them')->with('thongbao', 'Tin tức đã được thêm thành công!');
    }

    public function getSua($id)
    {
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	$tintuc = TinTuc::find($id);
    	return view('admin.tintuc.sua', ['tintuc'=>$tintuc, 'loaitin'=>$loaitin, 'theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id)
    {
    	$tintuc = TinTuc::find($id);
    	$comment = Comment::all();
    	$this->validate($request, 
    		[
    			'loaitin'	=>	'required',
    			'tieude'	=>	'required|unique:TinTuc,TieuDe|min:3|max:1000',
    			'tomtat'	=>	'required|min:3|max:1000',
    			'noidung'	=>	'required|min:3|max:10000'
    		], 
    		[
    			'loaitin.required'	=>	'Không được trống!',
    			'tieude.required'	=>	'Tiêu đề Không được trống!',
    			'tieude.min'		=>	'Tối thiểu 3 ký tự',
    			'tieude.max'		=>	'Tối đa 1000 ký tự',
    			'tieude.unique'		=>	'Tiêu đề đã tồn tại',
    			'tomtat.required'	=>	'Tóm tắt Không được trống!',
    			'tomtat.min'		=>	'Tối thiểu 3 ký tự',
    			'tomtat.max'		=>	'Tối đa 1000 ký tự',
    			'noidung.required'	=>	'Nội dung Không được trống!',
    			'noidung.min'		=>	'Tối thiểu 3 ký tự',
    			'noidung.max'		=>	'Tối đa 10000 ký tự',
    		]);
    	$tintuc->TieuDe = $request->tieude;
    	$tintuc->TieuDeKhongDau = changeTitle($request->tieude);
    	$tintuc->TomTat = $request->tomtat;
    	$tintuc->NoiDung = $request->noidung;
    	$tintuc->idLoaiTin = $request->loaitin;
    	$tintuc->NoiBat = $request->noibat;
    	$tintuc->SoLuotXem = 0;
    	if($request->hasFile('hinhanh'))
    	{
    		$file = $request->file('hinhanh');
    		$duoi = $file->getClientOriginalExtension();
    		if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'JPG' && $duoi != 'PNG' && $duoi != 'JPEG') {
    				return redirect('admin/tintuc/them')->with('thongbao', 'Kiểu file không đúng! Xin Vui Lòng Thử Lại');
    		}
    		$name = $file->getClientOriginalName();
    		$Hinh = str_random(4)."_".$name;
    		while (file_exists("upload/tintuc/".$Hinh)) {
    			$Hinh = str_random(4)."_".$name;
    		}
    		unlink("upload/tintuc/".$tintuc->Hinh);
    		$file->move("upload/tintuc", $Hinh);
    		$tintuc->Hinh = $Hinh;

    	}
    	dd($tintuc);
    	$tintuc->save();
    	return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Tin tức đã được sửa thành công!');
    }

    public function getXoa($id)
    {
    	$tintuc = TinTuc::find($id);
    	$tintuc->delete();
    	return redirect('admin/tintuc/danhsach')->with('thongbao', 'Tin tức đã được xóa thành công!');
    }
}
