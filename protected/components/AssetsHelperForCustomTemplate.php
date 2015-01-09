<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This function is used for settiong relevent css according to functionality.
 *
 * @author mdcconcepts
 */
class AssetsHelperForCustomTemplate {

    public static function getCSSForController() {
        if (Yii::app()->controller->id == 'branchMaster_parent') {
            ?>
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/DT_bootstrap.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/advanced-datatable/css/demo_page.css" rel="stylesheet">
            <?php
        } elseif (Yii::app()->controller->id == 'questionMaster_Child') {
            ?>
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/DT_bootstrap.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/advanced-datatable/css/demo_page.css" rel="stylesheet">
            <?php
        } elseif (Yii::app()->controller->id == 'tabletMaster_child') {
            ?>
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/DT_bootstrap.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/advanced-datatable/css/demo_page.css" rel="stylesheet">
            <?php
        } elseif (Yii::app()->controller->id == 'testimonials') {
            ?>
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/vedio_js/video-js.css" rel="stylesheet" type="text/css" />
            <?php
        } elseif (Yii::app()->controller->id == 'admin') {
            ?>
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/DT_bootstrap.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-editable/bootstrap-editable.css" rel="stylesheet">
            <?php
        }
    }

    public static function getJSForController() {
        if (Yii::app()->controller->id == 'branchMaster_parent') {
            ?>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
            <!-- Include all compiled plugins (below), or include individual files as needed --> 


            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/amcharts/amcharts.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/amcharts/serial.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/amcharts/themes/light.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/amcharts/amstock.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/branch_dashboard_helper.js"></script> 

            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/jquery.dataTables.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/DT_bootstrap.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/dynamic_table_init.js"></script>

            <?php
            /**
              <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.8.3.min.js"></script>
              <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/edit-table/edit-table.js"></script>

             * 
             */
            ?>
            <script>
                jQuery(document).ready(function () {
                    EditableTable.init();
                    $('.Branch_master').dataTable({
                        "aaSorting": [[4, "desc"]]
                    });
                });</script>

            <?php
        } elseif (Yii::app()->controller->id == 'questionMaster_Child') {
            ?>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
            <!-- Include all compiled plugins (below), or include individual files as needed --> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.8.3.min.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/jquery.dataTables.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/DT_bootstrap.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/dynamic_table_init.js"></script>
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/edit-table/edit-table.js"></script>

            <script>
                jQuery(document).ready(function () {
                    EditableTable.init();
                    $('.question_master').dataTable({
                        "aaSorting": [[4, "desc"]]
                    });
                });</script>
            <?php
        } elseif (Yii::app()->controller->id == 'tabletMaster_child') {
            ?>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
            <!-- Include all compiled plugins (below), or include individual files as needed --> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.8.3.min.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/jquery.dataTables.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/DT_bootstrap.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/dynamic_table_init.js"></script>
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/edit-table/edit-table.js"></script>

            <script>
                jQuery(document).ready(function () {
                    EditableTable.init();
                    $('.tablet_master').dataTable({
                        "aaSorting": [[4, "desc"]]
                    });
                });</script>
            <?php
        } elseif (Yii::app()->controller->id == 'testimonials') {
            ?>
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/vedio_js/video.js"></script>
            <script>
                videojs.options.flash.swf = "video-js.swf";
            </script>
            <?php
        } elseif (Yii::app()->controller->id == 'admin') {
            ?>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-2.0.2.min.js"></script> 
            <!-- Include all compiled plugins (below), or include individual files as needed --> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/jquery.dataTables.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/DT_bootstrap.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/data-tables/dynamic_table_init.js"></script>
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/accordion.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/common-script.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.nicescroll.js"></script>
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui.min.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-editable/bootstrap-editable.min.js"></script>

            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/x-editable/form-x-editable.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/x-editable/form-x-editable-demo.js"></script>
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/mockjax/jquery.mockjax.min.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/moment.min.js"></script>
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/select2.min.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/address.min.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/typeahead/typeahead.min.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/typeahead/typeaheadjs.min.js"></script> 

            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-editable/bootstrap-editable.min.js"></script>
            <script>
                //editables 
                $('.tablet_no').editable({
                    url: '/account/index.php/api/WebAppServices/postTableNumberForBranch',
                    type: 'text',
                    name: 'tablet_no',
                    title: 'Enter Tablet Number',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'This field is required';
                    },
                    success: function (response, newValue) {
                        console.log(response);
                        if (response.Success == "True") {

                        } else if (response.Success == "False") {
                            return response.Message;
                        } else
                        {
                            return response.Message; //msg will be shown in editable form
                        }

                    },
                    fail: function (response, newValue) {
                        console.log(response);
                    }
                });
                $('.status').editable({
                    url: '/account/index.php/api/WebAppServices/postStatusForUser',
                    source: [
                        {value: 0, text: 'Not Active'},
                        {value: 1, text: 'Active'},
                        {value: -1, text: 'Banned'}
                    ],
                    success: function (response, newValue) {
                        console.log(response);
                        if (response.Success == "True") {

                        } else if (response.Success == "False") {
                            return response.Message;
                        } else
                        {
                            return response.Message; //msg will be shown in editable form
                        }

                    },
                    fail: function (response, newValue) {
                        console.log(response);
                    }
                });
                $('.User_Table').dataTable({
                    "aaSorting": [[4, "desc"]]
                });</script>
            <?php
        } else {
            ?>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
            <!-- Include all compiled plugins (below), or include individual files as needed --> 

            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/amcharts/amcharts.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/amcharts/serial.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/amcharts/themes/light.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/amcharts/amstock.js"></script> 
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/dashboard_helper.js"></script> 
            <?php
        }
    }

}
