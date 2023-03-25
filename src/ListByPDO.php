<?php
// output bufferingを開始する
ob_start();

// データベースに接続するための情報
$host = 'db';
$dbname = 'example_db';
$user = 'root';
$pass = 'example';

try {
  // データベースに接続する
  $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  // エラーモードを例外モードに設定する
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  // HTMLを出力する
  include 'main.html';

  // POSTリクエストを処理する
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームのメッセージが送信された場合
    if (!empty($_POST['message'])) {
      // データを挿入する
      $stmt = $dbh->prepare("INSERT INTO messages (message, author) VALUES (:message, :author)");
      $message = $_POST['message'];
      $author = 'anonymous';
      $stmt->bindParam(':message', $message);
      $stmt->bindParam(':author', $author);
      $stmt->execute();

      // リダイレクトを行う
      header('Location: /ListByPDO.php');
      exit;
    }
  }
} catch (PDOException $e) {
  // データベースへの接続に失敗した場合、エラーメッセージを表示する
  echo "Failed to connect to database: " . $e->getMessage();
}

// output bufferingを終了し、出力する
ob_end_flush();
