@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Penarikan</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="card shadow mb-4">
            <div class="d-flex card-header py-3">
                <h6 class="flex-grow-1 font-weight-bold text-primary">Form Data</h6>
                <a href="/bukutabungan" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            <div class="card-body">
                <form action="/penarikan" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nasabah</label>
                        <select class="form-control selectpicker" name="name" data-live-search="true">
                            <option value="" selected>Pilih Nasabah</option>
                            @foreach ($users as $user)
                                <option value="{{ $user['id'] }}" {{ $user['id']==old('name') ? 'selected' : '' }}>{{ $user['name'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('name'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Penarikan</label>
                        <input type="text" class="form-control" name="penarikan" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Jumlah Penarikan" value="{{ old('penarikan') }}">
                        @if ($errors->has('penarikan'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('penarikan') }}</small>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
