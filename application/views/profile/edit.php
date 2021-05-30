<div class="right_col">
    <div class="container">
        <div class="row">
            <div class="col-8 mt-5">
                <?= form_open_multipart('profile/edit'); ?>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 mt-0 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input id="username" class="form-control" type="text" name="Username" value="<?= $user['username']?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 mt-0 col-form-label">Full name</label>
                    <div class="col-sm-10">
                        <input id="name" class="form-control" type="text" name="name" value="<?= $user['name']?>" >
                        <?= form_error('name', '<small class="text-danger">', '</small>')?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Picture</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/user/') . $user['img']; ?>" alt="User Image" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input id="img" class="custom-file-input" type="file" name="img">
                                    <label for="img" class="custom-file-label">Choose File</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>