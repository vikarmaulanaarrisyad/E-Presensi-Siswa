  <div class="row">
      <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
              <div class="inner">

                  <h3>{{ $jumlahKelas }}</h3>
                  <p>Jumlah Kelas</p>
              </div>
              <div class="icon">
                  <i class="fas fa-building"></i>
              </div>
              <a href="{{ route('kelas.index') }}" class="small-box-footer">Lihat Detail <i
                      class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>

      <div class="col-lg-3 col-6">

          <div class="small-box bg-success">
              <div class="inner">
                  <h3>{{ $jumlahSiswaAktif }}</h3>
                  <p>Jumlah Siswa Aktif</p>
              </div>
              <div class="icon">
                  <i class="fas fa-users"></i>
              </div>
              <a href="{{ route('kesiswaan.index') }}" class="small-box-footer">Lihat Detail <i
                      class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>

      <div class="col-lg-3 col-6">

          <div class="small-box bg-warning">
              <div class="inner">
                  <h3>{{ $jumlahSiswaTidakAktif }}</h3>
                  <p>Jumlah Siswa Tidak Aktif</p>
              </div>
              <div class="icon">
                  <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>

      <div class="col-lg-3 col-6">

          <div class="small-box bg-danger">
              <div class="inner">
                  <h3>{{ $jumlahSiswaPutusSekolah }}</h3>
                  <p>Jumlah Siswa Keluar</p>
              </div>
              <div class="icon">
                  <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>

  </div>

  <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Siswa Hadir</span>
                  <span class="info-box-number">
                      10
                      <small>%</small>
                  </span>
              </div>

          </div>

      </div>

      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Siswa Tidak Hadir</span>
                  <span class="info-box-number">41,410</span>
              </div>

          </div>

      </div>


      <div class="clearfix hidden-md-up"></div>
      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hospital"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Siswa Sakit</span>
                  <span class="info-box-number">760</span>
              </div>

          </div>

      </div>

      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-info"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Siswa Izin</span>
                  <span class="info-box-number">2,000</span>
              </div>

          </div>

      </div>

  </div>

  <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Guru Hadir</span>
                  <span class="info-box-number">
                      10
                      <small>%</small>
                  </span>
              </div>

          </div>

      </div>

      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Guru Tidak Hadir</span>
                  <span class="info-box-number">41,410</span>
              </div>

          </div>

      </div>


      <div class="clearfix hidden-md-up"></div>
      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hospital"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Guru Sakit</span>
                  <span class="info-box-number">760</span>
              </div>

          </div>

      </div>

      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-info"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Guru Izin</span>
                  <span class="info-box-number">2,000</span>
              </div>

          </div>

      </div>

  </div>
