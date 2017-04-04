<?php
    $products = array(
        101=>array("name"=>"商品名称1","img"=>"1.jpg","price"=>66.66,"sales"=>102,"amount"=>200,"hot"=>89),
        102=>array("name"=>"商品名称2","img"=>"2.jpg","price"=>25.7,"sales"=>45,"amount"=>245,"hot"=>90),
        103=>array("name"=>"商品名称3","img"=>"3.jpg","price"=>205,"sales"=>200,"amount"=>120,"hot"=>75),
        104=>array("name"=>"商品名称4","img"=>"4.jpg","price"=>160,"sales"=>21,"amount"=>110,"hot"=>77),
        105=>array("name"=>"商品名称5","img"=>"5.jpg","price"=>89,"sales"=>34,"amount"=>179,"hot"=>58),
        106=>array("name"=>"商品名称6","img"=>"6.jpg","price"=>70,"sales"=>20,"amount"=>168,"hot"=>69),
        107=>array("name"=>"商品名称7","img"=>"7.jpg","price"=>310,"sales"=>300,"amount"=>210,"hot"=>85),
        108=>array("name"=>"商品名称8","img"=>"8.jpg","price"=>198.9,"sales"=>80,"amount"=>88,"hot"=>94),
        109=>array("name"=>"商品名称9","img"=>"2.jpg","price"=>299,"sales"=>100,"amount"=>65,"hot"=>78),
        110=>array("name"=>"商品名称10","img"=>"5.jpg","price"=>150,"sales"=>150,"amount"=>74,"hot"=>88)
    );

   // id  name img price sales amount hot

    //假如是按价格排序，首先提取出二维数组中的价格

    //临时数组存储价格以及相应的价格在$products数组中对应的key值

    $tmp_arr = array();

    foreach($products as $key=>$value){
        $tmp_arr[$key] = $value['price'];
    }

    //var_dump($tmp_arr);

    //对数字类型的数组进行排序的方法
    //arsort() 对数组进行降序排列
    //asort()  对数组进行升序排列

    asort($tmp_arr);


   // var_dump($tmp_arr);
    $new_arr = array();  //存放products最终排序后的数组


    foreach($tmp_arr as $key=>$value){
        $new_arr[$key] = $products[$key];
    }

    //var_dump($new_arr);

//asc  desc
function array_sort($arr,$type,$order='asc'){
    $tmp_arr = array();
    foreach($arr as $key=>$value){
        $tmp_arr[$key] = $value[$type];
    }
    //根据$order的值判断排序是升序还是降序
    if($order == 'asc'){
        asort($tmp_arr);
    }else
    {
        arsort($tmp_arr);
    }
       $new_arr = array();
    //遍历$tmp_arr,将排序后的key值作为新数组的key值，$new_arr的value值则来自$arr
    foreach($tmp_arr as $key=>$value){
        $new_arr[$key] = $arr[$key];
    }


    return $new_arr;
}





    //foreach 遍历关联数组

    //$name_arr = array("01"=>"jerry","02"=>"Tom","03"=>"Alice");
    /*
    foreach($name_arr as $key=>$value){
        echo $key."=>".$value;
                            echo "<br>";
    }

    */







?>