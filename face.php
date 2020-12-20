<?php
    session_start();
    $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
    $state = false;
    $userid = $_SESSION['userid'];
    $gsql = "SELECT * FROM user_group WHERE userid = $userid";
    $gresult = $conn->query($gsql);
        if ($gresult->num_rows > 0) {
            while ($grow = $gresult->fetch_assoc()) {
                $gid =$grow['groupid'];
                $sql = "SELECT * FROM project WHERE groupid = $gid";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $proid = $row['proid'];
                            $psql = "SELECT * FROM face WHERE proid = $proid";
                            $presult = $conn->query($psql);
                            if ($presult->num_rows > 0) {
                                while ($prow = $presult->fetch_assoc()) {
                                    if ($prow['faceid'] == $_GET['id']) {
                                        $facename = $prow['name'];
                                        $facestate = $prow['state'];
                                        $proid2 = $prow['proid'];
                                        $state = true;
                                    }else{
                                        if ($_SESSION['type'] == "admin") {
                                            $facename = $prow['name'];
                                            $facestate = $prow['state'];
                                            $proid2 = $prow['proid'];
                                            $state = true;
                                        }
                                    }
                        }
                    }
                        }
                    }
            }
        } else {
            if ($_SESSION['type'] == "admin") {
                $id = $_GET['id'];
                $state = true;
                $psql = "SELECT * FROM face WHERE faceid = $id";
                $presult = $conn->query($psql);
                    if ($presult->num_rows > 0) {
                        while ($prow = $presult->fetch_assoc()) {
                            $facename = $prow['name'];
                            $facestate = $prow['state'];
                            $proid2 = $prow['proid'];
                        }
                    }
            }
        }
    $conn->close();
        if (!$state) {
            $_SESSION['msg'] = "你沒有權限進入此面向";
            header("Location:user.php");
        }
?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>專案討論</title>
    <?php include('head.php');?>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php
$conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
$sql = mysqli_query($conn, "SELECT * FROM project WHERE proid = $proid2");
    $row = mysqli_fetch_assoc($sql);
    $proname = $row['name'];
    $groupid = $row['groupid'];
 $conn->close();
        $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
        $sql = "SELECT pre FROM user_group WHERE userid = $userid AND groupid = $groupid";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                $pre = $row['pre'];
             }
        }
        $conn->close();
      if (!empty($_SESSION['msg'])) {
        ?><script> alert("<?php echo $_SESSION['msg'];?> ")</script><?php
        $_SESSION['msg'] = "";
      }else{
        $_SESSION['msg'] = "";
      };
?>
<?php include('navbar.php');?>
<body class="b">
    <br>
    <div class="container c txt-center">
        <h1>專案討論</h1>
        <h3>專案名稱:<?php echo $proname;?></h3>
        <h3>面向名稱:<?php echo $facename;?></h3>
        <?php if($facestate == "true"){
        $id = $_GET['id'];?>
        <a class="btn" href="creatopinion.php?id=<?php echo $id;?>">新增意見</a>
      <?php
        }
        if ($_SESSION['type'] == "admin" || $pre == "admin") {
            $fid = $_GET['id'];
            if($facestate == "true"){
            ?><a class="btn btn-danger" href="state.php?id=<?php echo $fid;?>">停止發表意見</a><?php
        }else {
            ?><a class="btn btn-primary" href="state.php?id=<?php echo $fid;?>">開始發表意見</a><?php
        }
    }
      ?>
        <br>
        <br>
        </div>
        <br>
        <div class='container'>
            <?php
                    $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
                    $fid = $_GET['id'];
                    $sql = "SELECT * FROM opinion WHERE faceid = $fid ORDER BY num ASC ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                         while ($frow = $result->fetch_assoc()) {
                            $opinion = "";
                            $code4 = "";
                            $opid = $frow["opid"];
                            $num = strval($frow["num"]);
                            $userid = $frow["userid"];
                            $files = $frow['file'];
                            $opinion = $frow['opinion'];
                            $osql = "SELECT * FROM opinion WHERE faceid = $fid";
                            $oresult = $conn->query($osql);
                            if ($result->num_rows > 0) {
                                 while ($orow = $oresult->fetch_assoc()) {
                            if (strpos($opinion,$orow['opid'])!==false) {
                                $code5 = " <a href='face.php?id=".$fid."#". $orow['opid'] . "'>" . $orow['name'] . "</a>";
                                $code4 = $code4 . $code5;
                            }
                            }
                            if ($code4 != "") {
                                $code4 = "<p>延伸意見:" . $code4."</p>";
                            }
                            }
                            switch ($frow['filetype']) {
                                case 'video':
                                    $code3 =  "<p>附件:</p><video width='300px' src='$files' controls></video><br>";
                                break;
                                case 'audio':
                                    $code3 =  "<p>附件:</p><audio src='$files' controls></audio><br>";
                                break;
                                case 'image':
                                    $code3 =  "<p>附件:</p><img width='300px' src='$files'></img><br>";
                                break;
                                default:
                                    $code3 = "";
                                break;
                            }
                            $usql = "SELECT * FROM user WHERE id = $userid";
                            $uresult = $conn->query($usql);
                            if ($uresult->num_rows > 0) {
                                 while ($urow = $uresult->fetch_assoc()) {
                                    $username = $urow["username"];
                                 }
                            }
                            $sql = mysqli_connect("127.0.0.1","admin","1234","test");
                            $userid = $_SESSION['userid'];
                            $score =  $sql->query("SELECT count(score) FROM score WHERE opid = $opid AND userid = $userid");
                            $score2 = $score->fetch_assoc();
                            if ($score2['count(score)'] != 1) {
                                $code = "<a class='btn btn-primary' href='score.php?id=" . $frow["opid"] . "'>評分</a>";
                                $code2 = "<span class='label label-important'>未評分</span>";
                            }else{
                                $code = "<a class='btn btn-warning' href='score.php?id=" . $frow["opid"] . "'>查看</a>";
                                $code2 = "<span class='label label-success'>已評分</span>";
                            }      
                            if ($_SESSION['type'] == "admin") {
                                $code = "";
                                $code2 = "";
                            }
                            $AVG = $conn->query("SELECT AVG(score) FROM score WHERE opid = $opid");
                            $AVG2 = $AVG->fetch_assoc();
                            $count = $conn->query("SELECT count(score) FROM score WHERE opid = $opid");
                            $count2 = $count->fetch_assoc();
                             echo "<div id='".$opid."' class='well txt-left'><p class='txt-right'>".$code2."</p><p>編號:$num</p>".$code4."<p>標題:".$frow["name"]."</p><p>說明:".$frow["des"]."</p><p>發表的時間:".$frow["creattime"]."</p><p>發表者的使用者名稱:$username</p><p>被評價平均分數:".ceil($AVG2['AVG(score)'])."</p><p>評價人數:".ceil($count2['count(score)'])."</p>". $code3 . "<br>" . $code ."</div>";
                        }
                    } else {
                         return;
                    }
                    $conn->close();
                    ?>
    </div>
    <br>
</body>
</html>