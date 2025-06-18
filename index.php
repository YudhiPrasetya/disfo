<?php
include 'dbconnect.php';

// Fungsi untuk mengubah bulan menjadi bahasa Indonesia
function formatTanggalIndonesia($date) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $pecahkan = explode('-', $date);
    // Format menjadi Tanggal Bulan Tahun
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

// Query untuk mengambil data kegiatan dan mengurutkan berdasarkan tanggal pelaksanaan

// $query = "SELECT id, nama_pelatihan, kerjasama, tempat, tgl_pelaksanaan, color,orc,qty_order,in_packing,ready_crtn,status FROM kegiatan ORDER BY tgl_pelaksanaan ASC LIMIT 15";
// $result = mysqli_query($conn, $query);

// $data = [];
// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $formatted_date = formatTanggalIndonesia($row['tgl_pelaksanaan']);
//         $data[] = [
//             'id' => htmlspecialchars($row['id']),
//             'nama_pelatihan' => htmlspecialchars($row['nama_pelatihan']),
//             'kerjasama' => htmlspecialchars($row['kerjasama']),
//             'tempat' => htmlspecialchars($row['tempat']),
//              'color' => htmlspecialchars($row['color']),
//              'orc' => htmlspecialchars($row['orc']),
//              'qty_order' => htmlspecialchars($row['qty_order']),
//              'in_packing' => htmlspecialchars($row['in_packing']),
//               'ready_crtn' => htmlspecialchars($row['ready_crtn']),
//                'status' => htmlspecialchars($row['status']),
//             'tgl_pelaksanaan' => $formatted_date
//         ];
//     }
// }

// mysqli_close($conn);

// Ambil status video dari file JSON
// $statusFile = 'admin/video_status.json'; // Jalur ke file JSON
// $videoStatus = file_exists($statusFile) ? json_decode(file_get_contents($statusFile), true) : [];

// $videoNames = ['2.mp4', '1.mp4']; // Daftar nama video yang ingin diperiksa
// $videoNameToDisplay = ''; // Variabel untuk menyimpan nama video yang akan ditampilkan

