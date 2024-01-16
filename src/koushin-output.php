<?php require 'db-connect.php'; ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cooking_id'])) {
    try {
        // データベース接続
        $pdo = new PDO($connect, USER, PASS);

        // POSTデータ受け取り
        $cooking_id = $_POST['cooking_id'];
        $cooking_name = $_POST['cooking_name'];
        $category = $_POST['category'];

        // Cookingテーブルのデータ更新のSQLクエリ
        $sql = "UPDATE Cooking SET cooking_name = :cooking_name, category = :category WHERE cooking_id = :cooking_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cooking_id', $cooking_id, PDO::PARAM_INT);
        $stmt->bindParam(':cooking_name', $cooking_name, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();

        // 成功メッセージ
        echo '<nav class="level">';
        //<!-- 中央揃え -->
        echo '<div class="level-item">';
        echo "レシピが更新されました。";
        echo '</div>';
        echo '</nav>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // データベース接続を閉じる
        $pdo = null;
    }
} else {
    echo "不正なアクセスです";
}
?>
<nav class="level">
<!-- 中央揃え -->
<div class="level-item">
<p><button class="button has-background-success-dark has-text-white" onclick = "location.href='ichiran.php'">レシピ一覧へ</button></p>
</div>
</div>
</div>
</nav>