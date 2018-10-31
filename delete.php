<?php

	$conn = mysqli_connect('localhost', 'root', '', 'iloilo_fleuriste') or 
	die('Connection Failed: ' . mysqli_error());

	//set the variable of url name
	if (isset($_GET['prod_del'])) {

		$prod_del = $_GET['prod_del']; //get url name
		$prod_sql = "DELETE FROM products WHERE ProductID = '$prod_del'";
		$prod_res = mysqli_query($conn, $prod_sql);

		echo "<script>
			alert('Product deleted successfully');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-manage-profiling.php'>";
	}
?>