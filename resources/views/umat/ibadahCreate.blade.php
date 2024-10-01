@extends('umat.index')

@section('content-umat')
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js'></script>
    <div class="container">
        <div class="px-3">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
                Ajukan Acara Ibadah
            </button>
        </div>

        <!-- Kegiatan Rutin -->
    <section id="kegiatan-rutin">
        <div class="text-center mb-5">
            <h2 class="section-heading text-uppercase">Jadwal Layanan</h2>
            <h3 class="section-subheading text-muted">Jadwal Ibadah Syukur, Baptis Anak, dan Pernikahan.</h3>
        </div>
        <div class="container">
            <div class="card shadow">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <p class="fw-semibold me-1">Acara :</p>
                        <p id="modalAcara"></p>
                    </div>
                    <div class="d-flex">
                        <p class="fw-semibold me-1">Pemilik Acara :</p>
                        <p id="modalNama"></p>
                    </div>
                    <div class="d-flex">
                        <p class="fw-semibold me-1">Alamat :</p>
                        <p id="modalAlamat"></p>
                    </div>
                    <div class="d-flex">
                        <p class="fw-semibold me-1">Tanggal :</p>
                        <p id="modalTanggal"></p>
                    </div>
                    <div class="d-flex">
                        <p class="fw-semibold me-1">Waktu :</p>
                        <p id="modalWaktu"></p>
                    </div>
                    <div class="d-flex">
                        <p class="fw-semibold me-1">Nama Pendeta :</p>
                        <p id="modalPendeta"></p>
                    </div>



                    {{-- <p id="modalWaktu"></p>
                    <p id="modalPendeta"></p> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="closeModal()">Close</button>
                    <!-- Add additional buttons or actions here if needed -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('home/js/scripts.js') }}"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script>
        const namaBulan = {
            0: 'Januari',
            1: 'Februari',
            2: 'Maret',
            3: 'April',
            4: 'Mei',
            5: 'Juni',
            6: 'Juli',
            7: 'Agustus',
            8: 'September',
            9: 'Oktober',
            10: 'November',
            11: 'Desember'
        };
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {

                eventClick: function(info) {
                    console.log(info);
                    if (info.event.url) {
                        alert(
                            'Clicked ' + info.event.title + '.\n' +
                            'Will open ' + info.event.url + ' in a new tab'
                        );
                        window.open(info.event.url);
                        return false; // prevents browser from following link in current tab.
                    } else {
                        $('#modalTitle').text(info.event.extendedProps.acara);
                        $('#modalAcara').text(info.event.extendedProps.acara);
                        $('#modalNama').text(info.event.title);
                        $('#modalAlamat').text(info.event.extendedProps.alamat);
                        $('#modalPendeta').text(info.event.extendedProps.pendeta);
                        $('#modalTanggal').text(info.event.start.toLocaleDateString('id-ID', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        }));
                        var newTime = info.event.extendedProps.time;
                        var timeParts = newTime.split(
                            ':'); // Split time string into components (hours, minutes, seconds)
                        var formattedTime = timeParts[0] + ':' + timeParts[
                            1]; // Concatenate hours and minutes only
                        $('#modalWaktu').text(formattedTime + ' WIB - Selesai');
                        $('#myModal').modal('show');
                    }
                },
                initialView: 'dayGridMonth',
                events: [
                    @foreach ($data as $event)
                        {
                            title: `
                                        @if ($event->acara === 'Pernikahan')
                                            {{ $event->userLaki->nama }} & {{ $event->userPerempuan->nama }}
                                        @else
                                            {{ $event->user->gender == 'P' ? 'Ibu ' : 'Bpk ' }} {{ $event->user->nama }}
                                        @endif
                                    `,
                            start: '{{ $event->tanggal }}',
                            extendedProps: {
                                acara: '{{ $event->acara }}',
                                nama: @if ($event->acara === 'Pernikahan')
                                    '{{ $event->userLaki->nama }} & {{ $event->userPerempuan->nama }}'
                                @else
                                    '{{ $event->user->nama }}'
                                @endif ,
                                alamat: @if ($event->acara === 'Pernikahan')
                                    'Gereja Evangelis'
                                @else
                                    '{{ $event->user->alamat }}'
                                @endif ,
                                lingkungan: @if ($event->acara === 'Pernikahan')
                                    '{{ $event->userLaki->lingkungan->nama ?? ' - ' }}'
                                @else
                                    '{{ $event->user->lingkungan->nama ?? ' - ' }}'
                                @endif ,
                                pendeta: `{{ $event->pendeta->nama ?? 'Belum Ditentukan' }}`,
                                time: '{{ $event->waktu }}'
                            },
                            backgroundColor: 
                            @if ($event->acara === 'Baptis Anak')
                                '#36BA98' /* Light Pink */
                            @elseif ($event->acara === 'Ibadah Syukur')
                                '#3FA2F6' /* Light Blue */
                            @elseif ($event->acara === 'Pernikahan')
                                '#FF4191' /* Pale Green */
                            @else
                                '#D3D3D3' /* Light Grey */ ,
                            @endif
                        },
                    @endforeach
                ],

                selectOverlap: function(event) {
                    return event.rendering === 'background';
                },
                titleFormat: function(info) {
                    return namaBulan[info.date.month] + ' ' + info.date.year;
                },


            });
            // console

            calendar.render();
        });


        function closeModal() {
            $('#myModal').removeClass('modal-open show');
            $('#myModal').modal('hide');

        }
    </script>

     <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/get-jadwal')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.users.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Kosong',
                            text: 'Tidak ada data yang ditemukan.',
                        });
                    } else {
                        // Tampilkan data pengguna ke dalam console atau logika lainnya
                        console.log("User ID:", data.users[0].id);
                        console.log("User Name:", data.users[0].name);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengambil data.',
                    });
                });
        });
    </script> 

        @foreach ($dataIbadah as $item)
            <div class="card shadow m-3">
                <div class="card-header d-flex">
                    <p class="my-auto">Data Pendaftaran Ibadah Syukur</p>
                    @if ($item->status == 'DITERIMA')
                        <a target="_blank" href="{{ route('ibadah-print.umat', $item->id) }}"
                            class="ms-auto btn btn-sm btn-secondary d-flex py-0">
                            <p class="mx-2 my-auto">Cetak Surat Hasil Validasi</p><i
                                class="my-auto bi bi-printer-fill ml-auto fs-6"></i>
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex">
                                <p class="fw-semibold me-1">Acara :</p>
                                <p>Ibadah Syukur</p>
                            </div>
                            <div class="d-flex">
                                <p class="fw-semibold me-1">Pemilik Acara :</p>
                                <p>{{ $item->user->nama }}</p>
                            </div>
                            <div class="d-flex">
                                <p class="fw-semibold me-1">Alamat :</p>
                                <p>{{ $item->user->alamat }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <p class="fw-semibold me-1">Tanggal :</p>
                                <p>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}</p>
                            </div>
                            <div class="d-flex">
                                <p class="fw-semibold me-1">Waktu :</p>
                                <p>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</p>
                            </div>
                            <div class="d-flex">
                                <p class="fw-semibold me-1">Nama Pendeta :</p>
                                <p>{{ $item->pendeta->nama }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex">
                                <p class="fw-semibold me-1">Keterangan :</p>
                                <p>{{ $item->keterangan ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    Status: {{ $item->status }}
                </div>
            </div>
        @endforeach



        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Form Pengajuan Acara Ibadah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col">
                            <form action="{{ route('ibadah-syukur.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="acara" class="form-label">Acara</label>
                                    <input type="text" disabled class="form-control" id="acara" name="acara"
                                        value="Ibadah Syukur">
                                </div>
                                <div class="mb-3">
                                    <label for="pemilik_acara" class="form-label">Pemilik Acara</label>
                                    <input type="text" disabled class="form-control" id="pemilik_acara"
                                        name="pemilik_acara" value="{{ auth()->user()->nama }}">
                                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" disabled class="form-control" id="alamat" name="alamat"
                                        value="{{ auth()->user()->alamat }}">
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3 ">
                                            <label for="tanggal" class="form-label">Tanggal</label>
                                            <div id="sandbox-container">
                                                <input id="tanggal" type="date" class="form-control" name="tanggal" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3 ">
                                            <label for="waktu" class="form-label">Waktu</label>
                                            <input type="time" class="form-control" id="waktu" name="waktu" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="id_pendeta" class="form-label">Pendeta</label>
                                    <select name="id_pendeta" id="id_pendeta" class="form-select">
                                        <option value="" selected disabled>Pilih Pendeta</option>
                                        @foreach ($listPendeta as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                        <div class="col">
                            <p>Jadwal Pendeta Berhalangan</p>
                            <div class="px-3 overflow-auto" style="height: 350px">
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
                                                        data-bs-target="#collapse-{{ $k1 }}"
                                                        aria-expanded="false"
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
                                                        <td>{{ isset($value['keterangan']) ? $value['keterangan'] : ' - ' }}
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        thead th { position: sticky; top: 0; }
    </style>
@endsection

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        var todayDate = new Date();
        var maxDate = new Date();
        maxDate.setDate(todayDate.getDate() + 2);
        var datesForDisable = ["2024-07-2", "2024-07-10", "2024-07-20"];

        function disableSpecificDates(date) {
            var string = $.datepicker.formatDate('yy-mm-dd', date);
            return [datesForDisable.indexOf(string) == -1];
        }

        $("#tanggal").datepicker({
            dateFormat: 'yy-mm-dd',
            autoclose: true,
            beforeShowDay: function(date) {
                // var today = new Date();
                // var afterTwoDays = new Date();
                // afterTwoDays.setDate(today.getDate() + 2);
                // var isWithinRange = date >= today && date <= afterTwoDays;
                return [disableSpecificDates(date)[0], ''];
            }
        });
    });
</script>

