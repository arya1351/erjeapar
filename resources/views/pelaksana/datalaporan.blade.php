<title>Pelaksana-Data Laporan</title>

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
                    <h5 class="card-title fw-semibold mb-4">Data Pengajuan Laporan</h5>
                    <div class="d-flex justify-content-end">
                        <a type="button" href="{{ route('pelaksana.tambahlaporan') }}"
                            class="btn btn-primary justify-content-end m-1">Tambah Laporan</a>
                    </div>
                    <div class="table-responsive">
                        <table class="text-nowrap mb-0 table align-middle">
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
                                            <h6 class="fw-Bold mb-0 text-center">
                                                {{ ($laporans->currentPage() - 1) * $laporans->perPage() + $loop->iteration }}
                                            </h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold d-inline-block text-truncate mb-1"
                                                style="max-width: 100px;">{{ $laporan->jenislaporan }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="fw-normal mb-0">{{ $laporan->pembuat }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="fw-normal mb-0">{{  \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d F Y') }}</p>
                                        </td>
                                        <td class="border-bottom-0 d-inline-flex gap-1">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $laporan->id }}">
                                                Detail
                                            </button>
                                            <a href="{{ route('pelaksana.editlaporan', $laporan->id) }}" type="button" class="btn btn-primary">
                                                Edit
                                            </a>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Laporan -
                                                        {{ $laporan->jenislaporan }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Pembuat:</strong> {{ $laporan->pembuat }}</p>
                                                    <p><strong>Tanggal Pengajuan:</strong>
                                                        {{ $laporan->tanggal_pengajuan }}</p>
                                                    @if ($laporan->komponens->isNotEmpty())
                                                        <ul>
                                                            @foreach ($laporan->komponens as $komponen)
                                                                <h5 class="modal-title py-2" id="exampleModalLabel">Detail
                                                                    Komponen Ke {{ $loop->iteration }}</h5>
                                                                <p>Nama Komponen : {{ $komponen->komponen }}</p>
                                                                <p>Jumlah Komponen : {{ $komponen->jumlah }}
                                                                    {{ $komponen->satuan }}</p>
                                                                <p>Keterangan : {{ $komponen->keterangan }}</p>
                                                                <button type="button" class="btn btn-danger fs-1 px-2"
                                                                    data-bs-target="#modalhapuskomponen{{ $komponen->id }}"
                                                                    data-bs-toggle="modal">Hapus</button>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p>Belum ada komponen yang terkait dengan laporan ini.</p>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-Primary"
                                                        onclick="window.location.href='{{ route('pelaksana.tambahkomponen', $laporan->id) }}'">Tambah
                                                        Komponen</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   @forelse ($laporan->komponens as $komponen)
                                    <div class="modal fade" id="modalhapuskomponen{{ $komponen->id }}"
                                        aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                   <h5>Apakah kamu yakin ingin menghapus komponen ini?</h5>
                                                    <h6>Nama Komponen : {{ $komponen->komponen }}</h6>
                                                    <h6>Id Komponen : {{ $komponen->id }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-warning" data-bs-target="#exampleModalToggle"
                                                        data-bs-toggle="modal">Close</button>
                                                        <form action="{{ route('komponens.destroy', $komponen->id) }}"
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
                                    </div>
                                    @empty
                                    <div class="modal-body">
                                        Komponen Tidak ditemukan!!
                                    </div>
                                    @endforelse

                                    <div class="modal fade" id="deleteModal{{ $laporan->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Laporan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apa kamu yakin ingin menghapus Laporan dengan nomer laporan
                                                        {{ $loop->iteration }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('pelaksana.laporans.destroy', $laporan->id) }}"
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
