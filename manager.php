<?php 
  
header("Content-Type: text/plain"); 

$data = file_get_contents("php://input"); 

/*$sql = "SELECT * FROM test";
$result = $conn->query($sql) or die($conn->error);

//echo $result->num_rows;

if ($data == "one") {
	while ($row = $result->fetch_row()) {
        printf ("%d\n", $row[0]);
    }
} elseif ($data == "two") {
    while ($row = $result->fetch_row()) {
        printf ("%d\n", $row[1]);
    }
} elseif ($data == "three") {
    while ($row = $result->fetch_row()) {
        printf ("%d\n", $row[2]);
    }
} elseif ($data == "four") {
    while ($row = $result->fetch_row()) {
       printf ("%d\n", $row[3]);
    }
} else {
    echo $data;
}*/

function search($subject){
    $conn = new mysqli("localhost", "id11649227_test", "TigR1943", "id11649227_test");
    $sql = 'SELECT wordNum, textID FROM words WHERE baseform = ?';
    $result = $conn->prepare($sql);
    $result->bind_param("s", $subject);
    $result->execute();
    $result = $result->get_result();
    return $result->fetch_all(MYSQLI_NUM);
    $conn->close();
}

$wordnums = search($data);

for ($i = 0; $i != sizeof($wordnums); $i++) {
    $conn = new mysqli("localhost", "id11649227_test", "TigR1943", "id11649227_test");
    $sql = 'SELECT word FROM words WHERE wordNum in (?, ?, ?, ?, ?) AND textID = ?';
    $fresult = $conn->prepare($sql);
    $wone = $wordnums[$i][0] - 2;
    $wtwo = $wordnums[$i][0] - 1;
    $wthr = $wordnums[$i][0];
    $wfou = $wordnums[$i][0] + 1;
    $wfiv = $wordnums[$i][0] + 2;
    $textID = $wordnums[$i][1];
    $fresult->bind_param("ssssss", $wone, $wtwo, $wthr, $wfou, $wfiv, $textID);
    $fresult->execute();
    $fresult = $fresult->get_result();
    $farray = $fresult->fetch_all(MYSQLI_NUM);
    
    /*$sql2 = 'SELECT textID FROM words WHERE wordNum=?';
    $fresult2 = $conn->prepare($sql2);
    if ($fresult2 === FALSE) {
    die($conn->error);
    echo("fresult2 false");
    }
    $fresult2->bind_param("s", $wordnums[$i][0]);
    $fresult2->execute();
    $fresult2 = $fresult2->get_result();
    $textid = $fresult2->fetch_row()[0];*/
    
    $conn->close();
    
    for ($x = 0; $x != sizeof($farray); $x++) {
        $s = $farray[$x][0];
        echo($s);
        echo(" ");
    }
    echo($wordnums[$i][0]);
    echo(" ");
    echo($textID);
    echo("\n");
}





?> 