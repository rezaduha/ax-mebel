<?php
include 'class.php';
session_start();

$db = new Koneksi;
$tabel = "products";
$total_berita = $db->get_total_records($tabel);
$current_page = $db->current_page();
$jum_display = 15;
$jum_hal = ceil($total_berita/$jum_display);
$mulai = ($current_page>1) ? ($current_page * $jum_display) - $jum_display : 0;
?>

<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/body.css" />
    <link rel="stylesheet" type="text/css" href="css/header.css" />
    <link rel="stylesheet" type="text/css" href="css/table.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
</head>
<body>
    <div class="header" id="myHeader" style="background:grey">
        <a class="name_top">DASHBOARD</a>
        <div class="header-right">
            <a href="dashboardInsert.php" style="background: #4e3f39; color:white;">Add New</a>
        </div>
    </div>
    <br>
    <br>
    <center>
        <table id="tableproduct">
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Code</th>
                <th>Price</th>
                <th>Image</th>
                <th colspan=2>Tools</th>
            </tr>
            <tr>
                <?php foreach ($db->display_product_page($mulai, $jum_display) as $o)
                {
                    ?>
                    <td>
                        <?php
                        echo $o['id'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $o['name'];
                        
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $o['code'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo "$".$o['price'];
                        ?>
                    </td>
                    <td>
                        <?php 
                        echo $o['image'];
                        ?>
                    </td>
                    <td>
                        <button class="buttonedit">
                            <a style="text-decoration: none; color: #fff" href="dashboardUpdate.php?id=<?php echo $o['id'];?>">Edit</a></td>
                        </button>
                    <td>
                        <button class="buttondelete">
                            <a style="text-decoration: none; color: #fff" href="process.php?id=<?php echo $o['id'];?>&aksi=delete_data">Hapus</a></td>
                        </button>
                </tr>

                <?php
            }
            ?>

        </table>
        <br>
    <div>
        <?php for ($i=1; $i<=$jum_hal; $i++)
        {
            ?>
            <a style="color: #127daa; text-decoration: none; margin: 5px" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php
        }
        ?>
    </div>
</center>
<br>
    <script>
        window.onscroll = function() {myFunction()};

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>       
</body>
</html>