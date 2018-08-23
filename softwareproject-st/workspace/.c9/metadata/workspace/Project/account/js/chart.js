{"filter":false,"title":"chart.js","tooltip":"/Project/account/js/chart.js","undoManager":{"mark":3,"position":3,"stack":[[{"start":{"row":0,"column":0},"end":{"row":149,"column":0},"action":"insert","lines":["/*","The purpose of this demo is to demonstrate how multiple charts on the same page","can be linked through DOM and Highcharts events and API methods. It takes a","standard Highcharts config with a small variation for each data set, and a","mouse/touch event handler to bind the charts together.","*/","","","","/**"," * In order to synchronize tooltips and crosshairs, override the"," * built-in events with handlers defined on the parent element."," */","$('#container').bind('mousemove touchmove touchstart', function (e) {","    var chart,","        point,","        i,","        event;","","    for (i = 0; i < Highcharts.charts.length; i = i + 1) {","        chart = Highcharts.charts[i];","        // Find coordinates within the chart","        event = chart.pointer.normalize(e.originalEvent);","        // Get the hovered point","        point = chart.series[0].searchPoint(event, true);","","        if (point) {","            point.highlight(e);","        }","    }","});","/**"," * Override the reset function, we don't need to hide the tooltips and"," * crosshairs."," */","Highcharts.Pointer.prototype.reset = function () {","    return undefined;","};","","/**"," * Highlight a point by showing tooltip, setting hover state and draw crosshair"," */","Highcharts.Point.prototype.highlight = function (event) {","    event = this.series.chart.pointer.normalize(event);","    this.onMouseOver(); // Show the hover marker","    this.series.chart.tooltip.refresh(this); // Show the tooltip","    this.series.chart.xAxis[0].drawCrosshair(event, this); // Show the crosshair","};","","/**"," * Synchronize zooming through the setExtremes event handler."," */","function syncExtremes(e) {","    var thisChart = this.chart;","","    if (e.trigger !== 'syncExtremes') { // Prevent feedback loop","        Highcharts.each(Highcharts.charts, function (chart) {","            if (chart !== thisChart) {","                if (chart.xAxis[0].setExtremes) { // It is null while updating","                    chart.xAxis[0].setExtremes(","                        e.min,","                        e.max,","                        undefined,","                        false,","                        { trigger: 'syncExtremes' }","                    );","                }","            }","        });","    }","}","","// Get the data. The contents of the data file can be viewed at","$.getJSON(","    'https://cdn.rawgit.com/highcharts/highcharts/057b672172ccc6c08fe7dbb27fc17ebca3f5b770/samples/data/activity.json',","    function (activity) {","        $.each(activity.datasets, function (i, dataset) {","","            // Add X values","            dataset.data = Highcharts.map(dataset.data, function (val, j) {","                return [activity.xData[j], val];","            });","","            $('<div class=\"chart\">')","                .appendTo('#container')","                .highcharts({","                    chart: {","                        marginLeft: 40, // Keep all charts left aligned","                        spacingTop: 20,","                        spacingBottom: 20","                    },","                    title: {","                        text: dataset.name,","                        align: 'left',","                        margin: 0,","                        x: 30","                    },","                    credits: {","                        enabled: false","                    },","                    legend: {","                        enabled: false","                    },","                    xAxis: {","                        crosshair: true,","                        events: {","                            setExtremes: syncExtremes","                        },","                        labels: {","                            format: '{value} km'","                        }","                    },","                    yAxis: {","                        title: {","                            text: null","                        }","                    },","                    tooltip: {","                        positioner: function () {","                            return {","                                // right aligned","                                x: this.chart.chartWidth - this.label.width,","                                y: 10 // align to title","                            };","                        },","                        borderWidth: 0,","                        backgroundColor: 'none',","                        pointFormat: '{point.y}',","                        headerFormat: '',","                        shadow: false,","                        style: {","                            fontSize: '18px'","                        },","                        valueDecimals: dataset.valueDecimals","                    },","                    series: [{","                        data: dataset.data,","                        name: dataset.name,","                        type: dataset.type,","                        color: Highcharts.getOptions().colors[i],","                        fillOpacity: 0.3,","                        tooltip: {","                            valueSuffix: ' ' + dataset.unit","                        }","                    }]","                });","        });","    }",");",""],"id":1}],[{"start":{"row":12,"column":3},"end":{"row":13,"column":0},"action":"insert","lines":["",""],"id":2},{"start":{"row":13,"column":0},"end":{"row":13,"column":1},"action":"insert","lines":[" "]}],[{"start":{"row":13,"column":1},"end":{"row":14,"column":0},"action":"insert","lines":["",""],"id":3},{"start":{"row":14,"column":0},"end":{"row":14,"column":1},"action":"insert","lines":[" "]}],[{"start":{"row":0,"column":0},"end":{"row":151,"column":0},"action":"remove","lines":["/*","The purpose of this demo is to demonstrate how multiple charts on the same page","can be linked through DOM and Highcharts events and API methods. It takes a","standard Highcharts config with a small variation for each data set, and a","mouse/touch event handler to bind the charts together.","*/","","","","/**"," * In order to synchronize tooltips and crosshairs, override the"," * built-in events with handlers defined on the parent element."," */"," "," ","$('#container').bind('mousemove touchmove touchstart', function (e) {","    var chart,","        point,","        i,","        event;","","    for (i = 0; i < Highcharts.charts.length; i = i + 1) {","        chart = Highcharts.charts[i];","        // Find coordinates within the chart","        event = chart.pointer.normalize(e.originalEvent);","        // Get the hovered point","        point = chart.series[0].searchPoint(event, true);","","        if (point) {","            point.highlight(e);","        }","    }","});","/**"," * Override the reset function, we don't need to hide the tooltips and"," * crosshairs."," */","Highcharts.Pointer.prototype.reset = function () {","    return undefined;","};","","/**"," * Highlight a point by showing tooltip, setting hover state and draw crosshair"," */","Highcharts.Point.prototype.highlight = function (event) {","    event = this.series.chart.pointer.normalize(event);","    this.onMouseOver(); // Show the hover marker","    this.series.chart.tooltip.refresh(this); // Show the tooltip","    this.series.chart.xAxis[0].drawCrosshair(event, this); // Show the crosshair","};","","/**"," * Synchronize zooming through the setExtremes event handler."," */","function syncExtremes(e) {","    var thisChart = this.chart;","","    if (e.trigger !== 'syncExtremes') { // Prevent feedback loop","        Highcharts.each(Highcharts.charts, function (chart) {","            if (chart !== thisChart) {","                if (chart.xAxis[0].setExtremes) { // It is null while updating","                    chart.xAxis[0].setExtremes(","                        e.min,","                        e.max,","                        undefined,","                        false,","                        { trigger: 'syncExtremes' }","                    );","                }","            }","        });","    }","}","","// Get the data. The contents of the data file can be viewed at","$.getJSON(","    'https://cdn.rawgit.com/highcharts/highcharts/057b672172ccc6c08fe7dbb27fc17ebca3f5b770/samples/data/activity.json',","    function (activity) {","        $.each(activity.datasets, function (i, dataset) {","","            // Add X values","            dataset.data = Highcharts.map(dataset.data, function (val, j) {","                return [activity.xData[j], val];","            });","","            $('<div class=\"chart\">')","                .appendTo('#container')","                .highcharts({","                    chart: {","                        marginLeft: 40, // Keep all charts left aligned","                        spacingTop: 20,","                        spacingBottom: 20","                    },","                    title: {","                        text: dataset.name,","                        align: 'left',","                        margin: 0,","                        x: 30","                    },","                    credits: {","                        enabled: false","                    },","                    legend: {","                        enabled: false","                    },","                    xAxis: {","                        crosshair: true,","                        events: {","                            setExtremes: syncExtremes","                        },","                        labels: {","                            format: '{value} km'","                        }","                    },","                    yAxis: {","                        title: {","                            text: null","                        }","                    },","                    tooltip: {","                        positioner: function () {","                            return {","                                // right aligned","                                x: this.chart.chartWidth - this.label.width,","                                y: 10 // align to title","                            };","                        },","                        borderWidth: 0,","                        backgroundColor: 'none',","                        pointFormat: '{point.y}',","                        headerFormat: '',","                        shadow: false,","                        style: {","                            fontSize: '18px'","                        },","                        valueDecimals: dataset.valueDecimals","                    },","                    series: [{","                        data: dataset.data,","                        name: dataset.name,","                        type: dataset.type,","                        color: Highcharts.getOptions().colors[i],","                        fillOpacity: 0.3,","                        tooltip: {","                            valueSuffix: ' ' + dataset.unit","                        }","                    }]","                });","        });","    }",");",""],"id":4}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":0,"column":0},"end":{"row":0,"column":0},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1534546649095,"hash":"da39a3ee5e6b4b0d3255bfef95601890afd80709"}