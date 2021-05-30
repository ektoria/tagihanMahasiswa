<div class="right_col">
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
    <?php endif; ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-block btn-create-tarif mt-5" data-toggle="modal" data-target="#formModal">
        Tambah Tarif
    </button>
<!--     <select name="filterTipe" id="filterTipe">
        <option value="">All</option>
        <option value="Daun">Daun</option>
        <option value="Tanah">Tanah</option>
        <option value="Limbah & Air">Limbah & Air</option>
    </select> -->
    <table class="table tarif">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Parameter</th>
                <th>Metodologi Pengujian</th>
                <th width="70px">Harga</th>
                <th>Tipe</th>
                <th width="60px">Action</th>
            </tr>
        </thead>
        <tbody class="tarif-content">
             <?php function rupiah1($angka){
                $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
                return $hasil_rupiah;
            } ?>
            <?php foreach( $daftar_tarif  as  $key => $row) : ?>
            <tr>
                <td><?= $key+ 1; ?></td>
                <td><?= $row['parameter'] ?></td>
                <td><?= $row['m_pengujian'] ?></td>
                <td data-order="<?= $row['harga']?>"><?= rupiah1($row['harga']); ?></td>
                <td><?= $row['nama_komoditi'] ?></td>
                <td>
                    <span data-target="#formModal" data-toggle="modal">
                        <a href="<?= base_url('tarif/edit/') . $row['id']; ?>" class="btn btn-sm btn-success btn-edit-tarif" data-toggle="tooltip" data-placement="bottom" title="Update tarif"><i class="far fa-sm fa-edit"></i></a>
                    </span>
                    <a href="<?= base_url('tarif/delete/') . $row['id']; ?>" class="btn btn-sm btn-danger btn-delete-tarif"  data-toggle="tooltip" data-placement="bottom" title="Delete tarif"><i class="far fa-sm fa-trash-alt"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title-form-modal" id="formModalLabel">Tambah Tarif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('tarif/add'); ?>" class="form">
                    <div class="form-group">
                        <label for="parameter">Nama Paket</label>
                        <input type="text" class="form-control" id="parameter" name="parameter">
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe</label>
                    </div>
                    <div class="wrapper-parameter2 d-flex align-items-end">
                        <select class="custom-select d-inline" id="tipe" name="tipe">
                            <?php foreach ($daftar_komoditi as $dk): ?>
                            <option value= <?= $dk->kode_komoditi?>> <?= $dk->nama_komoditi ?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="dropdown d-inline">
                            <button class="btn btn-secondary btn-sm dropdown-toggle dropdown-parameter2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Parameter
                            </button>
                            <div class="dropdown-menu wrapper-checkbox2" aria-labelledby="dropdownMenuButton">
                                <?= $checkbox; ?>
                            </div>
                        </div>
                        <div class="loader"></div>
                    </div>
                    <div class="form-group">
                        <label for="m_pengujian">Metodologi Pengujian</label>
                        <input type="text" class="form-control" id="m_pengujian" name="m_pengujian">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" id="harga" name="harga">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnSave">Save changes</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>