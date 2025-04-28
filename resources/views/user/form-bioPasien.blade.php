@extends('user.user-master')

@section('content')
<!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Form Data Pasien</h5>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="row mb-6">
                          <label class="col-sm-2 col-form-label" for="name">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="{{ $data -> name }}" />
                          </div>
                        </div>
                        <div class="row mb-6">
                          <label class="col-sm-2 col-form-label" for="nik">Nik</label>
                          <div class="col-sm-10">
                            <input
                              type="number"
                              class="form-control"
                              name="nik"
                              id="nik"
                              placeholder="Your NIK" />
                          </div>
                        </div>
                        <div class="row mb-6">
                          <label class="col-sm-2 col-form-label" for="phone">Phone No</label>
                          <div class="col-sm-10">
                            <input
                              type="text"
                              name="phone"
                              id="phone"
                              class="form-control phone-mask"
                              placeholder="{{ $data -> phone }}"
                              aria-label="{{ $data -> phone }}"
                              aria-describedby="basic-default-phone" />
                          </div>
                        </div>
                        <div class="row mb-6">
                          <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                          <div class="col-sm-10">
                            <textarea
                              name="alamat"
                              id="alamat"
                              class="form-control"
                              placeholder="Your address"
                              aria-label="Your address"
                              aria-describedby="basic-icon-default-message2"></textarea>
                          </div>
                        </div>
                        <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="tgl-lahir">Tanggal Lahir</label>
                        <div class="col-sm-10">
                          <input
                            type="text"
                            name="tgl-lahir"
                            id="tgl-lahir"
                            class="form-control dob-picker"
                            placeholder="YYYY-MM-DD" />
                        </div>
                      </div>
                       <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="jenis-kelamin">Jenis Kelamin</label>
                        <div class="col-sm-10">
                          <select id="jenis-kelamin" name="jenis-kelamin" class="select2 form-select" data-allow-clear="true">
                            <option value=""disabled selected style="color: #6c757d;" >Select</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
                        </div>
                      </div>
                           <div class="row mb-6">
                          <label class="col-sm-2 col-form-label" for="no-bpjs">No BPJS</label>
                          <div class="col-sm-10">
                            <input
                              type="text"
                              name="no-bpjs"
                              id="no-bpjs"
                              class="form-control phone-mask"
                              placeholder="Input your BPJS number if you have"
                              aria-label="Input your BPJS number if you have"
                              aria-describedby="basic-default-phone" />
                          </div>
                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <a href="{{ route('users.biopasien') }}" class="btn btn-secondary me-2">
                              <i class="bx bx-arrow-back"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">Send</button>
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