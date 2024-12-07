<title>Kepala Bagian-Tambah Laporan</title>

@extends('layouts.app')
@section('sidebar')
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between mx-auto row">
                <a href="{{ route('kepalabagian.dashboard') }}" class="text-nowrap logo-img justify-content-center mx-auto">
                    <img src="{{ asset('templates') }}/src/assets/images/logos/logoRJ.png" width="180" alt="" />
                </a>
                <a href="{{ route('kepalabagian.dashboard') }}" class="text-center text-black fs-6 fw-bolder">
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
                        <span class="hide-menu">Data Master</span>
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
@endsections


@section('content')
    <div class="container-fluid">
        <div class="card">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="card-body">
                <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold mb-4">Forms</h5>
        </div>
                <form action="{{ route('kepalabagian.laporans.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="jenislaporan" class="form-label">Masukkan Jenis Laporan</label>
                        <select name="jenislaporan" id="jenislaporan" class="form-control form-select">
                            <option value="">Jenis Laporan</option>
                            <option value="Laporan Pembelian dan Perbaikan Apar">Laporan Pembelian dan Perbaikan Apar</option>
                            <option value="Laporan Pengisian Ulang Apar">Laporan Pengisian Ulang Apar</option>
                        </select>                        
                    </div>
                    <div class="mb-3">
                        <label for="pembuat" class="form-label">Masukkan Nama Pembuat Laporan</label>
                        <input type="text" name="pembuat" class="form-control" id="pembuat" value="{{ old('pembuat') }}">
                    </div>
                    <div class="mb-3">
                        <label for="kepalabagian" class="form-label">Masukkan Nama Kepala Bagian</label>
                        <input type="text" name="kepalabagian" class="form-control" id="kepalabagian" value="{{ old('kepalabagian') }}">
                    </div>
                    <div class="mb-3">
                        <label for="hrd" class="form-label">Masukkan Nama HRD</label>
                        <input type="text" name="hrd" class="form-control" id="hrd" value="{{ old('hrd') }}">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                        <input type="date" name="tanggal_pengajuan" class="form-control" id="tanggal_pengajuan" value="{{ old('tanggal_exp') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
