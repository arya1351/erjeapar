@include('sidebar.kepalabagian')
<x-app-layout>
 <!--  Row 1 -->
 <div class="row">
   
      <div class="col">
        <div class="col-lg">
          <!-- Yearly Breakup -->
          <div class="card overflow-hidden">
            <div class="card-body">
              <div class="mb-3">
                <label for="select" class="form-label">Disabled select menu</label>
                <select id="select" class="form-select">
                  <option>Gedung 1</option>
                  <option>Gedung 2</option>
                  <option>Gedung 3</option>
                  <option>Gedung 4</option>
                </select>
              </div>
              <div class="position-relative d-flex">
              <img src="https://i.pinimg.com/564x/c8/d9/93/c8d9936f4bf774498d13229d95e8d172.jpg" style="width:24rem;" class="card-img-top p-4 rounded align-items-center justify-content-center" alt="...">
              </div>
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                the
                card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
