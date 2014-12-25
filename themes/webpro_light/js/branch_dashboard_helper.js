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

    var postTo = '/account/index.php/api/WebAppServices/getFeedbackDataForDashboardForGraphBranch';
    var data = "";
//    console.log($('input[name="dashboard_radio_index"]:checked').val());
    switch ($('input[name="dashboard_radio_feedback_index"]:checked').val())
    {
        case 'weekly':
            data = {
                branch_id: $('#branch_id').val(),
                period: 1
            };
            break;
        case 'montly':
            data = {
                branch_id: $('#branch_id').val(),
                period: 2
            };
            break;
        case 'yearly':
            data = {
                branch_id: $('#branch_id').val(),
                period: 3
            };

            break;
    }
    jQuery.post(postTo, data,
            function (data) {

                if (data.Success == "True") {

                    var chart = AmCharts.makeChart("dashboard_graph", {
                        type: "stock",
                        "theme": "none",
                        pathToImages: "http://www.amcharts.com/lib/3/images/",
                        categoryAxesSettings: {
                            minPeriod: "mm"
                        },
                        dataSets: [{
                                color: "#b0de09",
                                fieldMappings: [{
                                        fromField: "value",
                                        toField: "value"
                                    }, {
                                        fromField: "volume",
                                        toField: "volume"
                                    }],
                                dataProvider: data.dataProvider,
                                categoryField: "date"
                            }],
                        panels: [{
                                showCategoryAxis: false,
                                title: "Value",
                                percentHeight: 70,
                                stockGraphs: [{
                                        id: "g1",
                                        valueField: "value",
                                        type: "smoothedLine",
                                        lineThickness: 2,
                                        bullet: "round"
                                    }],
                                stockLegend: {
                                    valueTextRegular: " ",
                                    markerType: "none"
                                }
                            },
                            {
                                title: "Volume",
                                percentHeight: 30,
                                stockGraphs: [{
                                        valueField: "volume",
                                        type: "column",
                                        cornerRadiusTop: 2,
                                        fillAlphas: 1
                                    }],
                                stockLegend: {
                                    valueTextRegular: " ",
                                    markerType: "none"
                                }
                            }
                        ],
                        chartCursorSettings: {
                            valueBalloonsEnabled: true
                        },
                        panelsSettings: {
                            usePrefixes: true
                        }
                    });

                } else if (data.Success == "False") {


//                console.log("Invalied Username");
                }


            }, 'json');

});

var postTo = '/account/index.php/api/WebAppServices/getFeedbackDataForDashboardForGraphBranch';
var data = {
    branch_id: $('#branch_id').val(),
    period: 1
};
jQuery.post(postTo, data,
        function (data) {
 
            if (data.Success == "True") {

                var chart = AmCharts.makeChart("dashboard_graph", {
                    type: "stock",
                    "theme": "none",
                    pathToImages: "http://www.amcharts.com/lib/3/images/",
                    categoryAxesSettings: {
                        minPeriod: "mm"
                    },
                    dataSets: [{
                            color: "#b0de09",
                            fieldMappings: [{
                                    fromField: "value",
                                    toField: "value"
                                }, {
                                    fromField: "volume",
                                    toField: "volume"
                                }],
                            dataProvider: data.dataProvider,
                            categoryField: "date"
                        }],
                    panels: [{
                            showCategoryAxis: false,
                            title: "Value",
                            percentHeight: 70,
                            stockGraphs: [{
                                    id: "g1",
                                    valueField: "value",
                                    type: "smoothedLine",
                                    lineThickness: 2,
                                    bullet: "round"
                                }],
                            stockLegend: {
                                valueTextRegular: " ",
                                markerType: "none"
                            }
                        },
                        {
                            title: "Volume",
                            percentHeight: 30,
                            stockGraphs: [{
                                    valueField: "volume",
                                    type: "column",
                                    cornerRadiusTop: 2,
                                    fillAlphas: 1
                                }],
                            stockLegend: {
                                valueTextRegular: " ",
                                markerType: "none"
                            }
                        }
                    ],
                    chartCursorSettings: {
                        valueBalloonsEnabled: true
                    },
                    panelsSettings: {
                        usePrefixes: true
                    }
                });

            } else if (data.Success == "False") {


//                console.log("Invalied Username");
            }


        }, 'json');


