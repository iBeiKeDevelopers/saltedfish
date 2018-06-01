
@section('head_main')
<?php
    //include "localhost:8080/frame/head_main.php";
    if(isset($_GET['search'])){
        $target = array(
            'type'      =>  'search',
            'search'    =>  $_GET['search'],
            'page'      =>  1,
        );
        if (isset($_GET['page']))  $target['page'] = $_GET['page'];
        echo "<script>var target = ".json_encode($target).";</script>";
    }elseif (isset($_GET['category'],$_GET['level'])) {
        $target = array(
            'type'      =>  'category',
            'category'  =>  $_GET['category'],
            'level'     =>  $_GET['level'],
            'page'      =>  1,
        );
        if (isset($_GET['page']))  $target['page'] = $_GET['page'];
        echo "<script>
                var target = ".json_encode($target).";
            </script>";
    }else{
        echo "<script>var target = null;</script>";
    }
?>
@show