@extends('admin.admin_master')

@section('admin')
<div class="row">
    <div class="col-md-6">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <!-- <th>No</th> -->
                    <th>Potongan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($voucher as $item)
                <tr>
                    <!-- <td></td> -->
                    <td>{{ $item->potongan }}</td>
                    <td>
                        <a href="{{ route('edit.potongan', $item->id) }}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"></i></a>
                        <a href="{{ route('delete.potongan', $item->id) }}" class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-md-6">
        <form action="{{ route('add.potongan') }}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="form-group">
                <label for="">Potongan</label>
                <input class="form-control" name="potongan" type="number">
            </div>
            <input type="submit" class="btn btn-rounded btn-primary mt-10" value="Tambah Potongan">
        </form>
    </div>
</div>

@endsection