<?php

require_once "../admin/koneksi.php";

if (isset($_POST['send'])) {
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $select = mysqli_query($koneksi, "SELECT email FROM contact WHERE email = '$email'");

    if (mysqli_num_rows($select) > 0) {
        header("location: ../contact.php?status=email-sudahada");
        exit();
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO contact (nama, email, subject, message) VALUES ('$name', '$email', '$subject', '$message') ");

        if ($insert) {
            header("Location: ../contact.php?status=success");
            exit();
        }
    }
}
