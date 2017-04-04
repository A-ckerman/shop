<?php
    session_start();
?>
<header>
    <?php

       //var_dump(__FILE__);
       //var_dump($_SERVER['PHP_SELF']);

       //获取当前页面的url路径的basename

       $path =  basename($_SERVER['PHP_SELF']);

       $index = $path=="index.php" ? "class='active'" :"";
       $products = $path=="products.php" ? "class='active'":"";
       $detail = $path=="detail.php" ? "class='active'":"";
       $shopcar = $path=="shopcar.php" ? "class='active'":"";

    ?>
    <?php
        //判断用户是已登录
        if(isset($_SESSION['username'])){
            echo <<<tagName
                <div class="login">
                    <a href="javascript:void(0)">{$_SESSION['username']}</a>|<a href="logout.php">退出</a>
                </div>
tagName;
        }
        else
        {
            echo <<<tagName1
                <div class="login">
                    <a href="login.html">登陆</a>|<a href="register.html">注册</a>
                </div>
tagName1;
        }

    ?>

    <nav>
        <ul class="nav clearfix">
            <li <?php echo $index ?>><a href="index.php">首页</a></li>
            <li <?php echo $products ?>><a href="products.php">商品</a></li>
            <li <?php echo $detail ?>><a href="#" >已浏览的商品</a></li>
            <?php
                if(isset($_SESSION['cart'])){
                    $num = count($_SESSION['cart']);
                    echo <<<tagName2
                  <li {$shopcar}><a href="shopcar.php">购物车(<span class="number">{$num}</span>)</a></li> 
tagName2;
                }
                else
                {
                    echo <<<tagName3
                  <li {$shopcar}><a href="shopcar.php">购物车(<span class="number">0</span>)</a></li> 
tagName3;
                }
            ?>

        </ul>
    </nav>
</header>