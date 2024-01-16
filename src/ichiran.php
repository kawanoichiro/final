<?php require 'db-connect.php'; ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<?php
// データベース接続
try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cookingテーブルからデータ取得のSQLクエリ
    $sql = "SELECT * FROM Cooking";

    // クエリの実行
    $result = $pdo->query($sql);

    echo '<div class="content">';
    echo '<div class="container">';
    echo '<h3 class="title is-3 has-text-centered">レシピ一覧</h3>';

    if ($result->rowCount() > 0) {
        // テーブルヘッダー
        echo '<table class="table is-fullwidth">
                <tr class="has-background-success-dark">
                    <th class="has-text-light">料理ID</th>
                    <th class="has-text-light">料理名</th>
                    <th class="has-text-light">カテゴリ</th>
                    <th></th>
                    <th></th>
                </tr>';

        // データ表示
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row) {
            echo "<tr>
                    <td>" . $row["cooking_id"] . "</td>
                    <td>" . $row["cooking_name"] . "</td>
                    <td>" . $row["category"] . "</td>
                    <td><a href='koushin-input.php?cooking_id=" . $row["cooking_id"] . "'>更新</a></td>
                    <td><a href='sakujyo-input.php?cooking_id=" . $row["cooking_id"] . "'>削除</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "データがありません";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // データベース接続を閉じる
    $pdo = null;
}
?>
<nav class="level">
    <!-- 中央揃え -->
    <div class="level-item">
        <form action="touroku-input.php" method="post">
            <input class="button has-background-success-dark has-text-white" type="submit" value="新規登録">
        </form>
    </div>
</nav>