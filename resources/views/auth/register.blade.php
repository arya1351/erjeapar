{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<x-guest-layout>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
          class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
          <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
              <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                  <div class="card-body">
                    <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                      <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                    </a>
                    <p class="text-center">Your Social Campaigns</p>
                    <form method="POST" action="{{ route('register') }}">
                       @csrf
                      <div class="mb-3">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <label for="namelabel" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp">
                      </div>
                      <div class="mb-4">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <label for="emaillabel" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-4">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <label for="passwordlabel" class="form-label">{{ __('Password') }}</label>
                        <input type="password" class="form-control" name="password" id="password"
                        required autocomplete="current-password">
                      </div>
                      <div class="mb-4">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        <label for="passwordlabel" class="form-label">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                        required autocomplete="current-password">
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="form-check">
                          <input class="form-check-input primary" type="checkbox" name="remember" value="" id="remember_me" checked>
                          <label class="form-check-label text-dark" for="flexCheckChecked">
                            {{ __('Remember me') }}
                          </label>
                        </div>
                        <a class="text-primary fw-bold" href="">Forgot Password ?</a>
                      </div>
                      
                      <button type="submit"  class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </x-guest-layout>
