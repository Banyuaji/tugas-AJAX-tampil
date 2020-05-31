<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://kit.fontawesome.com/d26b5fdae2.js" crossorigin="anonymous"></script>
    <style>
        table {
            margin: 1000px 0px;
        }

        button {
            font-size: 11px;
        }
    </style>
    <title>tampil data ajax</title>
</head>

<body>
    <div class="container-fluid">
        <div class="table-responsive">
            <table id="data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Alamat</th>
                        <th>Jurusan</th>
                        <th>Jenis kelamin</th>
                        <th>Tanggal masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connection.php';
                    $no = 1;
                    $q = 'SELECT * FROM `tbl_siswa_search` ORDER BY `id`';
                    $dewan1 = $db1->prepare($q);
                    $dewan1->execute();
                    $res1 = $dewan1->get_result();
                    while ($row = $res1->fetch_assoc()) {
                        $id = $row['id'];
                        $nama_siswa = $row['nama_siswa'];
                        $alamat = $row['alamat'];
                        $jurusan = $row['jurusan'];
                        $jenis_kelamin = $row['jenis_kelamin'];
                        $tgl_masuk = $row['tgl_masuk'];
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $nama_siswa ?></td>
                            <td><?php echo $alamat ?></td>
                            <td><?php echo $jurusan ?></td>
                            <td><?php echo $jenis_kelamin ?></td>
                            <td><?php echo $tgl_masuk ?></td>
                            <td>
                                <button class="btn btn-primary" id="detail" name="detail" title="lihat Detail">
                                    <i class="fa fa-search"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div id="view" class="modal fade mr-tp-100" role="dialog">
                <div class="modal-dialog modal-lg flipInX animated">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="detailData">Lihat Data</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">close</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" class="form-control" id="id" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" readonly>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" id="alamat" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jurusan</label>
                                <input type="text" id="jurusan" class="form-control" readonly="">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" id="jenis_kelamin" class="form-control" readonly="">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="text" id="tgl_masuk" class="form-control" readonly="">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        let table = $('#data').DataTable();

        $('#data tbody').on('click', '#detail', function() {
            var current_row = $(this).parents('tr');

            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }

            var data = table.row(current_row).data();
            console.log(data);

            document.getElementById("id").value = data[0];
            document.getElementById("nama_siswa").value = data[1];
            document.getElementById("alamat").value = data[2];
            document.getElementById("jurusan").value = data[3];
            document.getElementById("jenis_kelamin").value = data[4];
            document.getElementById("tgl_masuk").value = data[5];


            $("#view").modal("show");
        });
    });
</script>

</html>