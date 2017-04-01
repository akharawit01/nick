<?php session_start();
$title = "ข่าวสาร";
include 'myadmin/class/connect_db.php';
include 'components/components.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php stylesheet($title); ?>
</head>

<body>
    <?php topHeader(); ?>
    <div class="container">
        <?php navHeader(); ?>
        <?php if (!empty($_GET['id'])) : ?>
            <?php
            $result_news=mysql_query("SELECT * FROM news WHERE news_id='".$_GET['id']."'") or die(mysql_error());
            $row_news = mysql_fetch_array($result_news);
                ?>
            <ol class="breadcrumb">
                <li><a href="index.php">หน้าหลัก</a></li>
                <li><a href="news.php">ข่าวสาร</a></li>
                <li class="active"><?php echo mb_substr($row_news['news_title'], 0, 20, "UTF-8"); ?>...</li>
            </ol>
            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="text-center">
                        <img src="uploads/pic_news/<?php echo $row_news['news_gallery']; ?>" class="img-responsive" style="display: initial;" alt="<?php echo $row_news['news_gallery']; ?>">
                    </div>
                    <br>
                    <h2><?php echo $row_news['news_title']; ?></h2>
                    <?php echo $row_news['news_detail']; ?>

                </div>
            </div>
        <?php else: ?>
            <ol class="breadcrumb">
                <li><a href="index.php">หน้าหลัก</a></li>
                <li class="active">ข่าวสาร</li>
            </ol>
            <div class="row">
                <?php
                $result_news=mysql_query("SELECT * FROM news ORDER BY news_sort ASC, news_id DESC") or die(mysql_error());
                while ($row_news = mysql_fetch_array($result_news)) { 
                    $shotTitle=strip_tags($row_news['news_detail']);
                ?>
                <div class="col-sm-4">
                    <div class="news">
                        <div class="img-figure">
                            <img src="uploads/pic_news/<?php echo $row_news['news_cover']; ?>" class="img-responsive">
                        </div>
                        <div class="title">
                            <h1><?php echo $row_news['news_title']; ?></h1>
                        </div>
                        <p class="description">
                            <?php echo mb_substr($shotTitle, 0, 80, "UTF-8"); ?>...
                        </p>
                        <p class="more">
                            <a href="?id=<?php echo $row_news['news_id']; ?>">เพิ่มเติม</a><i class="fa fa-angle-right" aria-hidden="true"></i>
                        </p>
                    </div>
                </div>
                <?php } ?>
            </div>
        <?php endif; ?>
    </div>
    <?php footer(); ?>
</body>

</html>
