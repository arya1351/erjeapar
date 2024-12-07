<title>Dashboard-Tambah Gedung</title>
@extends('layouts.app')

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
    .btn {
        padding: 10px 20px;
        margin: 5px;
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
    }
    .btn:hover {
        background-color: #0056b3;
    }
</style>

<h1>CRUD Denah Ruangan</h1>

<canvas id="canvas" width="800" height="600"></canvas>

<div id="info">
    <button class="btn" id="createMode">Tambah Ruangan</button>
    <button class="btn" id="resizeMode">Ubah Ukuran</button>
</div>

<script>
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const imageSrc = "{{ asset('images/' . $gambargedungs->image_gedung) }}";
    let gedungs = [];
    let mode = 'create'; // Modes: create, resize
    let dragging = false;
    let selectedGedung = null;
    let startX, startY, startWidth, startHeight;
    let draggingGedung = null; 
    let offsetX, offsetY;

    const defaultSize = 30;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const background = new Image();
    background.src = imageSrc;
    background.onload = function () {
        drawCanvas();
    };

    function drawCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(background, 0, 0, canvas.width, canvas.height);

        gedungs.forEach(gedung => {
            const boxWidth = gedung.width || defaultSize;
            const boxHeight = gedung.height || defaultSize;
            ctx.beginPath();
            ctx.rect(gedung.x - boxWidth / 2, gedung.y - boxHeight / 2, boxWidth, boxHeight);
            ctx.fillStyle = 'blue';
            ctx.fill();
            ctx.closePath();

            ctx.font = '12px Arial';
            ctx.fillStyle = 'black';
            ctx.fillText(gedung.nama_ruangan, gedung.x + boxWidth / 2 + 5, gedung.y);

            ctx.beginPath();
            ctx.arc(gedung.x + boxWidth / 2, gedung.y + boxHeight / 2, 5, 0, 2 * Math.PI);
            ctx.fillStyle = 'green';
            ctx.fill();
            ctx.closePath();
        });
    }

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

    async function addGedung(x, y) {
        const name = prompt('Masukkan nama ruangan:');
        if (!name) return;

        const gambargedungId = {{ $gambargedungs->id }};

        const formData = new FormData();
        formData.append('nama_ruangan', name);
        formData.append('x', x);
        formData.append('y', y);
        formData.append('width', defaultSize);
        formData.append('height', defaultSize);
        formData.append('gambargedung_id', gambargedungId);

        try {
            const response = await fetch('/gedungs', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            const gedung = await response.json();
            gedungs.push(gedung);
            drawCanvas();
        } catch (error) {
            console.error('Error saat menambahkan gedung:', error);
        }
    }

    async function updateGedung(gedung) {
        const formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('nama_ruangan', gedung.nama_ruangan);
        formData.append('x', gedung.x);
        formData.append('y', gedung.y);
        formData.append('width', gedung.width);
        formData.append('height', gedung.height);
        formData.append('gambargedung_id', gedung.gambargedung_id);

        try {
            const response = await fetch(`/gedungs/${gedung.id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            console.log('Data gedung berhasil diperbarui');
        } catch (error) {
            console.error('Error saat memperbarui gedung:', error);
        }
    }

    async function fetchGedungs() {
        try {
            const response = await fetch('/gedungs');
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            gedungs = await response.json();
            drawCanvas();
        } catch (error) {
            console.error('Error saat memuat gedung:', error);
        }
    }

    // Tambahkan mode baru
document.getElementById('deleteMode').addEventListener('click', () => mode = 'delete');

// Handle canvas click event untuk hapus gedung
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
        const response = await fetch(`/gedungs/${id}`, {
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


    document.getElementById('createMode').addEventListener('click', () => mode = 'create');
    document.getElementById('resizeMode').addEventListener('click', () => mode = 'resize');

    fetchGedungs();
</script>
@endsection
