<?php
include 'class.php';
session_start();

$db = new Koneksi;
?>

<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="css/body.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
</head>
<body style='background: url("images/axbackground.jpg") center  no-repeat;'>
    <div class="container-form">
        <form action="process.php?aksi=insert_data" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Add New Product</legend>
                <p>
                    <div class="form-element">
                        <label>Name</label>
                        <input type="text" name="name" value=""/>
                    </div>
                </p>
                <p>
                    <div class="form-element">
                        <label>Code</label>
                        <input type="text" name="code" value="" />
                    </div>
                </p>
                <p>
                    <div class="form-element">
                        <label>Price</label>
                        <input type="number" name="price" value="" />
                    </div>
                </p>
                <p>
                    <label>Choose a Picture</label>
                    <input type="file" name="image" value="" />

                </p>
                <p>
                    <input type="submit" name="insert_data" value="Save" />
                </p>
            </fieldset>
        </form>
    </div>

</body>
</html>