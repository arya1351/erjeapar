<title>Pelaksana-Data Gedung</title>
<style>
    img #preview {
        width: 75%;
        height: 75%;
    }
</style>
@extends('layouts.app')
@section('sidebar')
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between mx-auto">
                <div class="row py-4">
                    <a href="{{ route('pelaksana.dashboard') }}" class="text-nowrap logo-img justify-content-center mx-auto">
                        <img src="{{ asset('templates') }}/src/assets/images/logos/logoRJ.png" width="180" alt="" />
                    </a>
                    <a href="{{ route('pelaksana.dashboard') }}" class="fs-6 fw-bolder text-center text-black">
                        Monitoring Apar
                    </a>
                </div>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu fst-italic">Home</span>
                    </li>
                    <li class="sidebar-item {{ Request::is('pelaksana/dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('pelaksana.dashboard') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu fst-italic">Data Master</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pelaksana.dataapar') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-fire-extinguisher"></i>
                            </span>
                            <span class="hide-menu">Mengelola Data Apar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pelaksana.datamapping') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-building"></i>
                            </span>
                            <span class="hide-menu">Mapping Apar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pelaksana.datalaporan') }}" aria-expanded="false">
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
    <!--  Row 1 -->
    <div class="row">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Data Layout Gedung</h5>
                    <div class="d-flex justify-content-end">
                        <a type="button" href="{{ route('pelaksana.tambahlayoutgedung') }}"
                            class="btn btn-primary justify-content-end m-1">Tambah Layout Gedung</a>
                    </div>
                    <div class="table-responsive">
                        <table class="text-nowrap mb-0 table align-middle">
                            <thead class="text-dark fs-4">
                                <tr class="border-bottom">
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Urut</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold d-flex align-items-baseline justify-content-start mb-0">
                                            Gambar Gedung</h6>
                                    </th>
                                    <th class="border-bottom-0 d-flex align-items-baseline justify-content-end">
                                        <h6 class="fw-semibold mb-0">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                            ?>
                            <tbody>
                                @foreach ($gambargedungs as $gambargedung)
                                    <tr class="border-bottom">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-Bold mb-0 text-center">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"><img
                                                    src="{{ asset('images/' . $gambargedung->image_gedung) }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modaldetail{{ $gambargedung->id }}" width="500"
                                                    class="border-3 border border-black"></h6>
                                        </td>
                                        <td class="border-bottom-0 position-relative d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modaldetail{{ $gambargedung->id }}">
                                                Detail
                                            </button>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-Danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $gambargedung->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal detail -->
                                    <div class="modal fade" id="modaldetail{{ $gambargedung->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Layout Gedung
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="d-flex justify-content-between mx-4 py-4">
                                                            <h1 class="mx-4">Daftar Mapping</h1>
                                                            <a href="{{ route('pelaksana.tambahmapping', $gambargedung->id) }}"
                                                                class="btn btn-success my-auto">Tambah, Edit & Hapus
                                                                Mapping</a>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <ul>
                                                                    @forelse ($gambargedung->gedungs as $gedung)
                                                                        <a href="#" class="text-center text-white"
                                                                            onclick="selectGedung({{ $gedung['id'] }})">

                                                                            <li id="gedungItem{{ $gedung['id'] }}"
                                                                                class="alert d-flex align-items-center justify-content-between mx-4 border text-black">
                                                                                {{ $gedung['nama_ruangan'] }}
                                                                                {{-- <button type="button" class="btn btn-warning justify-content-end ti ti-trash" data-bs-toggle="modal" data-bs-target="#deletelayoutmodal{{ $gedung['id'] }}"> --}}
                                                                            </li>
                                                                        </a>
                                                                    @empty
                                                                        <p class="p-2 text-center">Data mapping belum
                                                                            tersedia.</p>
                                                                    @endforelse
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col justify-content-center">
                                                        <canvas id="canvas{{ $gambargedung->id }}" width="1080"
                                                            height="1080" alt="Image Preview"
                                                            class="img-fluid border-3 justify-content-center mx-auto mt-3 border border-black"style="transform: scale(0.75); transform-origin: center"></canvas>
                                                    </div>
                                                </div>
                                                {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $gambargedung->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Layout Gedung</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apa kamu yakin ingin menghapus layout gambar gedung ini? {{ $gambargedung->id }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('gambargedungs.destroy', $gambargedung->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-Danger">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('templates') }}/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="{{ asset('templates') }}/src/assets/libs/simplebar/dist/simplebar.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const gambargedungs = @json($gambargedungs);
                let selectedGedungId = null; // Variabel untuk menyimpan ID gedung yang dipilih
                const gedungs = @json($gedungs); // Gunakan data $gedungs langsung

                gambargedungs.forEach(gambargedung => {
                    const canvas = document.getElementById(`canvas${gambargedung.id}`);
                    const ctx = canvas.getContext("2d");
                    const image = new Image();

                    image.src = `/images/${gambargedung.image_gedung}`;
                    image.onload = function() {
                        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);

                        // Fetch data mapping untuk gedung ini
                        fetch(`/dashboard/datamapping/${gambargedung.id}/mapping`)
                            .then(response => response.json())
                            .then(data => {
                                gambargedung.mappings = data; // Simpan data mapping ke objek gedung
                                drawCanvas(canvas, ctx, gambargedung); // Gambar ulang canvas
                            })
                            .catch(error => console.error("Error fetching data:", error));
                    };
                });

                // Fungsi untuk memilih gedung
                window.selectGedung = function(gedungId) {
                    // Jika ID yang dipilih sama, keluar tanpa perubahan
                    if (selectedGedungId === gedungId) {
                        return;
                    }

                    selectedGedungId = gedungId; // Perbarui ID gedung yang dipilih

                    console.log(`Gedung dengan ID ${gedungId} dipilih`);

                    // Ubah warna item terpilih
                    gedungs.forEach(gedung => {
                        const listItem = document.getElementById(`gedungItem${gedung.id}`);
                        if (listItem) {
                            if (gedung.id === gedungId) {
                                listItem.classList.add("bg-primary","text-white");
                            } else {
                                listItem.classList.remove("bg-primary","text-white");
                            }
                        }
                    });

                    // Render ulang semua canvas
                    gambargedungs.forEach(gambargedung => {
                        const canvas = document.getElementById(`canvas${gambargedung.id}`);
                        const ctx = canvas.getContext("2d");
                        drawCanvas(canvas, ctx, gambargedung, gedungId); // Kirim gedungId ke drawCanvas
                    });
                };

                // Fungsi untuk menggambar ulang canvas
                function drawCanvas(canvas, ctx, gambargedung, activeGedungId = null) {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    // Gambar ulang gambar gedung
                    const image = new Image();
                    image.src = `/images/${gambargedung.image_gedung}`;
                    image.onload = function() {
                        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);

                        // Gambar semua mapping
                        if (gambargedung.mappings) {
                            gambargedung.mappings.forEach(mapping => {
                                const width = mapping.width || 50; // Default lebar
                                const height = mapping.height || 50; // Default tinggi
                                ctx.beginPath();
                                ctx.rect(mapping.x - width / 2, mapping.y - height / 2, width, height);
                                ctx.fillStyle = mapping.id === activeGedungId ?
                                    'rgba(0, 128, 0, 0.6)' // Warna hijau untuk gedung aktif
                                    :
                                    'rgba(55, 55, 255, 0.5)'; // Warna biru untuk gedung lain
                                ctx.fill();
                                ctx.closePath();

                                // Tampilkan nama ruangan
                                ctx.font = '12px Arial';
                                ctx.fillStyle = 'black';
                                ctx.fillText(mapping.nama_ruangan, mapping.x + width / 2 + 5, mapping.y);
                            });
                        }
                    };
                }
            });
        </script>
    @endsection
