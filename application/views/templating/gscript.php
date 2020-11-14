<script>
    var t = null;
    $(document).ready(function() {
        t = $('#table').DataTable({
            "columnDefs": [{
                'width': '15%',
                'targets': 5
            }, {
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            },
            "processing": true,
            "serverSide": true,
            "order": [
                [0, 'asc']
            ],
            "ajax": {
                "url": "<?php echo base_url('ajax/datatableFetch') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [
                [20, 50, 100],
                [20, 50, 100]
            ],
            "columns": [{
                "data": 'id',
            }, {
                "data": "nama_produk"
            }, {
                "data": "keterangan"
            }, {
                "data": "harga",
                "render": $.fn.dataTable.render.number(',', '.', 0, 'Rp. ', ',-')
            }, {
                "data": "jumlah"
            }, {
                "targets": -1,
                "data": null,
                "defaultContent": "<button class='btn btn-danger' id='deleteBtn'><i class='fa fa-trash'></i></button> <button id='editBtn' class='btn btn-info'><i class='fa fa-pen-square'></i></button>"
            }, ],
        });
        t.on('xhr order.dt search.dt', function() {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        t.on('click', '#deleteBtn', function() {
            var data = t.row($(this).parents('tr')).data();
            deleteData(data["id"], data["nama_produk"]);
        });
        t.on('click', '#editBtn', function() {
            var data = t.row($(this).parents('tr')).data();
            editData(data["id"], data["nama_produk"], data["keterangan"], data["harga"], data["jumlah"]);
        });
    });
</script>
<script>
    function deleteData(id, nama_produk) {
        Swal.fire({
            title: 'Apakah kamu yakin ingin menghapus produk "' + nama_produk + '"?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: `Hapus!`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("Ajax/delData") ?>",
                    dataType: "html",
                    data: {
                        "id": id
                    },
                    success: function(response) {
                        Swal.fire('Data "' + nama_produk + '" Berhasil Dihapus', '', 'success');
                        t.ajax.reload();
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Galat menyimpan data',
                            text: 'Sepertinya ada kesalahan'
                        });

                    }
                });
            }
        })
    }

    function editData(id, nama, ket, hrg, jml) {
        $("#buttonEdit").val(id);
        $("#namee").val(nama);
        $("#keterangann").val(ket);
        $("#hargaa").val(hrg);
        $("#jmll").val(jml);
        $('#modalEditData').modal('toggle');
    }

    function sendEditData() {
        $("#full-load").toggleClass("invisible");
        let id = $("#buttonEdit").val();
        let nama = $("#namee").val();
        let keterangan = $("#keterangann").val();
        let harga = $("#hargaa").val();
        let jumlah = $("#jmll").val();

        if (id == "" || nama == "" || keterangan == "" || harga == "" || jumlah == "") {
            $("#full-load").toggleClass("invisible");
            Swal.fire({
                icon: 'error',
                title: 'Galat!',
                text: 'Mohon isi semua bidang yang dibutuhkan!'
            });
        } else {
            swal.fire({
                title: "Apakah anda yakin ingin mengubah data?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ubah',
                cancelButtonText: "Batal"
            }).then((recult) => {
                if (recult.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url("Ajax/editData") ?>",
                        dataType: "html",
                        data: {
                            "id": id,
                            "nama_produk": nama,
                            "keterangan": keterangan,
                            "harga": harga,
                            "jml": jumlah
                        },
                        success: function(response) {
                            $("#fullload").toggleClass("invisible");
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses menyimpan data',
                                text: 'Data berhasil disimpan'
                            });
                            $('#modalEditData').modal('toggle');
                            t.ajax.reload();

                        },
                        error: function(response) {
                            $("#fullload").toggleClass("invisible");
                            Swal.fire({
                                icon: 'error',
                                title: 'Galat menyimpan data',
                                text: 'Sepertinya ada kesalahan'
                            });
                            $('#modalEditData').modal('toggle');
                            t.ajax.reload();
                        }
                    });
                }
            });
        }
    }

    function modalAddData() {
        $('#modalAddData').modal('toggle');
    }

    function addData() {
        $(".full-load").toggleClass("invisible");
        let nama_produk = $("#name").val();
        let keterangan = $("#keterangan").val();
        let harga = $("#harga").val();
        let jml = $("#jml").val();

        if (nama_produk == "" || keterangan == "" || harga == "" || jml == "") {
            $(".full-load").toggleClass("invisible");
            Swal.fire({
                icon: 'error',
                title: 'Galat!',
                text: 'Mohon isi semua bidang yang dibutuhkan!'
            });
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url("Ajax/addData") ?>",
                dataType: "html",
                data: {
                    "nama_produk": nama_produk,
                    "keterangan": keterangan,
                    "harga": harga,
                    "jml": jml
                },
                success: function(response) {
                    $(".full-load").toggleClass("invisible");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses menyimpan data',
                        text: 'Data berhasil disimpan'
                    });
                    $('#modalAddData').modal('toggle');
                    t.ajax.reload();

                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Galat menyimpan data',
                        text: 'Sepertinya ada kesalahan'
                    });
                    $('#modalAddData').modal('toggle');
                    t.ajax.reload();
                }
            });
        }
    }
</script>