<title>Dashboard-Tambah Gedung</title>

@extends('layouts.app')    
@section('sidebar')
<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="./index.html" class="text-nowrap logo-img">
        <img src="{{ asset('templates')}}/src/assets/images/logos/dark-logo.svg" width="180" alt="" />
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
        <li class="sidebar-item">
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
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">Data Apar</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('pelaksana.datagedung') }}" aria-expanded="false">
            <span>
              <i class="ti ti-building"></i>
            </span>
            <span class="hide-menu">Data Gedung</span>
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
                <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Forms</h5>
                <form action="{{ route('apar.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="mb-3">
                      <label for="InputJenisApar" class="form-label">Jenis Apar</label>
                      <input type="text" name="jenis" class="form-control" id="InputJenisApar" aria-describedby="textHelp">
                    </div>
                    <div class="mb-3">
                        <label for="InputMerekApar" class="form-label">Merek Apar</label>
                        <input type="text" name="merek" class="form-control" id="InputMerekApar" aria-describedby="textHelp">
                    </div>
                      <div class="mb-3">
                        <label for="InputLokasiApar" class="form-label">Lokasi</label>
                        <select name="gedung_id" id="InputLokasiApar" class="form-control form-select">
                          <option value="" class="">Pilih Lokasi</option>
                          @foreach($gedungs as $gedung)
                          <option value="{{ $gedung->id }}">
                            Lokasi : {{ $gedung->nama_ruangan }}
                          </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="InputNomerApar" class="form-label">Nomer Apar</label>
                        <input type="text" name="no_apar" class="form-control" id="InputNomerApar" aria-describedby="textHelp">
                    </div>
                    <div class="mb-3">
                      <label for="TanggalApar" class="form-label">Tanggal Expired</label>
                      <input type="date" name="tanggal_exp" class="form-control" id="TanggalApar">
                    </div>
                    <div class="mb-3">
                      <label for="KeteranganApar" class="form-label">Tanggal Expired</label>
                      <input type="text" name="keterangan" class="form-control" id="KeteranganApar">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            
          </div>
    </div>
@endsection