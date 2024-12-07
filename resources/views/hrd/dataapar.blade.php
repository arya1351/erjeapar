<title>HRD-Data Apar</title>

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
                        </div>
                      
                            <div id="data-table">
                                @include('hrd.data-apar-partial', ['apars' => $apars])
                            </div>
                       


              <!-- Modal -->
              <div class="modal fade" id="modaldetail{{ $apar->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Apar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Jenis Apar :</strong> {{ $apar->jenis }}</p>
                            <p><strong>Merek Apar :</strong> {{ $apar->merek ?? 'Tidak bermerek' }}</p>
                            <p><strong>Lokasi Apar :</strong> {{ $apar->gedungs->nama_ruangan ?? 'N/A' }}</p>
                            <p><strong>Nomer Apar :</strong> {{ $apar->no_apar }}</p>
                            <p><strong>Tanggal Expired :</strong> {{ $apar->tanggal_exp }}</p>
                            <p><strong>Perawatan Apar :</strong> {{ $apar->perawatan }}</p>
                            <p><strong>Keterangan :</strong> {{ $apar->keterangan }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>

            <script src="{{ asset('templates') }}/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
            <script src="{{ asset('templates') }}/src/assets/libs/simplebar/dist/simplebar.js"></script>
        @endsection
