<title>Dashboard-User</title>

@include('sidebar.pelaksana')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row">
      
        <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Special title treatment</h5>
                              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                              </div>
                            </div>
                          </div>
                  </div>
                </div>
        </div>
    </div>
</x-app-layout>
