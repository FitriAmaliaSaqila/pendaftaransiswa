<?php
// Include file koneksi database
include 'koneksi.php';

// Inisialisasi variabel untuk menyimpan pesan feedback
$msg = '';

// Fungsi untuk menghindari XSS (Cross-Site Scripting)
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Proses Create (Insert)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan validasi data dari form
    $nama = validate_input($_POST['nama']);
    $alamat = validate_input($_POST['alamat']);
    $jenis_kelamin = validate_input($_POST['jenis_kelamin']);
    $agama = validate_input($_POST['agama']);
    $asal_sekolah = validate_input($_POST['asal_sekolah']);

    // Query untuk menyimpan data ke database
    $sql_insert = "INSERT INTO data_siswa (nama, alamat, jenis_kelamin, agama, asal_sekolah)
                   VALUES ('$nama', '$alamat', '$jenis_kelamin', '$agama', '$asal_sekolah')";

    if ($conn->query($sql_insert) === TRUE) {
        $msg = '<div class="alert alert-success" role="alert">Data siswa berhasil ditambahkan</div>';
    } else {
        $msg = '<div class="alert alert-danger" role="alert">Error: ' . $sql_insert . '<br>' . $conn->error . '</div>';
    }
}

// Proses Read (Retrieve)
$sql_select = "SELECT * FROM data_siswa";
$result = $conn->query($sql_select);

// Proses Update (Edit)
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $sql_select_edit = "SELECT * FROM data_siswa WHERE id=$edit_id";
    $result_edit = $conn->query($sql_select_edit);
    $row_edit = $result_edit->fetch_assoc();

    // Proses Update Data
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $nama_edit = validate_input($_POST['nama_edit']);
        $alamat_edit = validate_input($_POST['alamat_edit']);
        $jenis_kelamin_edit = validate_input($_POST['jenis_kelamin_edit']);
        $agama_edit = validate_input($_POST['agama_edit']);
        $sekolah_edit = validate_input($_POST['sekolah_edit']);

        $sql_update = "UPDATE data_siswa SET nama='$nama_edit', alamat='$alamat_edit', jenis_kelamin='$jenis_kelamin_edit', 
                       agama='$agama_edit', sekolah='$sekolah_edit' WHERE id=$edit_id";

        if ($conn->query($sql_update) === TRUE) {
            $msg = '<div class="alert alert-success" role="alert">Data siswa berhasil diperbarui</div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">Error updating record: ' . $conn->error . '</div>';
        }
    }
}

// Proses Delete (Hapus)
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql_delete = "DELETE FROM data_siswa WHERE id=$delete_id";

    if ($conn->query($sql_delete) === TRUE) {
        $msg = '<div class="alert alert-success" role="alert">Data siswa berhasil dihapus</div>';
    } else {
        $msg = '<div class="alert alert-danger" role="alert">Error deleting record: ' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Siswa</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <style>
        /* Optional: Tambahkan styling tambahan di sini */
    </style>
</head>

<body>
    <div class="container">
        <h2>Form Pendaftaran Siswa</h2>
        <?php echo $msg; ?> <!-- Menampilkan pesan feedback -->

        <!-- Form untuk Create dan Update -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <?php if (isset($edit_id)) { ?>
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
            <?php } ?>
            <div class="form-group">
                <label for="nama">Nama Siswa:</label>
                <input type="text" class="form-control" id="nama" name="nama" required
                    value="<?php echo isset($row_edit) ? $row_edit['nama'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" required><?php echo isset($row_edit) ? $row_edit['alamat'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="L"
                        <?php echo (isset($row_edit) && $row_edit['jenis_kelamin'] == 'L') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P"
                        <?php echo (isset($row_edit) && $row_edit['jenis_kelamin'] == 'P') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="agama">Agama:</label>
                <select class="form-control" id="agama" name="agama" required>
                    <option value="">Pilih Agama</option>
                    <option value="Islam" <?php echo (isset($row_edit) && $row_edit['agama'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                    <option value="Kristen" <?php echo (isset($row_edit) && $row_edit['agama'] == 'Kristen') ? 'selected' : ''; ?>>Kristen</option>
                    <option value="Katolik" <?php echo (isset($row_edit) && $row_edit['agama'] == 'Katolik') ? 'selected' : ''; ?>>Katolik</option>
                    <option value="Hindu" <?php echo (isset($row_edit) && $row_edit['agama'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                    <option value="Buddha" <?php echo (isset($row_edit) && $row_edit['agama'] == 'Buddha') ? 'selected' : ''; ?>>Buddha</option>
                    <option value="Konghucu" <?php echo (isset($row_edit) && $row_edit['agama'] == 'Konghucu') ? 'selected' : ''; ?>>Konghucu</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sekolah">Asal Sekolah:</label>
                <input type="text" class="form-control" id="sekolah" name="sekolah" required
                    value="<?php echo isset($row_edit) ? $row_edit['sekolah'] : ''; ?>">
            </div>
            <?php if (isset($edit_id)) { ?>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            <?php } else { ?>
                <button type="submit" class="btn btn-primary">Submit</button>
            <?php } ?>
        </form>

        <!-- Tabel untuk menampilkan data siswa (Read) -->
        <h2>Data Siswa</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Asal Sekolah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['nama']."</td>";
                        echo "<td>".$row['alamat']."</td>";
                        echo "<td>".$row['jenis_kelamin']."</td>";
                        echo "<td>".$row['agama']."</td>";
                        echo "<td>".$row['sekolah']."</td>";
                        echo "<td>";
                        echo '<a href="' . $_SERVER['PHP_SELF'] . '?edit=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>';
                        echo ' <a href="' . $_SERVER['PHP_SELF'] . '?delete=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Belum ada data siswa</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// Tutup koneksi database
$conn->close();
?>
