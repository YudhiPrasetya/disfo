<?php 
session_start();
date_default_timezone_set("Asia/Makassar"); // Set timezone ke WITA
$date_now = date("Y-m-d");
include '../dbconnect.php';

$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Admin";

if($_SESSION['log'] !== "Logged"){
    header("location:login.php");
    exit();
}

// Fungsi untuk memformat tanggal menjadi "Tanggal Nama Bulan Tahun" dalam bahasa Indonesia
function indonesian_date($date) {
    $bulan = array (
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $date);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

// Proses tambah kegiatan
if (isset($_POST['add_kegiatan'])) {
    $nama_pelatihan = htmlspecialchars($_POST['nama_pelatihan']);
    $kerjasama = htmlspecialchars($_POST['kerjasama']);
    $tempat = htmlspecialchars($_POST['tempat']);
     $color = htmlspecialchars($_POST['color']);
      $orc = htmlspecialchars($_POST['orc']);
       $qty_order = htmlspecialchars($_POST['qty_order']);
        $in_packing = htmlspecialchars($_POST['in_packing']);
         $ready_crtn = htmlspecialchars($_POST['ready_crtn']);
            $status = htmlspecialchars($_POST['status']);
    $tgl_pelaksanaan = htmlspecialchars($_POST['tgl_pelaksanaan']);

    $query = "INSERT INTO kegiatan (nama_pelatihan, kerjasama, tempat, tgl_pelaksanaan, color,orc,qty_order,in_packing,ready_crtn,status) VALUES ('$nama_pelatihan', '$kerjasama','$tempat', '$tgl_pelaksanaan','$color','$orc','$qty_order','$in_packing','$ready_crtn','$status')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Kegiatan berhasil ditambahkan!');</script>";
        echo "<br><meta http-equiv='refresh' content='3; URL=index.php'> You will be redirected to the form in 3 seconds";
    } else {
        echo "<script>alert('Gagal menambahkan kegiatan!');</script>";
    }
}

