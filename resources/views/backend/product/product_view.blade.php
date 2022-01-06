@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Data Tables</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Tables</li>
                            <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name EN</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                    <tr>
                                        <td><img src="{{ asset($item->product_thumbnail) }}" style="width: 60px; height: 50px ;"></td>
                                        <td>{{ $item->product_name_en }}</td>
                                        <td>{{ $item->selling_price }} $</td>
                                        <td>{{ $item->product_qty }} Pcs</td>
                                        <td>
                                            @if ($item->discount_price == NULL)
                                            <span class="badge badge-pill badge-danger">No discount</span>
                                            @else
                                            @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = ($amount/$item->selling_price) * 100;
                                            @endphp
                                            <span class="badge badge-pill badge-success">{{ round($discount) }}%</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td width="25%;">
                                            <a href="{{ route('product.detail', $item->id) }}" class="btn btn-sm btn-primary" title="Detail"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('product.delete', $item->id) }}" class="btn btn-sm btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>

                                            @if ($item->status == 1)
                                            <a href="{{ route('product.deactive', $item->id) }}" class="btn btn-sm btn-info" title="Deactive Now"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a href="{{ route('product.active', $item->id) }}" class="btn btn-sm btn-success" title="Activate Now"><i class="fa fa-arrow-up"></i></a>
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

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection