<?php
    require_once "koneksi.php";

	$cek=0;
	$valid=0;
	// 1 - error data sama

    //sql inject
    $hewan = mysqli_real_escape_string($conn, $_POST['hewan']);
    $jenis = mysqli_real_escape_string($conn, $_POST['jenis']);

    //cek hewan tidak boleh sama
	$sql=mysqli_query($conn, "SELECT nama_hewan FROM tb_hewan WHERE nama_hewan='$hewan'");
	if(mysqli_num_rows($sql) > 0){
        $valid=1;
    }
    
    if($valid == 0){
		mysqli_autocommit($conn, false);		

		$result = mysqli_query($conn, "INSERT INTO tb_hewan (nama_hewan, jenis_hewan, created_at) VALUES ('$hewan', '$jenis', NOW())");	
		if (!$result) {
			$cek=$cek+1;
		}

		if ($cek==0){
			mysqli_commit($conn);
			$status['nilai']=1; //bernilai benar
			$status['error']="Data Berhasil Ditambahkan";
		}else{
			mysqli_rollback($conn);
			$status['nilai']=0; //bernilai benar
			$status['error']="Data Gagal Ditambahkan";
		}
		mysqli_close($conn);
    }else{
		$status['nilai']=0; //bernilai salah
		$status['error']="Nama Hewan Sudah Ada";
    }
    
	echo json_encode($status);
?>