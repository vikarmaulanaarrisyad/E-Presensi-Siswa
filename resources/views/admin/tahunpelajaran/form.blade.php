<x-modal size="modal-md" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Tahun Pelajaran
    </x-slot>

    @method('POST')

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
                <label for="academic_name">Tahun Pelajaran</label>
                <input type="text" name="academic_name" id="academic_name" class="form-control"
                    placeholder="Tahun Pelajaran 2022/2023" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
                <label for="semester_id">Semester</label>
                <select name="semester_id" id="semester_id" class="form-control" autocomplete="off">
                    <option disabled selected>Pilih Semester</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
                <label for="academic_start">Tanggal Mulai Tahun Pelajaran</label>
                <div class="input-group datepicker" id="academic_start" data-target-input="nearest">
                    <input type="text" name="academic_start" class="form-control datetimepicker-input"
                        data-target="#academic_start" data-toggle="datetimepicker" autocomplete="off" />
                    <div class="input-group-append" data-target="#academic_start" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
                <label for="academic_end">Tanggal Akhir Tahun Pelajaran</label>
                <div class="input-group datepicker" id="academic_end" data-target-input="nearest">
                    <input type="text" name="academic_end" class="form-control datetimepicker-input"
                        data-target="#academic_end" data-toggle="datetimepicker" autocomplete="off" />
                    <div class="input-group-append" data-target="#academic_end" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary"><i
                class="fas fa-save"></i>
            Simpan</button>
    </x-slot>
</x-modal>
