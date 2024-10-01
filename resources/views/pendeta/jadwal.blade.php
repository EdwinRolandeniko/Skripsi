@extends('pendeta.index')
@section('content-pendeta')
    <div class="container">
        <div class="alert alert-warning shadow text-center ">
            <h1 class="h3 fw-bold">Dashboard 
                                    {{ Auth::user()->nama }}
                                </h1>
        </div>
        <div class="card mb-5 shadow">
            <div class="card-header">
                Jadwal Bertugas Acara Ibadah Syukur
            </div>
            <div class="card-body">
                @if (count($ibadah) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Lingkungan</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ibadah as $item)
                                <tr>
                                    <th scope="row">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}</th>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</td>
                                    <td> 
                                        @if ($item->user->gender == 'L')                                 
                                        Bpk {{ $item->user->nama }}
                                        @elseif ($item->user->gender == 'P')
                                        Ibu {{ $item->user->nama }}
                                        @endif
                                    </td>
                                    <td>{{ $item->user->lingkungan->nama }}</td>
                                    <td>{{ $item->user->alamat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">Tidak Ada Jadwal Bertugas Acara Ibadah Syukur</p>
                @endif
            </div>
        </div>
        <div class="card my-5 shadow">
            <div class="card-header">
                Jadwal Bertugas Acara Pernikahan
            </div>
            <div class="card-body">
                @if (count($pernikahan) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Pasangan</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pernikahan as $item)
                                <tr>
                                    <th scope="row">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y')}}</th>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</td>
                                    <td>{{ $item->userLaki->nama }} & {{ $item->userPerempuan->nama }}</td>
                                    <td>Gereja Kalimantan Evangelis Sinta Kuala Kapuas</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">Tidak Ada Jadwal Bertugas Acara Pernikahan</p>
                @endif
            </div>
        </div>
    </div>
@endsection
