<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>組長功能管理</title>
    <?php include('head.php');?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="b">
    <?php include('navbar.php');?>
    <div class="container txt-center">
        <h2>組長功能管理</h2>
            <div class="c">
                <table class="table">
                    <thead>
                        <tr>
                            <th>專案名稱</th>
                            <th>功能</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = mysqli_connect("127.0.0.1","admin","1234","test");
                    if (!empty($_SESSION['msg'])) {
                        ?><script> alert("<?php echo $_SESSION['msg'];?> ")</script><?php
                        $_SESSION['msg'] = "";
                    }else{
                        $_SESSION['msg'] = "";
                    };
                    $admin = false;
                    $userid = $_SESSION['userid'];
                    $gresult = mysqli_query($sql,"SELECT * FROM user_group WHERE userid = $userid");
                    if (mysqli_num_rows($gresult) > 0) {
                         while ($grow = $gresult->fetch_assoc()) {
                             if ($grow['pre'] == 'admin') {
                                    $admin = true;
                            $gid =$grow['groupid'];
                            $result = mysqli_query($sql,"SELECT * FROM project WHERE groupid = $gid");
                            if ($result->num_rows > 0) {
                                 while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["name"] . "</td><td>" . '<a href=scoreitem.php?id=' . $row["proid"] .' class="btn btn-primary">評分指標</a>   <a href=actionplan.php?id=' . $row["proid"] .' class="btn btn-primary">執行方案</a>'. "</td></tr>";
                                }
                            } else {
                                 return;
                            }
                             }
                        }
                    } else {
                        if ($_SESSION['type'] == "admin") {
                            $result = mysqli_query($sql,"SELECT * FROM project");
                            $admin = true;
                            if ($result->num_rows > 0) {
                                 while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["name"] . "</td><td>" . '<a href=scoreitem.php?id=' . $row["proid"] .' class="btn btn-primary">評分指標</a>   <a href=actionplan.php?id=' . $row["proid"] .' class="btn btn-primary">執行方案</a>'. "</td></tr>";
                                }
                            } else {
                                 return;
                            }
                        }else{
                         return;
                        }
                    }
                    if (!$admin) {
                        header("Location:user.php");
                    }?>
                </table>
            </div>
    </div>
</body>
</html>