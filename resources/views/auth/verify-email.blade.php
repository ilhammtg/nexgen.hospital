@include('auth.auth-header')

 <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-8 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="{{ asset('/assets') }}/img/illustrations/email-verify.png"
              alt="auth-login-cover"
              class="my-5 auth-illustration"
              data-app-light-img="illustrations/email-verify.png"
              data-app-dark-img="illustrations/email-verify.png" />

            <img
              src="{{ asset('/assets') }}/img/illustrations/bg-shape-image-light.png"
              alt="auth-login-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <!-- /Left Text -->

<!-- Verify Email Page -->
<div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-6 p-sm-12">
  <div class="w-px-400 mx-auto mt-12">
    <h4 class="mb-1 text-center">Verify your email ✉️</h4>
    <p class="text-start">
      We’ve sent an account activation link to your email address:
      <strong>{{ Auth::user()->email }}</strong><br>
      Please check your inbox and click the link to verify.
    </p>

    @if (session('message'))
      <div class="alert alert-success my-3">
        {{ session('message') }}
      </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <button type="submit" class="btn btn-outline-primary w-100 my-4">
        Send verification email
      </button>
    </form>

    <div class="text-center mt-4">
      <p class="mb-0 text-muted" style="font-size: 0.9rem;">
        Didn't get the email? Check your spam folder or click the button above.
      </p>
    </div>
  </div>
</div>
<!-- / Verify Email Page -->

@include('auth.auth-footer')
