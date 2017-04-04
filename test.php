<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>购物车</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">

</head>
<body>
    <div class="container">
        <?php
           include "header.php";
           include "data.php";
           if(isset($_GET['id'])){
                $id = (int)$_GET['id'];
                $product_info = $products[$id];
                //如果是第二次进入
                if(isset($_SESSION['cart'])){
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
                }
                else{
                     //第一次进入
                    $arr = array();
                    $arr[$id] = array(
                        'name'=>$product_info['name'],
                        'img'=>$product_info['img'],
                        'price'=>$product_info['price'],
                        'count'=>1
                    );
                }
                $_SESSION['cart'] = $arr;
           }
       ?>
          <?php
            //判断购物车数组是否存在，并且数组长度大于1
            if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0  ){
                //拼接表头
                echo <<<tagName
                <table width="100%" border="1" cellspacing="0" cellpadding="5">
                  <thead>
                      <tr align="center">
                          <td>ID</td>
                          <td>图片</td>
                          <td>名称</td>
                          <td>价格</td>
                          <td>数量</td>
                          <td>小计</td>
                      </tr>
                  </thead>
                  <tbody>
tagName;
               $arr = $_SESSION['cart'];
               foreach($arr as $key=>$value){
                    $total = $value['price']*$value['price'];
                    echo <<<tagName2
                    <tr>
                        <td>{$key}</td>
                        <td><img src="images/{$value['img']}"/></td>
                        <td>{$value['name']}</td>
                        <td>{$value['price']}</td>
                        <td>{$value['price']}</td>
                        <td>{$total}</td>
                    </tr>
tagName2;
               }
               echo "</tbody></table>";
             }
             else
             {
                echo "购物车为空，<a href='index.php'>前往购物</a>";
             }


        ?>
        <?php
            include "footer.php";
         ?>
     </div>
</body>
</html>



















<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>购物车</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">

</head>
<body>
    <div class="container">
        <?php
           include "header.php";
           include "data.php";
            if(isset($_GET['id'])){
                //接收地址栏传过来的商品id
               $id = (int)$_GET['id'];

               //取出对应id的商品信息
               $product_info = $products[$id];
                //如果是第二次向购物车添加商品，则从session里取出购物车数组再向该数组添加元素
                if(isset($_SESSION['cart'])){
                    //1.取出已存在的购物车数组
                    $arr = $_SESSION['cart'];
                    /*
                        判断对应该商品id的信息是否已经在购物车数组里面
                        如果有，则将对应商品的count数量加1
                        array_key_exists($key,$arr)   功能：查找某个key在数组中是否存在
                       $key：需要在数组中查找的key值，
                        $arr：查找的目标数组
                     */
                     if(array_key_exists($id,$arr)){
                            //如果商品信息存在，则将对应的count加1
                            $arr[$id]['count']++;
                     }
                     else
                     {
                          //向购物车数组添加新的商品信息,默认数量为1
                            $arr[$id] = array(
                                "img"=>$product_info['img'],
                                "name"=>$product_info['name'],
                                "price"=>$product_info['price'],
                                "count"=>1
                            );

                     }
                }
                else
                {
                    //如果是第一次想购物车添加商品，则新建一个数组用于保存购物车信息
                    $arr = array();
                    $arr[$id] = array(
                        "img"=>$product_info['img'],
                        "name"=>$product_info['name'],
                        "price"=>$product_info['price'],
                        "count"=>1
                     );
                }
                 //将购物车数组保存到session里
                 $_SESSION['cart'] = $arr;
            }
             //var_dump($id);
             var_dump($_SESSION['cart']);
        ?>

        <?php
         //先判断购物车是否为空，如果为空，则输出提示
            if(isset($_SESSION['cart'])){
                echo <<<tagName1
                <table width="100%" border="1" cellspacing="0" cellpadding="5">
                  <thead>
                      <tr align="center">
                          <td>ID</td>
                          <td>图片</td>
                          <td>名称</td>
                          <td>价格</td>
                          <td>数量</td>
                          <td>小计</td>
                      </tr>
                  </thead>
                  <tbody>
tagName1;
                //取出购物车里商品信息
                $arr = $_SESSION['cart'];
                foreach($arr as $key=>$value){
                    $total = $value['price']*$value['count'];
                    echo <<<tagName
                        <tr align="center">
                            <td>{$key}</td>
                            <td><img src="images/{$value['img']}" /></td>
                            <td>{$value['name']}</td>
                            <td>{$value['price']}</td>
                            <td>{$value['count']}</td>
                            <td>￥{$total}</td>
                        </tr>
tagName;
                 }
                echo <<<tagName2
                         </tbody>
                         </table>
tagName2;
            }else
            {
                echo "购物车为空，<a href='index.php'>前往购物</a>";
            }
        ?>
        <?php
            include "footer.php";
         ?>
     </div>
</body>
</html>