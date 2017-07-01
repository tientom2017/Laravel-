@extends('admin.layout.index')

@section('content')
     <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tên Slide</label>
                                <input class="form-control" value="{{$slide->Ten}}" name="ten" placeholder="Nhập tên slide..." />
                            </div>

                            <div class="form-group">
                                <label>Hình</label>
                                <img src="upload/slide/{{$slide->Hinh}}" width="200px" style="margin-bottom: 10px;  ">
                                <input class="form-control" type="file" name="hinh"/>
                            </div>

                            <div class="form-group">
                                <label>Nội Dung</label>
                                <input class="form-control" value="{{$slide->NoiDung}}" name="noidung" placeholder="Nhập nội dung..." />
                            </div>

                             <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" value="{{$slide->link}}" name="link" placeholder="Nhập link..." />
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
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