<?php
    require_once "koneksi.php";
	
	$id= $_REQUEST['idHewan'];
	$cek=0;
	
    mysqli_autocommit($conn, false);
    
    $sql = mysqli_query($conn, "DELETE FROM tb_hewan WHERE id='$id'");
    
	if (!$sql) {
		$cek=$cek+1;
	}
	
	if ($cek==0){
		mysqli_commit($conn);
		$status['nilai']=1; //bernilai benar
		$status['error']="Data Berhasil Dihapus";			
	}else{
		mysqli_rollback($conn);
		$status['nilai']=0; //bernilai salah
		$status['error']="Data Gagal Dihapus";
	}

	echo json_encode($status);
?>
