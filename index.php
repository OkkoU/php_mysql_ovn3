<?php
include 'connectorDB.php';

$orderBy = '';

if (isset($_POST['due_date_asc'])) {
  $orderBy = 'ORDER BY due_date ASC';
} elseif (isset($_POST['due_date_desc'])) {
  $orderBy = 'ORDER BY due_date DESC';
} elseif (isset($_POST['created_at_asc'])) {
  $orderBy = 'ORDER BY created_at ASC';
} elseif (isset($_POST['created_at_desc'])) {
  $orderBy = 'ORDER BY created_at DESC';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
  <link rel="stylesheet" href="todo-style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=SUSE&display=swap" rel="stylesheet">
  <title>MySQL - Ovn3</title>
</head>

<body>

  <h1>To-Do List</h1>

  <br>

  <a id="add-btn" href="create.php">Add New To-Do</a>

  <br><br>

  <h2>Sort by:</h2>

  <form action="" method="POST" id="sort-btns">
    <div id="dd-btns">
      <button name="due_date_asc" id="dd-asc">Due Date - Ascending</button>
      <button name="due_date_desc" id="dd-desc">Due Date - Descending</button>
    </div>
    <div id="ca-btns">
      <button name="created_at_asc" id="ca-asc">Created At - Ascending</button>
      <button name="created_at_desc" id="ca-desc">Created At - Descending</button>
    </div>
  </form>

  <table>

    <?php
    $sql = "SELECT * FROM todos $orderBy";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($data) {
      foreach ($data as $row) {
        $btnClass = $row['status'] === 'Pending' ? 'pending-btn' : 'completed-btn';
        $btnLabel = $row['status'] === 'Pending' ? 'Pending' : 'Completed';
    ?>
        <tr>
          <td id="list-title"><?= htmlspecialchars($row['title']) ?></td>
          <td><?= htmlspecialchars($row['description']) ?></td>
          <td id="list-due-date">Due Date: <?= date("d.m.Y", strtotime($row['due_date'])) ?></td>
          <td>
            <form action="update_status.php" method="POST">
              <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
              <button type="submit" class="<?= $btnClass; ?>">
                <?= $btnLabel; ?>
              </button>
            </form>
          </td>

          <td id="td-btns">
            <a id="edit-btn" href="edit.php?id=<?= htmlspecialchars($row['id']); ?>">Edit</a>
            <form id="dlt-form" action="delete.php" method="POST">
              <button id="dlt-btn" type="submit" name="delete" value="<?= htmlspecialchars($row['id']); ?>">Delete</button>
            </form>
          </td>

        </tr>
      <?php
      }
    } else {
      ?>
      <tr>
        <td>No To-Do's</td>
      </tr>
    <?php
    }
    ?>

  </table>

</body>

</html>
