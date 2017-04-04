<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/jquery.js"></script>
</head>
<body>
    <div class="container">
        <?php
            //引入网页头部的html代码
            //require "header.php"  一般放在网页开始位置，只加载一次，如果加载的代码有错，那么程序停止运行并报出致命性错误
            include "header.php";  //一般放在控制流程里，可以多次加载
            include "db.php";     //引入数据文件
            include  "data.php"
        ?>
        <div class="wrap clearfix">
            <div class="product">
                <?php
                    $sql = "select * from products";
                    $result = mysql_query($sql);
                    $products = array();
                    while($row = mysql_fetch_assoc($result)){
                        $key = (int)$row['id'];
                        unset($row['id']);
                        $products[$key] = $row;
                    }
//                    var_dump($products);
//                    exit;
                        $i = 0;
                    //假设在首页当中是按照价格来排序
                    $new_arr = array_sort($products,'price');
                    foreach($new_arr as $key=>$value){
                    if($i == 6) break;
                        echo <<<tagName
                            <div class="product-item">
                                <h2>{$value['name']}</h2>
                                <a href="detail.php?id={$key}"><img src="images/{$value['img']}" alt="product-1"></a>
                                <span>价格：{$value['price']}元</span>
                                <div><button class="add" data-id="{$key}">加入购物车</button><b class="sales">销量：{$value['sales']}</b></div>
                            </div>
tagName;
                        $i++;
                    }
                ?>
            </div>
            <div class="aside">
                <h2>已浏览过的商品</h2>
                <?php
                    //1.首先取出cookie中已浏览过得商品id数组
                    //2.遍历该数组，并且根据商品id从商品信息数组中取出每一已浏览过的商品的详细信息
                    //3.echo 输出，最好用界定符
                   //判断cookie中是否存在已浏览过得商品的id数组
                   if(isset($_COOKIE['visited'])){
                        $visited = unserialize($_COOKIE['visited']);
                        foreach($visited as $key=>$value){
                               if($key==4) break;
                               echo <<<tagName
                               <dl class="clearfix">
                                   <dt>
                                       <img src="images/{$products[$value]['img']}" alt="visited product">
                                   </dt>
                                   <dd>
                                       <span>{$products[$value]['name']}</span>
                                       <span class="price">{$products[$value]['price']}元</span>
                                   </dd>
                                </dl>
tagName;
                         }
                   }
                 ?>
            </div>
        </div>
       <?php
            //引入页面底部相同部分内容
            include "footer.php";
       ?>
    </div>
    <script>
       $(".add").click(function(){
           var id = $(this).attr("data-id");
           $.get("addcar.php",{addId:id},function(data,status,xhr){
               var result = JSON.parse(data);
               if(result.issuccess){
                   alert("添加商品成功");
                   console.log(result);
                   //获取存放购物车数量的元素，更新其内容
                   $(".number").html(result.length);
               }
               else{
                   alert("添加商品失败");
               }

           });

       });
    </script>
</body>
</html>