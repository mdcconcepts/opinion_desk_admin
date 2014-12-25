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

                console.log(data.dataProvider);
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

var postTo = '/account/index.php/api/WebAppServices/getFeedbackDataForDashboardForGraph';
var data = {
    customer_id: 50,
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

var chartData = generateChartData();

console.log(chartData)


// generate some random data, quite different range
//function generateChartData() {
//    var chartData = [];
//    var firstDate = new Date();
//    firstDate.setDate(firstDate.getDate() - 100);
//
//    $Date = ['Jan', 'Feb', 'Apr', 'Mar', 'Jun', 'Jul', 'Aug', 'Sup', 'Oct', 'Nov', 'Dec'];
//    $Date = ['2014-1-1', '2014-2-1', '2014-3-1', '2014-4-1', '2014-5-1', '2014-6-1', '2014-7-1', '2014-8-1', '2014-9-1', '2014-10-1', '2014-11-1', '2014-12-1'];
//    for (var i = 0; i < 11; i++) {
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
//            country: $Date[i],
//            value: visits,
//            volume: hits,
////            views: views
//        });
//    }
//    return chartData;
//}

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
//        var a = Math.round(Math.random() * (40 + i)) + 100 + i;
//        var b = Math.round(Math.random() * 100000000);
//
//        chartData.push({
//            date: newDate,
//            value: a,
//            volume: b
//        });
//    }
//    return chartData;
//}

//var chart = AmCharts.makeChart("dashboard_graph", {
//    type: "stock",
//    "theme": "none",
//    pathToImages: "http://www.amcharts.com/lib/3/images/",
////    categoryAxesSettings: {
////        minPeriod: "mm"
////    },
//    dataSets: [{
//            color: "#b0de09",
//            fieldMappings: [{
//                    fromField: "value",
//                    toField: "value"
//                }, {
//                    fromField: "volume",
//                    toField: "volume"
//                }],
//            dataProvider: chartData,
//            categoryField: "country"
//        }],
//    panels: [{
//            showCategoryAxis: false,
//            title: "Value",
//            percentHeight: 70,
//            stockGraphs: [{
//                    id: "g1",
//                    valueField: "value",
//                    type: "smoothedLine",
//                    lineThickness: 2,
//                    bullet: "round"
//                }],
//            stockLegend: {
//                valueTextRegular: " ",
//                markerType: "none"
//            }
//        },
//        {
//            title: "Volume",
//            percentHeight: 30,
//            stockGraphs: [{
//                    valueField: "volume",
//                    type: "column",
//                    cornerRadiusTop: 2,
//                    fillAlphas: 1
//                }],
//            stockLegend: {
//                valueTextRegular: " ",
//                markerType: "none"
//            }
//        }
//    ],
////    chartScrollbarSettings: {
////        graph: "g1",
////        usePeriod: "10mm",
////        position: "top"
////    },
//    chartCursorSettings: {
//        valueBalloonsEnabled: true
//    },
////    periodSelector: {
////        position: "top",
////        dateFormat: "YYYY-MM-DD",
////        inputFieldWidth: 150,
////        periods: [{
////                period: "hh",
////                count: 1,
////                label: "1 hour",
////                selected: true
////
////            }, {
////                period: "hh",
////                count: 2,
////                label: "2 hours"
////            }, {
////                period: "hh",
////                count: 5,
////                label: "5 hour"
////            }, {
////                period: "hh",
////                count: 12,
////                label: "12 hours"
////            }, {
////                period: "MAX",
////                label: "MAX"
////            }]
////    },
//    panelsSettings: {
//        usePrefixes: true
//    }
//});