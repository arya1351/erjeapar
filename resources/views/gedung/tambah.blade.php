<title>Dashboard-Tambah Gedung</title>



@include('sidebar.pelaksana')

<x-app-layout>
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
                        <label for="exampleInputEmail1" class="form-label">Masukkan Gambar Layout Gedung</label>
                        <input type="file" name="image_gedung" class="form-control" id="fileInput" accept="image/*" aria-describedby="FileHelp">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <img id="preview" src="#" alt="Image Preview" class="img-fluid mt-3 mx-auto justify-content-center">
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

   </x-app-layout> 