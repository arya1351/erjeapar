<title>Dashboard-Tambah Apar</title>

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
                <div>
                <a href="{{route('pelaksana.importapar') }}" class="btn btn-warning mx-2">Import from Excel</a>
            </div>
        </div>
                <form action="{{ route('pelaksana.apars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="InputJenisApar" class="form-label">Jenis Apar</label>
                        <input type="text" name="jenis" class="form-control" id="InputJenisApar" value="{{ old('jenis') }}">
                        @error('jenis')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merek Apar</label>
                        <select name="merk" id="merk" class="form-control form-select">
                            <option>Pilih Merk Apar</option>
                            <option value="Apron">
                                Apron
                            </option>
                            <option value="Combat">
                                Combat
                            </option>
                            <option value="Firex">
                                Firex
                            </option>
                            <option value="Protec">
                                Protec
                            </option>
                            <option value="Special">
                                Special
                            </option>
                            <option value="Viking">
                                Viking
                            </option>
                            <option value="Yamoto">
                                Yamoto
                            </option>
                            <option value="">
                                Tidak Bermerek
                            </option>
                        </select>
                        @error('merek')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gedung_id" class="form-label">Lokasi</label>
                        <select name="gedung_id" id="gedung_id" class="form-control form-select">
                            <option value="">Pilih Lokasi</option>
                            @foreach ($gedungs as $gedung)
                                <option value="{{ $gedung->id }}" {{ (old('gedung_id') == $gedung->id) ? 'selected' : '' }}>
                                    {{ $gedung->nama_ruangan }}
                                </option>
                            @endforeach
                        </select>                        
                        @error('gedung_id')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_apar" class="form-label">Nomer Apar</label>
                        <input type="text" name="no_apar" class="form-control" id="no_apar" value="{{ old('no_apar') }}">
                        @error('no_apar')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_exp" class="form-label">Tanggal Expired</label>
                        <input type="date" name="tanggal_exp" class="form-control" id="tanggal_exp" value="{{ old('tanggal_exp') }}">
                        @error('tanggal_exp')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="perawatan" class="form-label">Perawatan</label>
                        <input type="text" name="perawatan" class="form-control" id="perawatan" value="{{ old('perawatan') }}">
                        @error('perawatan')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan" value="{{ old('keterangan') }}">
                        @error('keterangan')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>

        </div>
    </div>
@endsection
