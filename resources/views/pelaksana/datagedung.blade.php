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
                               <h6 class="fw-semibold mb-0">Id</h6>
                             </th>
                             <th class="border-bottom-0">
                               <h6 class="fw-semibold mb-0">Assigned</h6>
                             </th>
                             <th class="border-bottom-0">
                               <h6 class="fw-semibold mb-0">Name</h6>
                             </th>
                             <th class="border-bottom-0">
                               <h6 class="fw-semibold mb-0">Priority</h6>
                             </th>
                             <th class="border-bottom-0">
                               <h6 class="fw-semibold mb-0">Aksi</h6>
                             </th>
                           </tr>
                         </thead>
                         <tbody>
                           <tr>
                             <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                             <td class="border-bottom-0">
                                 <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                                 <span class="fw-normal">Web Designer</span>                          
                             </td>
                             <td class="border-bottom-0">
                               <p class="mb-0 fw-normal">Elite Admin</p>
                             </td>
                             <td class="border-bottom-0">
                               <div class="d-flex align-items-center gap-2">
                                 <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                               </div>
                             </td>
                             <td class="border-bottom-0">
                               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                  Edit
                               </button>
                               <!-- Button trigger modal -->
                               <button type="button" class="btn btn-Danger" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                  Delete
                               </button>
                           </td>
                           </tr> 
                           
                         </tbody>
                       </table>
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