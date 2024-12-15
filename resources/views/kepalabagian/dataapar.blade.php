<title>Kepala Bagian-Data Apar</title>

@extends('layouts.app')
@section('sidebar')
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between mx-auto">
                <div class="row py-4">
                    <a href="{{ route('kepalabagian.dashboard') }}"
                        class="text-nowrap logo-img justify-content-center mx-auto">
                        <img src="{{ asset('templates') }}/src/assets/images/logos/logoRJ.png" width="180" alt="" />
                    </a>
                    <a href="{{ route('kepalabagian.dashboard') }}" class="fs-6 fw-bolder text-center text-black">
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
                    <li class="sidebar-item {{ Request::is('kepalabagian/dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('kepalabagian.dashboard') }}" aria-expanded="false">
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
                        <a class="sidebar-link" href="{{ route('kepalabagian.dataapar') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-fire-extinguisher"></i>
                            </span>
                            <span class="hide-menu">Mengelola Data Apar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('kepalabagian.datamapping') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-building"></i>
                            </span>
                            <span class="hide-menu">Mapping Apar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('kepalabagian.datalaporan') }}" aria-expanded="false">
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
                        <a class="sidebar-link" href="{{ route('kepalabagian.datakirimlaporan') }}" aria-expanded="false">
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
                    <h5 class="card-title fw-semibold mb-4">Data Apar</h5>
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between mx-4 my-auto">
                            <form class="d-flex" action="" method="GET">
                                <input class="form-control" list="datalistOptions" name="search" id="search"
                                    value="{{ request('search') }}" placeholder="Type to search...">
                            </form>
                            @foreach ($apars as $apar)
                                <datalist id="datalistOptions">
                                    <option value="{{ $apar->jenis }}">
                                    <option value="{{ $apar->merk }}">
                                    <option value="{{ $apar->no_apar }}">
                                    <option value="{{ $apar->tanggal_exp }}">
                                    <option value="{{ $apar->perawatan }}">
                                    <option value="{{ $apar->keterangan }}">
                                    <option value="{{ $apar->gedungs->nama_ruangan }}">
                                </datalist>
                            @endforeach
                            <form action="{{ route('kepalabagian.dataapar.export') }}" method="GET">
                                <input type="hidden" name="search" id="search-hidden" value="">
                                <button type="submit" class="btn btn-warning">Export</button>
                            </form>
                        </div>

                        @include('kepalabagian.data-apar-partial', ['apars' => $apars])

                        <script src="{{ asset('templates') }}/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
                        <script src="{{ asset('templates') }}/src/assets/libs/simplebar/dist/simplebar.js"></script>
                    @endsection

                    @section('script')
                        <script>
                            $(document).ready(function() {
                                $('#search').on('keyup', function() {
                                    let query = $(this).val();
                                    $.ajax({
                                        url: "{{ route('kepalabagian.dataapar.search') }}",
                                        type: "GET",
                                        data: {
                                            search: query
                                        },
                                        success: function(data) {
                                            $('#data-table').html(data);
                                        },
                                        error: function() {
                                            alert('Terjadi kesalahan. Silakan coba lagi.');
                                        }
                                    });
                                });
                            });
                        </script>

                        <script>
                            document.getElementById('search').addEventListener('keydown', function(event) {
                                if (event.key === 'Enter') {
                                    event.preventDefault(); // Mencegah aksi Enter
                                }
                            });
                        </script>
                        <script>
                            $(document).ready(function() {
                                $('#search').on('input', function() {
                                    $('#search-hidden').val($(this).val());
                                });
                            });
                        </script>
                    @endsection
