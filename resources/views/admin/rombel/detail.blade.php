@extends('layouts.app')

@section('title', 'Detail Rombel')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('rombel.index') }}">Rombongan Belajar</a></li>
    <li class="breadcrumb-item active">Detail Rombongan Belajar</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Rombongan Belajar</h3>
                    <div class="card-tools">
                        <button onclick="addForm(`{{ route('rombel.tambah.siswa', $kelas->id) }}`)"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Tambah Siswa
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="text-bold text-center">Tahun Ajaran</h5>
                            <p class="text-center">{{ $kelas->academic->academic_name }} -
                                {{ $kelas->academic->semester->semester_name }}</p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="text-bold text-center">Rombel</h5>
                            <p class="text-center">{{ $kelas->class_rombel }}</p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="text-bold text-center">Kelas</h5>
                            <p class="text-center">{{ $kelas->class_name }}</p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="text-bold text-center">Wali Kelas</h5>
                            <p class="text-center">{{ $kelas->class_name }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <hr>
                            <h5 class="text-bold">
                                TOTAL SISWA {{ $kelasSiswa->count() }}/{{ $kelas->capacity }}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <table class="table table-striped">
                                <thead>

                                    <tr>
                                        <th>No</td>
                                        <th>Nama Lengkap</td>
                                        <th>NISN</td>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelasSiswa as $siswa)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $siswa->student_name }}</td>
                                            <td>{{ $siswa->student_identification_school }}</td>
                                            <td>
                                                <button
                                                    onclick="deleteData(`{{ route('rombel.siswa.destroy', $siswa->id) }}`, `{{ $siswa->student_name }}`)"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                    Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.rombel.form')

@endsection

@include('layouts.includes.datatable')


@push('scripts')
    <script>
        let modal = '#modal-form';
        let table;

        table = $('.table-siswa').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('rombel.siswa.data') }}'
            },
            columns: [{
                    data: 'siswa_id',
                }, {
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'nama_siswa',
                },
                {
                    data: 'nisn_siswa',
                },
            ],
        });

        function addForm(url, title =
            `Tambah Siswa ke dalam {{ $kelas->class_name }} {{ $kelas->class_rombel }} `) {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('POST');

            resetForm(`${modal} form`);
        }


        function submitForm(originalForm) {
            if ($('input:checked').length < 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Pilih data yang akan ditambahkan',
                    showConfirmButton: false,
                    timer: 2000
                });

                return;
            }

            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false
                })
                .done(response => {
                    $(modal).modal('hide');
                    if (response.status = 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                    window.location.reload();
                })
                .fail(errors => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: false,
                        timer: 2000
                    })

                    if (errors.status == 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                });
        }

        function deleteData(url, name, rombel) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })
            swalWithBootstrapButtons.fire({
                title: 'Perhatian',
                text: 'Apakah anda yakin ingin menghapus data ' + name +
                    ' ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(48, 133, 214)',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, {
                            '_method': 'delete'
                        })
                        .done(response => {
                            if (response.status = 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                window.location.reload();

                            }
                        })
                        .fail(errors => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: errors.responseJSON.message,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            window.location.reload();

                        });
                }
            })
        }


        $('[name=select_all]').on('click', function() {
            $(':checkbox').prop('checked', this.checked);
        });
    </script>
@endpush
