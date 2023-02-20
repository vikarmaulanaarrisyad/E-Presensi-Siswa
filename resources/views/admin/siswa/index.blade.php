@extends('layouts.app')

@section('title', 'Daftar Siswa')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Siswa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <x-card>
                <x-slot name="header">
                    <div class="btn-group">
                        <button onclick="addForm(`{{ route('kesiswaan.store') }}`)" class="btn btn-sm btn-primary"><i
                                class="fas fa-plus-circle"></i> Tambah Data</button>

                        <button onclick="importData(`{{ route('kesiswaan.import.excel') }}`)" class="btn btn-success btn-sm">
                            <i class="fas fa-file-excel"></i>
                            Import Data</button>

                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-file-pdf"></i>
                            Export PDf
                        </button>
                        <div class="dropdown-menu">
                            @foreach ($kelas as $item)
                                <a class="dropdown-item" href="{{ route('kesiswaan.export_pdf', $item->id) }}"
                                    target="_blank">{{ $item->class_name }}
                                    {{ $item->class_rombel }}</a>
                            @endforeach
                        </div>
                    </div>
                </x-slot>

                {{-- Filter data --}}
                <div class="d-flex">
                    <div class="form-group">
                        <label for="status2">Status</label>
                        <select name="status2" id="status2" class="custom-select">
                            <option disabled selected>Pilih Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif
                                ({{ $jumlahSiswaAktif }})</option>
                            <option value="tidak aktif" {{ request('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak
                                Aktif ({{ $jumlahSiswaTidakAktif }})</option>
                            <option value="pindah sekolah" {{ request('status') == 'pindah sekolah' ? 'selected' : '' }}>
                                Pindah Sekolah ({{ $jumlahSiswaPindahSekolah }})</option>
                            <option value="keluar" {{ request('status') == 'keluar' ? 'selected' : '' }}>Keluar
                                ({{ $jumlahSiswaKeluar }})</option>
                        </select>
                    </div>
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <th width="5%">No</td>
                            <th>Nama Lengkap</td>
                            <th>NISN</td>
                            <th>Tanggal Lahir</td>
                            <th>Kelas</td>
                            <th>Umur</td>
                            <th>Status</td>
                            <th>Aksi</td>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('admin.siswa.form')
    @include('admin.siswa.form_import')
@endsection

@includeIf('layouts.includes.datatable')
@include('layouts.includes.datepicker')
@include('layouts.includes.select2')

@push('scripts')
    <script>
        let modal = '#modal-form';
        let table, start, end;
        let siswaModal = '#modalSiswaImport';

        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('kesiswaan.data') }}',
                data: function(d) {
                    d.status = $('[name=status2]').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'student_name'
                },
                {
                    data: 'student_identification_school'
                },
                {
                    data: 'date_birth'
                },
                {
                    data: 'kelas'
                },
                {
                    data: 'umur'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action',
                    sortable: false,
                    searchable: false
                },
            ]
        });

        function addForm(url, title = "Tambah Data Siswa") {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('POST');

            resetForm(`${modal} form`);
        }

        function editForm(url, title = 'Edit Data Siswa') {
            $.get(url)
                .done(response => {
                    $(`${modal}`).modal('show');
                    $(`${modal} .modal-title`).text(title);
                    $(`${modal} form`).attr('action', url);
                    $(`${modal} [name=_method]`).val('PUT');
                    resetForm(`${modal} form`);
                    loopForm(response.data);
                })
                .fail(errors => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: false,
                        timer: 2000
                    })
                });
        }

        function submitForm(originalForm) {
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
                    table.ajax.reload();
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

        function deleteData(url, name) {
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
                                table.ajax.reload();
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
                            table.ajax.reload();
                        });
                }
            })
        }

        function updateStatus(url, name) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })
            swalWithBootstrapButtons.fire({
                title: 'Perhatian',
                text: "Apakah Anda yakin akan mengaktifkan " + name + ' ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(48, 133, 214)',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, Aktifkan!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, {
                            '_method': 'put'
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
                                table.ajax.reload();
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
                            table.ajax.reload();
                        });
                }
            });
        }

        // fungsi untuk menampilkan modal import data excel
        function importData(url, title = 'Tools Import Data Peserta Didik') {
            $(siswaModal).modal('show');
            $(`${siswaModal} .modal-title`).text(title);
        }

        $('[name=status2]').on('change', function() {
            table.ajax.reload();
        });
    </script>
@endpush
