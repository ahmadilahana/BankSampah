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
                <h6 class="flex-grow-1 font-weight-bold text-primary">Tambah Data</h6>
                <a href="/user/pengurus1" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="/user/pengurus1/add">
                    @csrf
                    <div class="form-group">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="namalengkap" aria-describedby="emailHelp"
                            placeholder="Nama Lengkap" value="{{ old('nama')}}">
                            @if ($errors->has('nama'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('nama') }}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email')}}">
                            @if ($errors->has('email'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="notelepon">Nomor Telepon</label>
                        <input type="text" class="form-control" id="notelepon" name="no_telp" aria-describedby="emailHelp"
                            placeholder="Nomor Telepon" value="{{ old('no_telp')}}">
                            @if ($errors->has('no_telp'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('no_telp') }}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                            placeholder="Password" value="{{ old('password')}}">
                            @if ($errors->has('password'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="confirmationpassword">Confirmation Password</label>
                        <input type="password" class="form-control" name="c_password" id="confirmationpassword"
                            placeholder="Confirmation Password">
                            @if ($errors->has('c_password'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('c_password') }}</small>
                            @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
