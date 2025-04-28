@include('auth.auth-header')

  <!-- Left Text -->
  <div class="d-none d-lg-flex col-lg-8 p-0">
    <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
      <img
        src="{{ asset('/assets/img/illustrations/auth-reset-password-illustration-light.png') }}"
        alt="auth-reset-password-cover"
        class="my-5 auth-illustration"
        data-app-light-img="illustrations/auth-reset-password-illustration-light.png"
        data-app-dark-img="illustrations/auth-reset-password-illustration-dark.png" />

      <img
        src="{{ asset('/assets/img/illustrations/bg-shape-image-light.png') }}"
        alt="auth-reset-password-cover"
        class="platform-bg"
        data-app-light-img="illustrations/bg-shape-image-light.png"
        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
    </div>
  </div>
  <!-- /Left Text -->

  <!-- Reset Password -->
  <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-6 p-sm-12">
    <div class="w-px-400 mx-auto mt-12 pt-5">
      <h4 class="mb-1">Reset Password 🔒</h4>
      <p class="mb-6">
        <span class="fw-medium">Your new password must be different from previously used passwords</span>
      </p>

      <form id="formAuthentication" class="mb-6" method="POST" action="/reset-password">
        @csrf

        @if(isset($token))
        <input type="hidden" name="token" id="token" value="{{ $token }}">
        @endif        

        <input type="hidden" name="email" value="{{ request()->email }}">

        <div class="mb-6 form-password-toggle">
          <label class="form-label" for="password">New Password</label>
          <div class="input-group input-group-merge">
            <input
              type="password"
              id="password"
              name="password"
              class="form-control @error('password') is-invalid @enderror"
              placeholder="New Password"
              required
            />
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
          </div>
          @error('password')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="mb-6 form-password-toggle">
          <label class="form-label" for="password_confirmation">Confirm Password</label>
          <div class="input-group input-group-merge">
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              class="form-control"
              placeholder="Confirm Password"
              required
            />
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
          </div>
        </div>

        <button class="btn btn-primary d-grid w-100 mb-6" type="submit">Set new password</button>

        <div class="text-center">
          <a href="{{ route('login') }}">
            <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
            Back to login
          </a>
        </div>
      </form>
    </div>
  </div>
  <!-- /Reset Password -->
</div>

@include('auth.auth-footer')
