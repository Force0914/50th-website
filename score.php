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
                                        $faceid = $prow['faceid'];
                                        $osql = "SELECT * FROM opinion WHERE faceid = $faceid";
                                        $oresult = $conn->query($osql);
                                            if ($oresult->num_rows > 0) {
                                                while ($orow = $oresult->fetch_assoc()) {
                                                    if ($orow['opid'] == $_GET['id']) {
                                                        $state = true;
                                                    }
                                                }
                                            }
                                    }
                                }
                        }
                    }
            }
        } else {
            if ($_SESSION['type'] == "admin") {
                $state = true;
            }
        }
    $conn->close();
        if (!$state) {
            $_SESSION['msg'] = "你沒有權限對此意見評分";
            header("Location:user.php");
        }
?>
<?php
$conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
$opid = $_GET['id'];
$sql = "SELECT * FROM opinion WHERE opid = $opid";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $opname = $row['name'];
            $opdes = $row['des'];
            $faceid = $row['faceid'];
        }
    }
$conn->close();
?>
<?php
$conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
$sql = "SELECT * FROM face WHERE faceid = $faceid";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $facename = $row['name'];
            $proid = $row['proid'];
        }
    }
$conn->close();
?>
<?php
$conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
$sql = "SELECT * FROM project WHERE proid = $proid";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $proname = $row['name'];
        }
    }
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>專案討論</title>
    <?php include('head.php');?>
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
<?php include('navbar.php');?>
<body class="b">
<div class="container c txt-center well">
<h3>專案討論</h3>
<div class="txt-left">
<p>專案名稱:<?php echo $proname;?></p>
<p>面向名稱:<?php echo $facename;?></p>
<p>意見名稱:<?php echo $opname;?></p>
<p>意見內容:<?php echo $opdes;?></p>
<?php
$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
$file =  $sql->query("SELECT * FROM opinion WHERE opid= $opid");
$file2 = $file->fetch_assoc();
$files = $file2['file'];
switch ($file2['filetype']) {
    case 'video':
        echo "<p>附件:</p><video width='300px' src='$files' controls></video><br>";
    break;
    case 'audio':
        echo "<p>附件:</p><audio src='$files' controls></audio><br>";
    break;
    case 'image':
        echo "<p>附件:</p><img width='300px' src='$files'></img><br>";
    break;
    default:
        echo"";
    break;
$sql->close();
}
?>
<br>
<?php
$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
$score =  $sql->query("SELECT count(score) FROM score WHERE opid = $opid AND userid = $userid");
$score2 = $score->fetch_assoc();
if ($score2['count(score)'] != 1) {
    echo"<form action='score1.php' method='post'><input type='hidden' name='opid' value='$opid'><input type='hidden' name='userid' value='$userid'><select name='score' id='score' style='vertical-align: middle; margin: 0px;'><option value=1>1</option><option value=2>2</option><option value=3 selected>3</option>
<option value=4>4</option><option value=5>5</option></select><input class='btn' type='submit' value= '評分'></form>";
}else{
    echo "<br><div class='alert alert-success'>你已完成評分</div>";
}
?>
<a class="btn" href="face.php?id=<?php echo $faceid?>">返回</a>
</div>
</div>
</body>
</html>