@extends('umat.index')

@section('content-umat')
    <div class="container">
        
        @foreach ($data as $item)
            <div class="card shadow my-3">
                <div class="card-header d-flex">
                    <p class="my-auto">Data Pengajuan Baptis Anak</p>
                    @if ($item->status == 'DITERIMA')
                        <a target="_blank" href="{{ route('baptis-anak-print.umat', $item->id) }}" class="ms-auto btn btn-sm btn-secondary d-flex py-0">
                            <p class="mx-2 my-auto">Cetak Surat Baptis Anak</p><i
                                class="my-auto bi bi-printer-fill ml-auto fs-6"></i>
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row my-1">
                        <div class="col-md-2">Id Jemaat</div>
                        <div class="col-md">: {{ $item->user->id }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Nama</div>
                        <div class="col-md">: {{ $item->user->nama }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Nama Anak</div>
                        <div class="col-md">: {{ $item->nama_anak }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Alamat</div>
                        <div class="col-md">: {{ $item->user->alamat }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Lingkungan</div>
                        <div class="col-md">: {{ $item->lingkungan ?? '-' }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Tanggal</div>
                        <div class="col-md">: {{ \Carbon\Carbon::parse($item->tgl_pelaksanaan)->isoFormat('D MMMM Y') }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Waktu</div>
                        <div class="col-md">: {{ \Carbon\Carbon::parse($item->waktu_pelaksanaan)->format('H:i') }}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Status Pengajuan</div>
                        <div class="col-md fw-bold">: {{ $item->status }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="container mt-5">
            <h2>Formulir Pendaftaran Baptis Anak</h2>
            <h7>*Baptis Anak di Laksanakan Pada Ibadah Hari Minggu</h7>
            <div></div>
            <p></p>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('baptis-anak.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <div class="mb-3">
                    <label for="nama_anak" class="form-label">Nama Anak</label>
                    <input type="text" class="form-control" id="nama_anak" name="nama_anak" required>
                </div>
    
                <div class="mb-3 w-25">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
    
                <div class="mb-3 w-25">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                </div>
                
                <div class="mb-3 w-25">
                    <label for="tgl_pelaksanaan" class="form-label">Tanggal Pelaksanaan baptis</label>
                    <input type="date" class="form-control" id="tgl_pelaksanaan" name="tgl_pelaksanaan" required>
                </div>
                
    
                <div class="mb-3 w-25">
                    <label for="waktu_pelaksanaan" class="form-label">Waktu Pelaksanaan</label>
                    <select name="waktu_pelaksanaan" id="waktu_pelaksanaan" class="form-select">
                        <option value="" selected disabled>Pilih Waktu</option>
                            <option value="06:30">06:30</option>
                            <option value="09:00">09:00</option>
                            <option value="06:30">16:00</option>
                        
                    </select>
                </div>
    
                <div class="mb-3 w-25">
                    <label for="akta_kelahiran" class="form-label">Akta Kelahiran</label>
                    <input type="file" class="form-control" id="akta_kelahiran" name="akta_kelahiran" accept=".pdf"
                        required>
                </div>
    
                <div class="mb-3 w-25">
                    <label for="kartu_keluarga" class="form-label">Kartu Keluarga</label>
                    <input type="file" class="form-control" id="kartu_keluarga" name="kartu_keluarga" accept=".pdf"
                        required>
                </div>
    
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
        
    </div>
@endsection

