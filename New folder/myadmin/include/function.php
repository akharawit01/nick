<?php
function getmodules($module,$action){
	include("modules/".$module."/index.php");
}

function fn_link() {
?>
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet"/>
    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    
    <link href="assets/css/themify-icons.css" rel="stylesheet">
<?php
}

function fn_script() {
?>
	<!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>
	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>
    <!--  Google Maps Plugin    -->
	<script src="assets/js/paper-dashboard.js"></script>
    <script src="assets/editor/ckeditor.js"></script>
	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
	<script src="assets/js/app.js"></script>
<?php
}

function fn_topnav() {
?>
	<nav class="navbar navbar-default">
	    <div class="container-fluid">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar bar1"></span>
	                <span class="icon-bar bar2"></span>
	                <span class="icon-bar bar3"></span>
	            </button>
	            <a class="navbar-brand" href="#">Dashboard</a>
	        </div>
	        <div class="collapse navbar-collapse">
	            <ul class="nav navbar-nav navbar-right">
	                <li>
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                        <i class="ti-panel"></i>
							<p>Stats</p>
	                    </a>
	                </li>
	                <li class="dropdown">
	                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                            <i class="ti-bell"></i>
	                            <p class="notification">5</p>
								<p>Notifications</p>
								<b class="caret"></b>
	                      </a>
	                      <ul class="dropdown-menu">
	                        <li><a href="#">Notification 1</a></li>
	                        <li><a href="#">Notification 2</a></li>
	                        <li><a href="#">Notification 3</a></li>
	                        <li><a href="#">Notification 4</a></li>
	                        <li><a href="#">Another notification</a></li>
	                      </ul>
	                </li>
					<li>
	                    <a href="#">
							<i class="ti-settings"></i>
							<p>Settings</p>
	                    </a>
	                </li>
	            </ul>

	        </div>
	    </div>
	</nav>
<?php
}

function fn_nav() {
?>
	<div class="sidebar" data-background-color="white" data-active-color="danger">
	    <!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Creative Tim
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="?module=home&action=home_index">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="">
                    <a href="?module=catagory&action=catagory_index">
                        <i class="ti-panel"></i>
                        <p>Catagory</p>
                    </a>
                </li>
                <li class="">
                    <a href="?module=contact&action=contact_index">
                        <i class="ti-panel"></i>
                        <p>Contact us</p>
                    </a>
                </li>
                <li>
                    <a href="?module=news&action=news_index">
                        <i class="ti-user"></i>
                        <p>News</p>
                    </a>
                </li>
                <li>
                    <a href="table.html">
                        <i class="ti-view-list-alt"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <li>
                    <a href="typography.html">
                        <i class="ti-text"></i>
                        <p>Typography</p>
                    </a>
                </li>
                <li>
                    <a href="icons.html">
                        <i class="ti-pencil-alt2"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="maps.html">
                        <i class="ti-map"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.html">
                        <i class="ti-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
<?php
}

function fn_footer() {
?>
	<footer class="footer">
        <div class="container-fluid">
            <nav class="pull-left">
                <ul>

                    <li>
                        <a href="http://www.creative-tim.com">
                            Creative Tim
                        </a>
                    </li>
                    <li>
                        <a href="http://blog.creative-tim.com">
                           Blog
                        </a>
                    </li>
                    <li>
                        <a href="http://www.creative-tim.com/license">
                            Licenses
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright pull-right">
                &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
            </div>
        </div>
    </footer>

<?php
}




function thai_date($time){
    $thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
    $thai_month_arr=array(
        "0"=>"",
        "1"=>"มกราคม",
        "2"=>"กุมภาพันธ์",
        "3"=>"มีนาคม",
        "4"=>"เมษายน",
        "5"=>"พฤษภาคม",
        "6"=>"มิถุนายน",    
        "7"=>"กรกฎาคม",
        "8"=>"สิงหาคม",
        "9"=>"กันยายน",
        "10"=>"ตุลาคม",
        "11"=>"พฤศจิกายน",
        "12"=>"ธันวาคม"                 
    );
    $thai_date_return="วัน".$thai_day_arr[date("w",$time)];
    $thai_date_return.= "ที่ ".date("j",$time);
    $thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];
    $thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
    return $thai_date_return;
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