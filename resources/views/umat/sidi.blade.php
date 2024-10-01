@extends('umat.index')

@section('content-umat')
    <div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <div class="card shadow">
            @if ($sidi)
                <div class="card-header d-flex">
                    <p class="my-auto">Data Anggota Sidi / Katekisasi</p>
                    @if ($data->status == 'DITERIMA')
                        <a target="_blank" href="{{ route('sidi-print.umat') }}"
                            class="ms-auto btn btn-sm btn-secondary d-flex py-0">
                            <p class="mx-2 my-auto">Cetak Surat Keanggotaan</p><i
                                class="my-auto bi bi-printer-fill ml-auto fs-6"></i>
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row my-1">
                        <div class="col-md-2">Id Jemaat</div>
                        <div class="col-md">: {{ $data->user->id }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Id Sidi</div>
                        <div class="col-md">: {{ $data->id }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Nama</div>
                        <div class="col-md">: {{ $data->user->nama }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Alamat</div>
                        <div class="col-md">: {{ $data->user->alamat }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Lingkungan</div>
                        <div class="col-md">: {{ $data->lingkungan }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Status Pengajuan</div>
                        <div class="col-md fw-bold">: {{ $data->status }}</div>
                    </div>
                </div>
            @else
                <div class="card-header d-flex">
                    <p class="my-auto">Data Anggota Sidi / Katekisasi</p>
                </div>
                <div class="card-body text-center">
                    <form method="POST" action="{{ route('sidi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <p class="my-1">Anda Belum Terdaftar Sebagai Anggota Sidi / Katekisasi</p>
                        <p class="fw-light mt-0">*Silahkan Upload Surat Baptis Berupa PDF untuk Mengikuti Katekisasi</p>
                        <p class="fw-light mt-0">*Jikalau Sudah Mengikuti Sidi/Katekisasi, Silahkan Upload Surat Sidi Berupa PDF</p>
                        <input type="file" name="surat_baptis" id="" accept="application/pdf" required>

                        <div class="d-flex justify-content-end pe-0 me-0">
                            <button class="btn btn-primary btn-sm w-auto px-3 tw-bg-[#007bff]"
                                type="submit">Kirim</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
