<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Bootstrap -->
        <link href="themes/webpro_light/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        <link href="themes/webpro_light/css/font-awesome.min.css" rel="stylesheet">
        <link href="themes/webpro_light/css/style.css" rel="stylesheet">
        <link href="themes/webpro_light/css/style-responsive.css" rel="stylesheet">
        <link href="themes/webpro_light/plugins/bootstrap-editable/bootstrap-editable.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body class="light-theme">
        <div class="page-container">
            <div id="main-content">
                <div class="page-content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="block-web">
                                <div class="header">
                                    <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                                    <h3 class="content-header">X-Editable</h3>
                                </div>
                                <div class="porlets-content">
                                    <div style="float: right; margin-bottom: 10px">
                                        <label style="display: inline-block; margin-right: 50px">
                                            <input type="checkbox" id="autoopen" style="vertical-align: baseline">
                                            <span class="custom-checkbox"></span>&nbsp;auto-open next field</label>
                                        <button id="enable" class="btn btn-primary">enable / disable</button>
                                    </div>
                                    <p>Click to edit</p>
                                    <table id="user" class="table table-bordered table-striped" style="clear: both">
                                        <tbody>
                                            <tr>
                                                <td width="35%">Simple text field</td>
                                                <td width="65%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">superuser</a></td>
                                            </tr>
                                            <tr>
                                                <td>Empty text field, required</td>
                                                <td><a href="#" id="firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your firstname"></a></td>
                                            </tr>
                                            <tr>
                                                <td>Select, local array, custom display</td>
                                                <td><a href="#" id="sex" data-type="select" data-pk="1" data-value="" data-title="Select sex"></a></td>
                                            </tr>
                                            <tr>
                                                <td>Select, remote array, no buttons</td>
                                                <td><a href="#" id="group" data-type="select" data-pk="1" data-value="5" data-source="/groups" data-title="Select group">Admin</a></td>
                                            </tr>
                                            <tr>
                                                <td>Select, error while loading</td>
                                                <td><a href="#" id="status" data-type="select" data-pk="1" data-value="0" data-source="/status" data-title="Select status">Active</a></td>
                                            </tr>
                                            <tr>
                                                <td>Datepicker</td>
                                                <td><span class="notready">not implemented for Bootstrap 3 yet</span></td>
                                            </tr>
                                            <tr>
                                                <td>Combodate (date)</td>
                                                <td><a href="#" id="dob" data-type="combodate" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1"  data-title="Select Date of birth"></a></td>
                                            </tr>
                                            <tr>
                                                <td>Combodate (datetime)</td>
                                                <td><a href="#" id="event" data-type="combodate" data-template="D MMM YYYY  HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM D, YYYY, HH:mm" data-pk="1"  data-title="Setup event date and time"></a></td>
                                            </tr>
                                            <tr>
                                                <td>Textarea, buttons below. Submit by <i>ctrl+enter</i></td>
                                                <td><a href="#" id="comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments">awesome
                                                        user!</a></td>
                                            </tr>
                                            <tr>
                                                <td>Twitter typeahead.js</td>
                                                <td><a href="#" id="state2" data-type="typeaheadjs" data-pk="1" data-placement="right" data-title="Start typing State.."></a></td>
                                            </tr>
                                            <tr>
                                                <td>Checklist</td>
                                                <td><a href="#" id="fruits" data-type="checklist" data-value="2,3" data-title="Select fruits"></a></td>
                                            </tr>
                                            <tr>
                                                <td>Select2 (tags mode)</td>
                                                <td><a href="#" id="tags" data-type="select2" data-pk="1" data-title="Enter tags">html, javascript</a></td>
                                            </tr>
                                            <tr>
                                                <td>Select2 (dropdown mode)</td>
                                                <td><a href="#" id="country" data-type="select2" data-pk="1" data-value="BS" data-title="Select country"></a></td>
                                            </tr>
                                            <tr>
                                                <td>Custom input, several fields</td>
                                                <td><a href="#" id="address" data-type="address" data-pk="1" data-title="Please, fill address"></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--/porlets-content--> 
                            </div><!--/block-web--> 
                        </div><!--/col-md-12--> 
                    </div><!--/row-->


                </div><!--/page-content end--> 
            </div><!--/main-content end--> 
        </div><!--/page-container end--> 

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
        <script src="themes/webpro_light/js/jquery-2.0.2.min.js"></script> 
        <!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script src="themes/webpro_light/bootstrap/js/bootstrap.min.js"></script> 
        <script src="themes/webpro_light/plugins/bootstrap-editable/bootstrap-editable.min.js"></script>
        <script src="themes/webpro_light/plugins/x-editable/form-x-editable.js"></script> 
        <script src="themes/webpro_light/plugins/x-editable/form-x-editable-demo.js"></script>
        <script src="themes/webpro_light/js/moment.min.js"></script>


    </body>
</html>
