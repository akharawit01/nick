<?php
function stylesheet($title) {
?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo (!empty($title)?$title:'my project'); ?></title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?v=11001">
    <link rel="stylesheet" href="assets/jquery.bxslider/jquery.bxslider.css?v=11001">
    <link rel="stylesheet" href="assets/EasyZoom-master/css/easyzoom.css?v=11001">
    <link rel="stylesheet" href="assets/css/app.css?v=11001">
<?php
}

function topHeader() {
?>
	<div class="top-head">
        <div class="container">
            <div class="row">
                <div class="col-md-6">สายด่วน: 053-115510, 097-9241851</div>
                <div class="col-md-6 text-right">
                    <?php
                    if (!empty($_SESSION['id_user'])) {
                    ?>
                        <span class="glyphicon glyphicon-user"></span> <a href="myuser.php"><?php echo $_SESSION['fname_user']." ".$_SESSION['lname_user']; ?></a>
                    <?php
                    }else {
                    ?>
                        <a href="register.php">สมัครสมาชิก | เข้าสู่ระบบ</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php
}

function navHeader() {
?>
	<header>
        <div class="row middle-head">
            <div class="col-md-2 col-sm-3 col-xs-4">
                <a href="index.php"><img src="images/logo.png" class="img-responsive" alt="Logo"></a>
            </div>
            <div class="col-md-8 col-sm-6 col-xs-8">
                <br class="hidden-xs">
                <div class="input-group">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default">
                            <span id="search_concept">All</span> <span class="caret"></span>
                        </button>
                    </div>
                    <input type="hidden" name="search_param" value="all" id="search_param">
                    <input type="text" class="form-control" name="x" placeholder="Search term...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12 text-right">
                <br>
                <?php
                if (count(@$_SESSION["strProductID"])) {
                ?>
                <a class="btn btn-shop btn-sm" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> รถเข็น: <?php echo count(@$_SESSION["strProductID"]); ?>  รายการ </a>
                <?php
                }else {
                ?>
                <a class="btn btn-shop btn-sm" href="#"><span class="glyphicon glyphicon-shopping-cart"></span> รถเข็น: <?php echo count(@$_SESSION["strProductID"]); ?>  รายการ </a>
                <?php
                }?>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand" href="#">Brand</a> -->
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $result_cat=mysql_query("SELECT * FROM catagory WHERE parent='0'") or die(mysql_error());
                while ($row_cat = mysql_fetch_array($result_cat)) { 
                ?>
                <li><a href="list.php?cat=<?php echo $row_cat['id']; ?>"><?php echo $row_cat['name']; ?></a></li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="news.php">เสอนราคา</a></li>
                <li><a href="news.php">ข่าวสาร</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ติดต่อเรา <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="quotation.php">ติดต่อเรา</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
<?php
}

function footer() {
?>
	<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h3>เกี่ยวกับเรา</h3>
                    <p>จำหน่ายหินธรรมชาตินานชนิดมีแบบให้เลือกมากมายส่งตรงจากเหมืองหินของดีราคาถูกพร้อมช่างบริการติดตั้งฝีมือดี หินกาบ หินทราย หินภูเขา หินแกรนิด ทรายล้าง หินจิ๊กซอว์ กรวดแม่น้ำโยง และอีกมากมาย</p>
                </div>
                <div class="col-md-5">
                    <h3>ติดต่อเรา</h3>
                    <p>ทวีลักษ์</p>
                    <address>
                        26 ถ.เชียงใหม่ - แม่ออน 
                        ต.ไชยสถาน อ.สารภี จ.เชียงใหม่ 50140
                    </address>
                    <div class="telphone">
                        <a href="tel:022769275">โทรศัพท์: 053-115510 </a>
                        <br>
                        <a href="tel:022769275">โทรสาร: (02) 097-9241851</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <div class="container"><address>สงวนลิขสิทธิ์ © 2557 บริษัท ไดนาสตี้ เซรามิค จำกัด (มหาชน)</address></div>
    </div>
    <script src="https://code.jquery.com/jquery-1.9.1.js?v=11001"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?v=11001"></script>
    <script src="assets/jquery.bxslider/jquery.bxslider.js?v=11001"></script>
    <script src="assets/EasyZoom-master/dist/easyzoom.js?v=11001"></script>
    <script src="assets/js/app.js?v11001"></script>
<?php
}

function DateThai($strDate) {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
?>