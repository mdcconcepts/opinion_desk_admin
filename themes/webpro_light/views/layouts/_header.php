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
                        <div class = "btn-group"> <a data-toggle = "dropdown" href = "" class = "con"><span class = "fa fa-envelope"></span><span class = "label label-success">7</span></a>
                            <ul role = "menu" class = "dropdown-menu dropdown-messages">
                                <li class = "title"><span class = "fa fa-envelope"></span>&nbsp;
                                    &nbsp;
                                    You have 13 new messages to read...</li>
                                <li class = "message">
                                    <div class = "message-icon"><img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/avatar2.jpg"></div>
                                    <div class = "message-content"><a href = "#">John Doe</a> <br>
                                        Lorem ipsum dolor sit amet...</div>
                                    <div class = "message-time">32 sec ago</div>
                                </li>
                                <li class = "message">
                                    <div class = "message-icon"><img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/avatar2.jpg"></div>
                                    <div class = "message-content"><a href = "#">John Doe</a> <br>
                                        Quisque commodo sed ipsum...</div>
                                    <div class = "message-time">11 min ago</div>
                                </li>
                                <li class = "message">
                                    <div class = "message-icon"><img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/avatar2.jpg"></div>
                                    <div class = "message-content"><a href = "#">John Doe</a> <br>
                                        Consectetur adipiscing elit...</div>
                                    <div class = "message-time">3 hours ago</div>
                                </li>
                                <li class = "message" style = "position:relative;">
                                    <div class = "message-icon"><img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/avatar2.jpg"></div>
                                    <div class = "message-content"><a href = "#">John Doe</a><br>
                                        Quisque commodo sed ipsum...</div>
                                    <div class = "message-time">2 days ago</div>
                                </li>
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
//    setInterval(function () {
    var postTo = '/account/index.php/api/WebAppServices/getAllNotificationForUser';
    var data = {
        'customer_id': 50
    };
    jQuery.post(postTo, data,
            function (data) {
                clearNotification();
                if (data.Success == "True") {

                    for (i = 0; i < data.Notification_Count; i++)
                    {
                        if (data.Notification[i].notification_type_id == 4)
                        {
                            var $msg = '<li class = "alert" onclick="window.location.href = \'' + data.Notification[i].redirect_url + '\'">\
                                    <div class = "alert-icon alt-default"><span class = "fa fa-check-square"></span></div>\
                                    <div class = "alert-content">New Feedback Entered</div>\
                                    <div class = "alert-time">' + data.Notification[i].created_at + '</div>\
                                </li>'
                            addMsg($msg);
                        }

                    }

                } else if (data.success == "2") {


                } else {

                }


            }, 'json');

//    }, 5000);
</script>