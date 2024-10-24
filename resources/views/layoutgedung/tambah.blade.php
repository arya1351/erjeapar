<title>Dashboard-Tambah Gedung</title>



@include('sidebar.pelaksana')

<x-app-layout>

    <h1>Tambah Ruangan</h1>

    <form action="{{ route('layoutgedung.store') }}" method="POST">
        @csrf
        <label for="gambargedung_id">Pilih Gambar Gedung:</label>
        <select name="gambargedung_id" id="gambargedung_id" onchange="loadGedungImage()">
            <option value="">Pilih Gambar Gedung</option>
            @foreach($gambargedungs as $gambargedung)
                <option value="{{ $gambargedung->image_gedung }}">{{ $gambargedung->id }}</option>
            @endforeach
        </select>

        <label for="nama_ruangan">Nama Ruangan:</label>
        <input type="text" name="nama_ruangan" id="nama_ruangan" required>

        <label for="area">Area (Canvas):</label>
        <input type="hidden" name="area" id="area">
        <canvas id="fabricCanvas" width="800" height="600" style="border:1px solid #000"></canvas>

        <button type="submit" onclick="saveCanvas()">Simpan</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.6.0/fabric.min.js"></script>
    <script>
        // Inisialisasi canvas Fabric.js
        const canvas = new fabric.Canvas('fabricCanvas');

        // Fungsi untuk memuat gambar gedung yang dipilih dari dropdown ke dalam canvas
        function loadGedungImage() {
            const selectedImage = document.getElementById('gambargedung_id').value;

            // Clear previous objects from the canvas
            canvas.clear();

            if (selectedImage) {
                // Load image gedung into canvas
                fabric.Image.fromURL('/images/' + selectedImage, function(img) {
                    img.set({
                        left: 0,
                        top: 0,
                        selectable: false // Agar gambar tidak bisa dipindahkan
                    });
                    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
                });
            }
        }

        // Contoh: Tambahkan teks ke canvas sebagai elemen tambahan
        const text = new fabric.Text('Ruangan', { left: 100, top: 100 });
        canvas.add(text);

        // Fungsi untuk menyimpan data area dari canvas ke dalam input hidden
        function saveCanvas() {
            const jsonArea = JSON.stringify(canvas);
            document.getElementById('area').value = jsonArea;
        }
    </script>


</x-app-layout> 