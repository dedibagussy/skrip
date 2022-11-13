<?php
session_start();

$koneksi = mysqli_connect("localhost","root","","db_skyresto");

if (isset($_POST['tambah_keranjang'])) {

    if (isset($_SESSION['keranjang'])){

        $session_array_id = array_column($_SESSION['keranjang'], "id");

        if (!in_array($_GET['id'], $session_array_id)) {

            $session_array = array(
                'id' => $_GET['id'],
                "nama" => $_POST['nama'],
                "harga" => $_POST['harga'],
                "jumlah" => $_POST['jumlah']
            );
            $_SESSION['cart'][] = $session_array;
        }

    }else{

        $session_array = array(
            'id' => $_GET['id'],
            "nama" => $_POST['nama'],
            "harga" => $_POST['harga'],
            "jumlah" => $_POST['jumlah']
        );

        $_SESSION['keranjang'][] = $session_array;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TreeTop SkyResto</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
<head>
<body>


    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center">Data Produk</h2>
                    <div class="col-md-12">
                        <div class="row">

                       
                    <?php
                    $query = "SELECT * FROM produk";
                    $result = mysqli_query($koneksi,$query);

                    while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="col-md-3">
                            <form method="post" action="cart.php?id=<?=$row['id'] ?>">
                            <h5 class="text-center"><?= $row['nama']; ?></h5>
                            <h5 class="text-center">Rp.<?= number_format($row['harga'],2); ?></h5>
                            <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                            <input type="hidden" name="harga" value="<?= $row['harga'] ?>">
                            <input type="number" name="jumlah" value="1" class="form-control">
                            <input type="submit" name="tambah_keranjang" class="btn btn-primary btn-block my-2"  value="Tambah Pesanan">
                          </form>
                        </div>

                    <?php } ?>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-center">Transaksi</h2>
                    <?php
                    $total = 0;
                    $output = "";
                    $output .= "
                        <table class='table table-bordered table-striped'>
                            <tr>
                                <th>ID</th>
                                <th>Nama Item</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                    ";

                    if(!empty($_SESSION['keranjang'])){

                        foreach ($_SESSION['keranjang'] as $key => $value) {

                            $output .= "
                            <tr>
                                <td>".$value['id']."</td>
                                <td>".$value['nama']."</td>
                                <td>".$value['harga']."</td>
                                <td>".$value['jumlah']."</td>
                                <td>$".number_format($value['harga'] * $value['jumlah'],2)."</td>
                                <td>
                                <a href='cart.php?action=remove&id=".$value['id']."'>
                                <button class-'btn btn-danger btn-block'>Hapus</button>
                                </a>

                            </td>
                            ";

                            $total = $total + $value['jumlah'] * $value['harga'];
                        }

                        $output .= "
                            <tr>
                                <td colspan='3'></td>
                                <td>Total Bayar</td>
                                <td>".number_format($total,2)."</td>
                                <td>
                                    <a href='cart.php?action=clearall'>
                                    <button class-'btn btn-danger btn-block'>Hapus Semua</button>
                                </td>
                                </tr>
                        ";
                    }
                    echo $output;
                    ?>

                </div>
            </div>
        </div>
    </div>

    
    <script src="js/bootstrap..min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>/