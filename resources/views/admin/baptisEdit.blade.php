@extends('admin.index')

@section('content-admin')
    <div class="container">
        <div class="card">
            <div class="card-header">Validasi Baptis Anak</div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('baptis-anak.update', $data->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group my-2">
                        <label for="inputID">Id</label>
                        <input disabled type="text" class="form-control" id="inputID" disabled
                            value="{{ $data->id }}">
                    </div>
                    <div class="form-group my-2">
                        <label for="inputID">Id Orang Tua</label>
                        <input disabled type="text" class="form-control" id="inputID" disabled
                            value="{{ $data->user->id }}">
                    </div>
                    <div class="form-group my-2">
                        <label for="inputNama">Nama Orang Tua</label>
                        <input disabled type="text" class="form-control" id="inputNama" name="nama"
                            value="{{ $data->user->nama }}">
                    </div>
                    <div class="form-group my-2">
                        <label for="inputNama">Nama Anak</label>
                        <input disabled type="text" class="form-control" id="inputNama" name="nama"
                            value="{{ $data->nama_anak }}">
                    </div>
                    <div class="form-group my-2">
                        <label for="gender">Gender</label>
                        <div class="form-check">
                            <input disabled class="form-check-input" type="radio" name="gender" id="genderMale"
                                value="L" {{ $data->gender == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label" for="genderMale">
                                Laki - laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input disabled class="form-check-input" type="radio" name="gender" id="genderFemale"
                                value="P" {{ $data->gender == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="genderFemale">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="inputtglLahir">Tanggal Lahir</label>
                        <input disabled type="text" class="form-control" id="inputtglLahir" name="tglLahir"
                            value="{{ \Carbon\Carbon::parse($data->tgl_lahir)->isoFormat('D MMMM Y') }}">
                    </div>
                    <div class="form-group my-2">
                        <label for="inputtglPelaksanaan">Tanggal Pelaksanaan</label>
                        <input disabled type="text" class="form-control" id="inputtglPelaksanaan" name="tgl_pelaksanaan"
                            value="{{ \Carbon\Carbon::parse($data->tgl_pelaksanaan)->isoFormat('D MMMM Y') }}">
                    </div>
                    <div class="form-group my-2">
                        <label for="inputtglPelaksanaan">Waktu Pelaksanaan</label>
                        <input disabled type="text" class="form-control" id="inputtglPelaksanaan"
                            name="waktu_pelaksanaan"
                            value="{{ \Carbon\Carbon::parse($data->waktu_pelaksanaan)->format('H:i') }}">
                    </div>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 d-flex">
                                <div class="col-lg-6"><div class="form-group mb-3">
                                    <label for="previewPdf"> Kartu Keluarga</label>
                                    <div class="mb-3 p-2 border border-2 d-flex justify-content-center">
                                        <embed id="previewPdf"
                                            src="{{ Storage::url($data->kartu_keluarga) }}"
                                            style="width:600px; height:500px;" frameborder="0">
                                    </div>
                                </div></div>
                                <div class="col-lg-6"><div class="form-group mb-3">
                                    <label for="previewPdf"> Akta Kelahiran</label>
                                    <div class="mb-3 p-2 border border-2 d-flex justify-content-center">
                                        <embed id="previewPdf"
                                            src="{{ Storage::url( $data->akta_kelahiran) }}"
                                            style="width:600px; height:500px;" frameborder="0">
                                    </div>
                                </div></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group my-2">
                    
                        <div class="form-group my-2">
                            <label for="inputRole">Status Baptis Anak</label>
                            <select class="form-select" aria-label="Default select example" name="status"
                                id="inputRole">
                                <option value="null" disabled>Pilih Status Pengajuan Bapts Anak
                                </option>
                                <option value="PROSES" {{ $data->status == 'PROSES' ? 'selected' : '' }}>PROSES
                                </option>
                                <option value="DITERIMA" {{ $data->status == 'DITERIMA' ? 'selected' : '' }}>DITERIMA
                                </option>
                                <option value="DITOLAK" {{ $data->status == 'DITOLAK' ? 'selected' : '' }}>DITOLAK
                                </option>
                            </select>
                        </div>




                        <div class="d-flex justify-content-end pe-0 me-0">
                            <a href="{{ route('sidi.index') }}" class="btn btn-secondary btn-sm w-auto px-3 me-2"
                                role="button">Kembali</a>
                            <a class="btn btn-danger btn-sm w-auto px-3 me-2" data-bs-toggle="modal" href="#exampleModal"
                                role="button">Hapus</a>
                            <button class="btn btn-primary btn-sm w-auto px-3 tw-bg-[#007bff]"
                                type="submit">Simpan</button>
                        </div>
                </form>
            </div>
        </div>

        {{-- modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header tw-justify-between">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
                        <button type="button" class="btn-close btn-sm tw-text-black" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm tw-bg-[#6c757d]"
                            data-bs-dismiss="modal">Close</button>
                        <form method="POST" action="{{ route('baptis-anak.destroy', $data->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm tw-bg-[#dc3545]">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- tutup modal --}}
    </div>
@endsection
