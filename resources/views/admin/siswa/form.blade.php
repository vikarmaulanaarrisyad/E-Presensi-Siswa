<x-modal size="modal-lg" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Kelas
    </x-slot>

    @method('POST')

    <input type="hidden" name="academic_id" value="{{ $tahunPelajaranAktif }}">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-6">
            <div class="form-group">
                <label for="student_name">Nama Lengkap</label>
                <input type="text" name="student_name" id="student_name" class="form-control" autocomplete="off">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-6">
            <div class="form-group">
                <label for="student_identification_school">NISN</label>
                <input type="number" name="student_identification_school" id="student_identification_school"
                    class="form-control" autocomplete="off" min="0">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-6">
            <div class="form-group">
                <label for="student_identification_number">NIS</label>
                <input type="number" name="student_identification_number" id="student_identification_number"
                    class="form-control" autocomplete="off" min="0">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-6">
            <div class="form-group">
                <label for="student_registration_number">NIK</label>
                <input type="number" name="student_registration_number" id="student_registration_number"
                    class="form-control" autocomplete="off" min="0">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-6">
            <div class="form-group">
                <label for="place_birth">Tempat Lahir</label>
                <input type="text" name="place_birth" id="place_birth" class="form-control" autocomplete="off">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-6">
            <div class="form-group">
                <label for="date_birth">Tanggal Lahir</label>
                <div class="form-group">
                    <div class="input-group datepicker" id="date_birth" data-target-input="nearest">
                        <input type="text" name="date_birth" class="form-control datetimepicker-input"
                            data-target="#date_birth" data-toggle="datetimepicker" autocomplete="off" />
                        <div class="input-group-append" data-target="#date_birth" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-4">
            <div class="form-group">
                <label for="gander">Jenis Kelamin</label>
                <select name="gander" id="gander" class="form-control">
                    <option disabled selected>Pilih jenis kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-4">
            <div class="form-group">
                <label for="student_phone_number">Nomor Hp</label>
                <input type="number" name="student_phone_number" id="student_phone_number" class="form-control"
                    autocomplete="off" min="0">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-4">
            <div class="form-group">
                <label for="child_number">Anak Ke</label>
                <input type="number" name="child_number" id="child_number" class="form-control" autocomplete="off"
                    min="0">
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-6">
            <div class="form-group">
                <label for="father_name">Nama Ayah</label>
                <input type="text" name="father_name" id="father_name" class="form-control" autocomplete="off">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-6">
            <div class="form-group">
                <label for="mother_name">Nama Ibu</label>
                <input type="text" name="mother_name" id="mother_name" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-4">
            <div class="form-group">
                <label for="father_work">Pekerjaan Ayah</label>
                <select name="father_work" id="father_work" class="form-control">
                    <option disabled selected>
                        Pilih pekerjaan
                    </option>
                    <option value="tidak bekerja">Tidak Bekerja</option>
                    <option value="PNS">PNS</option>
                    <option value="pensiunan">Pensiunan</option>
                    <option value="TNI / Polisi">TNI / Polisi</option>
                    <option value="Guru / Dosen">Guru / Dosen</option>
                    <option value="pegawai swasta">Pegawai Swasta</option>
                    <option value="pedagang">Pedagang</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-4">
            <div class="form-group">
                <label for="mother_work">Pekerjaan Ibu</label>
                <select name="mother_work" id="mother_work" class="form-control">
                    <option disabled selected>
                        Pilih pekerjaan
                    </option>
                    <option value="tidak bekerja">Tidak Bekerja</option>
                    <option value="PNS">PNS</option>
                    <option value="pensiunan">Pensiunan</option>
                    <option value="TNI / Polisi">TNI / Polisi</option>
                    <option value="Guru / Dosen">Guru / Dosen</option>
                    <option value="pegawai swasta">Pegawai Swasta</option>
                    <option value="pedagang">Pedagang</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-4">
            <label for="income">Penghasilan Orang Tua</label>
            <select name="income" id="income" class="form-control custom">
                <option selected disabled>Pilih penghasilan</option>
                <option value="500000">Rp. 500.000</option>
                <option value="1000000">Rp. 1.000.000</option>
                <option value="2000000">Rp.2000.000</option>
                <option value="3000000">Rp. 3.000.000</option>
                <option value="4000000">Rp. 4.000.000</option>
                <option value="5000000">Rp. 5000.000</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <div class="form-group">
                <label for="student_address">Alamat</label>
                <textarea name="student_address" id="student_address" cols="5" rows="5" class="form-control"></textarea>
            </div>
        </div>
    </div>


    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary"><i
                class="fas fa-save"></i>
            Simpan</button>
    </x-slot>
</x-modal>
