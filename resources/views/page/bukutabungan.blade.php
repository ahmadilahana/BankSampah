  @extends('layouts.app')

  @section('content')

      <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">BukuTabungan</h1>
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
                                  <th>Nama</th>
                                  <th>Berat (Kg)</th>
                                  <th>Saldo</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Nama</th>
                                  <th>Berat (Kg)</th>
                                  <th>Saldo</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot>
                          <tbody>
                              @foreach ($data as $item)

                                  <tr>
                                      <td>{{ $item['user']['name'] }}</td>
                                      <td>{{ $item['total_berat'] }} Kg</td>
                                      <td>{{ $item['total_saldo'] }}</td>
                                      <td>
                                          <button class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal"
                                              data-target="#detail{{ $item['user_id'] }}">
                                              <span class="icon text-white-50">
                                                  <i class="fas fa-info"></i>
                                              </span>
                                              <span class="text">Detail</span>
                                          </button>
                                          <div class="modal fade" id="detail{{ $item['user_id'] }}" tabindex="-1" role="dialog"
                                              aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                              <div class="modal-dialog  modal-xl">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Detail Setoran {{ $item['user']['name'] }}</h5>
                                                          <button type="button" class="close" data-dismiss="modal"
                                                              aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <table class="table table-bordered" class="dataTable2" width="100%"
                                                              cellspacing="0">
                                                              <thead>
                                                                  <tr>
                                                                      <th>Tanggal</th>
                                                                      <th>Keterangan</th>
                                                                      <th>Jenis</th>
                                                                      <th>Harga Satuan</th>
                                                                      <th>Berat</th>
                                                                      <th>Debit</th>
                                                                      <th>Kredit</th>
                                                                      <th>Saldo</th>
                                                                  </tr>
                                                              </thead>
                                                              <tfoot>
                                                                  <tr>
                                                                      <th>Tanggal</th>
                                                                      <th>Keterangan</th>
                                                                      <th>Jenis</th>
                                                                      <th>Harga Satuan</th>
                                                                      <th>Berat</th>
                                                                      <th>Debit</th>
                                                                      <th>Kredit</th>
                                                                      <th>Saldo</th>
                                                                  </tr>
                                                              </tfoot>
                                                              <tbody>
                                                                  @php
                                                                      \Carbon\Carbon::setLocale('id');
                                                                  @endphp
                                                                  @foreach ($buku as $hal)
                                                                      @if ($hal['user_id'] == $item['user_id'])
                                                                          @php
                                                                              $tanggal = \Carbon\Carbon::parse($hal['tanggal'])->isoFormat('dddd, D MMMM Y');
                                                                              if ($hal['keterangan'] == 'dijemput') {
                                                                                  $harga = $hal['jenis']['harga'] - $hal['jenis']['harga'] * 0.2;
                                                                              } else {
                                                                                  $harga = $hal['jenis']['harga'];
                                                                              }
                                                                          @endphp
                                                                          <tr>
                                                                              <td>{{ $tanggal }}</td>
                                                                              <td>{{ $hal['keterangan'] }}</td>
                                                                              <td>{{ $hal['jenis']['jenis'] }}</td>
                                                                              <td>{{ $harga }}</td>
                                                                              <td>{{ $hal['berat'] }}</td>
                                                                              <td>{{ $hal['debit'] }}</td>
                                                                              <td>{{ $hal['kredit'] }}</td>
                                                                              <td>{{ $hal['saldo'] }}</td>
                                                                          </tr>
                                                                      @endif
                                                                  @endforeach
                                                              </tbody>
                                                          </table>
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
