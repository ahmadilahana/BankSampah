  @extends('layouts.app')

  @section('content')

      <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Jenis Pembayaran</h1>
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
                  <h6 class="flex-grow-1 font-weight-bold text-primary">Data Table</h6>
                  @if (Auth::user()->role == 'Admin')
                      <a href="/jenis_sampah/add" class="btn btn-primary btn-icon-split btn-sm">
                          <span class="icon text-white-50">
                              <i class="fas fa-plus"></i>
                          </span>
                          <span class="text">Tambah Data</span>
                      </a>
                  @endif
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>Jenis</th>
                                  <th>Harga</th>
                                  @if (Auth::user()->role == 'Admin')
                                      <th>Action</th>
                                  @endif
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Jenis</th>
                                  <th>Harga (/Kg)</th>
                                  @if (Auth::user()->role == 'Admin')
                                      <th>Action</th>
                                  @endif
                              </tr>
                          </tfoot>
                          <tbody>
                              @foreach ($sampah as $item)

                                  <tr>
                                      <td>{{ $item['jenis'] }}</td>
                                      <td>{{ $item['harga'] }}</td>
                                      @if (Auth::user()->role == 'Admin')
                                          <td>
                                              <a href="/jenis_sampah/edit/{{ $item['id'] }}"
                                                  class="btn btn-primary btn-icon-split btn-sm">
                                                  <span class="icon text-white-50">
                                                      <i class="fas fa-edit"></i>
                                                  </span>
                                                  <span class="text">Edit</span>
                                              </a>
                                              <a href="/jenis_sampah/delete/{{ $item['id'] }}"
                                                  class="btn btn-danger btn-icon-split btn-sm">
                                                  <span class="icon text-white-50">
                                                      <i class="far fa-trash-alt"></i>
                                                  </span>
                                                  <span class="text">Hapus</span>
                                              </a>
                                          </td>
                                      @endif
                                  </tr>

                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

      </div>

  @endsection
