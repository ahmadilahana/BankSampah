@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jenis Sampah</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="card shadow mb-4">
            <div class="d-flex card-header py-3">
                <h6 class="flex-grow-1 font-weight-bold text-primary">Tambah Data</h6>
                <a href="/jenis_sampah" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="/jenis_sampah/add">
                    @csrf
                    <div class="form-group">
                        <label for="jenis">Jenis Sampah</label>
                        <input type="text" class="form-control" name="jenis" id="jenis" aria-describedby="emailHelp"
                            placeholder="Jenis Sampah" value="{{ old('jenis')}}">
                            @if ($errors->has('harga'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('harga') }}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="harga"></label>
                        <input type="text" class="form-control" name="harga" id="harga"
                            aria-describedby="emailHelp" placeholder="Harga (Rp)" value="{{ old('harga')}}">
                            @if ($errors->has('harga'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('harga') }}</small>
                            @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
