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
                                        $proid2 = $prow['proid'];
                                        $state = true;
                                    }else{
                                        if ($_SESSION['type'] == "admin") {
                                            $facename = $prow['name'];
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
                            $proid2 = $prow['proid'];
                        }
                    }
            }
        }
    $conn->close();
        if (!$state) {
            $_SESSION['msg'] = "你沒有在此面向新增意見";
            header("Location:user.php");
        }
$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
$id = $_GET['id'];
$count =  $sql->query("SELECT count(opid) FROM opinion WHERE faceid =$id");
$count2 = $count->fetch_assoc();
$num = str_pad($count2['count(opid)']+1,3,"0",STR_PAD_LEFT);
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
?>
<?php $date = date("Y-m-d");?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>新增意見</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
    <?php
          if (!empty($_SESSION['msg'])) {
            ?><script> alert("<?php echo $_SESSION['msg'];?> ")</script><?php
            $_SESSION['msg'] = "";
          }else{
            $_SESSION['msg'] = "";
          };
    ?>
<body class="a">
    <div class="box">
        <h2>新增意見</h2>
        <form action="creat-opinion.php" enctype="multipart/form-data" method="post">
        <div class="txt-left">
        <input type="hidden" name="faceid" value="<?php echo $id;?>">
        <p>發表者的使用者名稱:<?php echo $username;?></p>
        <input type="hidden" name="userid" value="<?php echo $userid;?>">
        <p>編號:<?php echo $num?></p>
        <input type="hidden" name="num" value="<?php echo $num;?>">
        <p >發表的時間:<?php echo $date;?></p>
        <label for="title">標題:</label>
        <input type="text" name="title" id="title" required="required">
        <label for="description">說明:</label>
        <input type="text" name="description" id="description" required="required">
        <input type="hidden" name="date" value="<?php echo $date;?>"><br>
        <label for="opinion">延伸意見:</label>
        <select name="opinion[]" id="opinion" multiple="true"> 
        <option value="" selected="selected">不回復其他意見</option>
        <?php
        $conn = @mysqli_connect("127.0.0.1","admin","1234","test");
        $sql = "SELECT * FROM opinion WHERE faceid = $id";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?><option value="<?php echo $row['opid'];?>"><?php echo $row['num'];?>/<?php echo $row['name'];?></option><?php
                        }
                    }
        $conn->close();
        ?>
        </select> 
        <label for="file">附件:</label>
        <input type="file" name="file" id="file" accept="image/*,video/*,audio/*"><br>
        </div>
        <a href="face.php?id=<?php echo $_GET['id'];?>" class="btn betterbtn">取消</a>
        <input type="submit" class="btn" value="送出">
        </form>
    </div>
</body>
</html>