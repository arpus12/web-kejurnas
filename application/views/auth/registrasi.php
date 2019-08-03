<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">

                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                            </div>

                            <!-- Form Input data register -->
                            <form class="user" method="post" action="<?= base_url('auth/registrasi'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>

                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="kontingen" name="kontingen" placeholder="Kontingen" value="<?= set_value('kontingen'); ?>">
                                    <?= form_error('kontingen', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>">
                                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="Nomor Handphone" value="<?= set_value('no_hp'); ?>">
                                    <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="status" name="status" value="Manager" readonly>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class=" form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Registrasi
                                </button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Lupa Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth') ?>">Akun Sudah Tersedia? Silahkan Login!</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('welcome') ?>">Kembali ke Halaman Utama</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>