<!DOCTYPE html>

<?php
session_start();
var_dump($_POST);
$conn = new mysqli('localhost', 'root', '', 'project_final');
if ($conn->connect_errno) {
    echo $conn->connect_errno . "-" . $conn->connect_error;
} else {
    echo "PHP connection : Successful";
}

// var_dump($_POST);
if (isset($_POST['price']) && isset($_POST['desc'])) {
    // var_dump($_POST);
    // var_dump($_SESSION);
    if ($_POST['edittype'] == "new") {
        $sql = 'insert into inapp_purchase ' .
            'values(NULL,' . $_POST['app'] . ',' . $_POST['price'] . ',"' . $_POST['desc'].'")';
        echo $sql;
        header("Location: deviap.php");
        if (!$conn->query($sql)) {
            echo "Insert failed";
        }
    }
    elseif ($_POST['edittype'] == "edit") {
        $sql = 'UPDATE inapp_purchase SET  price= ' . $_POST['price'] . ',iap_desc= "' . $_POST['desc'] .'"
        WHERE inapp_purchase.iap_id = '.$_POST['appid'];
        
       
        echo $sql;
        header("Location: devrelease.php");
        if (!$conn->query($sql)) {
            echo "Insert failed";
        }
    }
}

?>