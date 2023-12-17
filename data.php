<?php
    //Database
    $servername = "localhost";
    $username = "id21650381_anggotaperpustakaan";
    $password = "@Fachreza23";
    $dbname = "id21650381_eja";

    // Create connection
    $koneksi = mysqli_connect($servername, $username, $password, $dbname)or die(mysqli_error($koneksi));

    //Jika Tombol simpan di klik
    if (isset($_POST['bsimpan']))
    {
        //pengujian apakah data akan di edit atau disimpan baru
        if($_GET['hal'] == "edit")
        {
            //data akan di edit
            $edit = mysqli_query($koneksi, "UPDATE anggota set
            nomor_anggota = '$_POST[tnomor]',
            nama = '$_POST[tnama]',
            asal_instansi = '$_POST[tasal]',
            no_hp = '$_POST[tnomorhp]',
            keperluan = '$_POST[tkeperluan]',
            tanggal = '$_POST[ttanggal]',
            alamat = '$_POST[talamat]'
            WHERE nomor_anggota = '$_GET[nomor_anggota]'
            ");

            if($edit) //jika edit berhasil
            {
                echo"<script> 
                        alert('Edit data sukses!');
                        document.location='data.php';
                    </script>";
            }
            else
            {
                echo"<script> 
                        alert('Edit data GAGAL!');
                        document.location='data.php';
                    </script>";
            }
        }
        else
        {
            //data akan di simpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO anggota (nomor_anggota, nama, asal_instansi, no_hp, keperluan, tanggal, alamat)
            VALUES ('$_POST[tnomor]','$_POST[tnama]','$_POST[tasal]','$_POST[tnomorhp]','$_POST[tkeperluan]','$_POST[ttanggal]','$_POST[talamat]')
            ");

            if($simpan) //jika simpan berhasil
            {
                echo"<script> 
                        alert('Simpan data sukses!');
                        document.location='data.php';
                    </script>";
            }
            else
            {
                echo"<script> 
                        alert('Simpan data GAGAL!');
                        document.location='data.php';
                    </script>";
            }
        }
        
    }

    //Pengujian jika tombol edit dan hapus di klik
    if(isset($_GET['hal']))
    {
        //pengujian jika edit data
        if($_GET['hal'] == "edit")
        {
            //tampilkan data yang di edit
            $tampil = mysqli_query($koneksi, "SELECT * FROM anggota WHERE nomor_anggota = '$_GET[nomor_anggota]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditambahkan maka data ditampung ke dalam variabel
                $vnomor = $data['nomor_anggota'];
                $vnama = $data['nama'];
                $vasal_instansi = $data['asal_instansi'];
                $vno_hp = $data['no_hp'];
                $vkeperluan = $data['keperluan'];
                $vtanggal = $data['tanggal'];
                $valamat = $data['alamat'];
            }
        }
        else if ($_GET['hal'] == "hapus")
        {
            //persiapan hapus data
            $hapus = mysqli_query($koneksi, "DELETE FROM anggota WHERE nomor_anggota = '$_GET[nomor_anggota]' ");
            if($hapus)
            {
                echo"<script> 
                        alert('Hapus data sukses!');
                        document.location='data.php';
                    </script>";
            }
        }
    }
    
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

    <header>
        <!-- Jumbotron -->
        <nav class="navbar navbar-expand-sm fixed-top" style="background-color: #E1F5FE;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <img src="img/logolucu.jpg" alt="Logo" style="width:40px;" class="rounded-pill">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#index.html">Update</a></li>
                        <li class="nav-item"><a class="nav-link" href="#index.html">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#index.html">Information</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Account</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><a class="dropdown-item" href="#">Setting</a></li>
                                <li><a class="dropdown-item" href="#">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div>
                    <form class="d-flex justify-content-end">
                        <input class="form-control me-2" type="text" placeholder="Search">
                        <button class="btn btn-primary btn-info text-white" type="button">Search</button>
                    </form>
                </div> 
                
            </div>
        </nav>
        <!-- Jumbotron -->
    </header>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <h1 class="text-center">Official Website Perpustakaan Daerah</h1>
                        <h2 class="text-center">Pengembalian dan Peminjaman Buku</h2>

                        <!--Awal Card Form-->
                        <div class="card mt-3">
                            <div class="card-header bg-primary text-white">
                                Form Input Data
                            </div>
                            <div class="card-body">
                                <form method="post" action="">
                                    <div class="form-gruop">
                                        <label>Nomor Anggota</label>
                                        <input type="text" name="tnomor" value="<?=@$vnomor?>" class="form-control" placeholder="Input Nomor Anggota Perpustakaan Anda" required>
                                    </div>
                                    <div class="form-gruop">
                                        <label>Nama</label>
                                        <input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama Anda" required>
                                    </div>
                                    <div class="form-gruop">
                                        <label>Asal Instansi atau Sekolah</label>
                                        <input type="text" name="tasal" value="<?=@$vasal_instansi?>"class="form-control" placeholder="Input Asal Instansi atau Sekolah Anda" required>
                                    </div>
                                    <div class="form-gruop">
                                        <label>Nomor HP</label>
                                        <input type="text" name="tnomorhp" value="<?=@$vno_hp?>" class="form-control" placeholder="Input Nomor HP Anda" required>
                                    </div>
                                    <div class="form-gruop">
                                        <label>Keperluan</label>
                                        <select class="form-control" name="tkeperluan">
                                            <option value="<?=@$vkeperluan?>"><?=@$vkeperluan?></option>
                                            <option value="Peminjaman">Peminjaman Buku</option>
                                            <option value="Pengembalian">Pengembalian Buku</option>
                                        </select>
                                    </div>
                                    <div class="form-gruop">
                                        <label>Tanggal</label>
                                        <input type="text" name="ttanggal" value="<?=@$vtanggal?>"class="form-control" placeholder="Input Tanggal Pengenmbalian atau Peminjaman Anda" required>
                                    </div>
                                    <div class="form-gruop">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="talamat"  placeholder="Input Alamat Anda" required><?=@$valamat?></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                                    <button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>
                                </form>
                            </div>
                        </div>
                        <!--Akhir Card Form-->

                        <!--Awal Card Form-->
                        <div class="card mt-3">
                            <div class="card-header bg-info text-white">
                                Daftar Anggota
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Nomor Anggota</th>
                                        <th>Nama</th>
                                        <th>Asal Instansi atau Sekolah</th>
                                        <th>Nomor HP</th>
                                        <th>Keperluan</th>
                                        <th>Tanggal</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php
                                        $tampil = mysqli_query($koneksi, "SELECT * from anggota order by nomor_anggota desc");
                                        while($data = mysqli_fetch_array($tampil)):
                                    ?>
                                    <tr>
                                        <td><?=$data['nomor_anggota']?></td>
                                        <td><?=$data['nama']?></td>
                                        <td><?=$data['asal_instansi']?></td>
                                        <td><?=$data['no_hp']?></td>
                                        <td><?=$data['keperluan']?></td>
                                        <td><?=$data['tanggal']?></td>
                                        <td><?=$data['alamat']?></td>
                                        <td>
                                            <a href="data.php?hal=edit&nomor_anggota=<?=$data['nomor_anggota']?>" class="btn btn-secondary">Edit</a>
                                            <a href="data.php?hal=hapus&nomor_anggota=<?=$data['nomor_anggota']?>" onclick="return confirm('Apakah ada yakin untuk menghapus data ini?')" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endwhile;//penutup perulangan while?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    </body>
</html>