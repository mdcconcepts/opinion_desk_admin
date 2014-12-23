$('input[name="dashboard_radio_index"]').on("change", function () {
    console.log($('input[name="dashboard_radio_index"]:checked').val());
    switch ($('input[name="dashboard_radio_index"]:checked').val())
    {
        case 'today':
            $('.weekly').fadeOut();
            $('.montly').fadeOut();
            $('.yearly').fadeOut();
            setTimeout(function () {
                        $('.today').fadeIn();
            }, 400);


            break;
        case 'weekly':
            $('.today').fadeOut();
            $('.montly').fadeOut();
            $('.yearly').fadeOut();
            setTimeout(function () {
                        $('.weekly').fadeIn();
            }, 400);




            break;
        case 'montly':
            $('.today').fadeOut();
            $('.weekly').fadeOut();
            $('.yearly').fadeOut();
            setTimeout(function () {
                        $('.montly').fadeIn();
            }, 400);

            break;
        case 'yearly':
            $('.today').fadeOut();
            $('.weekly').fadeOut();
            $('.montly').fadeOut();
            setTimeout(function () {
                        $('.yearly').fadeIn();
            }, 400);

            break;
    }

});


$('input[name="dashboard_radio_feedback_index"]').on("change", function () {

    var postTo = '/account/index.php/api/WebAppServices/getFeedbackDataForDashboardForGraph';
    var data = "";
//    console.log($('input[name="dashboard_radio_index"]:checked').val());
    switch ($('input[name="dashboard_radio_feedback_index"]:checked').val())
    {
        case 'weekly':
            data = {
                customer_id: 50,
                period: 1
            };
            break;
        case 'montly':
            data = {
                customer_id: 50,
                period: 2
            };
            break;
        case 'yearly':
            data = {
                customer_id: 50,
                period: 3
            };

            break;
    }
    jQuery.post(postTo, data,
            function (data) {

                if (data.Success == "True") {

                    var chart = AmCharts.makeChart("dashboard_graph", {
                        "type": "serial",
                        "theme": "light",
                        "dataProvider": data.dataProvider,
                        "valueAxes": [{
                                "gridColor": "#FFFFFF",
                                "gridAlpha": 0.2,
                                "dashLength": 0
                            }],
                        "gridAboveGraphs": true,
                        "startDuration": 1,
                        "graphs": [{
                                "balloonText": "[[category]]: <b>[[value]]</b>",
                                "fillAlphas": 0.8,
                                "lineAlpha": 0.2,
                                "type": "column",
                                "valueField": "visits"
                            }],
                        "chartCursor": {
                            "categoryBalloonEnabled": false,
                            "cursorAlpha": 0,
                            "zoomable": false
                        },
                        "categoryField": "country",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "gridAlpha": 0,
                            "tickPosition": "start",
                            "tickLength": 20
                        },
                        "exportConfig": {
                            "menuTop": 0,
                            "menuItems": [{
                                    "icon": '/lib/3/images/export.png',
                                    "format": 'png'
                                }]
                        }
                    });

                } else if (data.Success == "False") {


//                console.log("Invalied Username");
                }


            }, 'json');

});

var postTo = '/account/index.php/api/WebAppServices/getFeedbackDataForDashboardForGraph';
var data = {
    customer_id: 50,
    period: 1
};
jQuery.post(postTo, data,
        function (data) {

            if (data.Success == "True") {

                var chart = AmCharts.makeChart("dashboard_graph", {
                    "type": "serial",
                    "theme": "light",
                    "dataProvider": data.dataProvider,
                    "valueAxes": [{
                            "gridColor": "#FFFFFF",
                            "gridAlpha": 0.2,
                            "dashLength": 0
                        }],
                    "gridAboveGraphs": true,
                    "startDuration": 1,
                    "graphs": [{
                            "balloonText": "[[category]]: <b>[[value]]</b>",
                            "fillAlphas": 0.8,
                            "lineAlpha": 0.2,
                            "type": "column",
                            "valueField": "visits"
                        }],
                    "chartCursor": {
                        "categoryBalloonEnabled": false,
                        "cursorAlpha": 0,
                        "zoomable": false
                    },
                    "categoryField": "country",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "gridAlpha": 0,
                        "tickPosition": "start",
                        "tickLength": 20
                    },
                    "exportConfig": {
                        "menuTop": 0,
                        "menuItems": [{
                                "icon": '/lib/3/images/export.png',
                                "format": 'png'
                            }]
                    }
                });

            } else if (data.Success == "False") {


//                console.log("Invalied Username");
            }


        }, 'json');