<?php

include 'connectorDB.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $sql = "SELECT status FROM todos WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['id' => $id]);
  $todo = $stmt->fetch();

  $new_status = $todo['status'] === 'Pending' ? 'Completed' : 'Pending';

  $sql = "UPDATE todos SET status = :status WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['status' => $new_status, 'id' => $id]);

  header("Location: index.php");
}
