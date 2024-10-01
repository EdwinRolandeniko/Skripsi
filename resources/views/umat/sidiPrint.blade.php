@extends('layouts.app')

@section('content')
    <div class="bg-white position-fixed top-0 start-0 w-100 h-100 p-3">
        <div class=" w-100 row d-flex mb-2 border-bottom border-dark" id="kop">
            <div class="col-3 float-end d-inline">
                <img src="{{ asset('home/assets/images/logo.png') }}" class="m-auto" alt="" width="125">
            </div>
            <div class="col-9 d-inline">
                <div class="text-start">
                    <p class="fs-5 fw-bold mb-1">Gereja Evangelis Kalimantan</p>
                    <p class=" mb-1"><span class="fw-semibold me-2">Alamat</span>: Jl. S. Parman No.88, Selat Hilir, Kec. Selat, Kabupaten Kapuas, Kalimantan Tengah 73516</p>
                </div>
            </div>
        </div>
        <div class="w-100 px-4 mb-2" id="body">
            <p class="text-center fw-bold fs-5"> Bukti Surat Keanggotaan Sidi / Katekisasi</p>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="fw-bold">Id Jemaat</th>
                        <td>: {{ $data->user->id }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold border-top">Id Sidi</th>
                        <td class="border-top">: {{ $data->id }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold border-top">Nama</th>
                        <td class="border-top">: {{ $data->user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold border-top">Alamat</th>
                        <td class="border-top">: {{ $data->user->alamat }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold border-top">Lingkungan</th>
                        <td class="border-top">: {{ $data->lingkungan }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold border-top">Status Pengajuan</th>
                        <td class="border-top fw-semibold">: {{ $data->status }}</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="w-full">
                <div>
                    <p><span class="fw-semibold">*Catatan</span> </p>
                </div>
            </div>
            <div class="w-100">
                <div class="w-auto float-end text-end">
                    <p>
                        <span class="fw-semibold">Kuala Kapuas,</span>
                        {{ \Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}
                    </p>
                    <img src="{{ asset('home/assets/images/signature.png') }}" width="125" alt=""
                        class="d-block ms-auto me-4">
                    <p class="fw-semibold">Pengurus Gereja Evangelis Kalimantan</p>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to trigger print when document is ready
            function printA4Potrait() {
                window.print(); // Trigger print dialog
            }

            printA4Potrait(); // Call the print function when document is ready
        });
    </script>
@endpush
