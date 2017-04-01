<?php
function home_index() {
?>
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_lb">
                <a href="#"> <i class="icon-dashboard"></i> My Dashboard </a>
            </li>
            <li class="bg_lg">
                <a href="#"> <i class="icon-shopping-cart"></i> Shopping Cart</a>
            </li>
            <li class="bg_ly">
                <a href="#"> <i class=" icon-globe"></i> Web Marketing </a>
            </li>
            <li class="bg_lo">
                <a href="#"> <i class="icon-group"></i> Manage Users </a>
            </li>
            <li class="bg_ls">
                <a href="#"> <i class="icon-signal"></i> Check Statistics</a>
            </li>
        </ul>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                        <h5>To Do list</h5>
                    </div>
                    <div class="widget-content">
                        <div class="todo">
                            <ul>
                                <li class="clearfix">
                                    <div class="txt"> Luanch This theme on Themeforest <span class="by label">Nirav</span> <span class="date badge badge-important">Today</span> </div>
                                    <div class="pull-right"> <a class="tip" href="#" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                                </li>
                                <li class="clearfix">
                                    <div class="txt"> Manage Pending Orders <span class="by label">Alex</span> <span class="date badge badge-warning">Today</span> </div>
                                    <div class="pull-right"> <a class="tip" href="#" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                                </li>
                                <li class="clearfix">
                                    <div class="txt"> MAke your desk clean <span class="by label">Admin</span> <span class="date badge badge-success">Tomorrow</span> </div>
                                    <div class="pull-right"> <a class="tip" href="#" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                                </li>
                                <li class="clearfix">
                                    <div class="txt"> Today we celebrate the great looking theme <span class="by label">Admin</span> <span class="date badge badge-info">08.03.2013</span> </div>
                                    <div class="pull-right"> <a class="tip" href="#" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                                </li>
                                <li class="clearfix">
                                    <div class="txt"> Manage all the orders <span class="by label">Mark</span> <span class="date badge badge-info">12.03.2013</span> </div>
                                    <div class="pull-right"> <a class="tip" href="#" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title bg_lo" data-toggle="collapse" href="#collapseG3"> <span class="icon"> <i class="icon-chevron-down"></i> </span>
                        <h5>News updates</h5>
                    </div>
                    <div class="widget-content nopadding updates collapse in" id="collapseG3">
                        <div class="new-update clearfix"><i class="icon-ok-sign"></i>
                            <div class="update-done"><a title="" href="#"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong></a> <span>dolor sit amet, consectetur adipiscing eli</span> </div>
                            <div class="update-date"><span class="update-day">20</span>jan</div>
                        </div>
                        <div class="new-update clearfix"> <i class="icon-gift"></i> <span class="update-notice"> <a title="" href="#"><strong>Congratulation Maruti, Happy Birthday </strong></a> <span>many many happy returns of the day</span> </span> <span class="update-date"><span class="update-day">11</span>jan</span>
                        </div>
                        <div class="new-update clearfix"> <i class="icon-move"></i> <span class="update-alert"> <a title="" href="#"><strong>Maruti is a Responsive Admin theme</strong></a> <span>But already everything was solved. It will ...</span> </span> <span class="update-date"><span class="update-day">07</span>Jan</span>
                        </div>
                        <div class="new-update clearfix"> <i class="icon-leaf"></i> <span class="update-done"> <a title="" href="#"><strong>Envato approved Maruti Admin template</strong></a> <span>i am very happy to approved by TF</span> </span> <span class="update-date"><span class="update-day">05</span>jan</span>
                        </div>
                        <div class="new-update clearfix"> <i class="icon-question-sign"></i> <span class="update-notice"> <a title="" href="#"><strong>I am alwayse here if you have any question</strong></a> <span>we glad that you choose our template</span> </span> <span class="update-date"><span class="update-day">01</span>jan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
