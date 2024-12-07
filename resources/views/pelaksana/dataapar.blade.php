<title>Pelaksana-Data Apar</title>

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
    <!--  Row 1 -->
    <div class="row">

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Forms</h5>
                    <div class="d-flex justify-content-end mx-2">
                        <a type="button" href="{{ route('pelaksana.tambahapar') }}"
                            class="btn btn-primary m-1 justify-content-end">Tambah Data Apar</a>
                            
                    </div>
                    <div class="table-responsive">
                        <div class="d-flex mx-4 justify-content-between my-auto">
                            <form class="d-flex" action="" method="GET">
                            <input class="form-control" list="datalistOptions" name="search" id="search" value="{{ request('search') }}" placeholder="Type to search...">
                        </form>
                            @foreach ($apars as $apar)
                                <datalist id="datalistOptions">
                                    <option value="{{ $apar->jenis }}">
                                    <option value="{{ $apar->merk }}">
                                    <option value="{{ $apar->no_apar }}">
                                    <option value="{{ $apar->tanggal_exp }}">
                                    <option value="{{ $apar->perawatan }}">
                                    <option value="{{ $apar->keterangan }}">
                                    <option value="{{ $apar->gedungs->nama_ruangan  }}">
                                    </datalist>
                            @endforeach
                        <a type="button" href="dataapar-export"
                            class="btn btn-warning m-1 justify-content-end">Exports</a>
                        </div>
                      
                            <div id="data-table">
                                @include('pelaksana.data-apar-partial', ['apars' => $apars])
                            </div>
                       


              <!-- Modal -->
             
            <script src="{{ asset('templates') }}/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
            <script src="{{ asset('templates') }}/src/assets/libs/simplebar/dist/simplebar.js"></script>
        @endsection
