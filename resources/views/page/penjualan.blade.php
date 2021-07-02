  @extends('layouts.app')

  @section('content')

      <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Riayat Setoran</h1>
              <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <div class="card shadow mb-4">
              <div class="d-flex card-header py-3">
                  <h6 class="flex-grow-1 font-weight-bold text-primary">Data Table</h6>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>Hari/Tanggal</th>
                                  <th>Jenis Sampah</th>
                                  <th>Harga</th>
                                  <th>Berat (Kg)</th>
                                  <th>Debit</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Hari/Tanggal</th>
                                  <th>Jenis Sampah</th>
                                  <th>Harga</th>
                                  <th>Berat (Kg)</th>
                                  <th>Debit</th>
                              </tr>
                          </tfoot>
                          <tbody>
                              @php
                                  \Carbon\Carbon::setLocale('id');
                              @endphp
                              @foreach ($penjualan as $item)
                                  @php
                                      $tanggal = \Carbon\Carbon::parse($item['tgl_setor'])->isoFormat('dddd, D MMMM Y');
                                  @endphp
                                  <tr>
                                      <td>{{ $tanggal }}</td>
                                      <td>{{ $item['jenis']['jenis'] }}</td>
                                      <td>{{ $item['jenis']['harga'] }}</td>
                                      <td>{{ $item['berat'] }}</td>
                                      <td>{{ $item['debit'] }}</td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

      </div>

  @endsection
