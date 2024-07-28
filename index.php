<!DOCTYPE html>
<html>

<head>
    <title>Petani</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="#" />
    <style>
    :root {
        --primary: #26ad14;
        --bg: #fff;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        /* outline: none; */
        /* border: none; */
        text-decoration: none;
    }

    body {
        font-family: "Poppins", sans-serif;
        /* background-color: var(--bg); */
        /* color: #010101; */
        min-height: 2000px;
    }

    #menu-toggle:checked+#menu {
        display: block;
    }


    /* .bg-gradient {
        background: linear-gradient(135deg, #6B73FF 0%, #000DFF 75%);
    } */

    .hover-bg-change:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }
    </style>
</head>

<body class="antialiased bg-gray-200">
    <header class="lg:px-16 px-6 bg-white flex fixed top-0 w-full flex-wrap items-center lg:py-0 py-2">
        <div class="flex-1 flex justify-between items-center">
            <a href="#">
                <svg width="32" height="36" viewBox="0 0 32 36" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.922 35.798c-.946 0-1.852-.228-2.549-.638l-10.825-6.379c-1.428-.843-2.549-2.82-2.549-4.501v-12.762c0-1.681 1.12-3.663 2.549-4.501l10.825-6.379c.696-.41 1.602-.638 2.549-.638.946 0 1.852.228 2.549.638l10.825 6.379c1.428.843 2.549 2.82 2.549 4.501v12.762c0 1.681-1.12 3.663-2.549 4.501l-10.825 6.379c-.696.41-1.602.638-2.549.638zm0-33.474c-.545 0-1.058.118-1.406.323l-10.825 6.383c-.737.433-1.406 1.617-1.406 2.488v12.762c0 .866.67 2.05 1.406 2.488l10.825 6.379c.348.205.862.323 1.406.323.545 0 1.058-.118 1.406-.323l10.825-6.383c.737-.433 1.406-1.617 1.406-2.488v-12.757c0-.866-.67-2.05-1.406-2.488l-10.825-6.379c-.348-.21-.862-.328-1.406-.328zM26.024 13.104l-7.205 13.258-3.053-5.777-3.071 5.777-7.187-13.258h4.343l2.803 5.189 3.107-5.832 3.089 5.832 2.821-5.189h4.352z">
                    </path>
                </svg>
            </a>
        </div>

        <label for="menu-toggle" class="pointer-cursor lg:hidden block"><svg class="fill-current text-gray-900"
                xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg></label>
        <input class="hidden" type="checkbox" id="menu-toggle" />

        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <nav>
                <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0">
                    <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400"
                            href="index.php">Home</a></li>
                    <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400"
                            href="admin/index.php">Admin</a></li>
                </ul>
            </nav>
            <a href="#" class="lg:ml-4 flex items-center justify-start lg:mb-0 mb-4 pointer-cursor">
                <img class="rounded-full w-10 h-10 border-2 border-transparent hover:border-indigo-400"
                    src="https://img.freepik.com/free-vector/hand-drawn-clip-art-man-customer-service-call-center-job-office-worker-character_40876-3163.jpg?t=st=1722176373~exp=1722179973~hmac=7485cd79bb670f5a90a52eabe28fd1c29fd1e9c4c90be8c6447d3431f70e3dd6&w=740"
                    alt="Andy Leverenz">
            </a>

        </div>

    </header>

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

    <?php
}

function tampil_data($koneksi) {
    $sql = "SELECT * FROM tabel_panen";
    $query = mysqli_query($koneksi, $sql);

    echo "<fieldset class='max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg text-black'>";
    echo "<legend><h2 class='text-2xl py-2 mt-24 px-2 font-bold'>Data Panen</h2></legend>";

    echo "<table class='min-w-full bg-white'>";
    echo "<thead class='bg-gray-800 text-white'>";
    echo "<tr>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Nama Tanaman</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Hasil Panen (Kg)</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Hasil Penjualan (RP)</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Biaya Tanam (Rp)</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Lama Tanam (Hari)</th>
            <th class='w-1/6 py-3 px-4 uppercase font-semibold text-sm'>Tanggal Panen</th>
          </tr>";
    echo "</thead>";
    echo "<tbody class='text-gray-700'>";
    while ($data = mysqli_fetch_array($query)) {
        ?>
    <tr class="hover-bg-change">
        <td class='py-3 px-4'><?php echo $data['nama_tanaman']; ?></td>
        <td class='py-3 px-4'><?php echo $data['hasil_panen']; ?></td>
        <td class='py-3 px-4'><?php echo $data['hasil_penjualan']; ?></td>
        <td class='py-3 px-4'><?php echo $data['biaya_tanam']; ?></td>
        <td class='py-3 px-4'><?php echo $data['lama_tanam']; ?></td>
        <td class='py-3 px-4'><?php echo $data['tanggal_panen']; ?></td>

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

    if (isset($_GET['id']) ) {
        ?>
    <a href=" index.php" class="bg-blue-500 text-white font-bold py-2 px-4 hover:text-black rounded"> &laquo;
        Home</a> |
    <a href="index.php?aksi=create" class="bg-blue-500 text-white font-bold py-2 px-4 hover:text-black rounded">
        Tambah
        Data</a>
    <hr>

    <form action="" method="POST" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg text-black">
        <fieldset>
            <legend>
                <h2 class="text-2xl font-bold mb-4">Ubah data</h2>
            </legend>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
            <label class="block mb-2">Nama tanaman <input type="text" name="nama_tanaman"
                    value="<?php echo $_GET['nama_tanaman'] ?>" class="w-full p-2 border rounded" /></label>
            <label class="block mb-2">Hasil Panen (Kg) <input type="number" name="hasil_panen"
                    value="<?php echo $_GET['hasil_panen'] ?>" class="w-full p-2 border rounded" /></label>
            <label class="block mb-2">Hasil Penjualan (RP) <input type="number" name="hasil_penjualan"
                    value="<?php echo $_GET['hasil_penjualan'] ?>" class="w-full p-2 border rounded" /></label>
            <label class="block mb-2">Biaya Tanam (Rp) <input type="number" name="biaya_tanam"
                    value="<?php echo $_GET['biaya_tanam'] ?>" class="w-full p-2 border rounded" /></label>
            <label class="block mb-2">Lama Tanam (Hari) <input type="number" name="lama"
                    value="<?php echo $_GET['lama'] ?>" class="w-full p-2 border rounded" /></label>
            <label class="block mb-2">Tanggal panen <input type="date" name="tgl_panen"
                    value="<?php echo $_GET['tanggal'] ?>" class="w-full p-2 border rounded" /></label>
            <br>
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
