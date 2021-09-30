<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">List Order <?= ($title != '' ? $title : '') ?></h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('Petugas') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">List Order</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right col-md-6 col-12">
        <?php if ($title != '') { ?>
        <div class="float-md-right">
          <a href="<?= base_url('Petugas/dataOrder') ?>" class="btn btn-danger round px-2" type="button">Tampil Semua</a>
        </div>
        <?php } ?>
      </div>

    </div>
    <div class="content-body mt-2">
      <section class="inputmask" id="inputmask">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Daftar Order</h4>
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

                  <table id="dataorder" class="table table-hover table-bordered table-striped data-table" style="font-size:small">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th nowrap>Aksi</th>
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
                          <td align="center">
                            <button type="button" onclick="hapusData(this)" data-id="<?= encode($val['id_order']) ?>" data-link="<?= base_url('Petugas/deleteOrder') ?>" class="btn btn-sm btn-danger" title="Hapus"><i class="la la-trash-o font-small-3"></i></button>
                          </td>
                          <td align="center"><?= $val['no_order'] ?></td>
                          <td><?= $val['nama_order'] ?></td>
                          <td align="center">
                            <button type="button" onclick="showPhotos(this)" data-title="<?= $val['nama_file'] ?>" data-photo="<?= $val['nama_file'] ?>" class="btn btn-sm btn-primary"><i class="la la-photo font-small-3" title="Tampil Gambar"></i></button>
                          </td>
                          <td align="center" nowrap><?= date('d/m/Y', strtotime($val['tgl_order'])) ?></td>
                          <td><?= $val['jenis_cetak'] ?></td>
                          <td align="center"><?= $val['jml_warna'] ?></td>
                          <td align="center"><?= $val['jml_cetak'] ?></td>
                          <td align="center"><?= nominal($val['tot_harga']) ?></td>
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