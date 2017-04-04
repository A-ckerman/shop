<?php
    session_start();
    //删除用户登录信息
    unset($_SESSION['username']);
    echo "<script>location.href='index.php'</script>";