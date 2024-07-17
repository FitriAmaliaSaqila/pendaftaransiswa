<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md">
                <h2 class="text-uppercase text-center fw-bold">Edit Data Siswa</h2>
            </div>
        </div>
        <hr>
        <?php
        // Include file koneksi database
        include 'koneksi.php';

        // Cek apakah parameter ID ada dalam URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query untuk mengambil data siswa berdasarkan ID
            $query = "SELECT * FROM data_siswa WHERE id = $id";
            $result = mysqli_query($conn, $query);

            // Jika data ditemukan
            if (mysqli_num_rows($result) > 0) {
                $d = mysqli_fetch_assoc($result);

                // Proses update data saat form disubmit
                if (isset($_POST['submit'])) {
                    $nama = $_POST['nama'];
                    $alamat = $_POST['alamat'];
                    $jenis_kelamin = $_POST['jenis_kelamin'];
                    $agama = $_POST['agama'];
                    $asal_sekolah = $_POST['asal'];

                    // Query untuk update data siswa
                    $sql_update = "UPDATE data_siswa SET 
                                   nama='$nama', 
                                   alamat='$alamat', 
                                   jenis_kelamin='$jenis_kelamin', 
                                   agama='$agama', 
                                   asal_sekolah='$asal_sekolah' 
                                   WHERE id=$id";

                    if ($conn->query($sql_update) === TRUE) {
                        echo '<div class="alert alert-success" role="alert">Data berhasil diupdate</div>';
                        // Redirect atau kembali ke halaman lain setelah update berhasil dilakukan
                        header("Location: index.php");
                        exit();
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
                    }
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Data tidak ditemukan</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">ID tidak valid</div>';
        }
        ?>

        <div class="container">
            <div class="card mt-5">
                <div class="card-body">
                    <form method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?php echo $d['nama']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="<?php echo $d['alamat']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki"
                                        value="L" <?php echo ($d['jenis_kelamin'] == 'L') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                        value="P" <?php echo ($d['jenis_kelamin'] == 'P') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama:</label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam" <?php echo ($d['agama'] == 'Islam') ? 'selected' : ''; ?>>Islam
                                </option>
                                <option value="Kristen" <?php echo ($d['agama'] == 'Kristen') ? 'selected' : ''; ?>>
                                    Kristen</option>
                                <option value="Katolik" <?php echo ($d['agama'] == 'Katolik') ? 'selected' : ''; ?>>
                                    Katolik</option>
                                <option value="Hindu" <?php echo ($d['agama'] == 'Hindu') ? 'selected' : ''; ?>>Hindu
                                </option>
                                <option value="Buddha" <?php echo ($d['agama'] == 'Buddha') ? 'selected' : ''; ?>>
                                    Buddha</option>
                                <option value="Konghucu" <?php echo ($d['agama'] == 'Konghucu') ? 'selected' : ''; ?>>
                                    Konghucu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="asal">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal" name="asal"
                                value="<?php echo $d['asal_sekolah']; ?>" required>
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