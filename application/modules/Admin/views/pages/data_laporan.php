<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Laporan</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12"> </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="<?= base_url('Admin/dataLaporan') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-daterange input-group date-range">
                                    <input type="text" class="form-control" name="tgl_awal" value="<?= $tgl_awal ?>" placeholder="Tanggal Awal" />
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-info b-0 text-white">SAMPAI</span>
                                    </div>
                                    <input type="text" class="form-control" name="tgl_akhir" value="<?= $tgl_akhir ?>" placeholder="Tanggal Akhir" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-info" type="submit"><i class="la la-eye"></i> Tampil</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="content-body mt-2">
            <section class="inputmask" id="inputmask">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Laporan</h4>
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

                                        div .dataTables_wrapper {
                                            margin-top: -20px !important;
                                        }
                                    </style>

                                    <table id="datalaporan" class="table table-hover table-bordered table-striped data-table" style="font-size:small">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Order</th>
                                                <th>Nama Klien</th>
                                                <th>File</th>
                                                <th>Tgl Order</th>
                                                <th>Jenis Cetak</th>
                                                <th>Jml Warna</th>
                                                <th>Jml Cetak</th>
                                                <th>Tot Bayar (Rp)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($dataOrder as $val) {
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td align="center"><?= $no ?></td>
                                                    <td align="center"><?= $val['no_order'] ?></td>
                                                    <td><?= $val['nama_order'] ?></td>
                                                    <td><?= $val['nama_file'] ?></td>
                                                    <td align="center" nowrap><?= date('d/m/Y', strtotime($val['tgl_order'])) ?></td>
                                                    <td><?= $val['jenis_cetak'] ?></td>
                                                    <td align="center"><?= $val['jml_warna'] ?></td>
                                                    <td align="center"><?= $val['jml_cetak'] ?></td>
                                                    <td align="center"><?= $val['tot_harga'] ?></td>
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

<div class="modal animated bounceIn text-left" id="modal-photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nama_modal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="font-medium-3" id="photo"> </div>
            </div>
            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="la la-close"></i> Keluar</button>
      </div> -->
        </div>
    </div>
</div>

<script>
    function showPhotos(data) {
        var title = $(data).data('title');
        var photo = $(data).data('photo');

        $('#modal-photo #nama_modal').html(title);
        $('#modal-photo #photo').html('<img class="img img-responsive" src="<?= base_url('assets/upload/') ?>' + photo + '" width="350">');
        $('#modal-photo').modal('show');

    }
</script>