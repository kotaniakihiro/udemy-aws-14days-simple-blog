<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>Simple Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>
  <body>
    <?php
      try {
        # TODO: 各自の RDS エンドポイントに変更する
        $dbh = new PDO('mysql:host=udemy-aws-mysql.c12wscg6gcrd.ap-northeast-1.rds.amazonaws.com;dbname=simple_blog', "simple_blog_user", "User!1234");

        $sth = $dbh->prepare("SELECT * from posts");
        $sth->execute();
        $posts = $sth->fetchAll();

        $dbh = null;
      } catch (PDOException $e) {
        print "エラー!: " . $e->getMessage() . "<br/>";
        die();
      }
    ?>

    <h2 class="text-center mt-3 mb-5">Simple Blogi codeseries</h2>
    <div class="container">

      <?php foreach ($posts as $post) : ?>
      <div class="mb-5 row">
        <div class="col-sm-2 mb-2">
          <img src=<?php echo $post["image"]; ?> class="w-75 rounded-circle"></img>
        </div>
        <div class="col-sm-10">
          <h3><?php echo $post["title"]; ?></h3>
          <p>
            <?php echo $post["detail"]; ?>
          </p>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </body>
</html>
