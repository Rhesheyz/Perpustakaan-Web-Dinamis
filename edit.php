<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['aksi'] == 'edit') {
        $id = $_POST['id'];
        $jenis = $_POST['jenis'];

        if ($jenis == 'buku') {
            editBuku($_POST, $id);
        } elseif ($jenis == 'penerbit') {
            editPenerbit($_POST, $id);
        }

        header("Location: admin.php");
    }
}

function editBuku($data, $id)
{
    global $koneksi;
    $kategori = mysqli_real_escape_string($koneksi, $data['kategori']);
    $nama_buku = mysqli_real_escape_string($koneksi, $data['nama_buku']);
    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $stok = mysqli_real_escape_string($koneksi, $data['stok']);
    $penerbit = mysqli_real_escape_string($koneksi, $data['penerbit']);

    $query = "UPDATE buku SET kategori='$kategori', nama_buku='$nama_buku', harga='$harga', stok='$stok', penerbit='$penerbit' WHERE id_buku='$id'";
    mysqli_query($koneksi, $query);
}

function editPenerbit($data, $id)
{
    global $koneksi;
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $kota = mysqli_real_escape_string($koneksi, $data['kota']);
    $telepon = mysqli_real_escape_string($koneksi, $data['telepon']);

    $query = "UPDATE penerbit SET nama='$nama', alamat='$alamat', kota='$kota', telepon='$telepon' WHERE id_penerbit='$id'";
    mysqli_query($koneksi, $query);
}

// Fetch data dari database sesuai ID dan jenis
$id = $_GET['id'];
$jenis = $_GET['jenis'];

if ($jenis == 'buku') {
    $result = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
} elseif ($jenis == 'penerbit') {
    $result = mysqli_query($koneksi, "SELECT * FROM penerbit WHERE id_penerbit='$id'");
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>

    <h2>Edit Data</h2>
    
    <?php if ($jenis == 'buku') : ?>
        <form action="edit.php" method="post">
            
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="jenis" value="buku">
            
            <label for="kategori" class="block text-sm font-medium text-gray-600">Kategori:</label>
            <input type="text" name="kategori" value="<?= $data['kategori'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"><br>

            <label for="nama_buku" class="block text-sm font-medium text-gray-600">Nama Buku:</label>
            <input type="text" name="nama_buku" value="<?= $data['nama_buku'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"><br>

            <label for="harga" class="block text-sm font-medium text-gray-600">Harga:</label>
            <input type="text" name="harga" value="<?= $data['harga'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"><br>

            <label for="stok" class="block text-sm font-medium text-gray-600">Stok:</label>
            <input type="text" name="stok" value="<?= $data['stok'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"><br>

            <label for="penerbit" class="block text-sm font-medium text-gray-600">Penerbit:</label>
            <input type="text" name="penerbit" value="<?= $data['penerbit'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"><br>

            <input type="hidden" name="aksi" value="edit">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer">Simpan Perubahan</button>
        </form>
    <?php elseif ($jenis == 'penerbit') : ?>
        <form action="edit.php" method="post" class="mb-8">

            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="jenis" value="penerbit">

            <label for="nama" class="block text-sm font-medium text-gray-600">Nama:</label>
            <input type="text" name="nama" value="<?= $data['nama'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"><br>

            <label for="alamat" class="block text-sm font-medium text-gray-600">Alamat:</label>
            <input type="text" name="alamat" value="<?= $data['alamat'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"><br>

            <label for="kota" class="block text-sm font-medium text-gray-600">Kota:</label>
            <input type="text" name="kota" value="<?= $data['kota'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"><br>

            <label for="telepon" class="block text-sm font-medium text-gray-600">Telepon:</label>
            <input type="text" name="telepon" value="<?= $data['telepon'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"><br>

            <input type="hidden" name="aksi" value="edit">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer">Simpan Perubahan</button>
        </form>
    <?php endif; ?>

</body>
</html>
