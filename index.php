<?php
	
	require 'config/db.php';

/** Connecting to the database */
	$db = new db(); // creating an instance of class db from db.php file
	$db = $db->connect(); // calling the function connect from class db

/** Performing query operations to the database */
	$sql = 'SELECT * FROM todo;'; // SQL string to fetch all items from table todo
	$stmt = $db->prepare($sql); // Prepare the sql statement for execution

/** Executing thhe query and fetching the results */
	$stmt->execute(); // executing the prepared statement
	$result = $stmt->fetchAll(PDO::FETCH_OBJ); // storing the result as Objects into variable $result

/** End Query fetching*/

/** Action to insert a new Item to the database */
	if(isset($_POST['btnAdd'])) // checking if the Add button is click
	{
		$newItem = $_POST['newItem'];
		if(empty($newItem)){
			echo "<script> alert('You cannot add an empty Task');</script>";
		}
		else {
			$sql = "INSERT INTO todo (item, date_created) VALUES(:item, :date_created);";

			$date = date('Y-m-d');
			$stmt = $db->prepare($sql);

			$stmt->bindParam(':item', $newItem);
			$stmt->bindParam(':date_created', $date);

			$stmt->execute();

			$db = null;

			echo "<script> window.location.href = 'index.php'; </script>";
		}
	}
/** End insert operation*/

/** Editing the Items */

	function edit($id){

	}

	if(isset($_GET['upd_id']))
	{
		$id = $_GET['upd_id'];
		$item = $_GET["item{$id}"];

		var_dump($id);
		var_dump($item);

		/*$sql = "UPDATE todo set item = :item WHERE id=:id";
		$stmt = $db->prepare($sql);

		$stmt->bindParam(':item', $item);
		$stmt->bindParam(':id', $id);

		$stmt->execute();

		$db = null;

		echo "<script> window.location.href = 'index.php'; </script>";*/
	}

/** Delete an item */
if(isset($_GET['del_id']))
{
	$id = $_GET['del_id'];

	$sql = "DELETE FROM todo WHERE id=:id";
		$stmt = $db->prepare($sql);

		$stmt->bindParam(':id', $id);

		$stmt->execute();

		$db = null;

		echo "<script> window.location.href = 'index.php'; </script>";	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Todo</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form action="" method="post">
<h1>My Todo List</h1>
	<label for="txtItem">Add new Task: </label>
	<textarea name="newItem" class="txtArea" id="txtItem" placeholder="Add new item here"></textarea><br>
	<button name="btnAdd" type="submit" class="btn btn-save">Add</button>
</form>
<table>
	<tr>
		<th>s/n</th>
		<th>Task</th>
		<th>Options</th>
		<th>Date</th>
	</tr>
	<?php $i=1; foreach($result as $row) { ?>
	<tr>
		<td><?= $i++; ?></td>
		<td>
			<form method="get" action="">
			<input type="text" name="item<?= $row->id ?>" value="<?= $row->item ?>">
		</td>
		<td>
			<a id="upd_id<?= $row->id; ?>" class="btn" href="edit.php?id=<?= $row->id; ?>">Edit</a>
			<a class="btn btn-delete" href="?del_id=<?= $row->id; ?>">Del</a>
		</td>
		<td><?= $row->date_created; ?></td>
		</form>
	</tr>
	<?php } ?>
</table>
<div>
	<form>
		<button class="hand-cursor btn btn-delete" type="submit">Trash bin</button>
	</form>
</div>
<script type="text/javascript">
	function getItem(id) {
		var item = document.getElementById('upd_id'+id).value;

		return item;
	}
</script>

<!-- Modal -->
<div id="modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Item</h4>
      </div>
      <div class="modal-body">
      <form>
      	<input type="text" name="" value="">
      	<button type="submit" name="update">Update</button>
      </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>