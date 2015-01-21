<div class = "header navbar navbar-inverse box-shadow navbar-fixed-top">
    <div class = "navbar-inner">
        <div class = "header-seperation">
            <ul class = "nav navbar-nav ">
                <li class = "sidebar-toggle-box"> <a href = "#"><i class = "fa fa-bars"></i></a> </li>
                <li> <a href = "<?php echo Yii::app()->request->baseUrl ?>" style="padding: 0px;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/opinion_desk_logo.gif"> </a> </li>
                <!--<li class = "hidden-xs"> <a href = "#"><i class = "fa fa-angle-double-left"></i> Go to the front page</a> </li>-->
                <li class = "hidden-xs">
                    <div class = "hov">
                        <div class = "btn-group nav-user"> <a data-toggle = "dropdown" href = "" class = "con"><span class = "fa fa-bell"></span><span class = "label label-danger count">0</span></a>
                            <ul role = "menu" class = "dropdown-menu dropdown-alerts notification_holder">


                            </ul>
                        </div>
                        <div class = "btn-group nav-message"> <a data-toggle = "dropdown" href = "" class = "con"><span class = "fa fa-envelope"></span><span class = "label label-success count">0</span></a>
                            <ul role = "menu" class = "dropdown-menu dropdown-alerts message_notification_holder">

                            </ul>
                        </div>
                    </div>
                </li>
                <!--<li class = "hidden-xs"> <form method = "post" action = "index.html" class = "searchform"><input type = "text" placeholder = "Search here..." name = "keyword" class = "form-control"></form> </li>-->
                <li id = "last-one" style="margin-right: -41px;"> <a href = "<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout">Logout <i class = "fa fa-angle-double-right"></i></a> </li>
                <!--<li><a id = "show-right-info-bar" href = "javascript:;" class = ""><i class = "fa fa-bars"></i></a></li>-->
            </ul><!--/nav navbar-nav-->
        </div><!--/header-seperation-->
    </div><!--/navbar-inner-->
</div><!--/header-->
<script type="text/javascript">
    function addMsg($msg) {
        var $el = $('.nav-user'), $n = $('.count:first', $el), $v = parseInt($n.text());
        console.log($v);
        $('.count', $el).fadeOut().fadeIn().text($v + 1);
        $($msg).hide().prependTo($el.find('.notification_holder')).slideDown();
    }

    function clearNotification() {
        var $el = $('.nav-user'), $n = $('.count:first', $el), $v = parseInt($n.text());
        $('.count', $el).fadeOut().fadeIn().text(0);
        $el.find('.notification_holder').html('<li class="alert" style="display: none;">\
                                </li>');
//        $($msg).hide().prependTo($el.find('.list-group')).slideDown().css('display', 'block');
    }

    function addMessageMsg($msg) {
        var $el = $('.nav-message'), $n = $('.count:first', $el), $v = parseInt($n.text());
        console.log($v);
        $('.count', $el).fadeOut().fadeIn().text($v + 1);
        $($msg).hide().prependTo($el.find('.message_notification_holder')).slideDown();
    }

    function clearMessageNotification() {
        var $el = $('.nav-message'), $n = $('.count:first', $el), $v = parseInt($n.text());
        $('.count', $el).fadeOut().fadeIn().text(0);
        $el.find('.message_notification_holder').html('<li class="alert" style="display: none;">\
                                </li>');
//        $($msg).hide().prependTo($el.find('.list-group')).slideDown().css('display', 'block');
    }

//    setInterval(function () {
    var postTo = '/account/index.php/api/WebAppServices/getAllNotificationForUser';
    var data = {
        'customer_id': <?php echo Yii::app()->user->id; ?>
    };
    jQuery.post(postTo, data,
            function (data) {
                clearNotification();
                if (data.Success == "True") {

                    for (i = 0; i < data.Notification_Count; i++)
                    {
                        var $msg = '<li class = "alert" onclick="window.location.href = \'' + data.Notification[i].redirect_url + '\'">\
                                    <div class = "alert-icon alt-default"><span class = "fa fa-sitemap"></span></div>\
                                    <div class = "alert-content">' + data.Notification[i].Total_Branch_Notification + ' Notification from ' + data.Notification[i].branch_name + ' </div>\
                                    <div class = "alert-time">' + data.Notification[i].created_at + '</div>\
                                </li>'
                        addMsg($msg);

                    }

                } else if (data.success == "2") {


                } else {

                }


            }, 'json');

//    }, 5000);



//    setInterval(function () {
    var postTo = '/account/index.php/api/WebAppServices/getAllMessageNotificationForUser';
    var data = {
        'customer_id': <?php echo Yii::app()->user->id; ?>
    };
    jQuery.post(postTo, data,
            function (data) {
                clearMessageNotification();
                if (data.Success == "True") {

                    for (i = 0; i < data.Notification_Count; i++)
                    {
//                        if (data.Notification[i].notification_type_id == 4)
//                        {
                        var $msg = '<li class = "alert" onclick="window.location.href = \'' + <?php Yii::app()->request->baseUrl . "/index.php/messageMaster/view/"; ?>data.Notification[i].id + '\'">\
                                    <div class = "alert-icon alt-default"><span class = "fa fa-check-square"></span></div>\
                                    <div class = "alert-content">' + data.Notification[i].subject + '</div>\
                                    <div class = "alert-time">' + data.Notification[i].created_at + '</div>\
                                </li>'
                        addMessageMsg($msg);
//                        }

                    }

                } else if (data.success == "2") {


                } else {

                }


            }, 'json');

//    }, 5000);
</script>