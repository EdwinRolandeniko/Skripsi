@extends('umat.index')
@section('content-umat')
    <div class="container">
        <div class="alert alert-warning shadow text-center ">
            <h1 class="h3 fw-bold">Dashboard Umat</h1>
        </div>
        <div class="card shadow">
            <!-- <div class="card-header">
                                Data Pengajuan Ibadah
                              </div> -->
            <div class="card-body ">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="alert alert-sm alert-secondary my-auto py-auto">
                            <h1 class="h5 fw-bold my-auto">Jumlah Data Pengajuan Ibadah Syukur</h1>
                        </div>
                        <div class="row d-flex">
                            <div class="col-sm m-3 text-end card bg-warning text-white p-3">
                                <p class="card-title h5 fw-bold ">Proses</p>
                                <hr>
                                <p class="my-3 h4">{{ $ibadah->proses ?? 0 }}</p>
                            </div>
                            <div class="col-sm m-3 text-end card bg-danger text-white p-3">
                                <p class="card-title h5 fw-bold ">Ditolak</p>
                                <hr>
                                <p class="my-3 h4">{{ $ibadah->ditolak ?? 0 }}</p>
                            </div>
                            <div class="col-sm m-3 text-end card bg-success text-white p-3">
                                <p class="card-title h5 fw-bold ">Disetujui</p>
                                <hr>
                                <p class="my-3 h4">{{ $ibadah->diterima ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="alert alert-sm alert-secondary my-auto py-auto ">
                            <h1 class="h5 fw-bold my-auto">Status Sidi</h1>
                        </div>
                        <div class="card mt-3 text-end card text-white p-3" style="background-color: #0d6efd">
                            <p class="card-title h5 fw-bold ">Status Verfikasi Sidi</p>
                            <hr>
                            @forelse($sidi as $data)
                            @if($data->status == 'DITERIMA')
                            <p class="my-3 h5">Sudah Sidi <i class=" ms-3 bi bi-check-circle-fill"></i></p>
                            <p class="my-3 h5">Diterima Pada Tanggal {{\Carbon\Carbon::parse($data->user->updated_at)->isoFormat('D MMMM Y')}}</p>
                            @elseif ($data->status == 'PROSES' || $data->status == 'DITOLAK')
                            <p class="my-3 h5">Belum Sidi <i class="ms-3 bi bi-x-circle-fill"></i></p>
                            @endif
                            @empty
                            <p class="my-3 h5">Belum Sidi <i class="ms-3 bi bi-x-circle-fill"></i></p>
                            @endforelse
                        </div>
                    </div>
                </div>
               
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        <div class="alert alert-sm alert-secondary my-auto py-auto">
                            <h1 class="h5 fw-bold my-auto">Jumlah Data Pengajuan Baptis Anak</h1>
                        </div>
                        <div class="row d-flex">
                            <div class="col-sm m-3 text-end card bg-warning text-white p-3">
                                <p class="card-title h5 fw-bold ">Proses</p>
                                <hr>
                                <p class="my-3 h4">{{ $baptis->proses ?? 0 }}</p>
                            </div>
                            <div class="col-sm m-3 text-end card bg-danger text-white p-3">
                                <p class="card-title h5 fw-bold ">Ditolak</p>
                                <hr>
                                <p class="my-3 h4">{{ $baptis->ditolak ?? 0 }}</p>
                            </div>
                            <div class="col-sm m-3 text-end card bg-success text-white p-3">
                                <p class="card-title h5 fw-bold ">Disetujui</p>
                                <hr>
                                <p class="my-3 h4">{{ $baptis->diterima ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="alert alert-sm alert-secondary my-auto py-auto ">
                            <h1 class="h5 fw-bold my-auto">Status Pernikahan</h1>
                        </div>
                        <div class="card mt-3 text-end card text-white p-3" style="background-color: #0d6efd">
                            <p class="card-title h5 fw-bold ">Status Verfikasi Pernikahan</p>
                            <hr>
                            @if($pernikahan)
                            <p class="my-3 h5">Menikah <i class=" ms-3 bi bi-check-circle-fill"></i></p>
                            @else
                            <p class="my-3 h5">Belum Menikah <i class="ms-3 bi bi-x-circle-fill"></i></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
