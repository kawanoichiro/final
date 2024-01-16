<?php require 'db-connect.php'; ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cooking_id'])) {
    // データベース接続
    try {
        $pdo = new PDO($connect, USER, PASS);

        // Cookingテーブルから特定のデータ取得のSQLクエリ
        $cooking_id = $_GET['cooking_id'];
        $sql = "SELECT * FROM Cooking WHERE cooking_id = :cooking_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cooking_id', $cooking_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // レシピ更新用のフォーム
            echo '<div class="content">';
            echo '<div class="container">';
            echo '<h3 class="title is-3 has-text-centered">レシピ更新</h3>';
            echo '<form action="koushin-output.php" method="post">';
            echo '<input type="hidden" name="cooking_id" value="' . $row['cooking_id'] . '">';
            echo '料理名: <input type="text" name="cooking_name" value="' . $row['cooking_name'] . '" required><br>';
            echo 'カテゴリ: <input type="text" name="category" value="' . $row['category'] . '" required><br>';
            echo '<input class="button has-background-success-dark has-text-white" type="submit" value="更新">';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        } else {
            echo "該当するデータが見つかりません";
        }
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