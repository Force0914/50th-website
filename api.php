<?php

function to($a){
    header("Location:$a");
}

if($_GET['do'] == 'auto')
{
    $sql = mysqli_connect("127.0.0.1","admin","1234","test");
    $porid = $_POST['proid'];
    $i = 0;
    foreach ($_POST['data'] as $key => $data) {
        $i++;
        $num = "A".str_pad($i,3,"0",STR_PAD_LEFT);
        $name = "執行方案".$i;
        $title;
        echo "INSERT INTO `action_plan`(`proid`, `num`, `name`, `des`, `opinion`) VALUES ($porid,'$num','$name',[value-4],[value-5],'$data')\n";
        // mysqli_query($sql,"INSERT INTO `action_plan`(`proid`, `num`, `name`, `des`, `opinion`) VALUES ($porid,'$num','$name',[value-4],[value-5],[value-6])");
    }
}