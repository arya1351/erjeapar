<title>Pelaksana-Data Apar</title>

@extends('layouts.app')
@section('sidebar')
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between mx-auto row">
                <a href="{{ route('pelaksana.dashboard') }}" class="text-nowrap logo-img justify-content-center mx-auto">
                    <img src="{{ asset('templates') }}/src/assets/images/logos/logoRJ.png" width="180" alt="" />
                </a>
                <a href="{{ route('pelaksana.dashboard') }}" class="text-center text-black fs-6 fw-bolder">
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
                        <span class="hide-menu">Data Master</span>
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
                        <a class="sidebar-link" href="{{ route('pelaksana.datagedung') }}" aria-expanded="false">
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
                    <h5 class="card-title fw-semibold mb-4">Forms</h5>
                    <div class="d-flex justify-content-end">
                        <a type="button" href="{{ route('apar.tambah') }}"
                            class="btn btn-primary m-1 justify-content-end">Tambah Data Apar</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Urut</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jenis Apar</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Merek</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Lokasi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Apar</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tanggal</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Perawatan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Keterangan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endsection
