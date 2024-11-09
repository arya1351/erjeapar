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
                        <a type="button" href="{{ route('gedung.tambah') }}"
                            class="btn btn-primary m-1 justify-content-end">Tambah Data Gedung</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr class="border-bottom">
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Urut</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 d-flex align-items-baseline justify-content-start">
                                            Gambar Gedung</h6>
                                    </th>
                                    <th class="border-bottom-0 d-flex align-items-baseline justify-content-end">
                                        <h6 class="fw-semibold mb-0">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                            ?>
                            <tbody>
                                @foreach ($gambargedungs as $gambargedung)
                                    <tr class="border-bottom">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-Bold mb-0 text-center">{{ $no++ }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"><img
                                                    src="{{ asset('images/' . $gambargedung->image_gedung) }}"
                                                    width="500" class="border border-3 border-black"></h6>
                                        </td>
                                        <td class="border-bottom-0 position-relative d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modaldetail{{ $gambargedung->id }}">
                                                Detail
                                            </button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal">
                                                Edit
                                            </button>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-Danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal detail -->
                                    <div class="modal fade" id="modaldetail{{ $gambargedung->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Layout Gedung
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h1 class="mx-4 ">test</h1>
                                                        <div class="row">
                                                            <div class="col">
                                                                <ul>
                                                                    <li
                                                                        class="mx-4 alert bg-primary border text-white d-flex align-items-center justify-content-between">
                                                                        <a href=""
                                                                            class="text-white text-center justify-content-center align-items-center">{{ $gambargedung->id }}</a>
                                                                        <button type="button"
                                                                            class="btn btn-danger justify-content-end ti ti-trash"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#deletelayoutmodal">
                                                                        </button>
                                                                    </li>
                                                                    <li class="mx-4 alert bg-white border text-white">
                                                                        <a href=""
                                                                            class="text-black">{{ $gambargedung->id }}</a>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col justify-content-center">
                                                        <img id="preview"
                                                            src="{{ asset('images/' . $gambargedung->image_gedung) }}"
                                                            width="720" height="720" alt="Image Preview"
                                                            class="img-fluid border border-3 border-black mt-3 mx-auto justify-content-center">
                                                    </div>
                                                </div>
                                                {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deletelayoutmodal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apa kamu yakin ingin menghapus layout gambar gedung ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('gambargedungs.destroy', $gambargedung->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-Danger">
                                                            Delete
                                                        </button>
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



            <style>
                #preimage {
                    display: none;
                    max-width: 100%;
                    max-height: 300px;
                }
            </style>

            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @error('nama')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <h5 class="card-title fw-semibold mb-4">Layout gedung</h5>
                            <form action="{{ route('gambargedungs.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <label for="exampleInputEmail1" class="form-label">Masukkan Gambar Layout
                                    Gedung</label>
                                <input type="file" name="image_gedung" class="form-control" id="fileEdit"
                                    accept="image/*" aria-describedby="FileHelp">
                            </form>
                            <img id="preimage" src="#" alt="Image Preview"
                                class="img-fluid mt-3 mx-auto justify-content-center">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            const fileEdit = document.getElementById('fileEdit');
            const preimage = document.getElementById('preimage');

            fileEdit.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preimage.src = e.target.result;
                        preimage.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preimage.style.display = 'none';
                }
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection