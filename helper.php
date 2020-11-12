<?php

function set_message($msg){
    $_SESSION['msg'] = $msg;
}

function show_message(){
    $msg = (isset($_SESSION['msg']))?$_SESSION['msg'] : NULL;
    if ($msg != NULL) {
        echo "<p style='color:red;'>".$msg."</p>";
        unset($_SESSION['msg']);
    }
}

function login($level)
{
    if (isset($_SESSION['login']['status'])) {
        if($_SESSION['login']['level'] != $level){
            set_message("Anda harus login terlebih dahulu");
            header("location:login.php");
        }
    }else{
        set_message("Anda Belum login");
        header("location:login.php");
    }
}
?>