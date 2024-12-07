<title>Kepala Bagian-Data Laporan</title>

@extends('layouts.app')
@section('sidebar')
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between mx-auto">
                <div class="row py-4">
                    <a href="{{ route('kepalabagian.dashboard') }}" class="text-nowrap logo-img justify-content-center mx-auto">
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
                    <h5 class="card-title fw-semibold mb-4">Forms</h5>
                    <div class="d-flex justify-content-end">
                        <a type="button" href="{{ route('kepalabagian.tambahlaporan') }}"
                            class="btn btn-primary m-1 justify-content-end">Tambah Laporan</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Urut</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jenis Laporan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Pembuat</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tanggal Pengajuan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporans as $laporan)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-Bold mb-0 text-center">{{($laporans->currentPage() - 1) * $laporans  ->perPage() + $loop->iteration}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1 d-inline-block text-truncate"
                                            style="max-width: 100px;">{{ $laporan->jenislaporan }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $laporan->kepalabagian }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $laporan->tanggal_pengajuan }}</p>
                                    </td>
                                    <td class="border-bottom-0 d-inline-flex gap-1">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $laporan->id }}">
                                            Detail
                                        </button>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $laporan->id }}">
                                    Hapus
                                </button>
                                    </td>
                                </tr>
                                
                                <!-- Modal Detail -->
                                <div class="modal fade" id="detailModal{{ $laporan->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="false">
                                    <div class="modal-dialog modal-xl modal-dialog-scrollable"">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Laporan - {{ $laporan->jenislaporan }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Pembuat (Kepala Bagian):</strong> {{ $laporan->kepalabagian }}</p>
                                                <p><strong>Tanggal Pengajuan:</strong> {{ $laporan->tanggal_pengajuan }}</p>
                                                <p><strong>Komponen Terkait:</strong></p>
                                                @if ($laporan->komponens->isNotEmpty())
                                                    <ul>
                                                        @foreach ($laporan->komponens as $komponen)
                                                        <h5 class="modal-title py-2" id="exampleModalLabel">Detail Komponen Ke {{ $loop->iteration }}</h5>
                                                            <p>Nama Komponen : {{ $komponen->komponen }}</p>
                                                            <p>Jumlah Komponen : {{ $komponen->jumlah }} {{ $komponen->satuan }}</p>
                                                            <p>Keterangan : {{ $komponen->keterangan }}</p>
                                                            <button type="button" class="btn btn-danger px-2 fs-1"  data-bs-target="#modalhapuskomponen" data-bs-toggle="modal">Hapus</button>
                                                        
                                                            @endforeach
                                                    </ul>
                                                    
                                                @else
                                                    <p>Belum ada komponen yang terkait dengan laporan ini.</p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-Primary" onclick="window.location.href='{{ route('kepalabagian.tambahkomponen', $laporan->id) }}'">Tambah Komponen</button>
                                                <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('kepalabagian.cetaklaporan', $laporan->id) }}'">Print</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalhapuskomponen" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Hide this modal and show the first with the button below.
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                


                                <div class="modal fade" id="deleteModal{{ $laporan->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apa kamu yakin ingin menghapus Laporan dengan nomer laporan
                                                    {{ $laporan->id }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('laporans.destroy', $laporan->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-Danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                <div>
                
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $laporans->links('vendor.pagination.bootstrap-5') }}
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

            <script src="{{ asset('templates') }}/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
            <script src="{{ asset('templates') }}/src/assets/libs/simplebar/dist/simplebar.js"></script>
        @endsection
