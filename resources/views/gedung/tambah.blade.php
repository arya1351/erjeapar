<title>Dashboard-Tambah Gedung</title>
@extends('layouts.app')
@section('sidebar')
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index.html" class="text-nowrap logo-img">
                    <img src="{{ asset('templates') }}/src/assets/images/logos/dark-logo.svg" width="180" alt="" />
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
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
@endsection

@section('content')
    <style>
        #preview {
            display: none;
            max-width: 100%;
            max-height: 300px;
        }
    </style>
    <div class="container-fluid">
        <div class="card">
            @error('nama')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Layout gedung</h5>
                <form action="{{ route('gambargedungs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="labelInputLayoutGedung" class="form-label">Masukkan Gambar Layout Gedung</label>
                        <input type="file" name="image_gedung" class="form-control" id="fileInput" accept="image/*"
                            aria-describedby="FileHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <img id="preview" src="#" alt="Image Preview"
                    class="img-fluid mt-3 mx-auto justify-content-center">
            </div>
        </div>
    </div>
    <script>
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