// Proses edit kegiatan
if (isset($_POST['edit_kegiatan'])) {
    $id = htmlspecialchars($_POST['id']);
    $nama_pelatihan = htmlspecialchars($_POST['edit_nama_pelatihan']);
    $kerjasama = htmlspecialchars($_POST['edit_kerjasama']);
    $tempat = htmlspecialchars($_POST['edit_tempat']);
    $tgl_pelaksanaan = htmlspecialchars($_POST['edit_tgl_pelaksanaan']);
      $orc = htmlspecialchars($_POST['edit_orc']);
    $color = htmlspecialchars($_POST['edit_color']);
     $qty_order = htmlspecialchars($_POST['edit_qty_order']);
      $in_packing = htmlspecialchars($_POST['edit_in_packing']);
         $ready_crtn= htmlspecialchars($_POST['edit_ready_crtn']);
           $status= htmlspecialchars($_POST['edit_status']);

    $query = "UPDATE kegiatan SET nama_pelatihan='$nama_pelatihan', kerjasama='$kerjasama', tempat='$tempat', tgl_pelaksanaan='$tgl_pelaksanaan',color='$color',orc='$orc',qty_order='$qty_order',in_packing='$in_packing',ready_crtn='$ready_crtn',status='$status'  WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Kegiatan berhasil diubah!');</script>";
        echo "<br><meta http-equiv='refresh' content='3; URL=index.php'> You will be redirected to the form in 3 seconds";
    } else {
        echo "<script>alert('Gagal mengubah kegiatan!');</script>";
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/ico" href="favicon.ico1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DISPALAY INFORMASI | PT.GLOBALINDO INTIMATETS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="page-container">
        <!-- sidebar menu area start -->
        <?php include 'includes/sidebar.php'; ?>
        <!-- sidebar menu area end -->

        <div class="main-content">
            <!-- header area start -->
            <?php include 'includes/header.php'; ?>
            <!-- header area end -->

            <div class="main-content-inner">
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                                    <h2>TAMBAH ITEM SHIPMENT</h2>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#addKegiatanModal">
                                        <i class="fas fa-plus-circle"></i> TAMBAH ITEM SHIPMENT
                                    </button>
                                </div>
                                <div class="data-tables datatable-dark">
                                    <table id="dataTable3" class="display" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>BUYER</th>
                                                <th>NO PO</th>
                                                <th>STYLE </th>
                                                 <th>ORC</th>
                                                <th>Color</th>
                                                <th>Qty Order</th>
                                                <th>Input Packing</th>
                                                 <th>Ready carton </th>
                                                   <th>Status</th>
                                                <th>Tgl  Shipment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $query = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY id ASC");
                                            $no = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                                $id = $row['id'];
                                                $nama_pelatihan = htmlspecialchars($row['nama_pelatihan']);
                                                $kerjasama = htmlspecialchars($row['kerjasama']);
                                                $tempat = htmlspecialchars($row['tempat']);
                                                   $color = htmlspecialchars($row['color']);
                                                    $orc = htmlspecialchars($row['orc']);
                                                       $qty_order = htmlspecialchars($row['qty_order']);
                                                        $in_packing = htmlspecialchars($row['in_packing']);
                                                $ready_crtn = htmlspecialchars($row['ready_crtn']);
                                                 $status = htmlspecialchars($row['status']);
                                                $tgl_pelaksanaan = $row['tgl_pelaksanaan'];
                                                
                                                ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $nama_pelatihan; ?></td>
                                                    <td><?php echo $kerjasama; ?></td>
                                                    <td><?php echo $tempat; ?></td>
                                                    <td><?php echo $orc; ?></td>
                                                    <td><?php echo $color; ?></td>
                                                    <td><?php echo $qty_order; ?></td>
                                                     <td><?php echo $in_packing; ?></td>
                                                     <td><?php echo $ready_crtn; ?></td>
                                                      <td><?php echo $status; ?></td>
                                                    <td><?php echo indonesian_date($tgl_pelaksanaan); ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning editBtn" data-toggle="modal" data-target="#editKegiatanModal" 
                                                        data-id="<?php echo $id; ?>" 
                                                        data-nama_pelatihan="<?php echo $nama_pelatihan; ?>" 
                                                        data-kerjasama="<?php echo $kerjasama; ?>" 
                                                        data-tempat="<?php echo $tempat; ?>" 
                                                         orc="<?php echo $orc; ?>" 
                                                        data-color="<?php echo $color; ?>" 
                                                         data_qty_order="<?php echo $qty_order; ?>" 
                                                          data_in_packing="<?php echo $in_packing; ?>" 
                                                           data_ready_crtn="<?php echo $ready_crtn; ?>" 
                                                             data_status="<?php echo $status; ?>" 
                                                        data-tgl_pelaksanaan="<?php echo $tgl_pelaksanaan; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="delete_kegiatan.php?id=<?php echo $id; ?>" class="btn btn-sm btn-danger" title="Hapus Kegiatan" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Footer area start -->
    <?php include 'includes/footer.php'; ?>
    <!-- Footer area end -->
</div>

<!-- Modal for Add Kegiatan -->
<div class="modal fade" id="addKegiatanModal" tabindex="-1" role="dialog" aria-labelledby="addKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKegiatanModalLabel">Tambah Style Shipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_pelatihan">BUYER</label>
                        <input type="text" class="form-control" id="nama_pelatihan" name="nama_pelatihan" required>
                    </div>
                    <div class="form-group">
                        <label for="kerjasama">NO PO</label>
                        <input type="text" class="form-control" id="kerjasama" name="kerjasama" required>
                    </div>
                     <div class="form-group">
                        <label for="tempat">STYLE</label>
                        <input type="text" class="form-control" id="tempat" name="tempat" required>
                    </div>
                     <div class="form-group">
                        <label for="orc">ORC</label>
                        <input type="text" class="form-control" id="orc" name="orc" required>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" id="color" name="color" required>
                    </div>
                     <div class="form-group">
                        <label for="qty_order">Qty order</label>
                        <input type="text" class="form-control" id="qty_order" name="qty_order" required>
                    </div>
                     <div class="form-group">
                        <label for="in_packing">Input Packing</label>
                        <input type="text" class="form-control" id="in_packing" name="in_packing" required>
                    </div>
                      <div class="form-group">
                        <label for="ready_crtn">Ready Carton</label>
                        <input type="text" class="form-control" id="ready_crtn" name="ready_crtn" required>
                    </div>
                     <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_pelaksanaan">Tanggal Shipment</label>
                        <input type="date" class="form-control" id="tgl_pelaksanaan" name="tgl_pelaksanaan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="add_kegiatan" class="btn btn-primary">Tambah Kegiatan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Edit Kegiatan -->
<div class="modal fade" id="editKegiatanModal" tabindex="-1" role="dialog" aria-labelledby="editKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKegiatanModalLabel">Edit Shipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_nama_pelatihan">Buyer</label>
                        <input type="text" class="form-control" id="edit_nama_pelatihan" name="edit_nama_pelatihan" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_kerjasama">No PO</label>
                        <input type="text" class="form-control" id="edit_kerjasama" name="edit_kerjasama" required>
                    </div>
               
                       <div class="form-group">
                        <label for="edit_tempat">Style</label>
                        <input type="text" class="form-control" id="edit_tempat" name="edit_tempat" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_orc">ORC</label>
                        <input type="text" class="form-control" id="edit_orc" name="edit_orc" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_color">color</label>
                        <input type="text" class="form-control" id="edit_color" name="edit_color" required>
                    </div>
                     <div class="form-group">
                        <label for="edit_qty_order">qty order</label>
                        <input type="text" class="form-control" id="edit_qty_order" name="edit_qty_order" required>
                    </div>
                      <div class="form-group">
                        <label for="edit_in_packing">Input Packing</label>
                        <input type="text" class="form-control" id="edit_in_packing" name="edit_in_packing" required>
                    </div>
                       <div class="form-group">
                        <label for="edit_ready_crtn">Ready Carton</label>
                        <input type="text" class="form-control" id="edit_ready_crtn" name="edit_ready_crtn" required>
                    </div>
                 
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <input type="text" class="form-control" id="edit_status" name="edit_status" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tgl_pelaksanaan">Tanggal Shipment</label>
                        <input type="date" class="form-control" id="edit_tgl_pelaksanaan" name="edit_tgl_pelaksanaan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="edit_kegiatan" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jquery.slicknav.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script src="assets/js/scripts.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable3').DataTable();

            // Handle edit button click
        $('.editBtn').on('click', function() {
            var id = $(this).data('id');
            var nama_pelatihan = $(this).data('nama_pelatihan');
            var kerjasama = $(this).data('kerjasama');
             var orc = $(this).data('orc');
             var color = $(this).data('color');
                var qty_order = $(this).data('qty_order');
            var tempat = $(this).data('tempat');
             var in_packing = $(this).data('in_packing');
             var ready_crtn = $(this).data('ready_crtn');
              var status = $(this).data('status');
            var tgl_pelaksanaan = $(this).data('tgl_pelaksanaan');

            $('#edit_id').val(id);
            $('#edit_nama_pelatihan').val(nama_pelatihan);
            $('#edit_kerjasama').val(kerjasama);
            $('#edit_tempat').val(tempat);
            $('#edit_color').val(color);
            $('#edit_orc').val(orc);
            $('#edit_status').val(status);
            $('#edit_tgl_pelaksanaan').val(tgl_pelaksanaan);
        });
    });
</script>
</body>
</html>
