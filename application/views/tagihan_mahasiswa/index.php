<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->session->flashdata('flash'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <h2>Hai <?= $user['name'] ?>, kamu memiliki <?= $jumlah_tagihan ?> Tagihan</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table data">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tagihan</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($tagihan  as  $da) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $da['nama_tagihan'] ?></td>
                                        <td><?= $da['keterangan'] ?></td>
                                        <td><?= $da['nominal'] ?></td>
                                        <td><a href="<?= base_url('Tagihan_mahasiswa/bayar/') . $da['id'] ?>" class="btn btn-success" onclick="return confirm('Apakah anda yakin ingin membayar tagihan?')"">Bayar</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>