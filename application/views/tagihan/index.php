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
                        <a class="btn btn-primary" href="<?= base_url('Tagihan/tambah_page') ?>">Tambah Tagihan</a>
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
                                            <th>Nama Mahasiswa</th>
                                            <th>Nama Tagihan</th>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($tagihan  as  $da) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $da->nama_mahasiswa ?></td>
                                                <td><?= $da->nama_tagihan ?></td>
                                                <td><?= $da->keterangan ?></td>
                                                <td><?= $da->nominal ?></td>
                                                <td>
                                                    <span data-target="#formModal" data-toggle="modal">
                                                        <a href="<?= base_url('Tagihan/edit_page/') . $da->id; ?>" class="btn btn-sm btn-success" title="Update"><i class="far fa-sm fa-edit"></i></a>
                                                    </span>
                                                    <a href="<?= base_url('Tagihan/delete/') . $da->id; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="far fa-sm fa-trash-alt" onclick="return confirm('Apakah anda ingin menghapus data?')"></i></a>
                                                </td>
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