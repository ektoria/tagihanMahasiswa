        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1><?= $title ?></h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="<?= base_url('Tagihan/tambah'); ?>" class="form">
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Nama Mahasiswa</label>
                                        <div class="col-xs-8">
                                            <select name="nama_mahasiswa" id="nama_mahasiswa" class="form-control">
                                                <option value="seluruhnya">Seluruhnya</option>
                                                <?php foreach ($nama_mahasiswa as $nm) : ?>
                                                    <option value="<?= $nm->id ?>"><?= $nm->nama_mahasiswa ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Nama Tagihan</label>
                                        <div class="col-xs-8">
                                            <input name="nama_tagihan" id="nama_tagihan" class="form-control" type="text" placeholder="Nama Tagihan" required autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Keterangan</label>
                                        <div class="col-xs-8">
                                            <textarea name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Nominal</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                                <input name="nominal" id="nominal" class="form-control" type="text" placeholder="Nominal" required autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-secondary" href="<?= base_url('Tagihan') ?>">Close</a>
                                            <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>