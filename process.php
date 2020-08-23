<?php
include 'class.php';
session_start();

$db     = new Koneksi();
$aksi   = $_GET['aksi'];

if($aksi == "login") {
    $login = $db->login($_POST['username'],  $_POST['password']);

    if($login) {
        $_SESSION['username'] = $_POST['username'];
        header("location:dashboard.php");
    } else {
        echo "<script type='text/javascript'>
        alert('Check your username and password');
        history.back(self);
        </script>";
    }
}

else if($aksi == "delete_data") {
    $delete_data = $db->delete_data($_GET['id']);

    if($delete_data) {
        echo "<script type='text/javascript'>
        alert('Data Succesfully Deleted');window.location='dashboard.php'
        </script>";
    } else {
        echo "<script type='text/javascript'>
        alert('Failed to Delete Data');window.location='dashboard.php'
        </script>";
    }
}

else if($aksi == "insert_data") {
    $insert_data = $db->insert_data($_POST['name'], $_POST['code'], $_POST['price'],
        $_FILES['image']['name']);

    if($insert_data) {
        echo "<script type='text/javascript'>
        alert('Added Data Succesfully');window.location='dashboard.php'
        </script>";
        move_uploaded_file($_FILES['image']['tmp_name'], "images/".$_FILES['image']['name']);
    } else {
        echo "<script type='text/javascript'>
        alert('Failed to Add Data');window.location='dashboard.php'
        </script>";
    }
}

else if($aksi == "update_data") {
    $update_data = $db->update_data($_POST['id'], $_POST['name'],$_POST['code'], $_POST['price'],
        $_FILES['image']['name']);

    if($update_data) {
        echo "<script type='text/javascript'>
        alert('Data Updated Succesfully');window.location='dashboard.php'
        </script>";
        move_uploaded_file($_FILES['image']['tmp_name'], "images/".$_FILES['image']['name']);
    } else {
        echo "<script type='text/javascript'>
        alert('Failed to Update Data');window.location='dashboard.php'
        </script>";
    }
}
?>