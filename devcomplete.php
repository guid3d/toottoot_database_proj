<!DOCTYPE html>

<?php
session_start();
var_dump('$_POST');
include('connect.php');

// var_dump($_POST);
if (isset($_POST['appname']) && isset($_POST['price']) && isset($_POST['version']) && isset($_POST['fileToUpload'])) {
    if ($_POST['edittype'] == "new") {
        $sql = 'insert into applications ' .
            'values(NULL,"' . $_POST['appname'] . '","' . $_POST['fileToUpload'] . '","' . $_POST['appshort'] . '",
            "' . $_POST['applong'] . '",' . $_POST['price'] . ',"' . $_POST['changelog'] . '",0,"' . $_POST['version'] . '
            ",0,123,' . $_POST['age'] . ', ' . $_SESSION['id'] . ',' . $_POST['cat'] . ',"Pending",current_timestamp); ';
        echo $sql;
        header("Location: devrelease.php");
        if (!$conn->query($sql)) {
            echo "Insert failed";
        }
    } elseif ($_POST['edittype'] == "edit") {
        $sql = 'UPDATE applications SET  app_name = "' . $_POST['appname'] . '",app_pic= "' . $_POST['fileToUpload'] . 
        '",`des_short`= "' . $_POST['appshort'] . '"`des_long`= "' . $_POST['applong'] . '",`app_price`= ' . $_POST['price']
         . ',`changelog`= "' . $_POST['changelog'] . '",`version`= "' . $_POST['version'] . '",`age_restriction`=' .
          $_POST['age'] . ',`cat_id`=' . $_POST['cat'] . ',`status`= "Pending",`upload_time`= current_timestamp
        WHERE applications.app_id = ' . $_POST['appid'];
        echo $sql;
        header("Location: devrelease.php");
        if (!$conn->query($sql)) {
            echo "Insert failed";
        }
    }
}

?>