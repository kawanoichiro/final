<?php
require 'db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cooking_id'])) {
    try {
        // データベース接続
        $pdo = new PDO($connect, USER, PASS);

        // POSTデータ受け取り
        $cooking_id = $_POST['cooking_id'];

        // Cookingテーブルのデータ削除のSQLクエリ
        $sql = "DELETE FROM Cooking WHERE cooking_id = :cooking_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cooking_id', $cooking_id, PDO::PARAM_INT);
        $stmt->execute();

        // 削除成功メッセージ
        echo "レシピが削除されました。";
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
<p><button onclick = "location.href='ichiran.php'">レシピ一覧へ</button></p>
</div>
</div>
</div>
</nav>