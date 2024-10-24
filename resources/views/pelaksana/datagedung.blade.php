<title>Dashboard-Data Apar</title>

@include('sidebar.pelaksana')

<x-app-layout>
    <!--  Row 1 -->
    <div class="row">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
             <h5 class="card-title fw-semibold mb-4">Forms</h5>
             <div class="d-flex justify-content-end">
            <a type="button" href="{{ route('gedung.tambah') }}" class="btn btn-primary m-1 justify-content-end">Tambah Data Gedung</a>
         </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">No Urut</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Gambar Gedung</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Aksi</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($gambargedungs as $gambargedung)
                    <tr>
                      <td class="border-bottom-0"><h6 class="fw-Bold mb-0 text-center">1</h6></td>
                      <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1"><img src="{{ asset('images/' . $gambargedung->image_gedung) }}" width="100"></h6>
                      </td>
                      <td class="border-bottom-0">
                       <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaldetail">
                         Detail
                      </button>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                        Edit
                     </button>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-Danger" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                         Delete
                      </button>
                      </td>
                    </tr> 
                    @endforeach
                  </tbody>
                </table>
              </div>
         
    </div>
  </div>

 
<!-- Modal detail -->
<div class="modal fade" id="modaldetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
 <div class="modal-content">
   <div class="modal-header">
     <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body">
    <div class="d-flex justify-content-end">
    <button type="button" class=" btn btn-success justify-content-end">Tambah Layout Gedung</button>
</div>
  <img id="preview" src="https://i.pinimg.com/564x/6a/e0/d3/6ae0d313ad0187ffdca38b4551ec8190.jpg" alt="Image Preview" class="img-fluid mt-3 mx-auto justify-content-center">
  </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
   </div>
 </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-header">
       <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
       ...
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="button" class="btn btn-primary">Save changes</button>
     </div>
   </div>
  </div>
  </div>
  
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
 <div class="modal-content">
   <div class="modal-header">
     <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body">
     ...
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="button" class="btn btn-primary">Save changes</button>
   </div>
 </div>
</div>
</div>
      </div>
   </x-app-layout>