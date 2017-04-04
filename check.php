<?php
    //开启session
    session_start();
    //判断是否提交表单
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($password=="123456"){
            $_SESSION['username'] = $username;
            //登录成功跳转到首页
            echo "<script>location.href='index.php'</script>";
        }
        else{
            //登录失败返回登录页面
            //echo "<script>location.href='login.html'</script>";
            echo "<script>history.back();</script>";
        }

    }
