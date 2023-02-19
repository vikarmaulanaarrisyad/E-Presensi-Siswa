<!-- Modal -->
<form action="{{ route('kesiswaan.import.excel') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" modal id="modalSiswaImport" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <li>
                                Menu ini digunakan untuk mengisi data peserta didik yang bersumber dari Aplikasi PPDB
                                dalam bentuk excel dengan Format xlsx
                            </li>
                            <li>
                                Pastikan dalam Excel hanya ada 1 worksheet yang berisi Data Peserta Didik
                            </li>
                            <li>
                                Pastikan dalam Excel nama kolum tidak boleh dirubah
                            </li>
                            <li>
                                Upload berulang tidak menjadi masalah, Program Otomatis akan melakukan Proses Insert
                                pada data yang belum ada saja
                            </li>
                            <li>
                                Berikut contoh file unggahan , silahkan <a download="contoh_template_siswa"
                                    href="{{ asset('templates/siswa_excel_template.xlsx') }}"
                                    class="btn btn-sm btn-success">download disini</a>
                            </li>
                            <li>
                                Silahkan Koreksi Data Excelnya Sesuai dengan Data Asli Apabila ada yang belum tepat, dan
                                pastikan menggunakan format unggahan yang telah disediakan.
                            </li>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="siswa">Import</label>
                        <input type="file" name="import_siswa" id="import_siswa" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </div>
    </div>
</form>
