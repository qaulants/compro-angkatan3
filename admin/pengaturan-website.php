<?php
session_start();
include 'koneksi.php';
$queryPengaturan = mysqli_query($koneksi, "SELECT * FROM general_setting ORDER BY id DESC");
$rowPengaturan = mysqli_fetch_assoc($queryPengaturan);
//jika button simpan ditekan
if (isset($_POST['simpan'])) {
    $website_name = $_POST['website_name'];
    $website_link = $_POST['website_link'];
    $id = $_POST['id'];
    $website_phone = $_POST['website_phone'];
    $website_email = $_POST['website_email'];
    $website_address = $_POST['website_address'];
    
    // mencari data di dalam tabel pengaturan, jika ada data akan di update,
    // jika tidak ada data akan di insert
    if (mysqli_num_rows($queryPengaturan) > 0) {
        if (!empty($_FILES['foto']['name'])) {
            $nama_foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
    
            // png, jpg, jpeg
            $ext = array('png', 'jpg', 'jpeg');
            $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);
    
            //JIKA EXTENSI FOTO TIDAK ADA DI DAFTAR ARRAY EXT
            if (!in_array($extFoto, $ext)) {
                echo "Maaf, hanya bisa upload file dengan ekstensi png, jpg, jpeg";
                die;
            } else {
                //pindahkan gambar dari tmp folder ke folder yang sudah kita buat 
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
    
                $update = mysqli_query($koneksi, "UPDATE general_setting SET website_name ='$website_name', website_link='$website_link', website_phone='$website_phone', website_email='$website_email', website_address='$website_address' logo='$nama_foto'  WHERE id='$id'");
            }
        } else {
            $update = mysqli_query($koneksi, "UPDATE general_setting SET website_name ='$website_name', website_link='$website_link', website_phone='$website_phone', website_email='$website_email', website_address='$website_address' WHERE id = '$id'");
        }
    } else {
        if (!empty($_FILES['foto']['name'])) {
            $nama_foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
    
            // png, jpg, jpeg
            $ext = array('png', 'jpg', 'jpeg');
            $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);
    
            //JIKA EXTENSI FOTO TIDAK ADA DI DAFTAR ARRAY EXT
            if (!in_array($extFoto, $ext)) {
                echo "Maaf, hanya bisa upload file dengan ekstensi png, jpg, jpeg";
                die;
            } else {
                //pindahkan gambar dari tmp folder ke folder yang sudah kita buat 
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
    
                $insert = mysqli_query($koneksi, "INSERT INTO general_setting (website_name, website_link, logo) VALUES ('$website_name', '$website_link', '$nama_foto')");
            }
        } else {
            $insert = mysqli_query($koneksi, "INSERT INTO general_setting (website_name, website_link) VALUES ('$website_name', '$website_link')");
        }
    }

    header("location:pengaturan-website.php");
}



$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$queryEdit = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    //jika pass diisi sama user
    if ($_POST['password']) {
        $password = $_POST['password'];
    } else {
        $password = $rowEdit['password'];
    }

    $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email='$email', password='$password' WHERE id = '$id'");
    header("location:user.php?edit=berhasil");
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
                                    <h3 class="card-header bg-secondary text-white mb-4">Pengaturan Website</h3>
                                    <div class="card-body">

                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>
                                        <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" class="form-control" value="<?php echo isset($rowPengaturan['id']) ? $rowPengaturan['id'] : '' ?>">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Nama Website</label>
                                                        <input type="text" name="website_name" class="form-control" placeholder="Masukkan Nama Perusahaan" required value="<?php echo isset($rowPengaturan['website_name']) ? $rowPengaturan['website_name'] : '' ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Nomor Telepon</label>
                                                        <input type="number" name="website_phone" class="form-control" placeholder="Masukkan Nomor Telepon" required value="<?php echo isset($rowPengaturan['website_phone']) ? $rowPengaturan['website_phone'] : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Link Website</label>
                                                        <input type="url" name="website_link" class="form-control" placeholder="Masukkan link" required value="<?php echo isset($rowPengaturan['website_link']) ? $rowPengaturan['website_link'] : '' ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">email website</label>
                                                        <input type="text" name="website_email" class="form-control" placeholder="Masukkan Email Perusahaan" required value="<?php echo isset($rowPengaturan['website_email']) ? $rowPengaturan['website_email'] : '' ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <label for="" class="form-label">Alamat</label>
                                                    <input type="text" name="website_address" class="form-control" placeholder="Masukkan alamat perusahaan" id="" value="<?php echo isset($rowPengaturan['website_address']) ? $rowPengaturan['website_address'] : '' ?>">
                                                </div>
                                            </div>
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