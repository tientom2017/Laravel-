<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function getXoa($idTinTuc,$id)
    {
    	$comment = Comment::find($id);
    	$comment->delete();
    	return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao', 'Xóa CMT thành công!');
    }

    public function postThem($idTinTuc, Request $request)
    {
    	$comment = new Comment;
    	$comment->idUser = Auth::user()->id;
    	$comment->idTinTuc = $idTinTuc;
    	$comment->NoiDung = $request->NoiDung;
    	$comment->save();
    	return redirect('trangchu');
    }
}
