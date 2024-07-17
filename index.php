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
                <h2 class="text-uppercase text-center fw-bold">Pendaftaran Siswa</h2>
                <button><a href="tambah.php">tambah data siswa</a></button>
            </div>
        </div>
        <hr>
        <div class="row my-5">
            <div class="col-md table-container">
                <table id="example" class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Asal Sekolah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Menggunakan koneksi.php untuk mengambil data dari database
                        include 'koneksi.php';
                        $no = 1;
                        $data = mysqli_query($conn, "SELECT * FROM data_siswa");
                        while ($d = mysqli_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['nama']; ?></td>
                                <td><?php echo $d['alamat']; ?></td>
                                <td><?php echo $d['jenis_kelamin']; ?></td>
                                <td><?php echo $d['agama']; ?></td>
                                <td><?php echo $d['asal_sekolah']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></i>&nbsp;EDIT </a>
                                    <a href="hapus.php?id=<?php echo $d['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data?')"><i class="bi bi-trash3-fill"></i>&nbsp;HAPUS</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>