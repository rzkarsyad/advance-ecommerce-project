@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slider List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $item)
                                    <tr>
                                        <td><img src="{{ asset($item->slider_img) }}" style="width: 70px; height: 40px;"></td>
                                        <td>
                                            @if ($item->title == NULL)
                                            <span class="text-danger">Not Set</span>
                                            @else
                                            {{ $item->title }}
                                            @endif
                                        </td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td width="25%;">
                                            <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('slider.delete', $item->id) }}" class="btn btn-sm btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>

                                            @if ($item->status == 1)
                                            <a href="{{ route('slider.deactive', $item->id) }}" class="btn btn-sm btn-info" title="Deactive Now"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a href="{{ route('slider.active', $item->id) }}" class="btn btn-sm btn-success" title="Activate Now"><i class="fa fa-arrow-up"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->

            <!-- Add Slider Column -->
            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Title</h5>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Description</h5>
                                    <div class="controls">
                                        <!-- <input type="text" name="brand_name_id" class="form-control"> -->
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Slider Image<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="slider_img" class="form-control">
                                        @error('slider_img')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mt-10" value="Add new slider">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection