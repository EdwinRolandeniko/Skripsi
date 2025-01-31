@extends('admin.index')

@section('content-admin')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">Validasi Pernikahan</div>

            <div class="card-body">
                <form method="POST" action="{{ route('pernikahan.update', $data->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="row mb-3">
                        <div class="col">
                            <div class="alert alert-success alert-sm" role="alert">
                                Data mempelai Laki - laki
                            </div>
                            <div class="form-group mb-3">
                                <label for="idLaki">Id user</label>
                                <input type="text" disabled class="form-control" id="idLaki" name="nama"
                                    value="{{ $data->id_user_laki }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="idLaki">Nama</label>
                                <input type="text" disabled class="form-control" id="idLaki" name="nama"
                                    value="{{ $data->userLaki->nama }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="idLaki">Lingkungan</label>
                                <input type="text" disabled class="form-control" id="idLaki" name="nama"
                                    value="{{ $data->userLaki->lingkungan->nama }}">
                            </div>
                            <div class="form-group my-2">
                                <label for="idLaki">Tanggal Pelaksanaan :</label>
                                <input type="text" disabled class="form-control" id="idLaki" name="tangga_pelaksanaan"
                                    value="{{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('D MMMM Y') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="idLaki">KTP</label>
                                <div class="p-3 border">
                                    <embed id="previewPdf" src="{{ Storage::url($data->ktp_laki) }}"
                                        style="width:100%; height:400px;" frameborder="0">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert alert-success alert-sm" role="alert">
                                Data mempelai Perempuan
                            </div>
                            <div class="form-group mb-3">
                                <label for="idLaki">Id user</label>
                                <input type="text" disabled class="form-control" id="idLaki" name="nama"
                                    value="{{ $data->id_user_perempuan }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="idLaki">Nama</label>
                                <input type="text" disabled class="form-control" id="idLaki" name="nama"
                                    value="{{ $data->userPerempuan->nama }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="idLaki">Lingkungan</label>
                                <input type="text" disabled class="form-control" id="idLaki" name="nama"
                                    value="{{ $data->userPerempuan->lingkungan->nama }}">
                            </div>
                            <div class="form-group my-2">
                                <label for="idLaki">Waktu Pelaksanaan :</label>
                                <input type="text" disabled class="form-control" id="idLaki" name="waktu_pelaksanaan"
                                 value="{{ \Carbon\Carbon::parse($data->waktu)->format('H:i') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="idLaki">KTP</label>
                                <div class="p-3 border">
                                    <embed id="previewPdf" src="{{ Storage::url($data->ktp_perempuan) }}"
                                        style="width:100%; height:400px;" frameborder="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputRole">Pendeta </label>
                        <select class="form-select" aria-label="Default select example" name="id_pendeta" id="inputRole">
                            <option value="null" {{ $data->id_pendeta == 'null' ? 'selected' : '' }}>Pilih Pendeta
                                Pernikahan
                            </option>
                            @foreach ($pendeta as $item)
                                <option value="{{ $item->id }}"
                                    {{ $data->id_pendeta == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row px-3 my-3">
                        <div class="p-3 overflow-auto border rounded shadow-sm" style="height: 350px">
                            <p class="fs-5">Jadwal Pendeta Berhalangan</p>
                            @if (count($jadwalHalangan) > 0)
                                <table class="table">
                                    <thead>
                                        <tr class="table-light">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalHalangan as $k1 => $item)
                                            <tr class="table-light">
                                                <td colspan="5" class="fw-bold" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $k1 }}" aria-expanded="false"
                                                    aria-controls="collapse-{{ $k1 }}" role="button">
                                                    {{ $k1 }}
                                                </td>
                                            </tr>
                                            @php $index = 1; @endphp
                                            @foreach ($item as $value)
                                                <tr>
                                                    <td>{{ $index }}</td>
                                                    <td>{{ $k1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($value['tanggal'])->isoFormat('D MMMM Y') }}</td>
                                                    <td>{{ !empty($value['keterangan']) ? $value['keterangan'] : ' - ' }}
                                                    </td>
                                                </tr>
                                                @php $index++; @endphp
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">Tidak ada jadwal ibadah syukur</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputRole">Status Pengajuan Pernikahan</label>
                        <select class="form-select" aria-label="Default select example" name="status" id="inputRole">
                            <option value="null" disabled>Status Pengajuan Pernikahan
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
                        <button class="btn btn-primary btn-sm w-auto px-3 tw-bg-[#007bff]" type="submit">Simpan</button>
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
                        <form method="POST" action="{{ route('pernikahan.destroy', $data->id) }}">
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

    <style>
        thead th {
            position: sticky;
            top: 0;
        }
    </style>
@endsection
