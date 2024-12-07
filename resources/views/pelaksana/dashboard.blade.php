<title>Pelaksana-Dashboard</title>

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
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu fst-italic">Data Sender</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pelaksana.datakirimlaporan') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-send"></i>
                            </span>
                            <span class="hide-menu">Kirim Laporan</span>
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
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 mb-sm-0 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="m-2">100</h1>
                            <h3 class="m-2">Total Apar</h3>
                            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-sm-0 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="m-2">100</h1>
                            <h3 class="m-2">Total Gedung</h3>
                            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-sm-0 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="m-2">100</h1>
                            <h3 class="m-2">Total </h3>
                            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    {{-- <script src="{{ asset('templates') }}/src/assets/js/dashboard.js"></script> --}}
@endsection
