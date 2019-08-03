<!-- Begin Page Content -->
<div class="container-fluid">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Belum Bayar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sudah Bayar</a>
        </li>
    </ul>



    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
        <h1 class="h3 mb-0 text-gray-800">Daftar Peserta Kontingen Kejurnas Brawijaya II 2019</h1>
    </div>

    <div class="table-responsive-sm col-6">
        <table class="table table-hover table-bordered">
            <thead align="center">
                <tr>
                    <th scope="col" rowspan="2">No</th>
                    <th scope="col" rowspan="2">Kontingen</th>
                    <th scope="col" colspan="4">Kategori</th>
                    <th scope="col" rowspan="2">Total</th>
                </tr>
                <tr>
                    <th scope="col">Tanding</th>
                    <th scope="col">Seni</th>
                    <th scope="col">Getaran</th>
                    <th scope="col">Stamina Tenaga</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php $no = 1; ?>
                <?php foreach ($kontingen as $k) : ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= $k['nama']; ?></td>
                        <td><?= $k['Tanding']; ?></td>
                        <td><?= $k['Seni']; ?></td>
                        <td><?= $k['Getaran']; ?></td>
                        <td><?= $k['Staga']; ?></td>
                        <td><?= $k['Tanding'] + $k['Seni'] + $k['Getaran'] + $k['Staga']; ?></td>
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