// foreach ($videoNames as $videoName) {
//     if (isset($videoStatus[$videoName]) && $videoStatus[$videoName] === 'Active') {
//         $videoNameToDisplay = $videoName; // Simpan nama video yang aktif
//     }
// }

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>DISPLAY | INFORMASI</title>
    <style>
         ::-webkit-scrollbar{
            width: 0px;
            background: transparent;
         }        
        #unmuteButton:hover #volumeIcon {
            color: red; /* Ubah warna ikon menjadi merah saat hover */
        }

        .row:before, .row:after{
            display: table;
            content: " ";
            clear:both
        }

        .table-container{
            overflow-y: auto;
            height: 78vh;
            /* max-height: 95vh; */
            width: 100vw;
        }
        
        thead th{
            position: sticky;
            top: 0;
            z-index: 1;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin/login.php" target="_blank">
                <img src="assets/logo/logo3.png" alt="Logo">
            </a>
        </div>
    </header>
    <main>
        <section>
            <!-- Image Slider -->
            <div class="container">
                <div class="schedule">
                    <div class="image-slider">
                        <img src="assets/images/image1.png" alt="Image 1" class="active">
                        <img src="assets/images/image2.png" alt="Image 2">
                        <img src="assets/images/image3.png" alt="Image 3">
                        <img src="assets/images/image4.png" alt="Image 4">
                        <img src="assets/images/image5.png" alt="Image 5">
                        <img src="assets/images/image6.png" alt="Image 6">
                    </div>
                    <h3><i class="fas fa-bullhorn"></i> INFORMASI KEDATANGAN MATERIAL</h3>
                    <!-- <br> -->
                    <div class="table-container" id="tableContainer">
                        <table id="tableInfo" class="table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><CENTER>TANGGAL &nbsp;PENGIRIMAN </CENTER></th>
                                    <th><CENTER>&nbsp;&nbsp;NAMA VENDOR&nbsp;</CENTER></th>
                                   
                                    <th><CENTER>&nbsp;&nbsp;EXSPEDISI&nbsp;&nbsp;</CENTER></th>
                                    <th><CENTER>&nbsp;&nbsp;COURIER&nbsp;&nbsp;</CENTER></th>
                                       
                                  
                                      <th><CENTER>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</CENTER></th>
                                    <th><CENTER>&nbsp;ESTIMASI KEDATANGAN</CENTER></th>
                               
                                   <th><CENTER>&nbsp;TOTAL ROLL&nbsp;/&nbsp;CARTON</CENTER></th>
                                  <th><CENTER>TANGGAL &nbsp;PENERIMAAN</CENTER></th>
                                    <th><CENTER>NAMA PENERIMA</CENTER></th>
                                    <th><CENTER>STATUS</CENTER></th>
                                 
                                                                
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>                    
                </div>
                <div class="gallery">
                    <!-- <//?php if ($videoNameToDisplay): ?> -->
                        <!-- <div class="video-container" style="position: relative; display: inline-block;">
                            <video id="video" src='assets/video/<//?php echo htmlspecialchars($videoNameToDisplay); ?>' autoplay loop muted></video>
                            <button id="unmuteButton" style="position: absolute; bottom: 10px; right: 10px; background: none; border: none; cursor: pointer;">
                                <i class="fas fa-volume-up" style="font-size: 10px;" id="volumeIcon"></i>
                            </button>
                        </div> -->
                        <!-- <script>
                            // Menghapus atribut muted setelah video dimulai
                            document.getElementById('video').addEventListener('loadeddata', function() {
                                this.muted = true; // Tetap dimute saat dimuat
                            });

                            // Menambahkan event listener untuk tombol unmute
                            document.getElementById('unmuteButton').addEventListener('click', function() {
                                const video = document.getElementById('video');
                                const volumeIcon = document.getElementById('volumeIcon');
                                video.muted = !video.muted; // Toggle mute
                                volumeIcon.classList.toggle('fa-volume-up'); // Ganti ikon
                                volumeIcon.classList.toggle('fa-volume-mute'); // Ganti ikon
                            });
                        </script> -->
                    <!-- <//?php else: ?> -->
                        <!-- <p>Video Tidak Aktif</p> -->
                    <!-- <//?php endif; ?> -->
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="date-time-container">
            <div id="day-date"></div>
            <div id="time"></div>
        </div>
        <div class="marquee-section">
            <div class="marquee-text">Berikanlah yang terbaik dalam setiap pekerjaan karena usaha tidak akan mengkhianati hasil</div>
        </div>
    </footer>

    <script src="admin/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script>
        // var rowCount = $('#tableInfo tbody tr').length;
        // var tableBody = $('tbody');
        // var tableBodyTop = tableBody.position().top;

        
        // var tableHeight = $('#tableInfo').height();
        // var divTableContainerHeight = $('.table-container').height();
        $(document).ready(function(){
            initTable();
            
            function initTable(){
                $('#tableInfo tbody').empty();
                tBody = "";
                $.ajax({
                    method: 'GET',
                    url: 'ajax_functions_handler.php',
                    dataType: 'json',
                    data: {
                        action: 'getDataKegiatan'
                    },
                    error: function(xhr, status, error){
                        console.log(status, error);
                    }
                }).done(function(resp){
                    if(resp.length > 0){
                        for(let x = 0; x < resp.length; x++){
                            tBody += `<tr id=${resp[x].id}>`;
                            tBody += `<td><CENTER>${resp[x].tgl_pelaksanaan}</CENTER></td>`;
                            tBody += `<td><CENTER>${resp[x].nama_pelatihan}</CENTER></td>`;
                            tBody += `<td><CENTER>${resp[x].kerjasama}</CENTER></td>`;
                            tBody += `<td><CENTER>${resp[x].tempat}</CENTER></td>`;
                            tBody += `<td><CENTER>${resp[x].orc}</CENTER></td>`;
                            tBody += `<td><CENTER>${resp[x].color}</CENTER></td>`;
                            tBody += `<td><CENTER>${resp[x].qty_order}</CENTER></td>`;
                            tBody += `<td><CENTER>${resp[x].in_packing}</CENTER></td>`;
                            tBody += `<td><CENTER>${resp[x].ready_crtn}</CENTER></td>`;
                            tBody += `<td><CENTER>${resp[x].status}</CENTER></td>`;
                            tBody += '</tr>';
                        }
                        $('#tableInfo tbody').append(tBody);

                        // var tableHeight = $('#tableInfo').height();
                        // var divTableContainerHeight = $('.table-container').height();
                        // // debugger;
                        // if(tableHeight > divTableContainerHeight){
                        //     tableScrollTopAnimation();
                        // }else{
                        //     $('#tableInfo tbody').children('tr').hide();
                        //     tableShowAnimation();
                        // }
                        // tBody="";

                        // tableScrollTopAnimation();

                        $('#tableInfo tbody tr').each(function(){
                            var row = $(this);
                            // var div = row.closest('div');
                            var div = $('.table-container');
                            var scrollPos = row.position().top - div.position().top;

                            div.animate({
                                scrollTop: scrollPos
                            }, 3000, function(){
                                div.animate({scrollTop: 0}, 3000, function(){
                                    div.stop(true,true);
                                    initTable();
                                    // tableScrollTopAnimation();
                                });
                            }).delay(1000);

                            // div.animate({
                            //     scrollTop: scrollPos
                            // }, 3000).delay(1000);
                        });                        
                    }
                });
            }

            // function tableScrollTopAnimation(){
            //     $('#tableInfo tbody tr').each(function(){
            //         var row = $(this);
            //         // var div = row.closest('div');
            //         var div = $('.table-container');
            //         var scrollPos = row.position().top - div.position().top;

            //         div.animate({
            //             scrollTop: scrollPos
            //         }, 3000, function(){
            //             div.animate({scrollTop: 0}, 3000, function(){
            //                 // initTable();
            //                 // tableScrollTopAnimation();
            //             });
            //         }).delay(1000);

            //         // div.animate({
            //         //     scrollTop: scrollPos
            //         // }, 3000).delay(1000);
            //     });
            //     // initTable();
            //     // setTimeout(function(){
            //     //     // $('#tableInfo tbody tr').each(function(idx){
            //     //     //     $(this).delay(idx * 2000).hide(3000);
            //     //     // });                    
            //     //     $('#tableInfo tbody').children('tr').empty();
            //     //     initTable();
            //     // },35000);                

            //     // setTimeout(function(){
            //     // $('#content').fadeOut(3000, function(){
            //     //     $('#content').css('display','');
            //     //     initTable();
            //     // })
            //     // },durasi * 3 * 1000);

            //     // initTable();                
            // }

            function tableShowAnimation(){
                $('#tableInfo tbody tr').each(function(idx){
                    $(this).delay(idx * 2000).show(3000);
                });
                setTimeout(function(){
                    $('#tableInfo tbody tr').each(function(idx){
                        $(this).delay(idx * 2000).hide(3000);
                    });                    
                    $('#tableInfo tbody').children('tr').empty();
                    initTable();
                },25000);
                // initTable();
            }

        })
        
        // if(tableHeight > divTableContainerHeight){
        //     tableScrollTopAnimation();

        //     $('#tableInfo tbody tr').each(function(){
        //         var row = $(this);
        //         // var div = row.closest('div');
        //         var div = $('.table-container');
        //         var scrollPos = row.position().top - div.position().top;
        //         div.animate({
        //             scrollTop: scrollPos
        //         }, 3000).delay(1000);
        //     });
        // }else{
        //     tableShowAnimation()
        //     $('#tableInfo tbody tr').each(function(idx){
        //         $(this).delay(idx * 2000).show(3000);
        //     });            
        // }




        // $('#tableContainer').animate({
        //     scrollTop: $('tr[id="78"]').position().top + 'px'
        // }, 10000);

        // $('#tableInfo tbody tr').each(function(){
        //     let row = $(this);
        //     // row.wrapInner(`<div ></div>`);
        //     row.children('td').wrapInner('<div></div>');
        // });

        // $('#tableInfo tbody tr').each(function(){
        //     let row = $(this);
        //     row.children('td').animate({
        //         top: '0px'
        //     }, 5000)
        //     // let scrollPos = row.position().top - div.position().top;
        //     // div.animate({
        //     //     scrollTop: scrollPos
        //     // }, 1000).delay(1000);
        // });

        


        // $('#tableInfo tbody tr').each(function(){
            // var row = $(this);
            // var td = row.children('td');
            // var tbody = row.closest('tbody');

            // console.log(`tbody.position().top: ${tbody.position().top}`);
            
            // console.log(`td.position().top: ${td.position().top}`);


            // var scrollPos = td.position().top - tbody.position().top;


            // td.animate({
            //     scrollTop: scrollPos
            // }, 1000);

            // row.animate({
            //     top: '0px'
            // }, 1000)
        // });        

        // $(document).ready(function(){
            // var targetRow = $('#tableInfo tr').last();
            // console.log(targetRow);
            // var tableContainer = $('.table-container');
            // var rowOffset = targetRow.offset().top - tableContainer.offset().top;

            // tableContainer.animate({
            //     scrollTop: rowOffset
            // }, 10000);


        // });
        // if(rowCount <= 15){
        //     $('#tableInfo tbody tr').hide();
        //     $('#tableInfo tbody tr').each(function(idx){
        //         $(this).delay(idx * 2000).show(3000);
        //     });
        // }

        // $("#tableInfo tbody tr").animate({scrollTop: "0"});

        // $('#tableInfo tbody tr').each(function(idx){
        //     $(this).animate({scrollTop: 0});
        // });

        // Fungsi untuk memperbarui waktu secara dinamis
        function updateTime() {
            const now = new Date();
            const options = { timeZone: 'Asia/Jakarta', hour12: false };
            let timeString = now.toLocaleTimeString('id-ID', options);
            // Mengubah pemisah titik (.) menjadi titik dua (:)
            timeString = timeString.replace(/\./g, ':');
            document.getElementById('time').innerText = timeString;
        }

        // Set interval untuk memperbarui waktu setiap detik
        setInterval(updateTime, 1000);

        // Menampilkan hari, tanggal, bulan, dan tahun secara dinamis
        function updateDate() {
            const now = new Date();
            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            const dayName = days[now.getDay()];
            const date = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();
            document.getElementById('day-date').innerText = `${dayName}, ${date} ${monthName} ${year}`;
        }

        updateDate(); // Panggil fungsi untuk memperbarui tanggal

        // Slider otomatis
        let currentIndex = 0;
        const images = document.querySelectorAll('.image-slider img');
        const totalImages = images.length;

        function showNextImage() {
            images[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % totalImages;
            images[currentIndex].classList.add('active');
        }

        setInterval(showNextImage, 3000); // Ganti gambar setiap 3 detik

        // Fungsi untuk memuat status video terbaru
        // function loadVideoStatus() {
        //     fetch('admin/video_status.json')
        //     .then(response => response.json())
        //     .then(videoStatus => {
        //         let videoNameToDisplay = '';
        //         if (videoStatus['2.mp4'] === 'Active') {
        //             videoNameToDisplay = '2.mp4';
        //         } else if (videoStatus['1.mp4'] === 'Active') {
        //             videoNameToDisplay = '1.mp4';
        //         }

        //         const videoElement = document.getElementById('video');
        //         if (videoElement && videoElement.src.includes(videoNameToDisplay)) {
        //             return; // Video sudah aktif
        //         }

        //         // Update video
        //         if (videoNameToDisplay) {
        //             videoElement.src = 'assets/video/' + videoNameToDisplay;
        //             videoElement.play(); // Play video baru
        //         } else {
        //             videoElement.pause(); // Stop video jika tidak ada yang aktif
        //             videoElement.src = ''; // Kosongkan sumber video
        //         }
        //     })
        //     .catch(error => console.error('Error fetching video status:', error));
        // }

        // Cek status video setiap 3 detik
        // setInterval(loadVideoStatus, 3000);
    </script>

    
</body>
</html>