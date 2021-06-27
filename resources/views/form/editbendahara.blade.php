@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bendahara</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="card shadow mb-4">
            <div class="d-flex card-header py-3">
                <h6 class="flex-grow-1 font-weight-bold text-primary">Edit Data</h6>
                <a href="/user/bendahara" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="/user/bendahara/edit/{{ $user['id']}}">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="namalengkap" aria-describedby="emailHelp"
                            placeholder="Nama Lengkap" value="{{ ($errors->has('nama')) ? old('nama') : $user['name']}}">
                            @if ($errors->has('nama'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('nama') }}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" value="{{ ($errors->has('email')) ? old('email') : $user['email']}}">
                            @if ($errors->has('email'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="notelepon">Nomor Telepon</label>
                        <input type="text" class="form-control" id="notelepon" name="no_telp" aria-describedby="emailHelp"
                            placeholder="Nomor Telepon" value="{{ ($errors->has('no_telp')) ? old('no_telp') : $user['no_telp']}}">
                            @if ($errors->has('no_telp'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('no_telp') }}</small>
                            @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
