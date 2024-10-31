<title>Dashboard-Tambah Gedung</title>

@include('sidebar.pelaksana')

<x-app-layout>
    <h1>Tambah Gedung</h1>

    <form action="{{ route('layoutgedung.store') }}" method="POST">
        @csrf
        <label for="gambargedung_id">Pilih Gambar Gedung:</label>
        <select name="gambargedung_id" id="gambargedung_id" onchange="loadGedungImage()">
            <option value="">Pilih Gambar Gedung</option>
            @foreach($gambargedungs as $gambargedung)
                <option value="{{ $gambargedung->id }}" data-image="{{ asset('images/' . $gambargedung->image_gedung) }}">
                    Gambar ID: {{ $gambargedung->id }}
                </option>
            @endforeach
        </select>

        <label for="nama_gedung">Nama Gedung:</label>
        <input type="text" name="nama_gedung" id="nama_gedung" required>

        <label for="area">Area (Canvas):</label>
        <input type="hidden" name="area" id="area">
        <canvas id="fabricCanvas" width="800" height="600" style="border:1px solid #000;"></canvas>

        <button type="submit" onclick="saveCanvas()">Simpan</button>
    </form>

    <div id="tooltip" style="position: absolute; padding: 5px; background: rgba(0, 0, 0, 0.7); color: #fff; border-radius: 4px; display: none;"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script>
        const canvas = new fabric.Canvas('fabricCanvas');
        const existingGedung = @json($existingGedung);

        function loadGedungImage() {
            const selectElement = document.getElementById('gambargedung_id');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const imageSrc = selectedOption.getAttribute('data-image');

            if (imageSrc) {
                fabric.Image.fromURL(imageSrc, function(img) {
                    img.scaleToWidth(canvas.width);
                    img.scaleToHeight(canvas.height);
                    img.set({ left: 0, top: 0, selectable: false });
                    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
                    showExistingMarkers();
                }, { crossOrigin: 'anonymous' });
            } else {
                canvas.setBackgroundImage(null, canvas.renderAll.bind(canvas));
            }
        }

        function showExistingMarkers() {
            if (!Array.isArray(existingGedung)) {
                console.log("existingGedung bukan array:", existingGedung);
                return;
            }

            existingGedung.forEach(function(gedung) {
                const areaData = JSON.parse(gedung.area);

                const rect = new fabric.Rect({
                    left: areaData.left,
                    top: areaData.top,
                    width: areaData.width,
                    height: areaData.height,
                    fill: 'rgba(0, 128, 0, 0.3)',
                    selectable: false
                });

                rect.on('mouseover', function(event) {
                    const pointer = canvas.getPointer(event.e);
                    showTooltip(pointer.x, pointer.y, gedung.nama_gedung);
                });

                rect.on('mouseout', function() {
                    hideTooltip();
                });

                canvas.add(rect);
            });

            canvas.renderAll();
        }

        function showTooltip(x, y, gedungName) {
            const tooltip = document.getElementById('tooltip');
            tooltip.innerHTML = `Nama Gedung: ${gedungName}`;
            tooltip.style.left = (x + 15) + 'px';
            tooltip.style.top = (y + 15) + 'px';
            tooltip.style.display = 'block';
            console.log("Tooltip shown at:", x, y);
        }

        function hideTooltip() {
            const tooltip = document.getElementById('tooltip');
            tooltip.style.display = 'none';
        }

        function saveCanvas() {
            const jsonArea = JSON.stringify(canvas.toObject(['left', 'top', 'width', 'height']));
            document.getElementById('area').value = jsonArea;
        }
    </script>

</x-app-layout>
