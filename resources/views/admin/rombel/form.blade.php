<x-modal size="modal-lg" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Kelas
    </x-slot>

    @method('POST')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-siswa">
                <thead>
                    <tr>
                        <td>
                            <input type="checkbox" name="select_all" id="select_all">
                        </td>
                        <td>No</td>
                        <td>NISN</td>
                    </tr>
                </thead>
            </table>
        </div>

    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>
            Simpan</button>
    </x-slot>
</x-modal>
