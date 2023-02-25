<x-modal size="modal-md" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Kelas
    </x-slot>

    @method('POST')

    <input type="hidden" name="academic_id" value="{{ $tahunPelajaranAktif }}">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
                <label for="class_level">Tingkat Kelas</label>
                <select name="class_level" id="class_level" class="form-control class_level">
                    <option disabled selected>Pilih Tingkat</option>
                    <option value="7">Kelas 7</option>
                    <option value="8">Kelas 8</option>
                    <option value="9">Kelas 9</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
                <label for="class_name">Nama Kelas</label>
                <input type="text" name="class_name" id="class_name" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
                <label for="class_rombel">Nama Rombel</label>
                <input type="text" name="class_rombel" id="class_rombel" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
                <label for="capacity">Kapasitas Kelas</label>
                <input type="number" name="capacity" id="capacity" class="form-control" autocomplete="off"
                    min="0">
            </div>
        </div>
    </div>



    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary"><i
                class="fas fa-save"></i>
            Simpan</button>
    </x-slot>
</x-modal>
