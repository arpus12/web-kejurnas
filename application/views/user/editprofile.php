<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> </h1>

    <div class="row">

        <div class="col-lg-6">
            <?= $this->session->flashdata('pesan'); ?>

            <?= form_open_multipart('user/editprofile'); ?>
            <form>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="Email" value="<?= $user['email']; ?>" readonly>
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?= $user['status']; ?>" readonly>
                        <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-7">
                        <label for="kontingen">Kontingen</label>
                        <input type="text" class="form-control" id="kontingen" name="kontingen" value="<?= $user['kontingen']; ?>">
                        <?= form_error('kontingen', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2"> <?= $user['alamat']; ?> </textarea>
                    <?= form_error('no_induk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class=" form-group">
                    <label for="nomor hp">Nomor Handhphone</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $user['no_hp']; ?>">
                    <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- awal upload gambar -->

                <div class="form-group">
                    <div class="form-group row">
                        <div class="col-sm-2">Gambar</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/') . 'default.jpg'; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                        <label class="custom-file-label" for="gambar">- Pilih file -</label>
                                    </div>
                                    <div>
                                        <p class="h6"><small><em> *Ukuran file <u> Maks 300 Kb </u> </em></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir upload gambar -->

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Edit Profile</button>
                </div>
            </form>

            </form>
        </div>


    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->