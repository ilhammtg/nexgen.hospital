      @include('auth.auth-header')


      <div class="authentication-inner row m-0">
          <!-- /Left Text -->
          <div class="d-none d-lg-flex col-lg-8 p-0">
              <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                  <img src="{{ asset('/assets') }}/img/illustrations/registerimage.png" alt="auth-login-cover"
                      class="my-5 auth-illustration" data-app-light-img="illustrations/registerimage.png"
                      data-app-dark-img="illustrations/registerimage.png" />

                  <img src="{{ asset('/assets') }}/img/illustrations/bg-shape-image-light.png" alt="auth-login-cover"
                      class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                      data-app-dark-img="illustrations/bg-shape-image-dark.png" />
              </div>
          </div>
          <!-- /Left Text -->

          <!-- Register -->
          <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
              <div class="w-px-400 mx-auto mt-12 pt-5">
                  <h4 class="mb-1">Come be part of us now 🚀</h4>
                  <p class="mb-6">Get an extraordinary experience from us!</p>

                  <form id="formAuthentication" class="mb-6" action="{{ route('register.userRegis') }}"
                      method="POST">
                      @csrf

                      <div class="mb-4">
                          <label for="name" class="form-label">Full Name</label>
                          <input type="text" class="form-control" id="name" name="name"
                              placeholder="Enter your full name" autofocus />
                      </div>

                      <div class="mb-4">
                          <label class="form-label" for="phone">Phone Number</label>
                          <div class="input-group input-group-merge">
                              <span class="input-group-text">ID (+62)</span>
                              <input type="text" id="phone" name="phone" required pattern="^[1-9].*"
                                  class="form-control" placeholder="822 7381 1061" />
                          </div>
                      </div>

                      <div class="mb-4">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" class="form-control" id="email" name="email"
                              placeholder="Enter your email" />
                      </div>

                      <div class="mb-4 form-password-toggle">
                          <label class="form-label" for="password">Password</label>
                          <div class="input-group input-group-merge">
                              <input type="password" id="password" class="form-control" name="password"
                                  placeholder="················" aria-describedby="password" />
                              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                          </div>
                      </div>

                      <div class="mb-6">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms"
                                  required />
                              <label class="form-check-label" for="terms-conditions">
                                  I agree to the <a href="javascript:void(0);">privacy policy & terms</a>
                              </label>
                          </div>
                      </div>

                      <button type="submit" class="btn btn-primary w-100 py-2">Sign Up</button>
                  </form>

                  <p class="text-center">
                      <span>Already have an account?</span>
                      <a href="/login">
                          <span>Sign in instead</span>
                      </a>
                  </p>

                  <div class="divider my-6">
                      <div class="divider-text">or</div>
                  </div>

                  <div class="d-flex justify-content-center">
                      <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-facebook me-1_5">
                          <i class="tf-icons ti ti-brand-facebook-filled"></i>
                      </a>

                      <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-twitter me-1_5">
                          <i class="tf-icons ti ti-brand-twitter-filled"></i>
                      </a>

                      <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-github me-1_5">
                          <i class="tf-icons ti ti-brand-github-filled"></i>
                      </a>

                      <a href="{{ route('google.login') }}" class="btn btn-sm btn-icon rounded-pill btn-text-google">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <path fill="#4285F4"
                                  d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                              <path fill="#34A853"
                                  d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                              <path fill="#FBBC05"
                                  d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                              <path fill="#EA4335"
                                  d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                              <path fill="none" d="M1 1h22v22H1z" />
                          </svg>
                      </a>

                  </div>
              </div>
          </div>
          <!-- /Register -->
      </div>
      </div>

      <!-- / Content -->
      @include('auth.auth-footer')
