@extends('layouts.owner-app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

 <!-- Content -->
<div class="app-content">
    <div class="container-fluid">

        <!-- Card Dashboard owner -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-4">

                        <div class="row align-items-center">

                            <!-- Icon -->
                            <div class="col-md-2 text-center mb-3 mb-md-0">
                                <i class="bi bi-person-circle text-primary" style="font-size: 6rem;"></i>
                            </div>

                            <!-- Informasi User -->
                            <div class="col-md-5">
                                <h3 class="fw-bold mb-2">Dashboard owner</h3>
                                <p class="fs-5 text-muted mb-0">
                                    Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>!  
                                    Anda login sebagai <span class="text-success fw-semibold">owner</span>.
                                </p>
                                <p class="mt-2 text-primary fw-semibold" id="tanggal-jam"></p>

                                <!-- Tombol -->
                                <div class="d-flex gap-2 mt-3 flex-wrap">
                                    <a href="{{ route('owner.dashboard') }}" class="btn btn-primary px-4">
                                        <i class="bi bi-person-lines-fill me-2"></i> Lihat Profil
                                    </a>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger px-4">
                                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Kalender -->
                            <div class="col-md-5 mt-4 mt-md-0">
                                <div class="card shadow-sm border-0 rounded-3">
                                    <div class="card-header bg-primary text-white text-center fw-bold">
                                        Kalender
                                    </div>
                                    <div class="card-body">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- .row -->

                    </div>
                </div>
            </div>
        </div>

<style>
    #calendar {
        width: 100%;
    }
    .calendar-table {
        width: 100%;
        text-align: center;
    }
    .calendar-table th {
        padding: 8px;
        font-weight: bold;
    }
    .calendar-table td {
        padding: 10px;
        cursor: pointer;
    }
    .calendar-today {
    background-color: #ffc107; 
    color: black;
    border-radius: 50%;
    font-weight: bold;
}


</style>

<script>
    function generateCalendar() {
        const calendar = document.getElementById("calendar");
        const date = new Date();
        const month = date.toLocaleString("id-ID", { month: "long" });
        const year = date.getFullYear();

        const firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
        const daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
        const today = date.getDate();

        let calendarHTML = `
            <h4 class="text-center fw-bold mb-3">${month} ${year}</h4>
            <table class="calendar-table table table-bordered">
                <thead>
                    <tr>
                        <th>Min</th><th>Sen</th><th>Sel</th><th>Rab</th>
                        <th>Kam</th><th>Jum</th><th>Sab</th>
                    </tr>
                </thead>
                <tbody>
        `;

        let day = 1;
        for (let i = 0; i < 6; i++) {
            calendarHTML += "<tr>";
            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < firstDay) {
                    calendarHTML += "<td></td>";
                } else if (day > daysInMonth) {
                    calendarHTML += "<td></td>";
                } else {
                    if (day === today) {
                        calendarHTML += `<td class="calendar-today">${day}</td>`;
                    } else {
                        calendarHTML += `<td>${day}</td>`;
                    }
                    day++;
                }
            }
            calendarHTML += "</tr>";
        }

        calendarHTML += "</tbody></table>";
        calendar.innerHTML = calendarHTML;
    }

    generateCalendar();
</script>




</main>
<script>
    function updateDateTime() {
        const now = new Date();

        // Format tanggal Indonesia
        const optionsTanggal = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const tanggal = now.toLocaleDateString('id-ID', optionsTanggal);

        // Format jam:menit:detik
        const jam = now.toLocaleTimeString('id-ID', { hour12: false });

        document.getElementById('tanggal-jam').textContent = `${tanggal} | ${jam}`;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>
@endsection
