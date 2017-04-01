<?php
function getmodules($module,$action){
	include("modules/".$module."/index.php");
}

function fn_link() {
?>
    <title>Matrix Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="assets/css/matrix-login.css">
    <link rel="stylesheet" href="assets/css/fullcalendar.css">
    <link rel="stylesheet" href="assets/css/matrix-style.css">
    <link rel="stylesheet" href="assets/css/matrix-media.css">
    <link rel="stylesheet" href="assets/css/colorpicker.css">
    <link rel="stylesheet" href="assets/css/datepicker.css">
    <link rel="stylesheet" href="assets/css/uniform.css">
    <link rel="stylesheet" href="assets/css/select2.css">
    <link rel="stylesheet" href="assets/css/bootstrap-wysihtml5.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/app.css">
<?php
}

function fn_topnav() {
?>
	<div id="header">
        <h1><a href="index.php">Matrix Admin</a></h1>
    </div>
    <!--close-Header-part-->
    <!--top-Header-menu-->
    <div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav">
            <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome User</span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="?module=profile&action=profile_index"><i class="icon-user"></i> My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
                    <li class="divider"></li>
                    <li><a href="?lg=logout"><i class="icon-key"></i> Log Out</a></li>
                </ul>
            </li>
            <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> new message</a></li>
                    <li class="divider"></li>
                    <li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>
                    <li class="divider"></li>
                    <li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>
                    <li class="divider"></li>
                    <li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>
                </ul>
            </li>
            <li class=""><a title="" href="?lg=logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
        </ul>
    </div>
    <!--start-top-serch-->
    <div id="search">
        <input type="text" placeholder="Search here...">
        <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
    </div>
    <!--close-top-serch-->
    <!--sidebar-menu-->
    <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard2</a>
        <ul>
            <li><a href="index.html"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>จัดการหน้าบ้าน</span> <span class="label label-important">3</span></a>
                <ul>
                    <li><a href="?module=photoslide&action=photoslide_index">ภาพสไลด์โชว์</a></li>
                    <li><a href="?module=news&action=news_index">ข่าวสาร</a></li>
                    <li><a href="?module=catagory&action=catagory_index">ประเภทสินค้า</a></li>
                    <li><a href="?module=tag&action=tag_index">แท็ก</a></li>
                    <li><a href="?module=unit&action=unit_index">หน่วยนับ</a></li>
                    <li><a href="?module=product&action=product_index">สินค้า</a></li>
                    <li><a href="?module=contact&action=contact_index">ติดต่อเรา</a></li>
                </ul>
            </li>
            <li><a href="?module=product&action=product_index"><i class="icon icon-home"></i> สินค้า</a></li>
            <li><a href="?module=user&action=user_index"><i class="icon icon-home"></i> <span>สมาชิก</span></a> </li>
        </ul>
    </div>
<?php
}



function fn_footer() {
?>
    <div class="row-fluid">
        <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
    </div>
    <!--end-Footer-part-->
    <script src="assets/js/excanvas.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.ui.custom.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.flot.min.js"></script>
    <script src="assets/js/jquery.flot.resize.min.js"></script>
    <script src="assets/js/jquery.peity.min.js"></script>
    <script src="assets/js/matrix.js"></script>
    <script src="assets/js/fullcalendar.min.js"></script>
    <script src="assets/js/matrix.calendar.js"></script>
    <script src="assets/js/matrix.chat.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/matrix.form_validation.js"></script>
    <script src="assets/js/jquery.wizard.js"></script>
    <script src="assets/js/jquery.uniform.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/matrix.popover.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/matrix.tables.js"></script>
    <script src="assets/editor/ckeditor.js"></script>
    <script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage(newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-") {
                resetMenu();
            }
            // else, send page to designated URL            
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }

    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });

    $(function(){
        CKEDITOR.replace( 'editor1', { skin : 'moono', toolbar : [ ['Paste','Source','-','Templates','-','Maximize','-','FontSize','Font','Table','-','Bold','Italic','Underline','-','JustifyLeft','JustifyCenter','JustifyRight','-','TextColor','BGColor','-','Outdent','Indent','-','Link','-','Image','-','NumberedList','-','BulletedList'] ], });
        CKEDITOR.replace( 'editor2', { skin : 'moono', toolbar : [ ['Paste','Source','-','Templates','-','Maximize','-','FontSize','Font','Table','-','Bold','Italic','Underline','-','JustifyLeft','JustifyCenter','JustifyRight','-','TextColor','BGColor','-','Outdent','Indent','-','Link','-','Image','-','NumberedList','-','BulletedList'] ], });
    });

    </script>
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