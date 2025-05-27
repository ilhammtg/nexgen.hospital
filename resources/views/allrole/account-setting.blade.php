@extends('allrole.allrole-master')

@section('content')
    <div class="card-body pt-4">
        <form id="formAccountSettings" method="POST" action="{{ route('users.updateAccount') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    {{-- Avatar Preview --}}
                    <img src="{{ !empty($data->image) && file_exists(public_path('storage/user-image/' . $data->image))
                        ? asset('storage/user-image/' . $data->image)
                        : 'https://ui-avatars.com/api/?name=' . urlencode($data->name) . '&background=0D8ABC&color=fff' }}"
                        alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />

                    {{-- Upload Controls --}}
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="ti ti-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" name="image" class="account-file-input" hidden
                                accept="image/png, image/jpeg" />
                        </label>

                        <button type="submit" formaction="{{ route('users.resetImage') }}" formmethod="POST"
                            name="resetImage" class="btn btn-label-secondary account-image-reset mb-4">
                            @csrf
                            @method('PUT')
                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <div>Allowed JPG, JPEG or PNG. Max size 800KB.</div>
                    </div>
                </div>
            </div>

            {{-- Info Form --}}
            <div class="card-body pt-4">
                <div class="row">
                    <div class="mb-4 col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="{{ old('name', $data->name) }}" autofocus required />
                    </div>

                    <div class="mb-4 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email" readonly
                            value="{{ $data->email }}" />
                    </div>

                    <div class="mb-4 col-md-6">
                        <label class="form-label" for="phone">Phone Number</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">ID (+62)</span>
                            <input type="text" id="phone" name="phone" required pattern="^[1-9][0-9]{9,12}$"
                                class="form-control" value="{{ old('phone', $data->phone) }}" />
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-3">Save changes</button>
                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Delete Account --}}
    <div class="card">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
            <div class="mb-6 col-12 mb-0">
                <div class="alert alert-warning">
                    <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
            </div>
            <form id="formAccountDeactivation" onsubmit="return false">
                <div class="form-check my-8">
                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                    <label class="form-check-label" for="accountActivation">
                        I confirm my account deactivation
                    </label>
                </div>
                <button type="submit" class="btn btn-danger deactivate-account" disabled>
                    Deactivate Account
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('upload').addEventListener('change', function(e) {
            const [file] = this.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('uploadedAvatar').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Optional: Validasi nomor telepon
        document.getElementById('phone').addEventListener('blur', function() {
            if (this.value.startsWith("0")) {
                alert("Phone number cannot start with 0.");
                this.value = '';
            }
        });
    </script>
@endsection
