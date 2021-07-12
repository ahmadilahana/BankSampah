@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pengurus 1</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="card shadow mb-4">
            <div class="d-flex card-header py-3">
                <h6 class="flex-grow-1 font-weight-bold text-primary">Edit Data</h6>
                <a href="/profile" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" class="row" action="/profile/edit/{{ Auth::user()->id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-4">
                        <img src="{{ (empty(Auth::user()->load('foto')->foto->foto) ? asset('img/undraw_profile.svg') : Auth::user()->load('foto')->foto->foto)}}" class="rounded-circle" width="300" height="300" id="preview_img">
                        <input type="file" class="form-control mt-2" name="foto" id="formFile" onchange="preview_image(event)" value="">
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="namalengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="namalengkap" aria-describedby="emailHelp"
                            placeholder="Nama Lengkap" value="{{ ($errors->has('nama')) ? old('nama') : Auth::user()->name}}">
                            @if ($errors->has('nama'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('nama') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" value="{{ ($errors->has('email')) ? old('email') : Auth::user()->email}}">
                            @if ($errors->has('email'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="notelepon">Nomor Telepon</label>
                            <input type="text" class="form-control" id="notelepon" name="no_telp" aria-describedby="emailHelp"
                            placeholder="Nomor Telepon" value="{{ ($errors->has('no_telp')) ? old('no_telp') : Auth::user()->no_telp}}">
                            @if ($errors->has('no_telp'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('no_telp') }}</small>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
        </div>
    </div>
@endsection
