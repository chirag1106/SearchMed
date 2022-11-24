<?php 
session_start();

require_once 'error.php';
require_once 'function.php';

if(isset($_SESSION['userIP'])){
    
    if(isset($_POST['keyword']) && !empty($_POST['keyword']) && isset($_POST['action']) && $_POST['action'] == 'liveSearch'){
        $keyword = testInput($_POST['keyword']);
        $output = livesearch($keyword);
        echo $output;
        
    }
    else if(isset($_POST['medicine_id']) && !empty($_POST['medicine_id']) && isset($_POST['action']) && $_POST['action'] == 'addToCart'){
        $medicine_id = testInput($_POST['medicine_id']);
        $output = addCart($medicine_id);
        echo json_encode($output);
    }
    else{
        echo 'Start typing your medicine name...';
    }
}
else{
    header('location: ./index.php');
}

?>