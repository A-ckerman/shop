<?php
session_start();
//echo "test for addcar";
/*判断传入的id在session的cart数组里是否存在
    如果存在----->将商品数量加1，将相应的商品信息在cart数组里的位置置顶
    如果不存在---->将相应id的商品信息加入cart数组，默认数量1

*/
include "db.php";

$sql = "select * from products";
$result = mysql_query($sql);
$products = array();
while($row = mysql_fetch_assoc($result)){
    $key = (int)$row['id'];
    unset($row['id']);
    $products[$key] = $row;
}

//添加购物车商品
if(isset($_GET['addId'])){
    $id =(int)$_GET['addId'];
    //取出对应id的商品信息
    $product_info = $products[$id];
    //判断购物车数组是否存在
    if(isset($_SESSION['cart'])){
        //判断传入的id是否在购物车数组当中
        $arr = $_SESSION['cart'];
        //判断id是否存在
        if(array_key_exists($id,$arr)){
            $arr[$id]['count']++;
        }
        else{
            $arr[$id] = array(
                'name'=>$product_info['name'],
                'img'=>$product_info['img'],
                'price'=>$product_info['price'],
                'count'=>1
            );
        }

        $result = array(
            "issuccess"=>true,
            "length"=>count($arr)
        );
        $result_str = json_encode($result);
        echo $result_str;

    }
    else{
        //如果购物车数不存在，则新建一个数组用于存放购物车信息
        $arr = array();
        $arr[$id] = array(
            'name'=>$product_info['name'],
            'img'=>$product_info['img'],
            'price'=>$product_info['price'],
            'count'=>1
        );

        $result = array(
            "issuccess"=>true,
            "length"=>count($arr)
        );
        $result_str = json_encode($result);
        echo $result_str;
    }

    $_SESSION['cart'] = $arr;
}

