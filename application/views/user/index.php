<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Unduh Daftar Atlit</a>
    </div>


    <?php if ($this->session->flashdata()) : ?>
        <div class="row-mt-3">
            <div class="row-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data <strong>berhasil</strong> <?= $this->session->flashdata('pesan'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">L/P</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($peserta as $p) : ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= $p['nama']; ?></td>
                        <td><?php if ($p['gender'] == 'P') {
                                echo "Perempuan";
                            } else {
                                echo "laki-laki";
                            }
                            ?>
                        </td>
                        <td><?= $p['jenis']; ?></td>
                        <td><?= $p['kategori']; ?></td>
                        <td><?= $p['kelas']; ?></td>
                        <td>
                            <a class="badge badge-info" href="<?= base_url('user/detail/') . $p['id']; ?>">detail</a>
                            <a class="badge badge-primary" href="<?= base_url('user/editpeserta/') . $p['id']; ?>">Ubah</a>
                            <?php if ($p['bayar'] == 1) : ?>
                                <div class="badge badge-secondary">Hapus</div>
                            <?php else : ?>
                                <a class="badge badge-danger" href="<?= base_url('user/hapusPeserta/') . $p['id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?');">Hapus</a>
                            <?php endif; ?>
                        </td>

                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->