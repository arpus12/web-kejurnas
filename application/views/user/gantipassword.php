<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> </h1>

    <div class="row">

        <div class="col-lg-6">
            <?= $this->session->flashdata('pesan'); ?>

            <form action="<?= base_url('user/gantipassword'); ?>" method="post">
                <form>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Password lama</label>
                        <input type="password" class="form-control" id="password0" name="password0">
                        <?= form_error('password0', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Password baru</label>
                        <input type="password" class="form-control" id="password1" name="password1">
                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Ulangi password baru</label>
                        <input type="password" class="form-control" id="password2" name="password2">
                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                    </div>
                </form>

            </form>
        </div>


    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->