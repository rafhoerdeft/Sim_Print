<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">List User</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">List User</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right col-md-6 col-12">
        <div class="float-md-right">
          <button class="btn btn-info round px-2" type="button" onclick="showModalAdd()">
            <i class="la la-plus"></i> Tambah User
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
                <h4 class="card-title">Daftar User</h4>
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

                  <table id="datauser" class="table table-hover table-bordered table-striped data-table" style="font-size:small">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th nowrap>Aksi</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Role</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 0;
                      foreach ($dataUser as $val) {
                        $no++;
                      ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td>
                            <button type="button" onclick="hapusData(this)" data-id="<?= encode($val['id_login']) ?>" data-link="<?= base_url('Admin/deleteUser') ?>" class="btn btn-sm btn-danger" title="Hapus"><i class="la la-trash-o font-small-3"></i></button>
                            <button type="button" onclick="showModalEdit(this)" data-id="<?= encode($val['id_login']) ?>" data-nama="<?= $val['nama_user'] ?>" data-user="<?= $val['username'] ?>" data-role="<?= $val['role'] ?>" class="btn btn-sm btn-primary" title="Edit"><i class="la la-edit font-small-3"></i></button>
                          </td>
                          <td><?= $val['nama_user'] ?></td>
                          <td><?= $val['username'] ?></td>
                          <td><?= $val['role'] ?></td>
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
        <h4 class="modal-title white" id="title_modal">Form User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formAddUser" method="POST">
        <div class="modal-body">
          <?= token_csrf() ?>
          <input type="hidden" value="" id="id_login" name="id_login">
          <div class="form-group">
            <h5>Nama User
              <span class="required text-danger">*</span>
            </h5>
            <div class="controls">
              <input type="text" id="nama_user" name="nama_user" class="form-control" autocomplete="off" required placeholder="Isi nama user">
            </div>
          </div>

          <div class="form-group">
            <h5>Role
              <span class="required text-danger">*</span>
            </h5>
            <div class="controls">
              <select name="role" id="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <h5>Username
              <span class="required text-danger">*</span>
            </h5>
            <div class="controls">
              <input type="text" id="username" name="username" class="form-control" autocomplete="off" required placeholder="Isi username">
            </div>
          </div>

          <div class="form-group">
            <h5>Password
              <span class="required text-danger">*</span>
            </h5>
            <div class="controls">
              <input type="text" id="password" name="password" class="form-control" autocomplete="off" required placeholder="Isi password">
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
    $('#formAddUser').trigger('reset');
    $('#formAddUser').attr('action',"<?= base_url('Admin/simpanUser') ?>");
    $('#modal_form #title_modal').html('Tambah User');
    $('#modal_form').modal('show');
  }

  function showModalEdit(data) {
    var id_login  = $(data).data('id');
    var nama_user = $(data).data('nama');
    var username  = $(data).data('user');
    var role      = $(data).data('role');
    $('#formAddUser').trigger('reset');
    $('#formAddUser').attr('action',"<?= base_url('Admin/updateUser') ?>");
    $('#modal_form #title_modal').html('Edit User');
    $('#modal_form #id_login').val(id_login);
    $('#modal_form #nama_user').val(nama_user);
    $('#modal_form #username').val(username);
    $('#modal_form #role').val(role).change();
    $('#modal_form').modal('show');
  }
</script>