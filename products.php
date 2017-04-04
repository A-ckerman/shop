<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品页</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/products.css">
</head>
<body>
    <div class="container">
        <?php
            include "header.php";
        ?>
        <div class="order">
            <a href="products.php?type=price">按价格</a>
            <a href="products.php?type=sales">按销量</a>
            <a href="products.php?type=hot">按人气</a>
        </div>
        <div class="wrap clearfix">
            <div class="product clearfix">
                <?php
                    include "data.php";
                    //初次进入改业面时，假如没有传入type值，则默认type值为price
                   $type = isset($_GET['type'])?$_GET['type']:"price";
                   //调用维维数组排序函数，对$products数组进行相应类型的排序
                   $new_arr = array_sort($products,$type);
                    foreach($new_arr as $key=>$value){
                        echo <<<tagName
                            <div class="product-item">
                                <h2>{$value['name']}</h2>
                                <img src="images/{$value['img']}" alt="product-1">
                                <span>价格：{$value['price']}元</span>
                                <div><button>加入购物车</button><b class="sales">销量：{$value['sales']}</b></div>
                            </div>
tagName;
                    }
                ?>
            </div>
        </div>
        <?php
            include "footer.php";
        ?>
    </div>
</body>
</html>