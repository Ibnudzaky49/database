<?php
#_POST untuk membawa data yang ada dibagian input ke dalam database
$source = $_POST['source'];
$jumlah = $_POST['jumlah'];
$jenis = $_POST['jenis'];
$tanggal = $_POST['tanggal'];
#host (server), root (username), password(password database), catatan (nama database)
if (!empty ($source) || !empty ($jumlah) || !empty (jenis) || !empty ($tanggal)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "catatan";

#$conn untuk proses penginputan 
    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
    if(mysqli_connect_error()) {
    #die untuk melihar error yang terjadi saat proses penginputan ke dalam database
        die('connect error('.mysqli_connect_errno().')'. mysqli_connect_error());
    }else {
    #$SELECT supaya tidak ada penginputan ganda
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