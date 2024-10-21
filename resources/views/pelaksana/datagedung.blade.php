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
<div class="my-4">
  <select name="" id="" class="form-control form-select">
    <option value="">testing 1</option>
    <option value="">testing 1</option>
    <option value="">testing 1</option>
    <option value="">testing 1</option>
    <option value="">testing 1</option>
    <option value="">testing 1</option>
    <option value="">testing 1</option>
  </select>
<img src="https://i.pinimg.com/736x/5b/6f/51/5b6f51ca48b8a1ea93b943df861ef391.jpg" alt="image-1" class="img-fluid mt-3 mx-auto justify-content-center">  
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
   </x-app-layout>