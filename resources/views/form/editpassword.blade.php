@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
        @if (Session::has('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php
                Session::forget('success');
            @endphp
        @endif
        <div class="card shadow mb-4">
            <div class="d-flex card-header py-3">
                <h6 class="flex-grow-1 font-weight-bold text-primary">Edit Data</h6>
                <a href="/" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="/profile/reset_password">
                    @csrf
                    <div class="form-group">
                        <label for="namalengkap">New Password</label>
                        <input type="password" class="form-control" name="new_password" id="namalengkap"
                            aria-describedby="emailHelp" placeholder="New Password">
                        @if ($errors->has('new_password'))
                            <small id="emailHelp"
                                class="form-text text-danger">{{ $errors->first('new_password') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirmation Password</label>
                        <input type="password" class="form-control" name="c_password" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email">
                        @if ($errors->has('c_password'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('c_password') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="notelepon">Old Password</label>
                        <input type="password" class="form-control" id="notelepon" name="old_password"
                            aria-describedby="emailHelp" placeholder="Nomor Telepon">
                        @if ($errors->has('old_password'))
                            <small id="emailHelp"
                                class="form-text text-danger">{{ $errors->first('old_password') }}</small>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
