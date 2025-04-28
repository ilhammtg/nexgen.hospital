
@include('auth.auth-header')

  <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-8 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="{{ asset('/assets') }}/img/illustrations/auth-forgot-password-illustration-light.png"
              alt="auth-login-cover"
              class="my-5 auth-illustration"
              data-app-light-img="illustrations/auth-forgot-password-illustration-light.png"
              data-app-dark-img="illustrations/auth-forgot-password-illustration-light.png" />

            <img
              src="{{ asset('/assets') }}/img/illustrations/bg-shape-image-light.png"
              alt="auth-login-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <!-- /Left Text -->

<!-- Forgot Password -->
<div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
  <div class="w-px-400 mx-auto mt-12 mt-5">
    <h4 class="mb-1">Forgot Password? 🔒</h4>
    <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p>

    @if (session('status'))
      <div class="alert alert-success mb-4" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <form id="formAuthentication" class="mb-6" method="POST" action="">
      @csrf
      <div class="mb-6">
        <label for="email" class="form-label">Email</label>
        <input
          type="email"
          class="form-control @error('email') is-invalid @enderror"
          id="email"
          name="email"
          placeholder="Enter your email"
          value="{{ old('email') }}"
          required
          autofocus
        />
        @error('email')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <button class="btn btn-primary d-grid w-100" type="submit">Send Reset Link</button>
    </form>

    <div class="text-center">
      <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
        <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
        Back to login
      </a>
    </div>
  </div>
</div>
<!-- /Forgot Password -->

@include('auth.auth-footer')
    