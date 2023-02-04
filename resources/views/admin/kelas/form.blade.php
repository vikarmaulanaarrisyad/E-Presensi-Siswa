<x-modal size="modal-md" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Kelas
    </x-slot>

    @method('POST')

    <input type="hidden" name="academic_id" value="{{ $tahunPelajaranAktif }}">

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

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary"><i
                class="fas fa-save"></i>
            Simpan</button>
    </x-slot>
</x-modal>
