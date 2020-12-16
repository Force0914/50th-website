    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location:login.php");
    }
    $sql = mysqli_connect("127.0.0.1","admin","1234","test");
    if (!empty($_SESSION['msg'])) {
        ?><script> alert("<?php echo $_SESSION['msg'];?> ")</script><?php
        $_SESSION['msg'] = "";
    }else{
        $_SESSION['msg'] = "";
    };
    $admin = false;
    $proid =$_GET['id'];
    $userid = $_SESSION['userid'];
    $presult = mysqli_query($sql,"SELECT * From project WHERE proid= $proid");
    if ($presult->num_rows > 0) {
    $prow = mysqli_fetch_assoc($presult);
    $groupid = $prow['groupid'];
    $projectname = $prow['name'];
    }else{
        $_SESSION['msg'] = "你無權訪問此頁";
        header("Location:user.php");
    }
    $gresult = mysqli_query($sql,"SELECT * FROM user_group WHERE userid = $userid AND groupid = $groupid");
    if (mysqli_num_rows($gresult) > 0) {
        while ($grow = $gresult->fetch_assoc()) {
            if ($grow['pre'] == 'admin') {
                $admin = true;
                $result = mysqli_query($sql,"SELECT * FROM action_plan WHERE proid = $proid");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $code = "<tr><td>" . $row["num"] . "</td><td>" . $row["name"] . "</td><td>" . $row["des"] . "</td><td>" . '<a href=editaction.php?id=' . $row["actionid"] .' class="btn btn-primary">編輯</a>'. "</td></tr>";
                    }
                } else {
                    $code = "";
                }
            }
        }
    } else {
        if ($_SESSION['type'] == "admin") {
            $result = mysqli_query($sql,"SELECT * FROM action_plan WHERE proid = $proid");
            $admin = true;
            if ($result->num_rows > 0) {
                $code = "";
                while ($row = $result->fetch_assoc()) {
                    $code = $code . "<tr><td>" . $row["num"] . "</td><td>" . $row["name"] . "</td><td>" . $row["des"] . "</td><td>" . '<div class="btn-group"><a href=editaction.php?id=' . $row["actionid"] .' class="btn">編輯</a><a href=delaction.php?id=' . $row["actionid"] .' class="btn btn-danger">刪除</a></div>'. "</td></tr>";
                }
            }else{
                $code = "";
            }
        }
    }
    if (!$admin) {
        $_SESSION['msg'] = "你無權訪問此頁";
        header("Location:user.php");
    }?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>執行方案管理</title>
    <?php include('head.php');?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="b">
<?php include('navbar.php');?>
<div class="container txt-center">
    <h2>執行方案管理</h2>
    <h3>專案名稱：<?php echo $projectname;?></h3>
    <a class="btn btn-primary" href="creataction.php?id=<?php echo $proid;?>">新增</a>
    <a class="btn btn-primary" href="autocreataction.php?id=<?php echo $proid;?>">自動產生執行方案</a><br><br>
    <div class="c">
        <table class="table">
            <thead>
            <tr>
                <th>編號</th>
                <th>執行方案名稱</th>
                <th>執行方案說明</th>
                <th>功能</th>
            </tr>
            </thead>
            <?php echo $code;?>
        </table>
    </div>
</div>
</body>
</html>