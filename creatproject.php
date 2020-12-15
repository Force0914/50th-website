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
    <title>新增專案</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="a">
    <div class="c container txt-center">
        <h2>新增專案</h2>
        <form action="creat-project.php" method="post">
        <input name="projectname" id="projactname" type="text" placeholder='專案名稱' required="required"><input name="projectdes" id="projectdes" type="text" placeholder='專案說明' required="required"><br>
        <hr>
        <div class="row">
        <div class="span1"></div>
        <div class="span4">
        <p>組長</p> 
        <select style="height: 30px; width:100%; " name="leader" id="leader" required="required">
        <?php
        $conn = @mysqli_connect("127.0.0.1","admin","1234","test");
        $sql = "SELECT * FROM user";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row['pre'] != "admin") {
                            ?><option value="<?php echo $row['id'];?>"><?php echo $row['username'];?></option><?php
                        }
                        }
                    }
        $conn->close();
        ?>
        </select>
        <p>組員</p> 
        <select style="height: 370px; width:100%; " name="team[]" id="team" multiple="true" required="required">
        <?php
        $conn = @mysqli_connect("127.0.0.1","admin","1234","test");
        $sql = "SELECT * FROM user";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row['pre'] != "admin") {
                            ?><option value="<?php echo $row['id'];?>"><?php echo $row['username'];?></option><?php
                        }
                        }
                    }
        $conn->close();
        ?>
        </select>
        </div>
    <div class="span7">
    <p id="times">目前面向數量:1/10</p>
        <a class="btn" href="javascript:add();">新增一個面向</a><br><br>
        <div id="face">
        <input name="facename[]" id="facename1" type="text" placeholder='面向名稱' required="required"><input name="facedes[]" id="facedes1" type="text" placeholder='面向內容' required="required"><button type="button" id="btn1" class="close del" onclick="del(1)">×</button><br id="br1">
        </div>
        </div>
        </div>
        <br>
        <a href="project.php" class="btn betterbtn">取消</a>
        <input type="submit" class="btn" value="送出">
        </form>
    </div>
</body>

<script>
var num = 1
var numplus = 1;
function add() {
    if(num < 10){
    num += 1;
    numplus +=1
    document.getElementById("times").innerHTML=`目前面向數量:${num}/10`;
    var face1 = document.getElementById("face");
　　var input1 = document.createElement(`input`);
    input1.setAttribute("name", `facename[]`);
    input1.setAttribute("id", `facename${numplus}`);
    input1.setAttribute("type", `text`);
    input1.setAttribute("placeholder", `面向名稱`);
    input1.setAttribute("require", `required`);
    face1.appendChild(input1);
　　var input2 = document.createElement(`input`);
    input2.setAttribute("name", `facedes[]`);
    input2.setAttribute("id", `facedes${numplus}`);
    input2.setAttribute("type", `text`);
    input2.setAttribute("placeholder", `面向內容`);
    input2.setAttribute("require", `required`);
    face.appendChild(input2);
    var btn = document.createElement(`button`);
    btn.setAttribute("type",`button`);
    btn.setAttribute("id",`btn${numplus}`);
    btn.setAttribute("class",`close del`);
    btn.setAttribute("onclick",`del(${numplus})`);
    btn.innerHTML = "&times;";
    face.appendChild(btn);
　　var br = document.createElement(`br`);
    br.setAttribute("id", `br${numplus}`);
    face.appendChild(br);
    }else{
        alert("已達最大上限10筆資料");
    }
}

function del(id) {
    if(num > 0){
    var del1 = document.getElementById(`facename${id}`);
    del1.parentNode.removeChild(del1);
    var del2 = document.getElementById(`facedes${id}`);
    del2.parentNode.removeChild(del2);
    var del3 = document.getElementById(`btn${id}`);
    del3.parentNode.removeChild(del3);
    var del4 = document.getElementById(`br${id}`);
    del4.parentNode.removeChild(del4);
    num -= 1;
    document.getElementById("times").innerHTML=`目前面向數量:${num}/10`;
    }else{
        alert("已刪除全部面向");
    }
}
</script>
</html>