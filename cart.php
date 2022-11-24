<?php

// session_start();

// require_once 'error.php';
// require_once 'config.php';
// require_once 'function.php';

// if(isset($_POST['genericName']) && isset($_POST['NonGenericName']) && !empty($_POST['NonGenericName']) && !empty($_POST['genericName'])){
// if(isset($_POST['sno']) && !empty($_POST['sno'])){
    // $genericName = testInput($_POST['genericName']);
    // // $genericName = $_POST['genericName'];
    // $NonGenericName = testInput($_POST['NonGenericName']);
    // // $NonGenericName = $_POST['NonGenericName'];
    // $sql = 'INSERT INTO medicineCart (userIP, NonGeneric, Generic) VALUES (?,?,?)';
    // $stmt = $con->prepare($sql);
    // $stmt->bind_param('sss',$_SESSION['userIP'], $NonGenericName, $genericName);
    // $stmt->execute();

    // echo 'Added'.$_POST['sno'];

    // echo $genericName.'<br>';
    // echo $NonGenericName.'<br>';

    // setcookie('GenericName', $genericName, strtotime('+30days'), '/');
    // setcookie('NonGenericName', $NonGenericName, strtotime('+30days'), '/');
    // setcookie($NonGenericName,$genericName, strtotime('+30days'),'/');
    // if(isset($_SESSION['userIP'])){
        // $medicine[$NonGenericName] = $genericName; 
    // }
        // $userFile = 'userFile/user_'.$_SESSION['userIP'];

        // if(file_exists($userFile)){
            // $handle = fopen('userFile/user_'.$_SESSION['userIP'],'w+');
            // echo 'exist';
            // echo $handle;

        // }else{
            // echo 'not exists';
        // }
    // $_COOKIE[$NonGenericName] = $genericName;
    // setcookie(generic[$NonGenericName],$genericName, strtotime('+30days'), '/');

    // print_r($_COOKIE);
    // print_r($medicine);

    // echo $NonGenericName;
// }
// else{
    // echo "couldn't able to add";

    // header('location: ./loader.php');
// }
?>