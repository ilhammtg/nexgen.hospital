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
                            @method('PUT')

                            <!-- Nama -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', $data->name) }}" readonly />
                                </div>
                            </div>

                            <!-- NIK -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nik"
                                        value="{{ old('nik', $data->pasien->nik ?? '') }}" required minlength="16"
                                        maxlength="16" />
                                </div>
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" class="form-control" name="phone" required
                                            pattern="^[1-9][0-9]{7,14}$" value="{{ $data->phone ? '' : old('phone') }}"
                                            placeholder="{{ $data->phone ?? '-' }}" />
                                    </div>
                                </div>
                            </div>

                            <!-- Nomor Keluarga -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nomor Keluarga</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" class="form-control" name="family_phone" required
                                            pattern="^[1-9][0-9]{7,14}$"
                                            value="{{ optional($data->pasien)->family_phone ? '' : old('family_phone') }}"
                                            placeholder="{{ optional($data->pasien)->family_phone ?? '-' }}" />
                                    </div>
                                </div>
                            </div>

                            <!-- Wilayah -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Alamat Lengkap</label>
                                <div class="col-sm-10">
                                    <select id="provinsi" name="provinsi" class="form-select mt-2" required>
                                        <option value="">Memuat provinsi...</option>
                                    </select>

                                    <select id="kabupaten" name="kabupaten" class="form-select mt-2" required>
                                        <option value="">Pilih Kabupaten/Kota</option>
                                    </select>

                                    <select id="kecamatan" name="kecamatan" class="form-select mt-2" required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>

                                    <select id="kelurahan" name="kelurahan" class="form-select mt-2" required>
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>

                                    <textarea name="alamat_lengkap" class="form-control mt-2" rows="2" required
                                        placeholder="Detail alamat anda, seperti jalan, lorong, nomer rumah..">{{ old('alamat_lengkap', $data->pasien->alamat_lengkap ?? '') }}</textarea>
                                </div>
                            </div>

                            <!-- Umur -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Umur</label>
                                <div class="col-sm-10">
                                    <input type="number" name="umur" class="form-control"
                                        value="{{ old('umur', $data->pasien->umur ?? '') }}" required min="1"
                                        max="120" />
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        value="{{ old('tanggal_lahir', $data->pasien->tanggal_lahir ?? '') }}"
                                        max="{{ date('Y-m-d') }}" required />
                                </div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="" disabled
                                            {{ empty($data->pasien->jenis_kelamin) ? 'selected' : '' }}>
                                            Pilih Jenis Kelamin
                                        </option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin', $data->pasien->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin', $data->pasien->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- No BPJS -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">No BPJS</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_bpjs" class="form-control"
                                        value="{{ old('no_bpjs', $data->pasien->no_bpjs ?? '') }}"
                                        placeholder="Isi jika memiliki" />
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="row justify-content-end">
                                <div class="col-sm-10 offset-sm-2">
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
@endsection



@section('scripts')
    <script>
        $(document).ready(function() {
            // Load provinsi saat halaman dimuat
            $.ajax({
                url: '/get-provinces',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#provinsi').empty();
                    $('#provinsi').append('<option value="">Pilih Provinsi</option>');
                    $.each(data, function(key, value) {
                        $('#provinsi').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });

                    // Jika ada data lama, set nilai yang sesuai
                    @if (isset($data->pasien->provinsi))
                        $('#provinsi').val('{{ $data->pasien->provinsi }}').trigger('change');
                    @endif
                }
            });

            // Ketika provinsi dipilih
            $('#provinsi').change(function() {
                var province_id = $(this).val();
                if (province_id) {
                    $('#kabupaten').empty().append('<option value="">Memuat kabupaten...</option>').prop(
                        'disabled', false);

                    $.ajax({
                        url: '/get-regencies/' + province_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kabupaten').empty();
                            $('#kabupaten').append(
                                '<option value="">Pilih Kabupaten/Kota</option>');
                            $.each(data, function(key, value) {
                                $('#kabupaten').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });

                            // Jika ada data lama, set nilai yang sesuai
                            @if (isset($data->pasien->kabupaten))
                                $('#kabupaten').val('{{ $data->pasien->kabupaten }}').trigger(
                                    'change');
                            @endif
                        }
                    });
                } else {
                    $('#kabupaten').empty().prop('disabled', true);
                    $('#kecamatan').empty().prop('disabled', true);
                    $('#kelurahan').empty().prop('disabled', true);
                }
            });

            // Ketika kabupaten dipilih
            $('#kabupaten').change(function() {
                var regency_id = $(this).val();
                if (regency_id) {
                    $('#kecamatan').empty().append('<option value="">Memuat kecamatan...</option>').prop(
                        'disabled', false);

                    $.ajax({
                        url: '/get-districts/' + regency_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kecamatan').empty();
                            $('#kecamatan').append('<option value="">Pilih Kecamatan</option>');
                            $.each(data, function(key, value) {
                                $('#kecamatan').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });

                            // Jika ada data lama, set nilai yang sesuai
                            @if (isset($data->pasien->kecamatan))
                                $('#kecamatan').val('{{ $data->pasien->kecamatan }}').trigger(
                                    'change');
                            @endif
                        }
                    });
                } else {
                    $('#kecamatan').empty().prop('disabled', true);
                    $('#kelurahan').empty().prop('disabled', true);
                }
            });

            // Ketika kecamatan dipilih
            $('#kecamatan').change(function() {
                var district_id = $(this).val();
                if (district_id) {
                    $('#kelurahan').empty().append('<option value="">Memuat kelurahan...</option>').prop(
                        'disabled', false);

                    $.ajax({
                        url: '/get-villages/' + district_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kelurahan').empty();
                            $('#kelurahan').append(
                                '<option value="">Pilih Kelurahan/Desa</option>');
                            $.each(data, function(key, value) {
                                $('#kelurahan').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });

                            // Jika ada data lama, set nilai yang sesuai
                            @if (isset($data->pasien->kelurahan))
                                $('#kelurahan').val('{{ $data->pasien->kelurahan }}');
                            @endif
                        }
                    });
                } else {
                    $('#kelurahan').empty().prop('disabled', true);
                }
            });
        });
    </script>
@endsection
