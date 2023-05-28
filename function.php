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

	$medicine_to_add = array(
		'generic'    => $genericName,
		'nongeneric' => $NonGenericName,
	);

	$medicineList = array();
	if ( isset( $_SESSION['medicineList'] ) ) {
		$medicineList = unserialize( $_SESSION['medicineList'] );
	}
	$medicineList[]           = $medicine_to_add;
	$_SESSION['medicineList'] = serialize( $medicineList );

	if ( isset( $_SESSION['medicineList'] ) ) :
		?>
		<tr>
			<th>Sno.</th>
			<th>Non Generic name</th>
			<th>Generic name</th>
		</tr>
		<?php
		foreach ( unserialize( $_SESSION['medicineList'] ) as $key => $value ) {
			?>

			<tr>
				<td>
					<?php echo $key + 1; ?>
				<td>
					<?php echo $value['generic']; ?>
				</td>
				<td>
					<?php echo $value['nongeneric']; ?>
				</td>
				<td>
					<?php echo '<button id="removeList-btn-' . $key+1 . '" type="button" data-fpid="' . $key . '" onclick="removeCart(this.id)">Remove</button>'; ?>
				</td>
			</tr>
			<?php
		}
	endif;

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