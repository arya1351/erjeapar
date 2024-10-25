<title>Dashboard-Tambah Gedung</title>



@include('sidebar.pelaksana')

<x-app-layout>
    @error('area')
    <div class="alert alert-danger" role="alert">
      {{ $message }}
    </div>
    @enderror
    @error('gambargedung_id')
    <div class="alert alert-danger" role="alert">
      {{ $message }}
    </div>
    @enderror
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script>
        // Inisialisasi canvas Fabric.js
        const canvas = new fabric.Canvas('fabricCanvas', {
            selection: true // Enable selection untuk memudahkan menandai
        });

        // Fungsi untuk memuat gambar gedung yang dipilih dari dropdown ke dalam canvas
        function loadGedungImage() {
            const selectedImage = document.getElementById('gambargedung_id').value;

            if (selectedImage) {
                fabric.Image.fromURL('/images/' + selectedImage, function(img) {
                    img.scaleToWidth(canvas.width);
                    img.scaleToHeight(canvas.height);
                    img.set({
                        left: 0,
                        top: 0,
                        selectable: false // Gambar tidak bisa dipindahkan
                    });
                    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
                });
            }
        }

        // Menambahkan area penanda yang dapat dipindah-pindahkan
        function addMarker() {
            const rect = new fabric.Rect({
                left: 150,
                top: 150,
                fill: 'rgba(255, 0, 0, 0.5)',
                width: 100,
                height: 100,
                selectable: true
            });
            canvas.add(rect);
        }

        // Tambahkan event listener untuk mendeteksi klik pada tombol
        document.addEventListener("keydown", (e) => {
            if (e.key === "m") { // "m" sebagai tombol untuk menambah marker
                addMarker();
                alert("Marker ruangan ditambahkan. Gunakan mouse untuk mengatur posisi.");
            }
        });

        // Fungsi untuk menyimpan data area dari canvas ke dalam input hidden
        function saveCanvas() {
            const jsonArea = JSON.stringify(canvas.toObject(['left', 'top', 'width', 'height']));
            document.getElementById('area').value = jsonArea;
        }
    </script>

</x-app-layout> 