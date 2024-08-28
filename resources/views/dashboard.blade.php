<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Waktu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Filter Pegawai -->
                    <div class="mb-4" id="search-section">
                        <div class="d-flex align-items-center">
                            <select class="form-control me-2" id="pegawaiDropdown">
                                <option value="">Pilih Pegawai</option>
                                @foreach($pegawai as $item)
                                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" id="searchButton">Cari</button>
                        </div>
                    </div>
                    
                    <!-- Kalender -->
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Event Modal -->
    <div class="modal fade" id="eventDetailModal" tabindex="-1" aria-labelledby="eventDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventDetailModalLabel">Detail Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Tamu:</strong> <span id="eventDetailTitle"></span></p>
                    <p><strong>Deskripsi:</strong> <span id="eventDetailDescription"></span></p>
                    <p><strong>Mulai:</strong> <span id="eventDetailStart"></span></p>
                    <p><strong>Pegawai yang dituju:</strong> <span id="eventDetailPegawai"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar and Bootstrap CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <style>
        /* Mengatur ukuran keseluruhan kalender */
        #calendar {
            max-width: 50%;
            margin: 0 auto;
        }

        /* Mengurangi ukuran bagian pencarian agar sesuai dengan kalender */
        #search-section {
            max-width: 50%;
            margin: 0 auto;
        }

        .fc-view-container {
            font-size: 12px; /* Mengurangi ukuran font di dalam kalender */
        }

        .fc-toolbar h2 {
            font-size: 14px; /* Mengurangi ukuran judul kalender */
        }

        .fc-toolbar button {
            font-size: 12px; /* Mengurangi ukuran tombol navigasi */
        }

        .fc-day-header {
            padding: 5px 0; /* Mengurangi padding pada header hari */
        }

        .fc-day-grid .fc-row {
            height: auto; /* Mengatur tinggi baris kalender secara otomatis */
        }

        .fc-event {
            font-size: 10px; /* Mengurangi ukuran font pada event */
            padding: 2px; /* Mengurangi padding event */
        }

        /* Mengubah ukuran tampilan hari dan tanggal */
        .fc-day-grid .fc-day-number {
            font-size: 10px;
            padding: 2px;
        }

        .fc-view .fc-day-grid-event .fc-content {
            white-space: nowrap; /* Agar event tetap dalam satu baris */
        }

        /* Mengatur tinggi agar semua hari terlihat tanpa scroll */
        .fc-day-grid-container {
            max-height: none; /* Menghilangkan batasan tinggi */
            overflow: visible; /* Menghilangkan overflow */
        }
    </style>

    <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function loadPegawai() {
            $.get('/pegawai', function(data) {
                var options = '<option value="">Pilih Pegawai</option>';
                data.forEach(function(pegawai) {
                    options += '<option value="' + pegawai.id + '">' + pegawai.nama + '</option>';
                });
                $('#pegawaiDropdown').html(options);
            });
        }

        loadPegawai();

        function loadEvents(pegawaiId = '') {
            $('#calendar').fullCalendar('removeEvents');

            $.get('/events', { pegawai_id: pegawaiId }, function(events) {
                if (events.length === 0) {
                    $('#calendar').fullCalendar('addEventSource', []);
                    alert('Maaf, jadwal untuk pegawai ini tidak ditemukan.');
                } else {
                    $('#calendar').fullCalendar('addEventSource', events);
                }
            });
        }

        loadEvents();

        $('#pegawaiDropdown').on('change', function() {
            var pegawaiId = $(this).val();
            loadEvents(pegawaiId);
        });

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            defaultView: 'month',
            editable: true,
            eventLimit: true,

            eventClick: function(event) {
                $('#eventDetailTitle').text(event.title);
                $('#eventDetailDescription').text(event.description);
                $('#eventDetailStart').text(event.start.format('YYYY-MM-DD HH:mm'));
                $('#eventDetailEnd').text(event.end ? event.end.format('YYYY-MM-DD HH:mm') : 'Tidak Diketahui');
                $('#eventDetailPegawai').text(event.pegawai || 'Tidak Diketahui');
                $('#eventDetailModal').modal('show');
            }
        });
    });
    </script>
</x-app-layout>
