<?php require 'db-connect.php'; ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<?php
// データベース接続
$pdo = new PDO($connect, USER, PASS);

// レシピが送信された場合
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信されたデータを取得
    $cooking_name = $_POST['cooking_name'];
    $category = $_POST['category'];

    // SQLクエリの準備
    $sql = "INSERT INTO Cooking (cooking_id, cooking_name, category) VALUES (:cooking_id, :cooking_name, :category)";

    // プリペアドステートメントの作成
    $stmt = $pdo->prepare($sql);

    // パラメータのバインド
    $stmt->bindParam(':cooking_id', $cooking_id, PDO::PARAM_INT);
    $stmt->bindParam(':cooking_name', $cooking_name, PDO::PARAM_STR);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);

    try {
        // クエリの実行
        $stmt->execute();

        // 登録成功時のメッセージ
        echo '<nav class="level">';
        //<!-- 中央揃え -->
        echo '<div class="level-item">';
        echo '<p class="">レシピが正常に登録されました。</p>';
        echo '</div>';
        echo '</nav>';
    } catch (PDOException $e) {
        // エラーメッセージ
        echo '<p class="has-text-danger">エラー: ' . $e->getMessage() . '</p>';
        
    }
}
?>
<nav class="level">
<!-- 中央揃え -->
<div class="level-item">
<p><button class="button has-background-success-dark has-text-white" onclick = "location.href='ichiran.php'">レシピ一覧へ</button></p>
</div>
</nav>
</div>
</diV>