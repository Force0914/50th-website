<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>專案討論</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="b">
    <?php include("navbar.php")?>
    <?php
    if (!empty($_SESSION['msg'])) {
        ?><script> alert("<?php echo $_SESSION['msg'];?> ")</script><?php
        $_SESSION['msg'] = "";
    }else{
        $_SESSION['msg'] = "";
    };
    ?>
    <div class="container txt-center">
        <h2>專案討論</h2>
            <div class="c">
                <table class="table">
                    <thead>
                        <tr>
                            <th>專案名稱</th>
                            <th>功能</th>
                        </tr>
                    </thead>
                    <?php
                    $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
                    $userid = $_SESSION['userid'];
                    $gsql = "SELECT * FROM user_group WHERE userid = $userid";
                    $gresult = $conn->query($gsql);
                    if ($gresult->num_rows > 0) {
                         while ($grow = $gresult->fetch_assoc()) {
                            $gid =$grow['groupid'];
                            $sql = "SELECT * FROM project WHERE groupid =  $gid";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                 while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["name"] . "</td><td>" . '<a href=discuss.php?id=' . $row["proid"] .' class="btn btn-primary">進入討論</a>'. "  " . '<a href=useraction.php?id=' . $row["proid"] .' class="btn btn-primary">進入執行方案</a>'. "</td></tr>";
                                }
                            } else {
                                 return;
                            }
                        }
                    } else {
                        if ($_SESSION['type'] == "admin") {
                            $sql = "SELECT * FROM project";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                 while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["name"] . "</td><td>" . '<a href=discuss.php?id=' . $row["proid"] .' class="btn btn-primary">進入討論</a>'. "  " . '<a href=useraction.php?id=' . $row["proid"] .' class="btn btn-primary">進入執行方案</a>'. "</td></tr>";
                                }
                            } else {
                                 return;
                            }
                        }else{
                         return;
                        }
                    }
                    $conn->close();
                    ?>
                </table>
            </div>
    </div>
</body>
</html>