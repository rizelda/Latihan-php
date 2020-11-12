<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
<?php
    session_start();
    require_once "koneksi.php";
    require_once "helper.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //ambil data
   $user = (isset($_POST['username'])) ? $_POST['username']:"";
   $pass = (isset($_POST['password'])) ? $_POST['password']:"";
   //validasi
   $errCount = 0;
   if ($user == "" || $pass == ""){
    set_message("Kolom inputan username atau password tidak boleh kosong");
       $errCount +=1;
   }

   //cek login
   if($errCount == 0){

        $SQL = "SELECT * FROM user WHERE username='".$user."'" ;

        $result = $conn->query($SQL);
        if ($result->num_rows > 0) {
            $u = $result->fetch_assoc();
            if(password_verify($pass,$u['password'])){
            $_SESSION['login']['status'] = true;
            $_SESSION['login']['username'] = $u['username'];
            $_SESSION['login']['level'] = $u['level'];
            switch($u['level']){
                case 'Admin':
                    header("location:admin.php");
                break;
                case 'Guru':
                    header("location:guru.php");
                break;
                case 'Siswa':
                    header("location:siswa.php");
                break;
                }
                
            
        }else{
            set_message("gagal login! coba lagi.");
        }
          
           
       }else{
           set_message("gagal login! coba lagi.");
       }
   }

}

?>
    <h1>Halaman Login</h1>
    <hr>
    <?=show_message(); ?>
    <form action="" method="post">
        <label for="username">Username</label><br>
        <input type="text" name="username"><br>
        <label for="password">Password</label><br>
        <input type="password" name="password"><br>
        <input type="submit" value="Login">
    
    </form>
    <a href="index.php"><button>Kembali</button></a>
</body>
</html>