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
        $data_array = explode(",",$data);
        $des = "";
        foreach ($data_array as $key => $onedata) {
            $result = mysqli_query($sql,"SELECT * FROM opinion WHERE opid = $onedata");
            $ans = mysqli_fetch_assoc($result);
            if($des === ""){
                $des = $ans['name'];
            }else {
                $des = $des. "," . $ans['name'];
            }
        }
        // echo "INSERT INTO `action_plan`(`proid`, `num`, `name`, `des`, `opinion`) VALUES ($porid,'$num','$name','$des','$data')\n";
        mysqli_query($sql,"INSERT INTO `action_plan`(`proid`, `num`, `name`, `des`, `opinion`) VALUES ($porid,'$num','$name','$des','$data')");
    }
}