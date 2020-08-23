<?php
include 'class.php';
session_start();

$db = new Koneksi;
?>

<html>
<head>
    <title>Update Product</title>
    <link rel="stylesheet" type="text/css" href="css/body.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
</head>
<body style='background: url("images/axbackground.jpg") center  no-repeat;'>
    <div class="container-form">
        <form action="process.php?aksi=update_data" method="POST" enctype="multipart/form-data">
            <fieldset>
                <?php
                foreach ($db->display_edit($_GET['id']) as $y)
                {
                    ?>
                    <legend>Update Product</legend>
                    <input type="hidden" name="id" value="<?php echo $y['id']?>" />
                    <p>
                        <div class="form-element">
                            <label>Name</label>
                            <input type="text" name="name" value="<?php echo $y['name']?>"/>
                        </div>
                    </p>
                    <p>
                        <div class="form-element">
                            <label>Code</label>
                            <input type="text" name="code" value="<?php echo $y['code']?>"/>
                        </div>
                    </p>
                    <p>
                        <div class="form-element">
                            <label>Price</label>
                            <input type="number" name="price" value="<?php echo $y['price']?>" />
                        </div>
                    </p>
                    <p>
                        <label>Choose a Picture</label>
                        <input type="File" name="image" value="<?php echo $y['image']?>" />
                    </p>
                    <p>
                        <input type="submit" name="update_data" value="Update" />
                    </p>
                    <?php
                }
                ?>
            </fieldset>
        </form>
    </div>
</body>
</html>