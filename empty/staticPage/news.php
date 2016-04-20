    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>新闻列表</title>
    </head>
    <body>
        
    <a href="add.php">添加文章</a>
    <hr>
    <?php
        require_once "conn.php";
        $sql = "select * from news";
        foreach($dbh->query($sql) as $row){
            echo "<a href='news_{$row['id']}.html'>{$row['title']}</a>---------<a href='add.php?id={$row['id']}'>修改文章</a><br>";
        }
    ?>
    </body>
    </html>
    