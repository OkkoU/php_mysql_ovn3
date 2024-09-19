<?php
include 'connectorDB.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM todos WHERE id=:id LIMIT 1";
  $stmt = $pdo->prepare($sql);
  $data = [':id' => $id];
  $stmt->execute($data);

  $result = $stmt->fetch(PDO::FETCH_OBJ);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $title =  $_POST['title'];
  $description = $_POST['description'];
  $due_date =  $_POST['due_date'];


  $update = "UPDATE todos SET title=:title, description=:description, due_date=:due_date WHERE id=:id LIMIT 1";

  $run = $pdo->prepare($update);

  $member = [
    ':id' => $id,
    ':title' => $title,
    ':description' => $description,
    ':due_date' => $due_date
  ];

  $query_execute = $run->execute($member);

  if ($query_execute) {
    echo "<p>Successfully updated!</p>";
    header('Refresh: 1; URL = index.php');
  } else {
    echo "<p>Failed to update!</p>";
    header('Refresh: 1; URL = index.php');
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="todo-style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=SUSE&display=swap" rel="stylesheet">
  <title>Edit To-Do</title>
  <script src="tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="script.js" defer></script>
</head>

<body>

  <h1>Edit To-Do</h1>

  <br>

  <form id="edit-todo-form" action="" method="POST">

    <input type="hidden" name="id" value="<?= $result->id ?>">

    <label for="title" id="title-label">Title:</label>
    <input type="text" name="title" id="title" value="<?= $result->title; ?>" size="25">

    <br>

    <label for="description" id="description-label">Description:</label>
    <textarea name="description" id="description-editor"><?= $result->description; ?></textarea>

    <br>

    <label for="due_date" id="due-date-label">Due Date:</label>
    <input type="date" name="due_date" id="due-date" value="<?= $result->due_date; ?>" size="25">

    <br>

    <button id="edit-btn-form" type="submit" value="submit">Edit</button>

  </form>

</body>

</html>
