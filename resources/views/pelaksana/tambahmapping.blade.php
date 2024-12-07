<title>Dashboard-Tambah Gedung</title>
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
<style>
    canvas {
        border: 1px solid black;
        cursor: pointer;
        display: block;
        margin: 20px auto;
        position: relative;
    }
    #info {
        margin-top: 20px;
        text-align: center;
    }
   
    .btn:hover {
        background-color: #0056b3;
    }
</style>

<h1>CRUD Denah Ruangan</h1>

<canvas id="canvas" width="1080" height="1080"></canvas>

<div id="info">
    <button class="btn btn-primary" id="createMode">Tambah Ruangan</button>
    <button class="btn btn-warning" id="resizeMode">Edit</button>
    <button class="btn btn-danger" id="deleteMode">Hapus Ruangan</button>
</div>

<script>
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const imageSrc = "{{ asset('images/' . $gambargedungs->image_gedung) }}"; // Ganti sesuai path gambar Anda
    let gedungs = @json($existingGedung);
    let mode = 'create'; 
    let dragging = false;
    let selectedGedung = null;
    let draggingGedung = null; 
    let startX, startY, startWidth, startHeight;

    const gambargedungId = {{ $gambargedungs->id }};


    const defaultWidth = 30; // Lebar default kotak
    const defaultHeight = 30; // Tinggi default kotak

    // Ambil CSRF token dari meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Load background image
    const background = new Image();
    background.src = imageSrc;
    background.onload = function () {
        drawCanvas();
    };

    // Tambahkan ID gambar gedung pada data
gedungs = gedungs.map(gedung => ({
    ...gedung,
    gambargedung_id: {{ $gambargedungs->id }},
    isSelected: false
}));

    // Draw canvas with background and gedungs
    function drawCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(background, 0, 0, canvas.width, canvas.height); // Draw background

        gedungs.forEach(gedung => {
            const width = gedung.width || defaultWidth; // Gunakan width yang disesuaikan atau default
            const height = gedung.height || defaultHeight; // Gunakan height yang disesuaikan atau default
            ctx.beginPath();
            ctx.rect(gedung.x - width / 2, gedung.y - height / 2, width, height); // Kotak dengan ukuran yang dapat diubah
            ctx.fillStyle = gedung.isSelected ? 'rgba(255, 0, 0, 0.5)' : 'rgba(55, 55, 255, 0.5)';
            ctx.fill();
            ctx.closePath();

            // Tampilkan nama ruangan
            ctx.font = '12px Arial';
            ctx.fillStyle = 'black';
            ctx.fillText(gedung.nama_ruangan, gedung.x + width / 2 + 5, gedung.y);

            // Gambar handle di sudut kotak untuk mengubah ukuran
            ctx.beginPath();
            ctx.arc(gedung.x + width / 2, gedung.y + height / 2, 5, 0, 2 * Math.PI); // Handle di sudut kanan bawah
            ctx.fillStyle = 'green'; // Warna handle
            ctx.fill();
            ctx.closePath();
        });
    }

    // Handle canvas mouse down event to start dragging or resizing
    canvas.addEventListener('mousedown', (e) => {
    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    if (mode === 'create') {
        addGedung(x, y);
    } else if (mode === 'resize') {
        selectedGedung = gedungs.find(gedung => {
            const boxWidth = gedung.width || defaultSize;
            const boxHeight = gedung.height || defaultSize;
            const handleX = gedung.x + boxWidth / 2;
            const handleY = gedung.y + boxHeight / 2;
            return Math.hypot(x - handleX, y - handleY) <= 5;
        });

        if (selectedGedung) {
            startX = x;
            startY = y;
            startWidth = selectedGedung.width;
            startHeight = selectedGedung.height;
            dragging = true;
        } else {
            draggingGedung = gedungs.find(gedung => {
                const boxWidth = gedung.width || defaultSize;
                const boxHeight = gedung.height || defaultSize;
                return x >= gedung.x - boxWidth / 2 && x <= gedung.x + boxWidth / 2 &&
                       y >= gedung.y - boxHeight / 2 && y <= gedung.y + boxHeight / 2;
            });

            if (draggingGedung) {
                offsetX = x - draggingGedung.x;
                offsetY = y - draggingGedung.y;
            }
        }
    }
});



    
    // Handle mouse move event to resize the box
    canvas.addEventListener('mousemove', (e) => {
        if (mode === 'resize' && dragging && selectedGedung) {
            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const deltaX = x - startX;
            const deltaY = y - startY;

            selectedGedung.width = Math.max(startWidth + deltaX, 10);
            selectedGedung.height = Math.max(startHeight + deltaY, 10);
            drawCanvas();
        } else if (draggingGedung) {
            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            draggingGedung.x = x - offsetX;
            draggingGedung.y = y - offsetY;

            drawCanvas();
            // updateGedung(selectedGedung); // Panggil fungsi untuk memperbarui gedung di server

        }
    });
    canvas.addEventListener('mouseup', () => {
        if (mode === 'resize' && dragging && selectedGedung) {
            updateGedung(selectedGedung);
        } else if (draggingGedung) {
            updateGedung(draggingGedung);
        }
        dragging = false;
        draggingGedung = null;
        selectedGedung = null;
    });

    // Add new gedung
    async function addGedung(x, y) {
    const name = prompt('Masukkan nama ruangan:');
    if (!name) return;

    const gambargedungId = {{ $gambargedungs->id }};

    const formData = new FormData();
    formData.append('nama_ruangan', name);
    formData.append('x', x);
    formData.append('y', y);
    formData.append('width', defaultWidth);
    formData.append('height', defaultHeight);
    formData.append('gambargedung_id', gambargedungId);

    try {
        const response = await fetch('/dashboard/tambahmapping/', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData,
        });

        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

        const gedung = await response.json();
        gedungs = [gedung]; // Pastikan gedung baru menggantikan array kosong
        drawCanvas();
        location.reload(); 
    } catch (error) {
        console.error('Error saat menambahkan gedung:', error);
    }
}
// Handle canvas click event untuk edit nama ruangan
canvas.addEventListener('click', (e) => {
    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    gedungs.forEach(gedung => gedung.isSelected = false);

    // Cari ruangan yang diklik berdasarkan posisi nama ruangan
    const clickedGedung = gedungs.find(gedung => {
        const boxWidth = gedung.width || defaultSize;
        const boxHeight = gedung.height || defaultSize;
        return x >= gedung.x + boxWidth / 2 + 5 && x <= gedung.x + boxWidth / 2 + 100 &&
               y >= gedung.y - 10 && y <= gedung.y + 10; // Area sekitar teks nama
    });
    const selectedGedung = gedungs.find(gedung => {
        const boxWidth = gedung.width || defaultSize;
        const boxHeight = gedung.height || defaultSize;
        return x >= gedung.x - boxWidth / 2 && x <= gedung.x + boxWidth / 2 &&
        y >= gedung.y - boxHeight / 2 && y <= gedung.y + boxHeight / 2;
    });

    if (selectedGedung) {
        selectedGedung.isSelected = true; // Tandai sebagai terpilih
        console.log(`Gedung "${selectedGedung.nama_ruangan}" dipilih.`);
    }

    if (clickedGedung) {
        const newName = prompt('Masukkan nama baru ruangan:', clickedGedung.nama_ruangan);
        if (newName && newName !== clickedGedung.nama_ruangan) { // Pastikan nama berubah
            clickedGedung.nama_ruangan = newName; // Perbarui nama secara lokal
        }
    }
    // updateGedung(clickedGedung);
    drawCanvas(); // Render ulang canvas
});

