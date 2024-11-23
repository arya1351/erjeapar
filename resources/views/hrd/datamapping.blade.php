<title>HRD-Data Gedung</title>

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
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
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
                    <h5 class="card-title fw-semibold mb-4">Forms</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr class="border-bottom">
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Urut</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 d-flex align-items-baseline justify-content-start">
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
                                            <h6 class="fw-Bold mb-0 text-center">{{ $no++ }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"><img
                                                    src="{{ asset('images/' . $gambargedung->image_gedung) }}"
                                                    data-bs-toggle="modal"
                                                data-bs-target="#modaldetail{{ $gambargedung->id }}"
                                                    width="500" class="border border-3 border-black"></h6>
                                        </td>
                                        <td class="border-bottom-0 position-relative d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modaldetail{{ $gambargedung->id }}">
                                                Detail
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
                                                        <h1 class="mx-4 ">Daftar Mapping</h1>
                                                        <div class="row">
                                                            <div class="col">
                                                                <ul>
                                                                    <li
                                                                        class="mx-4 alert bg-primary border text-white d-flex align-items-center justify-content-between">
                                                                        <a href=""
                                                                            class="text-white text-center justify-content-center align-items-center">{{ $gambargedung->id }}</a>
                                                                        </button>
                                                                    </li>
                                                                    <li class="mx-4 alert bg-white border text-white">
                                                                        <a href=""
                                                                            class="text-black">{{ $gambargedung->id }}</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col justify-content-center">
                                                        <img id="preview"
                                                            src="{{ asset('images/' . $gambargedung->image_gedung) }}"
                                                            width="720" height="720" alt="Image Preview"
                                                            class="img-fluid border border-3 border-black mt-3 mx-auto justify-content-center">
                                                    </div>
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



            <style>
                #preimage {
                    display: none;
                    max-width: 100%;
                    max-height: 300px;
                }
            </style>
        </div>

        <script>
            const fileEdit = document.getElementById('fileEdit');
            const preimage = document.getElementById('preimage');

            fileEdit.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preimage.src = e.target.result;
                        preimage.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preimage.style.display = 'none';
                }
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection
