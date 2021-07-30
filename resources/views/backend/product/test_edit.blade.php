@extends('admin.admin_master')

@section('admin')
<form action="{{ route('update.potongan') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $voucher->id }}">
    <div class="form-group">
        <label for="">Potongan</label>
        <input class="form-control" name="potongan" type="number" value="{{ $voucher->potongan }}">
    </div>
</form>
<a href="{{ route('update.potongan') }}" class="btn btn-primary">Update</a>
@endsection