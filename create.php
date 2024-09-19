<?php
include 'connectorDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title =  $_POST['title'];
  $description = $_POST['description'];
  $due_date =  $_POST['due_date'];

  $insert = "INSERT INTO todos (title, description, due_date) VALUES (:title, :description, :due_date)";

  $run = $pdo->prepare($insert);

  $todo = [
    ':title' => $title,
    ':description' => $description,
    ':due_date' => $due_date
  ];

  $query_execute = $run->execute($todo);

  if ($query_execute) {
    echo "<p>Successfully added!</p>";
    header('Refresh: 1; URL = index.php');
  } else {
    echo "<p>Failed to add!</p>";
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
  <title>Add New To-Do</title>
  <script src="tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="script.js" defer></script>
</head>

<body>

  <h1>Add New To-Do</h1>

  <br>

  <form id="add-todo-form" action="" method="POST">

    <label for="title" id="title-label">Title:</label>
    <input type="text" name="title" id="title" size="25">

    <br>

    <label for="description" id="description-label">Description:</label>
    <textarea name="description" id="description-editor"></textarea>

    <br>

    <label for="due_date" id="due-date-label">Due Date:</label>
    <input type="date" name="due_date" id="due-date" size="25">

    <br>

    <button id="add-btn-form" type="submit" value="submit">Add</button>

  </form>

</body>

</html>
