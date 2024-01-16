<?php require 'db-connect.php'; ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<?php 
// データベース接続
$pdo = new PDO($connect,USER, PASS);
// Columnsテーブルからデータ取得
$sql = "SELECT * FROM Cooking WHERE cooking_id = ?";
$result = $pdo->prepare($sql);
$result->execute([$_GET['cooking_id']]);
$row = $result->fetch();
?>
<h3 class="title is-3 has-text-centered">レシピ更新</h3>
<div class="content">
<div class="container">
<nav class="level">
    <!-- 中央揃え -->
<div class="level-item">   
<form action="koushin-output.php" method="post">
        <input type="hidden" name="cooking_id" value="<?= $row['cooking_id'] ?>">
        <input type="text" name="cooking_name" value="<?= $row['cooking_name'] ?>" required><br>
        <input type="text" name="category" value="<?= $row['category'] ?>" required><br>         
        <input class="button has-background-success-dark has-text-white" type="submit" value="更新">
</form>
</div>
</div>
</div>
</nav>