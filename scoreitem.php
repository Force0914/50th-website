<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$id = $_GET['id'];
$_SESSION['proid'] = $id;
$sql = mysqli_connect("127.0.0.1", "admin", "1234", "test");
$result = mysqli_query($sql, "SELECT * FROM project WHERE proid = $id");
$row = mysqli_fetch_assoc($result);
$proname = $row['name'];
$griupid = $row['groupid'];
$userid = $_SESSION['userid'];
$result1 = mysqli_query($sql,"SELECT * FROM user_group WHERE groupid = $griupid AND userid = $userid");
$row1 = mysqli_fetch_assoc($result1);
if ($row1['pre'] != "admin"){
    if($_SESSION['type'] != "admin") {
        $_SESSION['msg'] = "你沒有權限進入此專案管理頁";
        header("Location:teamleader.php");
    }
}
 ?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>評分指標管理</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="b">
<?php
if (!empty($_SESSION['msg'])) {
?><script> alert("<?php echo $_SESSION['msg'];?> ")</script><?php
        $_SESSION['msg'] = "";
    }else{
        $_SESSION['msg'] = "";
    };
include("navbar.php");?>
    <div class="container">
    <div class="txt-center">
        <h2>評分指標管理</h2>
        <h3>專案名稱:<?php echo $proname;?></h3>
        <a href="creatscoreitem.php?id=<?php echo $id;?>" class="btn btn-primary">新增</a>
    </div>
    <br>
    <div class="c">
               <table class="table">
                    <thead>
                         <tr>
                              <th>評分指標</th>
                              <th>功能</th>
                         </tr>
                    </thead>
                    <?php
                    $id = $_GET['id'];
                    $result = mysqli_query($sql,"SELECT * FROM `score_item` WHERE proid = $id");
                    $result_num = mysqli_num_rows($result);
                    if ($result_num > 0) {
                         while ($row = $result->fetch_assoc()) {
                             echo "<tr><td>".$row['name']."</td><td>"."<btn class='btn-group'><a class='btn' href='editscoreitem.php?id=".$row['siid']."'>編輯</a><a class='btn btn-danger' href='delscoreitem.php?id=".$row['siid']."'>刪除</a></div>"."</td></tr>";
                        }
                    }
                    ?>
               </table>
    </div>
    </div>
</body>
</html>