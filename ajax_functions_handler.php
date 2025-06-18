<?php
require_once 'dbconnect.php';

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
   if(isset($_GET['action'])){
      $action = $_GET['action'];
      switch($action){
         case "getDataKegiatan":
            get_data_kegiatan();
            break;
      }
   }
}

function get_data_kegiatan(){
   global $conn;
   $query = "SELECT id, nama_pelatihan, kerjasama, tempat, tgl_pelaksanaan, color,orc,qty_order,in_packing,ready_crtn,status FROM kegiatan ORDER BY tgl_pelaksanaan ASC LIMIT 15";
   $result = mysqli_query($conn, $query);

   $data = [];
   if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
         // $formatted_date = formatTanggalIndonesia($row['tgl_pelaksanaan']);
         $formatted_date = date('d-m-Y', strtotime($row['tgl_pelaksanaan']));
         $data[] = [
               'id' => htmlspecialchars($row['id']),
               'nama_pelatihan' => htmlspecialchars($row['nama_pelatihan']),
               'kerjasama' => htmlspecialchars($row['kerjasama']),
               'tempat' => htmlspecialchars($row['tempat']),
               'color' => htmlspecialchars($row['color']),
               'orc' => htmlspecialchars($row['orc']),
               'qty_order' => htmlspecialchars($row['qty_order']),
               'in_packing' => htmlspecialchars($row['in_packing']),
               'ready_crtn' => htmlspecialchars($row['ready_crtn']),
                  'status' => htmlspecialchars($row['status']),
               'tgl_pelaksanaan' => $formatted_date
         ];
      }
   }

   mysqli_close($conn);
   
   $dataReturn = json_encode($data);

   echo $dataReturn;
}

?>