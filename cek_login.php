<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'koneksi.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['status']=="admin"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['status'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:admin.php?halaman=admin");
 
	// cek jika user login sebagai pegawai
	}else if($data['status']=="dosen"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['status'] = "dosen";
		// alihkan ke halaman dashboard pegawai
		header("location:dosen.php?halaman=dosen");
 
	// cek jika user login sebagai pengurus
	}else if($data['status']=="verifikator"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['status'] = "verifikator";
		// alihkan ke halaman dashboard pengurus
		header("location:verifikator.php?halaman=verifikator");
 
	}else if($data['status']=="upt"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['status'] = "upt";
		// alihkan ke halaman dashboard pengurus
		header("location:upt.php?halaman=upt");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}
 
?>