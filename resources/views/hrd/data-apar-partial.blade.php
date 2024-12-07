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
    <tbody>
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
                    <p class="fw-normal mb-0">{{ $apar->tanggal_exp }}</p>
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
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal1">
                            Edit
                        </button> --}}
                    <!-- Button trigger modal -->
                </td>
            </tr>

         
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
