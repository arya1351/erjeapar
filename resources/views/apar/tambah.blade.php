<title>Dashboard-Data Apar</title>

@include('sidebar.pelaksana')

<x-app-layout>
        <div class="container-fluid">
              <div class="card">
                <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Forms</h5>
                  <form>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Jenis Apar</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Merek</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Lokasi</label>
                        <select name="" id="" class="form-control form-select">
                          <option value="" class="">Pilih Lokasi</option>
                          <option value="Pilih Lokasi" class="form control">Contoh 1</option>
                          <option value="Pilih Lokasi" class="form control">Contoh 1</option>
                          <option value="Pilih Lokasi" class="form control">Contoh 1</option>
                        </select>
                      </div>
                    <div class="mb-3">
                      <label for="expired" class="form-label">Tanggal Expired</label>
                      <input type="date" name="expired" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Tanggal Expired</label>
                      <input type="text" name="keterangan" class="form-control" id="keterangan">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            
          </div>
    </div>
   </x-app-layout>