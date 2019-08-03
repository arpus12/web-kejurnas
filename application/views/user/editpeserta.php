<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> </h1>

    <div class="row">

        <div class="col-lg-6">
            <?= form_open_multipart('user/editpeserta/' . $peserta['id']); ?>
            <form>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $peserta['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-7">
                        <label for="formGroupExampleInput">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $peserta['tempat_lahir']; ?>">
                        <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="formGroupExampleInput">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                        <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nomor Induk Siswa / Mahasiswa</label>
                    <input type="text" class="form-control" id="no_induk" name="no_induk" value="<?= $peserta['no_induk']; ?>">
                    <?= form_error('no_induk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="formGroupExampleInput">Kolat / Sekolah / Kampus</label>
                        <input type="text" class="form-control" id="kolat" name="kolat" value="<?= $peserta['kolat']; ?>">
                        <?= form_error('kolat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="formGroupExampleInput">Tingkatan MP</label>
                        <select class="form-control" name="tingkatan" id="tingkatan">
                            <option value="0" selected="selected">- Pilih -</option>
                            <option value="Dasar 1">Dasar I</option>
                            <option value="Dasar 2">Dasar II</option>
                            <option value="Balik 1">Balik I</option>
                            <option value="Balik 2">Balik II</option>
                            <option value="Kombinasi 1">Kombinasi I</option>
                            <option value="Kombinasi 2">Kombinasi II</option>
                            <option value="Khusus 1">Khusus I</option>
                            <option value="Khusus 2">Khusus II</option>
                            <option value="Khusus 3">Khusus III</option>
                        </select>
                        <?= form_error('tingkatan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alamat Tempat Tinggal</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2"><?= $peserta['alamat']; ?></textarea>
                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="formGroupExampleInput">Jenis Kelamin</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="0" selected="selected">- Pilih -</option>
                            <option value="P">Perempuan</option>
                            <option value="L">Laki-Laki</option>
                        </select>
                        <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="formGroupExampleInput">Tinggi <sub> (Cm)</sub></label>
                        <input type="text" class="form-control" id="tb" name="tb" value="<?= $peserta['tb']; ?>">
                        <?= form_error('tb', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="formGroupExampleInput">Berat<sub> (Kg)</sub></label>
                        <input type="text" class="form-control" id="bb" name="bb" value="<?= $peserta['bb']; ?>">
                        <?= form_error('bb', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="formGroupExampleInput">Gol Darah</label>
                        <select class="form-control" name="goldar" id="goldar">
                            <option value="0" selected="selected">Pilih</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="O">O</option>
                            <option value="AB">AB</option>
                        </select>
                        <?= form_error('goldar', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="formGroupExampleInput">Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="kategori" value="<?= $peserta['kategori']; ?>" readonly></input>
                        <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="formGroupExampleInput">Sub Kategori</label>
                        <input type="text" class="form-control" name="jenis" id="jenis" value="<?= $peserta['jenis']; ?>" readonly></input>
                        <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="formGroupExampleInput">Kelas</label>
                        <input type="text" class="form-control" name="kelas" id="kelas" value="<?= $peserta['kelas']; ?>" readonly>
                        <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <!-- awal upload gambar -->

                <div class="form-group">
                    <div class="form-group row">
                        <div class="col-sm-2">Gambar</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/') . $peserta['gambar']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                        <label class="custom-file-label" for="gambar">- Pilih file -</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir upload gambar -->

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                </div>
            </form>

            </form>
        </div>


    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->