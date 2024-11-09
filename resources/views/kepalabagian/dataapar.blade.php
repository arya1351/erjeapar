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
                  <i class="ti ti-article"></i>
              </span>
              <span class="hide-menu">Data Apar</span>
          </a>
      </li>
      <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('kepalabagian.datagedung') }}" aria-expanded="false">
              <span>
                  <i class="ti ti-building"></i>
              </span>
              <span class="hide-menu">Data Gedung</span>
          </a>
      </li>
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
                            <tbody>
                                <?php
                                    $no = 1;
                                ?>
                                @foreach ($apars as $apar)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-Bold mb-0 text-center">{{ $no++ }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1 d-inline-block text-truncate" style="max-width: 100px;">{{ $apar->jenis }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1 d-inline-block text-truncate" style="max-width: 100px;">{{ $apar->merek }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <!-- Mengakses nama_ruangan melalui relasi gedung -->
                                        <p class="mb-0 fw-normal">{{ $apar->gedungs->nama_ruangan ?? 'N/A' }}</p>
                                    </td>
                                    <td class="border-bottom-0 mx-auto">
                                        <div class="d-flex align-items-center gap-2  justify-content-center">
                                            <span class="badge bg-primary rounded-3 fw-semibold">{{ $apar->no_apar }}</span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $apar->tanggal_exp }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal d-inline-block text-truncate" style="max-width: 100px;">{{ $apar->perawatan }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal d-inline-block text-truncate" style="max-width: 100px;">{{ $apar->keterangan }}</p>
                                    </td>
                                    <td class="border-bottom-0 d-inline-flex gap-1">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal1">
                                            Edit
                                        </button>
                                        <!-- Button trigger modal -->
                                            <button type="submit" class="btn btn-Danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $apar->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="exampleModal{{ $apar->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                               <p>Apa kamu yakin ingin menghapus Apar dengan nomer apar {{ $apar->no_apar }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('apars.destroy', $apar->id) }}" method="POST">
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


            <!-- Modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            
        @endsection
