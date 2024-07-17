<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS khusus untuk mengatur tampilan tabel */
        .table-container {
            margin-top: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .table-container th,
        .table-container td {
            padding: 10px;
            border: 1px solid #ddd;
            /* Garis batas antar sel */
            text-align: center;
        }

        .table-container thead {
            background-color: #007bff;
            /* Warna latar header */
            color: white;
            /* Warna teks header */
        }

        .table-container tbody tr:nth-child(even) {
            background-color: #f2f2f2;
            /* Warna latar setiap baris ganjil */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md">
                <h2 class="text-uppercase text-center fw-bold">Tambah Data Siswa</h2>
            </div>
        </div>
        <hr>
        <?php
        // Include file koneksi.php
        include 'koneksi.php';

        // Cek jika form telah disubmit
        if (isset($_POST['submit'])) {
            // Ambil nilai dari form
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $agama = $_POST['agama'];
            $asal_sekolah = $_POST['asal_sekolah'];

            // Query SQL untuk memasukkan data ke dalam tabel data_siswa
            $sql = "INSERT INTO data_siswa (nama, alamat, jenis_kelamin, agama, asal_sekolah) 
                    VALUES ('$nama', '$alamat', '$jenis_kelamin', '$agama', '$asal_sekolah')";

            // Eksekusi query
            if ($conn->query($sql) === TRUE) {
                echo "Data berhasil ditambahkan";
                // Redirect ke halaman index.php setelah berhasil menyimpan data
                header("location: index.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>

        <div class="container">
            <div class="card mt-5">
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki"
                                        value="L" checked>
                                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                        value="P">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama:</label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        <a href="index.php" class="btn btn-success">Kembali</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>

</html>