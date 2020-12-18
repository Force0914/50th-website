<?php 
$projectid = $_GET['id'];
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
$facesql = mysqli_query($sql,"SELECT * FROM face WHERE proid= $projectid");
$data = array();
while ($facerow = mysqli_fetch_assoc($facesql)) {
    $faceid = $facerow['faceid'];
    $result = array();
    $opinionsql = mysqli_query($sql,"SELECT * FROM opinion WHERE faceid = $faceid");
    while ($opinionrow = mysqli_fetch_assoc($opinionsql)) {
        $opinionid = $opinionrow['opid'];
        array_push($result,$opinionid);
    }
    array_push($data,$result);
}
print_r($data);
$ans = $now = array();
function explore($now,$prefix){
$next = array_shift($data);
for ($i=0; $i < count($now); $i++) { 
    if ($next) {
        explore($next,$prefix.$now[i]);
    }else {
        array_push($ans,$prefix.$now[i]);
    }
}
if($next) array_push($data,$next);
}
explore(array_shift($data),"");
print_r($ans);