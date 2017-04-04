<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品详情页</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/detail.css">
</head>
<body>
    <?php
        include "data.php";
         var_dump($_GET);
         $id = rand(101,110);
        if(isset($_GET['id'])){
            $id = (int)$_GET['id'];
            //如果是第二次及以上浏览商品详情页，则先取出cookie里的已浏览过得商品id数组
            if(isset($_COOKIE['visited'])){
                $visited = unserialize($_COOKIE['visited']);
                //判断该商品id是否已经存在于已浏览过得商品id数组当中
                //array_search(arg1,arg2)
                //参数1  需要查找的元素
                //arg2   目标数组（即要到哪个数组中查找arg1元素）
                $index=array_search($id,$visited);
                //  $index的值两种可能 一：索引 二：false
                if($index === false){
                        //若果该商品id不在$visited 中，则两该商品id添加到$visited数组的头部
                        //array_unshift(arg1,arg2)  参数1：需要添加元素的数组 ，参数2：需要被添加到数组中的元素
                        array_unshift($visited,$id);
                }
                else{
                        //如果该商品已经被浏览过了，则将该商品的id在数组中剔除掉，之后再将该商品id添加到数组头部
                        unset($visited[$index]);
                        array_unshift($visited,$id);
                }
            }
            else
            {
             //如果是第一次浏览商品，则新建一个数组，将浏览过的商品id存放到该数组里面去
                        $visited[] = $id;
            }
            //将浏览过的商品id数组存放到cookie中
            setcookie("visited",serialize($visited),time()+60*60*24*7);
        }
        $product = $products[$id];
    ?>
    <div class="container">
        <?php
            include "header.php";
        ?>
        <?php
        echo <<<tagName
         <div class="product-item">
            <h2>{$product['name']}</h2>
            <img src="images/{$product['img']}" alt="product-1">
            <span>价格：{$product['price']}元</span>
            <div><button>加入购物车</button><b class="sales">销量：{$product['sales']}</b></div>
        </div>
tagName;

    var_dump($visited);

        ?>

        <?php
            include "footer.php";
        ?>
    </div>
</body>
</html>