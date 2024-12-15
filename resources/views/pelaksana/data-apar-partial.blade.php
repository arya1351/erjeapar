<div id="data-table">
<table class="text-nowrap mb-0 table align-middle">
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
    <tbody id>
        @forelse ($apars as $apar)
            <tr>
                <td class="border-bottom-0">
                    <h6 class="fw-Bold mb-0 text-center">
                        {{ ($apars->currentPage() - 1) * $apars->perPage() + $loop->iteration }}</h6>
                </td>
                <td class="border-bottom-0">
                    <h6 class="fw-semibold d-inline-block text-truncate mb-1" style="max-width: 100px;">
                        {{ $apar->jenis }}</h6>
                </td>
                <td class="border-bottom-0">
                    <h6 class="fw-semibold d-inline-block text-truncate mb-1" style="max-width: 100px;">
                        {{ $apar->merek }}</h6>
                </td>
                <td class="border-bottom-0">
                    <!-- Mengakses nama_ruangan melalui relasi gedung -->
                    <p class="fw-normal mb-0">{{ $apar->gedungs->nama_ruangan ?? 'N/A' }}</p>
                </td>
                <td class="border-bottom-0 mx-auto">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <span class="badge bg-primary rounded-3 fw-semibold">{{ $apar->no_apar }}</span>
                    </div>
                </td>
                <td class="border-bottom-0">
                    <p class="fw-normal mb-0">{{  \Carbon\Carbon::parse($apar->tanggal_exp)->format('d F Y') }}</p>
                </td>
                <td class="border-bottom-0">
                    <p class="fw-normal d-inline-block text-truncate mb-0" style="max-width: 100px;">
                        {{ $apar->perawatan }}</p>
                </td>
                <td class="border-bottom-0">
                    <p class="fw-normal d-inline-block text-truncate mb-0" style="max-width: 100px;">
                        {{ $apar->keterangan }}</p>
                </td>
                <td class="border-bottom-0 d-inline-flex gap-1">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#modalDetail{{ $apar->id }}">
                        Detail
                    </button>
                    
                    <!-- Button trigger modal -->
                    <button type="submit" class="btn btn-Danger" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $apar->id }}">
                        Delete
                    </button>
                </td>
            </tr>

            <div class="modal fade" id="deleteModal{{ $apar->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apa kamu yakin ingin menghapus Apar dengan nomer apar
                                {{ $apar->no_apar }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="{{ route('pelaksana.apars.destroy', $apar->id) }}" method="POST">
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
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
              </div>
        @empty
            <div>

            </div>
        @endforelse
    </tbody>
</table>
{{ $apars->links('vendor.pagination.bootstrap-5') }}
</div>

</div>
</div>
</div>
