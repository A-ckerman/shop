<?php
session_start();

//var_dump($_SESSION['cart']);
//$_SESSION['cart'][106]['count']++
if(isset($_GET['addId'])){
    $id = $_GET['addId'];
    //对传入id的的商品数量+1
    echo ++$_SESSION['cart'][$id]['count'];
}

if(isset($_GET['reduId'])){
    //获取商品id，将购物车中相应的商品数量减1
    $id = $_GET['reduId'];
    if($_SESSION['cart'][$id]['count']>1){
        echo --$_SESSION['cart'][$id]['count'];
    }else
    {
        echo $_SESSION['cart'][$id]['count'];
    }

}