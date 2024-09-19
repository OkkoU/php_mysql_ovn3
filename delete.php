<?php
include 'connectorDB.php';

if (isset($_POST['delete'])) {
  $id = $_POST['delete'];

  $query = "DELETE FROM todos WHERE id=:id";
  $run = $pdo->prepare($query);
  $data = [
    ':id' => $id
  ];

  $query_execute = $run->execute($data);

  if ($query_execute) {
    echo "<p>Successfully deleted!</p>";
    header('Refresh: 1; URL = index.php');
  } else {
    echo "<p>Failed to delete!</p>";
    header('Refresh: 1; URL = index.php');
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="todo-style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=SUSE&display=swap" rel="stylesheet">
  <title>Deleted</title>
</head>

<body>

</body>

</html>
