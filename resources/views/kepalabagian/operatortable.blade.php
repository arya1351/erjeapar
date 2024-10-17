@include('sidebar.kepalabagian')
<x-app-layout>
 <!--  Row 1 -->
 <div class="row">
   
    <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <button type="button" class="btn btn-outline-primary m-1 justify-content-end">Primary</button>
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
                            <button type="button" class="btn btn-outline-primary m-1">Danger</button>
                            <button type="button" class="btn btn-outline-danger m-1">Danger</button>
                        </td>
                        </tr> 
                      </tbody>
                    </table>
                  </div>
             
        </div>
      </div>
</x-app-layout>
