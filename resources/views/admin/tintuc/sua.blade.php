 @extends('admin/layout/index')
 @section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label>Danh Sách Thể Loại</label>
                                <select class="form-control" name="theloai" id="theloai">
                                    @foreach ($theloai as $tl)
                                    	<option @if ($tl->id == $tintuc->LoaiTin->TheLoai->id)
                                    		{{"selected"}}
                                    	@endif value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>

                       		<div class="form-group">
                                <label>Danh Sách loại tin</label>
                                <select class="form-control" name="loaitin" id="loaitin">
                                   	@foreach ($loaitin as $lt)
                                   		<option @if ($lt->id == $tintuc->LoaiTin->id)
                                   			{{"selected"}}
                                   		@endif value="{{$lt->id}}">{{$lt->Ten}}</option>
                                   	@endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" value="{{$tintuc->TieuDe}}" name="tieude" placeholder="Nhập tiêu đề..." />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <input class="form-control" value="{{$tintuc->TomTat}}" name="tomtat" placeholder="Nội dung tóm tắt..." />
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                               <textarea id="demo"  name="noidung" class="ckeditor">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <img src="upload/tintuc/{{$tintuc->Hinh}}" width="150px" style="border: 2px solid;margin-bottom: 5px;">
                                <input class="form-control" name="hinhanh" class="form-control" type="file" placeholder="Please Enter Category Keywords" />
                            </div>
                            <div class="form-group">
                               <label>Nổi Bật</label>
                                <label class="radio-inline">
                                    <input name="noibat" value="{{$tintuc->NoiBat}}" @if ($tintuc->NoiBat == 0)
                                    	{{"checked"}}
                                    @endif type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="noibat" value="{{$tintuc->NoiBat}}" @if ($tintuc->NoiBat == 1)
                                    	{{"checked"}}
                                    @endif type="radio">Có
                                </label>
                            </div> 

                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>User</th>
                                <th>Nội Dung</th>
                                <th>Thời gian tạo</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($tintuc->Comment as $cm)
                             <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td><p>{{$cm->User->name}}</p>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->created_at}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$tintuc->id}}/{{$cm->id}}"> Xóa</a></td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$("#theloai").change(function(){
				var idTheloai = $(this).val();
				$.get("admin/ajax/loaitin/"+idTheloai, function(data){
					$("#loaitin").html(data);
				});
			});
		});
	</script>
@endsection