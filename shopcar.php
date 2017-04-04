<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>购物车</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/jquery.js"></script>
    <style type="text/css">
        .add,.redu{
            display: inline-block;
            width:30px;
            height:20px;
            background-color:#ccc;
            margin:0 15px;
            cursor:pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
           include "header.php";
           include "data.php";
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
                          <td>操作</td>
                      </tr>
                  </thead>
                  <tbody>
tagName;
                //102,101,106]]
                //将购物车id数组里的元素倒序
               $arr = $_SESSION['cart'];
                $orderArr = array();
                foreach ($arr as $key=>$value){
                    array_unshift($orderArr,$key);
                }
                /*var_dump($orderArr);
                exit;*/
                $arr = $_SESSION['cart'];
                $totalprice = 0;
               foreach($orderArr as $key=>$value){
                    $total = $arr[$value]['price']*$arr[$value]['count'];
                    $totalprice += $total;
                    echo <<<tagName2
                    <tr align="center">
                        <td>{$value}</td>
                        <td><img src="images/{$arr[$value]['img']}"/></td>
                        <td>{$arr[$value]['name']}</td>
                        <td class="price">{$arr[$value]['price']}</td>
                        <td><span class="add" data-id="{$value}">+</span><span>{$arr[$value]['count']}</span><span class="redu" data-id="{$value}">-</span></td>
                        <td class="total">{$total}</td>
                        <td><a href="javascript:;" class="del" data-id="{$value}">删除</a></td>
                    </tr>
tagName2;
               }
               echo "<tr align='center'><td colspan='6'>总价</td><td class='totalprice'>{$totalprice}</td></tr>";
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
    <script>
        //点击"+"按钮增减商品数量
        $(".add").click(function () {
            //js中获取元素的属性
            console.log(this);
            var obj= $(this);
            var id = $(this).attr("data-id");  //获取被点击元素的属性

            //console.log($(this).data("id"));
            console.log(id);
            $.get('ajax.php',{addId:id},function(data,status,xhr){
                //更新页面商品数量
                obj.next().html(data);
                calc(obj,data);
            });
        });
        //点击"-"号减少商品数量
        $(".redu").click(function(){
            //alert("redu");
            var id = $(this).attr("data-id");
            var obj = $(this);
            $.get("ajax.php",{reduId:id},function(data,status,xhr){
                //更新页面商品数量
                obj.prev().html(data);
                calc(obj,data);
            });
        });

        function calc(obj,data){
            //更新小计
            var total = data*obj.parent().parent().find(".price").html();

            obj.parent().parent().find('.total').html(total.toFixed(2));

            //更新总价
            var totalprice = 0;
            $.each($(".total"),function(index,value){
                // console.log(value);
                totalprice += parseFloat($(value).html());
            });

            //console.log(totalprice);

            $(".totalprice").html(totalprice.toFixed(2));
        }

        //点击删除购物车商品
        $(".del").click(function () {
           // alert(111);
            //获取删除商品的id
            var id = $(this).attr("data-id");

            var obj = $(this);

            $.get("delproduct.php",{delId:id},function(data,status,xhr){
                if(data == "success"){
                    alert("删除成功");
                    obj.parent().parent().remove();
                }else
                {
                    alert("您所删除的商品id不存在");
                }
            });

        });
    </script>
</body>
</html>
