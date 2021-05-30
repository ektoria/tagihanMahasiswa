<div class="right_col">
  <div class="clearfix"></div>
  <div class="row justify-content-center">
    <h3>Access User Control</h3>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8 mt-2">
      <button type="button" class="btn btn-primary mt-4 btn-add-access" data-toggle="modal" data-target="#newUser">
        Add new user
      </button>
      <?php if( $this->session->flashdata('flash') ): ?>
      <div class="row">
        <div class="col-lg-12 flash">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data <strong>Berhasil!</strong> <?= $this->session->flashdata('flash'); ?>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
      <?php elseif( $this->session->flashdata('flashE') ) : ?>
        <div class="row">
          <div class="col-lg-12 flash">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Data <strong>Tidak dikrim!</strong> <?= $this->session->flashdata('flashE'); ?>.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
      </div>
      <?php endif; ?>
        <table class="table table-hover data">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">User Access</th>
              <th scope="colgroup">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php $i = 1; ?>
          <?php foreach($userd as $key => $pengguna) : ?>
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td>
              <?= $pengguna[0]['username']; ?>
            </td>
            <td>
              <?php if( $pengguna[0]['status_user'] == 1 ) : ?> 
              <a href="<?= base_url('admin/getUserId/') . $pengguna[0]['user_id'] ?>" class="btn btn-sm btn-edit-access btn-outline-primary" data-toggle="modal" data-target="#addUser">
                Edit user access
              </a>
              <?php else : ?>
                <?php $i = ''; ?>
              <?php endif; ?>
            </td>
            <td>
              <?php if( $pengguna[0]['status_user'] == 1 ) : ?> 
              <a href="<?= base_url('admin/deleteUser/') . $pengguna[0]['user_id'] ?>" class="btn btn-action-user-success btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Deactivate user">
                <i class="far fa-check-circle"></i>
              </a>
              <?php else :  ?>
              <a href="<?= base_url('admin/restoreUser/') . $pengguna[0]['user_id'] ?>" class="btn btn-action-user-danger btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Activate user">
                <i class="far fa-times-circle"></i>
              </a>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addUser"  tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserLabel">Edit User Access</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="<?= base_url('admin/editUser') ?>" method="post">
          <input type="hidden" class="input-id" name="id" value="">
          <div class="form-group">
            <label for="access">User Access</label>
            <div class="pohon">
              <?= $pohon; ?>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit user access</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Add User-->
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newUserLabel">Add new user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/addUser') ?>" method="post" name="theForm">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label for="role">Role User</label>
            <select class="form-control" name="role" id="role">
              <?php foreach($role as $dataRole) : ?>
              <option value="<?= $dataRole['id'] ?>"><?= $dataRole['role_user'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <?php
             $external = ['id' => '0', 'name' => 'tuser', 'value' => '0'];
             $internal = ['id' => '1', 'name' => 'tuser', 'value' => '1'];
            ?>
            <label for="tipe">User Type</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="0">
              <label class="form-check-label">External</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="1">
              <label class="form-check-label">Internal</label>
            </div>
          </div>
          <div class="form-group">
            <label for="access">User Access</label>
            <div class="pohon">
              <?= $pohon; ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary submit-useraccess">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>