<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">List Jenis Cetak</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">List Jenis Cetak</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="float-md-right">
                    <button class="btn btn-info round px-2" type="button" onclick="showModalAdd()">
                        <i class="la la-plus"></i> Tambah Jenis Cetak
                    </button>
                </div>
            </div>

        </div>
        <div class="content-body mt-2">
            <section class="inputmask" id="inputmask">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Jenis Cetak</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <?= show_alert() ?>
                                    <style>
                                        .no-wrap {
                                            white-space: nowrap;
                                        }
                                    </style>

                                    <table id="datajenis" class="table table-hover table-bordered table-striped data-table" style="font-size:small">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">No</th>
                                                <th style="text-align: center;" nowrap>Aksi</th>
                                                <th style="text-align: center;">Nama Jenis Cetak</th>
                                                <th style="text-align: center;">Harga 1</th>
                                                <th style="text-align: center;">Harga 2</th>
                                                <th style="text-align: center;">Harga 3</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($dataJenis as $val) {
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td align="center"><?= $no ?></td>
                                                    <td align="center">
                                                        <button type="button" onclick="hapusData(this)" data-id="<?= encode($val['id_jenis_order']) ?>" data-link="<?= base_url('Admin/deleteJenisCetak') ?>" class="btn btn-sm btn-danger" title="Hapus"><i class="la la-trash-o font-small-3"></i></button>
                                                        <button type="button" onclick="showModalEdit(this)" data-id="<?= encode($val['id_jenis_order']) ?>" data-nama="<?= $val['nama_jenis_order'] ?>" data-harga1="<?= nominal($val['harga1']) ?>" data-harga2="<?= nominal($val['harga2']) ?>" data-harga3="<?= nominal($val['harga3']) ?>" class="btn btn-sm btn-primary" title="Edit"><i class="la la-edit font-small-3"></i></button>
                                                    </td>
                                                    <td><?= $val['nama_jenis_order'] ?></td>
                                                    <td align="center"><?= nominal($val['harga1']) ?></td>
                                                    <td align="center"><?= nominal($val['harga2']) ?></td>
                                                    <td align="center"><?= nominal($val['harga3']) ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="title_modal">Form Jenis Cetak</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAddJenis" method="POST">
                <div class="modal-body">
                    <?= token_csrf() ?>
                    <input type="hidden" value="" id="id_jenis_order" name="id_jenis_order">
                    <div class="form-group">
                        <h5>Nama Jenis Cetak
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" id="nama_jenis_order" name="nama_jenis_order" class="form-control" autocomplete="off" required placeholder="Isi nama jenis cetak">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Harga 1 (1 warna)
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" onkeypress="return inputAngka(event);" onkeyup="changeRupe(this)" id="harga1" name="harga1" class="form-control" autocomplete="off" required placeholder="Isi harga" maxlength="7">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Harga 2 (2 - 3 warna)
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" onkeypress="return inputAngka(event);" onkeyup="changeRupe(this)" id="harga2" name="harga2" class="form-control" autocomplete="off" required placeholder="Isi harga" maxlength="7">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Harga 3 (4 warna)
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" onkeypress="return inputAngka(event);" onkeyup="changeRupe(this)" id="harga3" name="harga3" class="form-control" autocomplete="off" required placeholder="Isi harga" maxlength="7">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showModalAdd() {
        $('#formAddJenis').trigger('reset');
        $('#formAddJenis').attr('action', "<?= base_url('Admin/simpanJenisCetak') ?>");
        $('#modal_form #title_modal').html('Tambah Jenis Cetak');
        $('#modal_form').modal('show');
    }

    function showModalEdit(data) {
        var id_jenis_order = $(data).data('id');
        var nama_jenis_order = $(data).data('nama');
        var harga1 = $(data).data('harga1');
        var harga2 = $(data).data('harga2');
        var harga3 = $(data).data('harga3');

        $('#formAddJenis').trigger('reset');
        $('#formAddJenis').attr('action', "<?= base_url('Admin/updateJenisCetak') ?>");
        $('#modal_form #title_modal').html('Edit Jenis Cetak');
        $('#modal_form #id_jenis_order').val(id_jenis_order);
        $('#modal_form #nama_jenis_order').val(nama_jenis_order);
        $('#modal_form #harga1').val(harga1);
        $('#modal_form #harga2').val(harga2);
        $('#modal_form #harga3').val(harga3);
        $('#modal_form').modal('show');
    }
</script>