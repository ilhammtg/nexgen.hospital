@extends('user.user-master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-2 text-center">
                                @if ($data->image)
                                    <img src="{{ asset('storage/user-image/' . $data->image) }}" alt="Foto Profil"
                                        class="rounded-circle img-fluid" style="width: 80px; height: 80px;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($data->name) }}&background=0D8ABC&color=fff"
                                        alt="Avatar" class="rounded-circle img-fluid" style="width: 80px; height: 80px;">
                                @endif
                            </div>

                            <div class="col-md-10">
                                <h5 class="mb-1">{{ $data->name }}</h5>
                                <p class="mb-1">NIK: {{ $data->pasien->nik ?? '-' }}</p>

                                @php
                                    $isComplete =
                                        $data->pasien &&
                                        $data->pasien->nik &&
                                        $data->pasien->umur &&
                                        $data->pasien->tanggal_lahir &&
                                        $data->pasien->jenis_kelamin &&
                                        $data->phone &&
                                        $data->pasien->family_phone &&
                                        $data->pasien->alamat;
                                @endphp
                                <span class="badge bg-{{ $isComplete ? 'success' : 'warning' }}">
                                    {{ $isComplete ? 'Lengkap' : 'Belum Lengkap' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon</label>
                                <div class="form-control-plaintext">
                                    {{ $data->phone ? '0' . $data->phone : '-' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Keluarga</label>
                                <div class="form-control-plaintext">
                                    {{ $data->pasien?->family_phone ? '0' . $data->pasien->family_phone : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Umur</label>
                                <div class="form-control-plaintext">{{ $data->pasien->umur ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="form-control-plaintext">{{ $data->pasien->tanggal_lahir ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="form-control-plaintext">{{ $data->pasien->jenis_kelamin ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. BPJS</label>
                                <div class="form-control-plaintext">{{ $data->pasien->no_bpjs ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <div class="form-control-plaintext text-wrap">
                                {{ $data->pasien->alamat ?? '-' }}
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('users.EditBiopasien') }}" class="btn btn-primary">
                                <i class="bx bx-edit"></i> Edit Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
