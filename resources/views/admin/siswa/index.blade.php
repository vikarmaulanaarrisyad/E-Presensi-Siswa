@extends('layouts.app')

@section('title', 'Data Siswa')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Siswa</li>
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-12 col-md-12 col-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('kesiswaan.store') }}`)" class="btn btn-sm btn-primary"><i
                            class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <th width="5%">No</td>
                            <th>NISN</td>
                            <th>Nama Lengkap</td>
                            <th>Tanggal Lahir</td>
                            <th>Jenis Kelamin</td>
                            <th>Aksi</td>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('admin.siswa.form')
@endsection

@includeIf('layouts.includes.datatable')
@include('layouts.includes.datepicker')

@push('scripts')
    <script>
        let modal = '#modal-form';
        let table, start, end;

        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('kesiswaan.data') }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'student_identification_school'
                },
                {
                    data: 'student_name'
                },
                {
                    data: 'date_birth'
                },
                {
                    data: 'gander'
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


    </script>
@endpush
