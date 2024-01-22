<?php 
    include('config/config.php');
    if(!empty($_POST['email'])){
        $role = $_POST['role'];
        $email = $_POST['email'];
        switch($role){
            case "admin":
            if(!empty($_POST['password'])){
                $password = $_POST['password'];
                $sql = $conn->query("SELECT * FROM user WHERE email = '$email' and password = '$password' and chuc_vu='admin' ");
                $numRow = $sql->num_rows;
                if($numRow > 0){
                    $row = $sql->fetch_array();
                    $detail = array('type'=>'Success','chuc_vu'=>$row['chuc_vu']);
                    
                    session_start();
                    if($_POST['username']){
                    $_SESSION['username'] =$_POST['username']; // session run
                    }
                    $_SESSION['user']="admin";
                    $_SESSION['ma_nv']= $row["ma_nv"];
                    $_SESSION['ten_nv']= $row["ten_nv"];
                    echo json_encode($detail);
                    
                }else{
                    echo "Something Went Wrong !";
                }
            }
            break;
            
            case "user":
            if(!empty($_POST['password'])){
                $password = $_POST['password'];
                $sql = $conn->query("SELECT * FROM user WHERE email = '$email' and password = '$password' and chuc_vu='user' ");
                $numRow = $sql->num_rows;
                if($numRow > 0){
                    $row = $sql->fetch_array();
                    $detail = array('type'=>'Success','chuc_vu'=>$row['chuc_vu']);
                    $_SESSION['user']="user";
                    $_SESSION['ma_nv']= $row["ma_nv"];
                    $_SESSION['ten_nv']= $row["ten_nv"];
                    echo json_encode($detail);
                }else{
                    echo "Something Went Wrong !";
                }
            }
            break;
            
        }
    }
?>