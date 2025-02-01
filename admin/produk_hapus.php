<?php
include "../koneksi.php";

mysqli_query($koneksi,"DELETE from products where id='$_GET[kdproduk]'");
?>
<script>document.location='produk_tampilan.php'</script>