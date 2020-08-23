<?php
class Koneksi{
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPass = "";
    private $dbName = 'axmebel_data';
    protected $connect;

    public function __construct() {
        $this->connect = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
    }

    function login($uName, $pass) {
        $query = "SELECT * FROM user WHERE username = '$uName' AND password = '$pass'";
        $result = mysqli_query($this->connect, $query);
        
        if (mysqli_num_rows($result) == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function display_product() {
        $query = "SELECT * FROM products";
        $result = mysqli_query($this->connect, $query);
        
        while ($data = mysqli_fetch_array($result)) {
            $value[] = $data; 
        }
        return $value;
    }

    function display_edit($id) {
        $query = "SELECT * FROM products WHERE id = '$id'";
        $result = mysqli_query($this->connect, $query);
        
        while ($data = mysqli_fetch_array($result)) {
            $value[] = $data; 
        }
        return $value;
    }

    function insert_data($name,$code, $price, $image) {
        $query = "INSERT INTO products (name, code, price, image) VALUES ('$name','$code', '$price', 'images/$image')";
        $result = mysqli_query($this->connect, $query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_data($id, $name, $code, $price, $image) {
        $query = "UPDATE products SET name = '$name', code = '$code', price = '$price', image = 'images/$image' WHERE id = '$id'";
        $result = mysqli_query($this->connect, $query);
        
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_data($id) {
        $query = "DELETE FROM products WHERE id='$id'";
        $result = mysqli_query($this->connect, $query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_total_records($tabel) {
        $query =  "SELECT * FROM  $tabel";
        $result = mysqli_query($this->connect, $query);
        $temp =  mysqli_num_rows($result);

        if($temp) {
            return $temp;
        } else  {
            return false;
        }
    }

    function current_page() {
        return (isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1);
    }

    function  display_product_page($mulai, $jum_display) {
        $query = "SELECT * FROM products LIMIT $mulai,$jum_display";
        $result = mysqli_query($this->connect, $query);
        
        while ($data = mysqli_fetch_array($result)) {
            $value[] = $data; 
        }
        return $value;
    }

    function  display_page($mulai, $jum_display, $tabel) {
        $query = "SELECT * FROM $table LIMIT $mulai,$jum_display";
        $result = mysqli_query($this->connect, $query);
        
        while ($data = mysqli_fetch_array($result)) {
            $value[] = $data; 
        }
        return $value;
    }
}
?>