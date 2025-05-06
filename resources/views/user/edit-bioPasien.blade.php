@extends('user.user-master')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-xxl">
      <div class="card mb-6">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Form Edit Data Pasien</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('users.UpdateBiopasien') }}" method="POST">
            @csrf
            @method('PUT') <!-- karena ini edit/update -->
            
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="name">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $data->name) }}" required />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="nik">NIK</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="nik" id="nik" value="{{ old('nik', $data->pasien->nik ?? '') }}" required />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="phone">Phone No</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $data->phone) }}" required />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
              <div class="col-sm-10">
                <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $data->pasien->alamat ?? '') }}</textarea>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="tanggal_lahir">Tanggal Lahir</label>
              <div class="col-sm-10">
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $data->pasien->tanggal_lahir ?? '') }}" required />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                  <option value="" disabled {{ empty($data->pasien->jenis_kelamin) ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                  <option value="Laki-laki" {{ (old('jenis_kelamin', $data->pasien->jenis_kelamin ?? '') == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ (old('jenis_kelamin', $data->pasien->jenis_kelamin ?? '') == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="no_bpjs">No BPJS</label>
              <div class="col-sm-10">
                <input type="text" name="no_bpjs" id="no_bpjs" class="form-control" value="{{ old('no_bpjs', $data->pasien->no_bpjs ?? '') }}" placeholder="Isi jika punya" />
              </div>
            </div>

            <div class="row justify-content-end">
              <div class="col-sm-10">
                <a href="{{ route('users.biopasien') }}" class="btn btn-secondary me-2">
                  <i class="bx bx-arrow-back"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="bx bx-save"></i> Simpan Perubahan
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection
