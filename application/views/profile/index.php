<div class="right_col">
    <div class="container">
        <?php 
            // var_dump( $user_level);die;
        if( $this->session->flashdata('message') ): ?>
            <div class="row">
                <div class="col-6 flash">
                    <?=  $this->session->flashdata('message'); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="card mb-3 mt-0" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/user/') . $user['img']?>" class="card-img" alt="User Image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title mb-0"><?= $user['name'] ?></h5>
                                <p class="card-text"><span class="text-muted"><?= $user_level ?></span></p>
                                <p class="card-text">Username: <strong><?= $user['username'] ?></strong></p>
                                <a href="<?= base_url('profile/changepassword/')?>" class="btn btn-primary btn-sm mb-0">Change Password</a>
                                <a href="<?= base_url('profile/edit/')?>" class="btn btn-primary btn-sm mb-0">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>