$('input[name="dashboard_radio_category_index"]').on("change", function () {

    var postTo = '/account/index.php/api/WebAppServices/getCategoryDataForDashboardForGraphBranch';
    var data = "";
//    console.log($('input[name="dashboard_radio_index"]:checked').val());
    switch ($('input[name="dashboard_radio_category_index"]:checked').val())
    {
        case 'today':
            data = {
                branch_id: $('#branch_id').val(),
                period: 1
            };
            break;
        case 'weekly':
            data = {
                branch_id: $('#branch_id').val(),
                period: 2
            };
            break;
        case 'montly':
            data = {
                branch_id: $('#branch_id').val(),
                period: 3
            };
            break;
        case 'yearly':
            data = {
                branch_id: $('#branch_id').val(),
                period: 4
            };


            break;
    }
    jQuery.post(postTo, data,
            function (data) {

                if (data.Success == "True") {

                    var chart = AmCharts.makeChart("dashboard_graph_category", {
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

var postTo = '/account/index.php/api/WebAppServices/getCategoryDataForDashboardForGraphBranch';
var data = {
    branch_id: $('#branch_id').val(),
    period: 1
};
jQuery.post(postTo, data,
        function (data) {

            if (data.Success == "True") {

                var chart = AmCharts.makeChart("dashboard_graph_category", {
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

//var chartData = generateChartData();
//console.log(chartData);




//// generate some random data, quite different range
//function generateChartData() {
//    var chartData = [];
//    var firstDate = new Date();
//    firstDate.setDate(firstDate.getDate() - 100);
//
//    for (var i = 0; i < 100; i++) {
//        // we create date objects here. In your data, you can have date strings
//        // and then set format of your dates using chart.dataDateFormat property,
//        // however when possible, use date objects, as this will speed up chart rendering.
//        var newDate = new Date(firstDate);
//        newDate.setDate(newDate.getDate() + i);
//
//        var visits = Math.round(Math.random() * 40) + 100;
//        var hits = Math.round(Math.random() * 80) + 500;
//        var views = Math.round(Math.random() * 6000);
//
//        chartData.push({
//            date: newDate,
//            visits: visits,
//            hits: hits,
////            views: views
//        });
//    }
//    return chartData;
//}




$('input[name="dashboard_radio_Female_Male_index"]').on("change", function () {

    var postTo = '/account/index.php/api/WebAppServices/getFeedbackDataForDashboardForGraphBranch_For_MALE_AND_FEMALE';
    var data = "";
//    console.log($('input[name="dashboard_radio_index"]:checked').val());
    switch ($('input[name="dashboard_radio_Female_Male_index"]:checked').val())
    {
        case 'weekly':
            data = {
                branch_id: $('#branch_id').val(),
                period: 1
            };
            break;
        case 'montly':
            data = {
                branch_id: $('#branch_id').val(),
                period: 2
            };
            break;
        case 'yearly':
            data = {
                branch_id: $('#branch_id').val(),
                period: 3
            };

            break;
    }
    jQuery.post(postTo, data,
            function (data) {

                if (data.Success == "True") {

                    var chart = AmCharts.makeChart("New_Male_Female_repete_chartdiv", {
                        "type": "serial",
                        "theme": "light",
                        "pathToImages": "http://www.amcharts.com/lib/3/images/",
                        "legend": {
                            "useGraphSettings": true
                        },
                        "dataProvider": data.dataProvider,
                        "valueAxes": [{
                                "id": "v1",
                                "axisColor": "#FF6600",
                                "axisThickness": 2,
                                "gridAlpha": 0,
                                "axisAlpha": 1,
                                "position": "left"
                            }, {
                                "id": "v2",
                                "axisColor": "#FCD202",
                                "axisThickness": 2,
                                "gridAlpha": 0,
                                "axisAlpha": 1,
                                "position": "right"
                            }],
                        "graphs": [{
                                "valueAxis": "v1",
                                "lineColor": "#FF6600",
                                "bullet": "round",
                                "bulletBorderThickness": 1,
                                "hideBulletsCount": 30,
                                "title": "Male",
                                "valueField": "visits",
                                "fillAlphas": 0
                            }, {
                                "valueAxis": "v2",
                                "lineColor": "#FCD202",
                                "bullet": "square",
                                "bulletBorderThickness": 1,
                                "hideBulletsCount": 30,
                                "title": "Female",
                                "valueField": "hits",
                                "fillAlphas": 0
                            }],
                        "chartScrollbar": {},
                        "chartCursor": {
                            "cursorPosition": "mouse"
                        },
                        "categoryField": "date",
                        "categoryAxis": {
                            "parseDates": true,
                            "axisColor": "#DADADA",
                            "minorGridEnabled": true
                        }
                    });

//                    chart.addListener("dataUpdated", zoomChart);
//                    chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length - 1);

                } else if (data.Success == "False") {


//                console.log("Invalied Username");
                }


            }, 'json');

});

var postTo = '/account/index.php/api/WebAppServices/getFeedbackDataForDashboardForGraphBranch_For_MALE_AND_FEMALE';
var data = {
    branch_id: $('#branch_id').val(),
    period: 1
};
jQuery.post(postTo, data,
        function (data) {

            if (data.Success == "True") {
                var chart = AmCharts.makeChart("New_Male_Female_repete_chartdiv", {
                    "type": "serial",
                    "theme": "light",
                    "pathToImages": "http://www.amcharts.com/lib/3/images/",
                    "legend": {
                        "useGraphSettings": true
                    },
                    "dataProvider": data.dataProvider,
                    "valueAxes": [{
                            "id": "v1",
                            "axisColor": "#FF6600",
                            "axisThickness": 2,
                            "gridAlpha": 0,
                            "axisAlpha": 1,
                            "position": "left"
                        }, {
                            "id": "v2",
                            "axisColor": "#FCD202",
                            "axisThickness": 2,
                            "gridAlpha": 0,
                            "axisAlpha": 1,
                            "position": "right"
                        }],
                    "graphs": [{
                            "valueAxis": "v1",
                            "lineColor": "#FF6600",
                            "bullet": "round",
                            "bulletBorderThickness": 1,
                            "hideBulletsCount": 30,
                            "title": "Male",
                            "valueField": "visits",
                            "fillAlphas": 0
                        }, {
                            "valueAxis": "v2",
                            "lineColor": "#FCD202",
                            "bullet": "square",
                            "bulletBorderThickness": 1,
                            "hideBulletsCount": 30,
                            "title": "Female",
                            "valueField": "hits",
                            "fillAlphas": 0
                        }],
                    "chartScrollbar": {},
                    "chartCursor": {
                        "cursorPosition": "mouse"
                    },
                    "categoryField": "date",
                    "categoryAxis": {
                        "parseDates": true,
                        "axisColor": "#DADADA",
                        "minorGridEnabled": true
                    }
                });

//                chart.addListener("dataUpdated", zoomChart);
//                chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length - 1);

            } else if (data.Success == "False") {


//                console.log("Invalied Username");
            }


        }, 'json');