<?php
	include("db_connection.php");
    session_start();

    if(isset($_GET["getFormThumbnail"])){
		$sql = "SELECT * FROM forms WHERE id = $_GET[id]";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
				$thumbnail = $row['thumbnail'];
			}
		}
		echo json_encode($thumbnail);
	}
?>