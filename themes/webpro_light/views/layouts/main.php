<!DOCTYPE html>
<html lang="en">
    <?php require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_head.php'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-datepicker/css/datepicker.css" />
    <body class = "light-theme">
        <?php require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_header.php'); ?>
        <?php require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_right_sidebar.php'); ?>
        <div class = "page-container">
            <div class = "nav-collapse top-margin fixed box-shadow2 hidden-xs" id = "sidebar">
                <?php require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_left_navigation.php'); ?>
            </div><!--/sidebar-->


            <div id = "main-content">
                <div class = "page-content">
                    <?php echo $content; ?>
                </div> <!--/page-content end-->
            </div><!--/main-content end-->
        </div><!--/page-container end-->

        <!--jQuery (necessary for Bootstrap's JavaScript plugins) --> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-2.0.2.min.js"></script> 
        <!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/accordion.js"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/common-script.js"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.nicescroll.js"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.sparkline.js"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/sparkline-chart.js"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/graph.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/edit-graph.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/kalendar/kalendar.js" type="text/javascript"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/kalendar/edit-kalendar.js" type="text/javascript"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/knob/jquery.knob.min.js"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/demo-slider/demo-slider.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> 
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.tokenize.js"></script> 
        <script type="text/javascript"  src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/toggle-switch/toggles.min.js"></script> 
        <script type="text/javascript">
            $('.default-date-picker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('.colorpicker-default').colorpicker({
                format: 'hex'
            });
            var checkin = $('.dpd1').datepicker({
                format: 'yyyy-mm-dd',
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                }
                checkin.hide();
                $('.dpd2')[0].focus();
            }).data('datepicker');
            var checkout = $('.dpd2').datepicker({
                format: 'yyyy-mm-dd',
                onRender: function (date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                checkout.hide();
            }).data('datepicker');
            $('.data_export').tokenize();
            function delete_data(alert_msg, return_url) {
                // Code...
                if (confirm(alert_msg)) {
                    // Save it!
//                    console.log();
                    window.location.replace(return_url);
                } else {
                    // Do nothing!
                }
            }
        </script>
        <?php AssetsHelperForCustomTemplate::getJSForController() ?>
    </body>
</html>
