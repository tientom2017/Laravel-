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
                        <form action="admin/user/sua/{{$user->id}}" method="POST" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" value="{{$user->name}}" name="ten" placeholder="Nhập tên User..." />
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" value="{{$user->email}}" name="email" placeholder="Nhập email..." />
                            </div>

                             <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" value="{{$user->password}}" name="password" placeholder="Nhập password..." />
                            </div>

                            <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control" name="quyen">
                                        <option @if ($user->quyen == 0)
                                            {{"selected"}}
                                        @endif value="0">USER</option>
                                        <option @if ($user->quyen == 1)
                                            {{"selected"}}
                                        @endif value="1">ADMIN</option>
                                </select>
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