<?php
session_start();
if (isset($_SESSION['username'])) {
    if($_SESSION['type'] != "admin"){
        header("Location:user.php");
    }
}else{
    header("Location:login.php");
}?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>專案管理</title>
    <?php include('head.php');?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="b txt-center">
    <?php include('navbar.php'); ?>
    <?php
          if (!empty($_SESSION['msg'])) {
            ?><script> alert("<?php echo $_SESSION['msg'];?> ")</script><?php
            $_SESSION['msg'] = "";
          }else{
            $_SESSION['msg'] = "";
          };?>
    <h2>專案管理</h2>
    <div class='container'>
    <a href='creatproject.php' class='btn'>新增專案</a><br><br>
    <div class='c'>
    <table class="table">
    <th>專案名稱</th>
    <th>功能</th>
    <?php
                    $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
                        $sql = "SELECT * FROM project";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>".$row['name']."</td><td>"." <div class='btn-group'><a class='btn' href='editproject.php?id=".$row['proid']."'>編輯</a>"." <a class='btn btn-danger' onclick='delpro(".$row['proid'].",`".$row['name']."`)'>刪除</a></div>"."</td></tr>";
                        }
                    } else {
                         return;
                    }
                    $conn->close();
                    ?>
    </table>
    </div>
    </div>
</body>
<script>
function delpro(proid,proname) {
 var yes = confirm(`確定刪除 "${proname}" ?`)
 if (yes) {
     location.href = `deleteproject.php?id=${proid}`
 }
}
</script>
</html>