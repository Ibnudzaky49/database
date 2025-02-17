<?php

$source = $_POST['source'];
$jumlah = $_POST['jumlah'];
$jenis = $_POST['jenis'];
$tanggal = $_POST['tanggal'];

if (!empty ($source) || !empty ($jumlah) || !empty (jenis) || !empty ($tanggal)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "catatan";

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
    if(mysqli_connect_error()) {
        die('connect error('.mysqli_connect_errno().')'. mysqli_connect_error());
    }else {
            $SELECT = "SELECT source from pemasukan where source = ? Limit 1";
            $INSERT = "INSERT into catatan (sumber, jumlah, jenis, tanggal) values (?, ?, ?, ?)";

            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s",$source);
            $stmt->execute();
            $stmt->bind_result($source);
            $stmt->store_result();
            $rnum = $stmt->num_rows;
            if ($rnum==0){
                $stmt->close();
            
                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("ssssii", $source, $jumlah, $jenis, $tanggal);
                $stmt->execute();
                echo "berhasil";
        }else{
            echo "gagal";
        }
                $stmt->close();
                $conn->close();
        }
    })
}else {
    echo "all field are required";
    die();
}
?>