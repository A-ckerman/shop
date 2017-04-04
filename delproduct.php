<?php
session_start();
//删除购物车商品
if(isset($_GET['delId'])){
    $delId = (int)$_GET['delId'];
    $arr = $_SESSION['cart'];
    //判断该商品是否在购物车当中
    if(array_key_exists($delId,$arr)){
        unset($arr[$delId]);
        echo "success";
    }
    else{
        echo "error";
    }
    //删除成功之后再保存
    $_SESSION['cart'] = $arr;


}