// let isUpdating = false;

async function updateGedung(gedung) {
    // if (isUpdating) return; // Jangan lanjutkan jika sedang update
    // isUpdating = true;

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('nama_ruangan', gedung.nama_ruangan);
    formData.append('x', gedung.x);
    formData.append('y', gedung.y);
    formData.append('width', gedung.width);
    formData.append('height', gedung.height);
    formData.append('gambargedung_id', gedung.gambargedung_id);

    try {
        const response = await fetch(`/dashboard/tambahmapping/${gedung.id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData,
        });

        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        console.log('Ruangan berhasil diperbarui');
    } catch (error) {
        console.error('Error saat memperbarui nama ruangan:', error);
    } finally {
        isUpdating = false; // Reset flag
    }
}

function handleResize(gedung, newWidth, newHeight) {
    const isResized = gedung.width !== newWidth || gedung.height !== newHeight;

    if (isResized) {
        gedung.width = newWidth;
        gedung.height = newHeight;
        updateGedung(gedung); // Update hanya jika terjadi perubahan ukuran
    }
}


// delete function start

canvas.addEventListener('click', async (e) => {
    if (mode !== 'delete') return; // Hanya jalan jika mode hapus aktif

    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    // Cari gedung yang diklik berdasarkan posisi
    const clickedGedung = gedungs.find(gedung => {
        const boxWidth = gedung.width || defaultSize;
        const boxHeight = gedung.height || defaultSize;
        return x >= gedung.x - boxWidth / 2 && x <= gedung.x + boxWidth / 2 &&
               y >= gedung.y - boxHeight / 2 && y <= gedung.y + boxHeight / 2;
    });

    if (clickedGedung) {
        // Konfirmasi sebelum menghapus
        const confirmDelete = confirm(`Apakah Anda yakin ingin menghapus ruangan "${clickedGedung.nama_ruangan}"?`);
        if (confirmDelete) {
            try {
                await deleteGedung(clickedGedung.id); // Hapus dari server
                gedungs = gedungs.filter(gedung => gedung.id !== clickedGedung.id); // Hapus dari array lokal
                drawCanvas(); // Render ulang canvas
            } catch (error) {
                console.error('Error saat menghapus gedung:', error);
            }
        }
    }
});

// Fungsi untuk menghapus gedung dari server
async function deleteGedung(id) {
    try {
        const response = await fetch(`/dashboard/tambahmapping/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Tambahkan token CSRF
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        console.log(`Gedung dengan ID ${id} berhasil dihapus.`);
    } catch (error) {
        console.error('Error saat menghapus gedung dari server:', error);
        throw error;
    }
}

// delete function end 


// Fetch gedungs
async function fetchGedungs(gedung) {
    try {
        const gambargedungId = {{ $gambargedungs->id }};
        const response = await fetch(`/dashboard/tambahmapping/${gambargedungId}/mapping`);
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

        const data = await response.json();
        console.log("Data gedung yang diterima:", data);  // Cek data yang diterima

        gedungs = data;  // Pastikan data dimasukkan dengan benar
        drawCanvas();
    } catch (error) {
        console.error('Error saat memuat gedung:', error);
    }
}

    // Set mode
    document.getElementById('createMode').addEventListener('click', () => mode = 'create');
    document.getElementById('resizeMode').addEventListener('click', () => mode = 'resize');
    document.getElementById('deleteMode').addEventListener('click', () => mode = 'delete');


    // Initial fetch
    fetchGedungs();

</script>

@endsection
