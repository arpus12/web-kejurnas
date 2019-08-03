<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>


    <!-- Page Heading -->
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" class="card-img" alt="gambar">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nama']; ?></h5>
                    <p class="card-text"> Email &emsp;&emsp; <small><?= $user['email']; ?></small>
                        <br> Status &emsp;&nbsp;&nbsp; <small><?= $user['status']; ?> </small>
                        <br> No HP &emsp;&nbsp;&nbsp; <small><?= $user['no_hp']; ?></small>
                        <br> Kontingen <small><?= $user['kontingen']; ?></small>
                        <br> Alamat &emsp;&nbsp; <small><?= $user['alamat']; ?></small>
                    </p>
                    <p class="card-text"><small class="text-muted">Anggota sejak : <?= date('d F Y', $user['tanggal']); ?></small></p>
                </div>
            </div>
        </div>
    </div>
    <a href="<?= base_url('user/editprofile'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-edit fa-sm text-white-50"></i> Edit Profile</a>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->