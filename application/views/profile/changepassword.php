<div class="right_col">
    <div class="container">
        <?php if( $this->session->flashdata('message') ): ?>
            <div class="row">
                <div class="col-6 flash">
                    <?=  $this->session->flashdata('message'); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-6">
                <h4 class=""><?= $title ?></h4>
                <form method="post" action="<?= base_url('profile/changepassword')?>">
                    <div class="form-group">
                        <label for="currentpassword">Current Password</label>
                        <input type="text" class="form-control" id="currentpassword" name="currentpassword">
                        <?= form_error('currentpassword', '<small class="text-danger">', '</small>')?>
                    </div>
                    <div class="form-group">
                        <label for="newpassword1">New Password</label>
                        <input type="password" class="form-control" id="newpassword1" name="newpassword1">
                        <?= form_error('newpassword1', '<small class="text-danger">', '</small>')?>
                    </div>
                    <div class="form-group">
                        <label for="newpassword2">Confirm New Password</label>
                        <input type="password" class="form-control" id="newpassword2" name="newpassword2">
                        <?= form_error('newpassword2', '<small class="text-danger">', '</small>')?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>