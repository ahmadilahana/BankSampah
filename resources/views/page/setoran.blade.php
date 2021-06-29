  @extends('layouts.app')

  @section('content')

      <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Setoran</h1>
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
                                  <th>Nama</th>
                                  <th>Keterangan</th>
                                  <th>Harga Satuan</th>
                                  <th>Berat (Kg)</th>
                                  <th>Debit</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Hari/Tanggal</th>
                                  <th>Nama</th>
                                  <th>Keterangan</th>
                                  <th>Harga Satuan</th>
                                  <th>Berat (Kg)</th>
                                  <th>Debit</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot>
                          <tbody>
                              @php
                                  \Carbon\Carbon::setLocale('id');
                              @endphp
                              @foreach ($data as $item)
                                  @php
                                      $tanggal = \Carbon\Carbon::parse($item['tgl_setor'])->isoFormat('dddd, D MMMM Y');
                                      
                                      if ($item['keterangan'] == 'dijemput') {
                                          $harga = $item['jenis']['harga'] - $item['jenis']['harga'] * 0.2;
                                      } else {
                                          $harga = $item['jenis']['harga'];
                                      }
                                  @endphp
                                  <tr>
                                      <td>{{ $tanggal }}</td>
                                      <td>{{ $item['user']['name'] }}</td>
                                      <td>{{ $item['keterangan'] }}</td>
                                      <td>{{ $harga }}</td>
                                      <td>{{ $item['berat'] }}</td>
                                      <td>{{ $item['debit'] }}</td>
                                      <td>
                                          <button class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal"
                                              data-target="#detail{{ $item['id'] }}">
                                              <span class="icon text-white-50">
                                                  <i class="fas fa-info"></i>
                                              </span>
                                              <span class="text">Detail</span>
                                          </button>
                                          <div class="modal fade" id="detail{{ $item['id'] }}" tabindex="-1" role="dialog"
                                              aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Detail Setoran</h5>
                                                          <button type="button" class="close" data-dismiss="modal"
                                                              aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <div class="row">
                                                              <label for="" class="col-md-4">Hari/Tanggal</label>
                                                              <p class="col-md-8">: {{ $tanggal }}</p>
                                                          </div>
                                                          <div class="row">
                                                              <label for="" class="col-md-4">Nama</label>
                                                              <p class="col-md-8">: {{ $item['user']['name'] }}</p>
                                                          </div>
                                                          <div class="row">
                                                              <label for="" class="col-md-4">Keterangan</label>
                                                              <p class="col-md-8">: {{ $item['keterangan'] }}</p>
                                                          </div>
                                                          <div class="row">
                                                              <label for="" class="col-md-4">Jenis Sampah</label>
                                                              <p class="col-md-8">: {{ $item['jenis']['jenis'] }}</p>
                                                          </div>
                                                          <div class="row">
                                                              <label for="" class="col-md-4">Harga</label>
                                                              <p class="col-md-8">: {{ $harga }}</p>
                                                          </div>
                                                          <div class="row">
                                                              <label for="" class="col-md-4">Berat</label>
                                                              <p class="col-md-8">: {{ $item['berat'] }} Kg</p>
                                                          </div>
                                                          <div class="row">
                                                              <label for="" class="col-md-4">Debit</label>
                                                              <p class="col-md-8">: {{ $item['debit'] }}</p>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

      </div>

  @endsection
