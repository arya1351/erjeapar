<title>HRD-Dashboard</title>

@extends('layouts.app')
@section('sidebar')
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between mx-auto row">
                <a href="{{ route('hrd.dashboard') }}" class="text-nowrap logo-img justify-content-center mx-auto">
                    <img src="{{ asset('templates') }}/src/assets/images/logos/logoRJ.png" width="180" alt="" />
                </a>
                <a href="{{ route('hrd.dashboard') }}" class="text-center text-black fs-6 fw-bolder">
                    Monitoring Apar
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item {{ Request::is('hrd/dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('hrd.dashboard') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Data Master</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('hrd.dataapar') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-fire-extinguisher"></i>
                            </span>
                            <span class="hide-menu">Mengelola Data Apar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('hrd.datamapping') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-building"></i>
                            </span>
                            <span class="hide-menu">Mapping Apar</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Data Transaction</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('hrd.datapengajuan') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Laporan</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Statistik -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="m-2">{{ $apars }}</h1>
                        <h3 class="m-2">Total Apar</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="m-2">{{ $mappings }}</h1>
                        <h3 class="m-2">Total Gedung</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="m-2">{{ $filelaporans }}</h1>
                        <h3 class="m-2">Laporan Masuk</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dropdown Pilih Gedung -->
        <div class="row mb-3">
            <div class="col">
                <label for="selectGedung" class="form-label">Pilih Gedung:</label>
                <select id="selectGedung" class="form-select">
                    @foreach ($gambargedungs as $key => $gambargedung)
                        <option value="{{ $gambargedung->id }}" {{ $key === 0 ? 'selected' : '' }}>
                            Gedung {{ $gambargedung->nama_gedung }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar Ruangan -->
            <div class="col-3">
                <h5 class="mb-3">Mapping Apar</h5>
                <ul id="ruanganList" class="list-group">
                    @foreach ($gambargedung[0]->gedungs ?? [] as $gedung)
                        <li class="alert bg-primary list-group-item list-group-item-action" id="gedungItem{{ $gedung['id'] }}"
                            onclick="highlightRuangan({{ $gedung->id }})">
                            {{ $gedung->nama_ruangan }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Canvas Gedung -->
            <div class="col-9">
                <div class="border-dark border">
                    <canvas id="canvasGedung" width="1080" height="1080" class="img-fluid"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
    const gambargedungs = @json($gambargedungs);
    const canvas = document.getElementById("canvasGedung");
    const ctx = canvas.getContext("2d");
    let activeRuanganId = null; // Untuk melacak ruangan aktif

    function drawCanvas(gambargedungId) {
        const gedung = gambargedungs.find(item => item.id === gambargedungId);
        if (!gedung) return;

        const image = new Image();
        image.src = `/images/${gedung.image_gedung}`;
        image.onload = function() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(image, 0, 0, canvas.width, canvas.height);

            // Ambil data mapping untuk menggambar ulang ruangan
            fetch(`/hrd/dashboard/${gambargedungId}/mapping`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(mapping => {
                        const width = mapping.width || 50;
                        const height = mapping.height || 50;

                        ctx.beginPath();
                        ctx.rect(
                            mapping.x - width / 2,
                            mapping.y - height / 2,
                            width,
                            height
                        );
                        ctx.fillStyle = mapping.id === activeRuanganId
                            ? 'rgba(0, 150, 0, 0.6)' // Warna merah untuk ruangan aktif
                            : 'rgba(55, 55, 255, 0.5)'; // Warna biru untuk ruangan lainnya
                        ctx.fill();
                        ctx.closePath();

                        // Tambahkan teks nama ruangan
                        ctx.font = '12px Arial';
                        ctx.fillStyle = 'black';
                        ctx.fillText(
                            mapping.nama_ruangan,
                            mapping.x + width / 2 + 5,
                            mapping.y
                        );
                    });
                })
                .catch(error => console.error("Error fetching mapping data:", error));
        };
    }

    function loadRuanganByGedung(gambargedungId) {
        fetch(`/hrd/dashboard/${gambargedungId}/mapping`)
            .then(response => response.json())
            .then(ruangans => {
                const ruanganList = document.getElementById("ruanganList");
                ruanganList.innerHTML = ""; // Clear current list

                ruangans.forEach(ruangan => {
                    const listItem = document.createElement("li");
                    listItem.id = `ruanganItem${ruangan.id}`;
                    listItem.className = "list-group-item list-group-item-action";
                    listItem.textContent = ruangan.nama_ruangan;
                    listItem.onclick = () => highlightRuangan(ruangan.id);
                    if (ruangan.id === activeRuanganId) {
                        listItem.classList.add("bg-danger", "text-white"); // Warna khusus untuk ruangan aktif
                    }
                    ruanganList.appendChild(listItem);
                });
            })
            .catch(error => console.error("Error fetching ruangan data:", error));
    }

    function highlightRuangan(ruanganId) {
        activeRuanganId = ruanganId; // Set ruangan aktif

        // Perbarui tampilan daftar ruangan
        const ruanganItems = document.querySelectorAll("#ruanganList .list-group-item");
        ruanganItems.forEach(item => {
            if (item.id === `ruanganItem${ruanganId}`) {
                item.classList.add("bg-primary", "text-white"); // Warna merah untuk aktif
            } else {
                item.classList.remove("bg-primary", "text-white");
            }
        });

        // Gambar ulang canvas dengan ruangan aktif
        const selectedGedungId = parseInt(document.getElementById("selectGedung").value, 10);
        drawCanvas(selectedGedungId);
    }

    const defaultGedungId = gambargedungs[0]?.id;
    if (defaultGedungId) {
        drawCanvas(defaultGedungId);
        loadRuanganByGedung(defaultGedungId);
    }

    document.getElementById("selectGedung").addEventListener("change", function() {
        const selectedId = parseInt(this.value, 10);
        drawCanvas(selectedId);
        loadRuanganByGedung(selectedId);
    });
});

    </script>
@endsection
