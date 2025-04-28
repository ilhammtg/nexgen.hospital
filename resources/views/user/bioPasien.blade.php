@extends('user.user-master')

@section('content')
<!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Detail Data Pasien</h5>
        </div>
        <div class="card-body">
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <div class="form-control bg-light">{{ $data->name }}</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
              <div class="form-control bg-light">{{ $data->nik }}</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Phone No</label>
            <div class="col-sm-10">
              <div class="form-control bg-light">{{ $data->phone }}</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <div class="form-control bg-light" style="min-height: 80px;">{{ $data->alamat }}</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
              <div class="form-control bg-light">{{ $data->tgl_lahir }}</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <div class="form-control bg-light">{{ $data->jenis_kelamin }}</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">No BPJS</label>
            <div class="col-sm-10">
              <div class="form-control bg-light">{{ $data->no_bpjs }}</div>
            </div>
          </div>
                <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <a href="{{ route('users.form-biopasien') }}" class="btn btn-primary">Edit Data</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Basic with Icons -->
               
              </div>

              <!-- Multi Column with Form Separator -->
           

              <!-- Collapsible Section -->
          
              <!-- Form with Tabs -->
          
              <!-- Form Alignment -->
            
            </div>
            <!-- / Content -->

            @endsection