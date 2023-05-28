<?php

require_once './error.php';
require_once './config.php';

define( 'TABLE_NAME', 'medicine_sheet' );

function testInput( $data ) {
	$data = trim( $data );
	$data = stripslashes( $data );
	$data = strip_tags( $data );
	$data = htmlspecialchars( $data );

	return $data;
}

function liveSearch( $keyword ) {
	global $con;
	$output = '';
	$sql    = "SELECT * FROM medicine_sheet WHERE NonGeneric LIKE CONCAT('%',?,'%') ORDER BY NonGeneric ASC LIMIT 30";
	$stmt   = $con->prepare( $sql );
	$stmt->bind_param( 's', $keyword );
	$stmt->execute();
	$result = $stmt->get_result();
	if ( $result->num_rows ) {
		$row = $result->fetch_assoc();
		while ( $row ) {
			$output .= '<tr id="' . $row['medicine_id'] . '"><td>' . $row['NonGeneric'] . '</td>
                           <td><input type="hidden" value="' . $row['Generic'] . '"  name="genericName"></td>
                           <td><input type="hidden" value="' . $row['NonGeneric'] . '"  name="NonGenericName"></td>
                           <td><button id="addList-btn-' . $row['medicine_id'] . '" type="button" data-fpid="' . $row['medicine_id'] . '" onclick="addCart(this.id)">Add to list</button></td>
                        </tr>';
			$row    = $result->fetch_assoc();
		}

		return $output;
	} else {
		$output = 'No record Found!';
		return $output;
		;
	}
}

function addCart( $medicine_id ) {
	$output         = getRecord( $medicine_id );
	$genericName    = str_replace( ' ', '', $output['Generic'] );
	$NonGenericName = str_replace( ' ', '', $output['NonGeneric'] );
	// if ( ! isset( $_COOKIE[ $NonGenericName ] ) ) {
	// 	setcookie( $NonGenericName, $genericName, strtotime( '+30days' ), '/' );
	// }

	// add ke leta hu generic, nongeneric to the array of array then on every time have to add into the array
	$medicine_to_add = array(
		'generic'    => $genericName,
		'nongeneric' => $NonGenericName,
	);

	// Adding the list of medicine to the array to be displayed on the list page
	$medicineList = array();
	if ( isset( $_COOKIE['medicineList'] ) ) {
		$medicineList = unserialize( $_COOKIE['medicineList'] );
	}
	$medicineList[] = $medicine_to_add;
	setcookie( 'medicineList', serialize( $medicineList ), strtotime( '+30days' ), '/' );
	return $output;
}

function getRecord( $medicine_id ) {
	global $con;
	$sql  = "SELECT * FROM medicine_sheet WHERE medicine_id = ?";
	$stmt = $con->prepare( $sql );
	$stmt->bind_param( 'i', $medicine_id );
	$stmt->execute();
	$result = $stmt->get_result();

	$row = $result->fetch_assoc();

	return $row;
}

?>