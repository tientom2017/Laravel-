@extends('admin.layout.index')

@section('content')
     <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12" style="padding-bottom:120px">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>   
                    @endif
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          	<div class="form-group">
                                <label>Danh Sách Thể Loại</label>
                                <select class="form-control" name="theloai" id="theloai">
                                    @foreach ($theloai as $tl)
                                    	<option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Danh Sách loại tin</label>
                                <select class="form-control" name="loaitin" id="loaitin">
                                   	@foreach ($loaitin as $lt)
                                   		<option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                   	@endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="tieude" placeholder="Nhập tiêu đề..." />
                            </div>
                               <div class="form-group">
                                <label>Tóm tắt</label>
                                <input class="form-control" name="tomtat" placeholder="Nội dung tóm tắt..." />
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                               <textarea id="demo" name="noidung" class="ckeditor"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <input class="form-control" name="hinhanh" class="form-control" type="file" placeholder="Please Enter Category Keywords" />
                            </div>
                            <div class="form-group">
                               <label>Nổi Bật</label>
                                <label class="radio-inline">
                                    <input name="noibat" value="0" checked="" type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="noibat" value="1" type="radio">Có
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$("#theloai").change(function(){
				var idTheLoai = $(this).val();
				$.get("admin/ajax/loaitin/"+idTheLoai, function(data){
					$("#loaitin").html(data);
				});
			});
		});
	</script>
@endsection