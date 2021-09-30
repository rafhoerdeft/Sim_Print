<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Tambah Order</h3>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="row breadcrumbs-top d-inline-block float-md-right">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('Petugas') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tambah Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body mt-2">
            <section class="inputmask" id="inputmask">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Input</h4>
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

                                    <form id="formOrder" class="form-horizontal" method="POST" action="<?= base_url('Petugas/addOrder') ?>" enctype="multipart/form-data">
                                        <?= token_csrf() ?>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-12">

                                                <div class="form-group">
                                                    <h5>Nomor Order</h5>
                                                    <div class="controls">
                                                        <input type="text" id="no_order" name="no_order" class="form-control" placeholder="Isi nomor order" required value="<?= $no_order ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Nama Klien
                                                        <span class="required text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" id="nama_order" name="nama_order" class="form-control" placeholder="Isi nama klien" value="<?= $post['nama_order'] ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Jenis Cetak
                                                        <span class="required text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <select id="id_jenis_order" name="id_jenis_order" class="form-control" required>
                                                            <option value="" hidden>Pilih Jenis Cetak</option>
                                                            <?php
                                                            $jenis_cetak = '';
                                                            foreach ($jenis_order as $key) {
                                                                if ($post['id_jenis_order']==$key['id_jenis_order']) {
                                                                    $jenis_cetak = $key['nama_jenis_order'];
                                                                }
                                                            ?>
                                                                <option <?= ($post['id_jenis_order'] == $key['id_jenis_order'] ? 'selected' : '') ?> value="<?= $key['id_jenis_order'] ?>"><?= $key['nama_jenis_order'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-xl-6 col-lg-12">
                                                <div class="form-group">
                                                    <h5>Upload File Gambar
                                                        <span class="required text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="file" id="nama_file" name="nama_file" class="dropify" accept="image/x-png, image/jpg, image/jpeg" data-allowed-file-extensions="jpg png jpeg" data-height="113" data-max-file-size="5200K" required />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Jumlah Cetak
                                                        <span class="required text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" onkeypress="return inputAngka(event);" id="jml_cetak" name="jml_cetak" class="form-control" maxlength="6" placeholder="Isi jumlah cetak" value="<?= $post['jml_cetak'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-danger btn-block pull-right" onclick="resetForm('formOrder')">
                                                            <i class="la la-rotate-left"></i> Reset
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary btn-block pull-right">
                                                            <i class="la la-money"></i> Cek Harga
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php if ($getColor) { ?>
                <section class="inputmask" id="inputmask">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Form Input</h4>
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
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <img style="width: 300px" src="<?= base_url('assets/upload/' . $file) ?>" alt="test image" />
                                            </div>
                                        </div>
                                        <hr>
                                        <form id="formSimpan" class="form-horizontal" method="POST" action="<?= base_url('Petugas/simpanOrder') ?>">
                                            <?= token_csrf() ?>
                                            <input type="hidden" name="no_order" value="<?= $post['no_order'] ?>">
                                            <input type="hidden" name="nama_order" value="<?= $post['nama_order'] ?>">
                                            <input type="hidden" name="id_harga" value="<?= $id_harga ?>">
                                            <input type="hidden" name="nama_file" value="<?= $file ?>">
                                            <input type="hidden" name="jml_warna" value="<?= count($getColor) ?>">
                                            <input type="hidden" name="jml_cetak" value="<?= $post['jml_cetak'] ?>">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <table class="table table-hover table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th width="20">No.</th>
                                                                <th>Rumpun Warna Digunakan</th>
                                                                <!-- <th>Persentase</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php

                                                            $xx = 0;
                                                            foreach ($getColor as $hex => $percent) {
                                                                $xx++;
                                                                echo "<tr><td align='center'>" . $xx . "</td><td style=\"background-color:#" . $hex . ";\"></td></tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                </div>

                                                <div class="col-md-8">
                                                    <table class="table table-hover table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Jml. Warna</th>
                                                                <th>Jenis Cetak</th>
                                                                <th>Jml. Cetak</th>
                                                                <th>Total (Rp)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <?php
                                                                $jml_warna   = count($getColor);
                                                                $jml_cetak   = $post['jml_cetak'];
                                                                $total_harga = $harga * $jml_cetak;
                                                                ?>
                                                                <td align="center"><?= $jml_warna ?></td>
                                                                <td><?= $jenis_cetak ?> @<?= $harga ?></td>
                                                                <td align="center"><?= $jml_cetak ?></td>
                                                                <td align="center"><?= $total_harga ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6"></div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-info btn-block pull-right">
                                                                <i class="la la-save"></i> Simpan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    function resetForm(id = '') {
        $('#' + id).trigger("reset");
        $('#' + id + ' .dropify-clear').click();
    }
</script>

<?php if ($getColor) { ?>
    <script>
        $(document).ready(function() {
            $('#formOrder .dropify-render img').attr('src', "<?= base_url('assets/upload/' . $file) ?>");
        });
    </script>
<?php } ?>