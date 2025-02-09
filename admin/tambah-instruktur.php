<?php
session_start();
include 'koneksi.php';
//jika button simpan ditekan
if (isset($_POST['simpan'])) {
    $nama_instruktur = $_POST['nama_instruktur'];
    $nama_jurusan = $_POST['nama_jurusan'];
    //$_POST : ambil dari form input nama
    //$_GET : url ?param'nilai'
    //$_FILES: ngambil nilai dari type file

    if (!empty($_FILES['foto']['name'])) {
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];

        // png, jpg, jpeg
        $ext = array('png', 'jpg', 'jpeg', 'jfif');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        //JIKA EXTENSI FOTO TIDAK ADA DI DAFTAR ARRAY EXT
        if (!in_array($extFoto, $ext)) {
            echo "Maaf, hanya bisa upload file dengan ekstensi png, jpg, jpeg";
            die;
        } else {
            //pindahkan gambar dari tmp folder ke folder yang sudah kita buat 
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);

            $insert = mysqli_query($koneksi, "INSERT INTO instruktur (nama_instruktur, nama_jurusan, foto) VALUES ('$nama_instruktur', '$nama_jurusan', '$nama_foto')");
        }
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO instruktur (nama_instruktur, nama_jurusan) VALUES ('$nama_instruktur', '$nama_jurusan')");
    }
    header("location:instruktur.php?tambah=berhasil");
}
$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$queryEdit = mysqli_query($koneksi, "SELECT * FROM instruktur WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $nama_instruktur = $_POST['nama_instruktur'];
    $nama_jurusan = $_POST['nama_jurusan'];

    //jika user ingin memasukkan gambar
    if (!empty($_FILES['foto']['name'])) {
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];

        // png, jpg, jpeg
        $ext = array('png', 'jpg', 'jpeg', 'jfif');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        if (!in_array($extFoto, $ext)) {
            echo "ekstensi gambar tidak ditemukan";
            die;
        } else {
            unlink('upload/' . $rowEdit['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);

            // coding update 
            $update = mysqli_query($koneksi, "UPDATE instruktur SET nama_instruktur='$nama_instruktur', nama_jurusan='$nama_jurusan', foto='$nama_foto' WHERE id = '$id'");
        }
    } else { //kalau user tidak ingin memasukkan gambar
        $update = mysqli_query($koneksi, "UPDATE instruktur SET nama_instruktur='$nama_instruktur', nama_jurusan='$nama_jurusan' WHERE id = '$id'");
    }

    header("location:instruktur.php?edit=berhasil");
}
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <?php include 'inc/head.php' ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- menu sidebar -->
            <?php include 'inc/sidebar.php' ?>
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include 'inc/nav.php' ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header bg-secondary text-white mb-4"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Instruktur</div>
                                    <div class="card-body">


                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Nama Instruktur</label>
                                                    <input type="text" name="nama_instruktur" class="form-control" placeholder="Masukkan Nama Anda" required value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_instruktur'] : '' ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Jurusan</label>
                                                    <input type="text" name="nama_jurusan" class="form-control" placeholder="Masukkan Jurusan Anda" required value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_jurusan'] : '' ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <label for="" class="form-label">Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda" id="" required>
                                                </div>
                                            </div> -->
                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <label for="" class="form-label">Foto</label>
                                                    <input type="file" name="foto">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include 'inc/footer.php' ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>