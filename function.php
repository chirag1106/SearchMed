<?php

require_once './error.php';
require_once './config.php';

function testInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
}

function liveSearch($keyword){
    global $con;
    $output ='';
    $sql = "SELECT * FROM medicine_db_csv___sheet1 WHERE NonGeneric LIKE CONCAT('%',?,'%') ORDER BY NonGeneric ASC LIMIT 30";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s',$keyword);
    $stmt->execute();
    $result = $stmt->get_result();
//    print_r($result);
    if($result->num_rows){
        $row = $result->fetch_assoc();
        while($row){
            $output .= '<tr id="'.$row['medicine_id'].'"><td>'.$row['NonGeneric'].'</td>
                           <td><input type="hidden" value="'.$row['Generic'].'"  name="genericName"></td>
                           <td><input type="hidden" value="'.$row['NonGeneric'].'"  name="NonGenericName"></td>
                           <td><button id="addList-btn-'.$row['medicine_id'].'" type="button" data-fpid="'.$row['medicine_id'].'" onclick="addCart(this.id)">Add to list</button></td>
                        </tr>'; 
            $row = $result->fetch_assoc();
        }
        
        return $output;
    }
    else{
        $output = 'No record Found!';
        return $output;;
    }
}

function addCart($medicine_id){
    // $userFileName = 'user_'.$_SESSION['userIP'];
    // $handle = fopen('./userFile/'.$userFileName,'w+');
    // $userFileName = 'cache';
    // $handle = fopen('./'.$userFileName,'w+');
    $output = getRecord($medicine_id);
    // fwrite($handle, $sno);
    // fclose($handle);    
    $genericName = str_replace(' ','',$output['Generic']); 
    $NonGenericName = str_replace(' ','',$output['NonGeneric']);
    if(!isset($_COOKIE[$NonGenericName])){
        setcookie($NonGenericName, $genericName, strtotime('+30days'), '/');
    }
        return $output;
}

function getRecord($medicine_id){
    require_once 'config.php';
    $sql = "SELECT * FROM medicine_db_csv___sheet1 WHERE medicine_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i',$medicine_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    
    return $row;
}

?>