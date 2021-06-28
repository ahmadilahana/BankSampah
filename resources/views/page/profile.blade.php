@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body row">
                <div class="col-md-4">
                    <img src="img/undraw_profile.svg" class="rounded-circle">
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="namalengkap" aria-describedby="emailHelp"
                            placeholder="Nama Lengkap" value="{{ Auth::user()->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" value="{{ Auth::user()->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="notelepon">Nomor Telepon</label>
                        <input type="text" class="form-control" id="notelepon" name="no_telp" aria-describedby="emailHelp"
                            placeholder="Nomor Telepon" value="{{ Auth::user()->no_telp}}" readonly>
                    </div>
                    <a href="/profile/edit" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection