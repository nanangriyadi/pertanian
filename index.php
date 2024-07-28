<!DOCTYPE html>
<html>
<head>
    <title>Petani</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="icon" href="#" />
    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 75%);
        }

        .hover-bg-change:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient min-h-screen text-white">

<?php

$koneksi = mysqli_connect("localhost", "root", "", "pertanian") or die(mysqli_error());

function tambah($koneksi) {
    if (isset($_POST['btn_simpan'])) {
        $id = time();
        $nama_tanaman = $_POST['nama_tanaman'];
        $hasil_panen = $_POST['hasil_panen'];
        $hasil_penjualan = $_POST['hasil_penjualan'];
        $biaya_tanam = $_POST['biaya_tanam'];
        $lama = $_POST['lama'];
        $tgl_panen = $_POST['tgl_panen'];

        if (!empty($nama_tanaman) && !empty($hasil_panen) && !empty($hasil_penjualan) && !empty($biaya_tanam) && !empty($lama) && !empty($tgl_panen)) {
            $sql = "INSERT INTO tabel_panen (id, nama_tanaman, hasil_panen, hasil_penjualan, biaya_tanam, lama_tanam, tanggal_panen) VALUES($id, '$nama_tanaman', '$hasil_panen', '$hasil_penjualan', '$biaya_tanam', '$lama', '$tgl_panen')";
            $simpan = mysqli_query($koneksi, $sql);
            if ($simpan && isset($_GET['aksi'])) {
                if ($_GET['aksi'] == 'create') {
                    header('location: index.php');
                }
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }

    ?> 
        <form action="" method="POST" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg text-black">
            <fieldset>
                <legend><h2 class="text-2xl font-bold mb-4">Tambah data</h2></legend>
                <label class="block mb-2">Nama tanaman <input type="text" name="nama_tanaman" class="w-full p-2 border rounded" /></label> 
                <label class="block mb-2">Hasil Panen (Kg) <input type="number" name="hasil_panen" class="w-full p-2 border rounded" /> </label>
                <label class="block mb-2">Hasil Penjualan (RP) <input type="number" name="hasil_penjualan" class="w-full p-2 border rounded" /> </label>
                <label class="block mb-2">Biaya Tanam (Rp) <input type="number" name="biaya_tanam" class="w-full p-2 border rounded" /> </label>
                <label class="block mb-2">Lama Tanam (Hari) <input type="number" name="lama" class="w-full p-2 border rounded" /> </label> 
                <label class="block mb-2">Tanggal panen <input type="date" name="tgl_panen" class="w-full p-2 border rounded" /></label> 
                <br>
                <label class="block mb-2">
                    <input type="submit" name="btn_simpan" value="Simpan" class="bg-blue-500 hover:bg-blue-700 hover:text-black text-white font-bold py-2 px-4 rounded"/>
                    <input type="reset" name="reset" value="Bersihkan" class="bg-gray-500 hover:bg-gray-700 hover:text-black text-white font-bold py-2 px-4 rounded"/>
                </label>
                <br>
                <p class="text-red-500"><?php echo isset($pesan) ? $pesan : "" ?></p>
            </fieldset>
        </form>
    <?php
}

function tampil_data($koneksi) {
    $sql = "SELECT * FROM tabel_panen";
    $query = mysqli_query($koneksi, $sql);

    echo "<fieldset class='max-w-6xl mx-auto bg-white p-10 rounded-lg shadow-lg text-black'>";
    echo "<legend><h2 class='text-2xl py-2 mt-6 px-2 font-bold'>Data Panen</h2></legend>";

    echo "<table class='min-w-full bg-white'>";
    echo "<thead class='bg-gray-800 text-white'>";
    echo "<tr>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>ID</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Nama Tanaman</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Hasil Panen (Kg)</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Hasil Penjualan (RP)</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Biaya Tanam (Rp)</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Lama Tanam (Hari)</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Tanggal Panen</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Tindakan</th>
          </tr>";
    echo "</thead>";
    echo "<tbody class='text-gray-700'>";
    while ($data = mysqli_fetch_array($query)) {
        ?>
            <tr class="hover-bg-change">
                <td class='py-3 px-4'><?php echo $data['id']; ?></td>
                <td class='py-3 px-4'><?php echo $data['nama_tanaman']; ?></td>
                <td class='py-3 px-4'><?php echo $data['hasil_panen']; ?></td>
                <td class='py-3 px-4'><?php echo $data['hasil_penjualan']; ?></td>
                <td class='py-3 px-4'><?php echo $data['biaya_tanam']; ?></td>
                <td class='py-3 px-4'><?php echo $data['lama_tanam']; ?></td>
                <td class='py-3 px-4'><?php echo $data['tanggal_panen']; ?></td>
                <td class='py-3 px-4'>
                    <a href="index.php?aksi=update&id=<?php echo $data['id']; ?>&nama_tanaman=<?php echo $data['nama_tanaman']; ?>&hasil_panen=<?php echo $data['hasil_panen']; ?>&hasil_penjualan=<?php echo $data['hasil_penjualan']; ?>&biaya_tanam=<?php echo $data['biaya_tanam']; ?>&lama=<?php echo $data['lama_tanam']; ?>&tanggal=<?php echo $data['tanggal_panen']; ?>" class="bg-gray-500 hover:bg-gray-700 text-white hover:text-black font-bold py-2 px-2 flex rounded">Ubah</a> |
                    <a href="index.php?aksi=delete&id=<?php echo $data['id']; ?>" class="bg-red-500 hover:bg-gray-700 hover:text-black text-white font-bold py-2 px-2 flex rounded"">Hapus</a>
                </td>
            </tr>
        <?php
    }
    echo "</tbody>";
    echo "</table>";
    echo "</fieldset>";
}

function ubah($koneksi) {
    if (isset($_POST['btn_ubah'])) {
        $id = $_POST['id'];
        $nama_tanaman = $_POST['nama_tanaman'];
        $hasil_panen = $_POST['hasil_panen'];
        $hasil_penjualan = $_POST['hasil_penjualan'];
        $biaya_tanam = $_POST['biaya_tanam'];
        $lama = $_POST['lama'];
        $tgl_panen = $_POST['tgl_panen'];

        if (!empty($nama_tanaman) && !empty($hasil_panen) && !empty($hasil_penjualan) && !empty($biaya_tanam) && !empty($lama) && !empty($tgl_panen)) {
            $sql_update = "UPDATE tabel_panen SET nama_tanaman='$nama_tanaman', hasil_panen='$hasil_panen', hasil_penjualan='$hasil_penjualan', biaya_tanam='$biaya_tanam', lama_tanam='$lama', tanggal_panen='$tgl_panen' WHERE id=$id";
            $update = mysqli_query($koneksi, $sql_update);
            if ($update && isset($_GET['aksi'])) {
                if ($_GET['aksi'] == 'update') {
                    header('location: index.php');
                }
            }
        } else {
            $pesan = "Data tidak lengkap!";
        }
    }

    if (isset($_GET['id'])) {
        ?>
            <a href="index.php" class="bg-blue-500 text-white font-bold py-2 px-4 hover:text-blue-700 hover:text-black rounded"> &laquo; Home</a> | 
            <a href="index.php?aksi=create" class="bg-blue-500 text-white font-bold py-2 px-4 hover:text-blue-700 hover:text-black rounded"> Tambah Data</a>
            <hr>
            
            <form action="" method="POST" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg text-black">
            <fieldset>
                <legend><h2 class="text-2xl font-bold mb-4">Ubah data</h2></legend>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
                <label class="block mb-2">Nama tanaman <input type="text" name="nama_tanaman" value="<?php echo $_GET['nama_tanaman'] ?>" class="w-full p-2 border rounded" /></label> 
                <label class="block mb-2">Hasil Panen (Kg) <input type="number" name="hasil_panen" value="<?php echo $_GET['hasil_panen'] ?>" class="w-full p-2 border rounded" /></label>
                <label class="block mb-2">Hasil Penjualan (RP) <input type="number" name="hasil_penjualan" value="<?php echo $_GET['hasil_penjualan'] ?>" class="w-full p-2 border rounded" /></label>
                <label class="block mb-2">Biaya Tanam (Rp) <input type="number" name="biaya_tanam" value="<?php echo $_GET['biaya_tanam'] ?>" class="w-full p-2 border rounded" /></label>
                <label class="block mb-2">Lama Tanam (Hari) <input type="number" name="lama" value="<?php echo $_GET['lama'] ?>" class="w-full p-2 border rounded" /></label> 
                <label class="block mb-2">Tanggal panen <input type="date" name="tgl_panen" value="<?php echo $_GET['tanggal'] ?>" class="w-full p-2 border rounded" /></label> 
                <br>
                <label class="block mb-2">
                    <input type="submit" name="btn_ubah" value="Simpan Perubahan" class="bg-blue-500 hover:bg-blue-700 text-white hover:text-black font-bold py-2 px-4 rounded"/> atau <a href="index.php?aksi=delete&id=<?php echo $_GET['id'] ?>" class="bg-red-500 py-2 px-4 rounded text-white font-bold hover:text-black"> Hapus data ini</a>
                </label>
                <br>
                <p class="text-red-500"><?php echo isset($pesan) ? $pesan : "" ?></p>
            </fieldset>
            </form>
        <?php
    }
}

function hapus($koneksi) {
    if (isset($_GET['id']) && isset($_GET['aksi'])) {
        $id = $_GET['id'];
        $sql_hapus = "DELETE FROM tabel_panen WHERE id=$id";
        $hapus = mysqli_query($koneksi, $sql_hapus);
        if ($hapus) {
            if ($_GET['aksi'] == 'delete') {
                header('location: index.php');
            }
        }
    }
}

if (isset($_GET['aksi'])) {
    switch ($_GET['aksi']) {
        case "create":
            echo '<a href="index.php" class="text-blue-500 hover:text-blue-700 hover:text-black"> &laquo; Home</a>';
            tambah($koneksi);
            break;
        case "read":
            tampil_data($koneksi);
            break;
        case "update":
            ubah($koneksi);
            tampil_data($koneksi);
            break;
        case "delete":
            hapus($koneksi);
            break;
        default:
            echo "<h3 class='text-red-500'>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
            tambah($koneksi);
            tampil_data($koneksi);
    }
} else {
    tambah($koneksi);
    tampil_data($koneksi);
}

?>
</body>
</html>
