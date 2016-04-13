var meterID = 7813517;

// Load Charts and the corechart package.
google.charts.load('current', {'packages':['corechart', 'table']});

// Draw the combo chart for daily use when Charts is loaded.
google.charts.setOnLoadCallback(drawDayChart);

// Draw the combo chart for weekly use when Charts is loaded.
//google.charts.setOnLoadCallback(drawWeeklyChart);

// Draw the combo chart for monthly use when Charts is loaded.
//google.charts.setOnLoadCallback(drawMonthChart);

// Draw the combo chart for daily use when Charts is loaded.
google.charts.setOnLoadCallback(drawDayTotalChart);

// Draw the combo chart for weekly use when Charts is loaded.
google.charts.setOnLoadCallback(drawWeekTotalChart);

// Draw the combo chart for monthly use when Charts is loaded.
google.charts.setOnLoadCallback(drawMonthTotalChart);

google.charts.setOnLoadCallback(drawDayTable);

google.charts.setOnLoadCallback(drawWeekTable);

google.charts.setOnLoadCallback(drawMonthTable);


var jsonData = $.ajax({
	url: "getData.php",
	dataType: "json",
	async: false
	}).responseText;


// Callback that draws the combo chart for daily use when Charts is loaded.
function drawDayChart() {
	/*
	// Create the data table for Daily combo chart.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Date');
	data.addColumn('number', 'Daily Use');
	data.addColumn('number', 'Daily Average\nfor Febuary');
	data.addColumn('number', 'Daily Average\nfor Year');
	data.addRows([
		['2/1/2016',24,24,11.625],
		['2/2/2016',17,20.5,11.78787879],
		['2/3/2016',7,16,11.64705882],
		['2/4/2016',2,12.5,11.37142857],
		['2/5/2016',20,14,11.61111111],
		['2/6/2016',4,12.33333333,11.40540541],
		['2/7/2016',22,13.71428571,11.68421053],
		['2/8/2016',3,12.375,11.46153846],
		['2/9/2016',16,12.77777778,11.575],
		['2/10/2016',24,13.9,11.87804878],
		['2/11/2016',9,13.45454545,11.80952381],
		['2/12/2016',17,13.75,11.93023256],
		['2/13/2016',24,14.53846154,12.20454545],
		['2/14/2016',17,14.71428571,12.31111111],
		['2/15/2016',17,14.86666667,12.41304348],
		['2/16/2016',21,15.25,12.59574468],
		['2/17/2016',7,14.76470588,12.47916667],
		['2/18/2016',7,14.33333333,12.36734694],
		['2/19/2016',4,13.78947368,12.2],
		['2/20/2016',23,14.25,12.41176471],
		['2/21/2016',3,13.71428571,12.23076923],
		['2/22/2016',21,14.04545455,12.39622642],
		['2/23/2016',9,13.82608696,12.33333333],
		['2/24/2016',16,13.91666667,12.4],
		['2/25/2016',17,14.04,12.48214286],
		['2/26/2016',17,14.15384615,12.56140351],
		['2/27/2016',0,13.62962963,12.34482759],
		['2/28/2016',7,13.39285714,12.25423729],
		['2/29/2016',22,13.68965517,12.41666667]
	]);
*/

	$.get("../api/" + meterID + "/daychart", function(csvString) {
		// transform the CSV string into a 2-dimensional array
		var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

		// this new DataTable object holds all the data
		var data = new google.visualization.arrayToDataTable(arrayData);
		// CAPACITY - En-route ATFM delay - YY - CHART
		var crt_day = new google.visualization.ChartWrapper({
			chartType: 'ComboChart',
		//	containerId: 'crt_day',
			containerId: document.getElementById('barchartday'),
			dataTable: data,
			options:{
				title:'Febuary Water Use',
				width:700,
				height:400,
				vAxis: {title: 'Water Use'},
				hAxis: {slantedText:true, slantedTextAngle:70},
				seriesType:'line',
				series: {0: {type: 'bars'}},
				legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
				chartArea: {}
			}
		});
		crt_day.draw();
	});
/*
		var options = {title:'Febuary Water Use',
									width:700,
									height:400,
									vAxis: {title: 'Water Use'},
									hAxis: {slantedText:true, slantedTextAngle:70},
									seriesType:'line',
									series: {0: {type: 'bars'}},
									legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
									chartArea: {}
		};

		var chart = new google.visualization.ComboChart(document.getElementById('barchartday'));
		chart.draw(data, options);
	});
/*
	var jsonData = $.ajax({
		url: "getData.php",
		dataType: "json",
		async: false
		}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);
*/
/*
	// Set options for Daily combo chart.
	var options = {title:'Febuary Water Use',
								width:700,
								height:400,
								vAxis: {title: 'Water Use'},
								hAxis: {slantedText:true, slantedTextAngle:70},
								seriesType:'line',
								series: {0: {type: 'bars'}},
								legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
								chartArea: {}
	};

	// Instantiate and draw the chart for Sarah's pizza.
	var chart = new google.visualization.ComboChart(document.getElementById('barchartday'));
	chart.draw(data, options);
*/
}

// Callback that draws the combo chart for weekly use when Charts is loaded.
function drawWeeklyChart() {
/*
	// Create the data table for Weekly combo chart.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Date');
	data.addColumn('number', 'Weekly Total');
	data.addColumn('number', 'Weekly Average');
	data.addRows([
		['1/2/2016',26,26],
		['1/9/2016',66,46],
		['1/16/2016',80,57.33333333],
		['1/23/2016',95,66.75],
		['1/30/2016',68,67],
		['2/6/2016',87,70.33333333],
		['2/13/2016',115,76.71428571],
		['2/20/2016',96,79.125],
		['2/27/2016',83,79.55555556],
		['3/5/2016',88,80.4],
		['3/12/2016',105,82.63636364],
		['3/19/2016',65,81.16666667],
		['3/26/2016',101,82.69230769],
		['4/2/2016',51,80.42857143],
		['4/9/2016',91,81.13333333],
		['4/16/2016',111,83],
		['4/23/2016',98,83.88235294],
		['4/30/2016',91,84.27777778],
		['5/7/2016',125,86.42105263],
		['5/14/2016',83,86.25],
		['5/21/2016',54,84.71428571],
		['5/28/2016',75,84.27272727],
		['6/4/2016',69,83.60869565],
		['6/11/2016',97,84.16666667],
		['6/18/2016',106,85.04],
		['6/25/2016',84,85],
		['7/2/2016',70,84.44444444],
		['7/9/2016',106,85.21428571],
		['7/16/2016',55,84.17241379],
		['7/23/2016',97,84.6],
		['7/30/2016',76,84.32258065],
		['8/6/2016',60,83.5625],
		['8/13/2016',145,85.42424242],
		['8/20/2016',84,85.38235294],
		['8/27/2016',94,85.62857143],
		['9/3/2016',118,86.52777778],
		['9/10/2016',109,87.13513514],
		['9/17/2016',75,86.81578947],
		['9/24/2016',79,86.61538462],
		['10/1/2016',82,86.5],
		['10/8/2016',97,86.75609756],
		['10/15/2016',87,86.76190476],
		['10/22/2016',45,85.79069767],
		['10/29/2016',112,86.38636364],
		['11/5/2016',67,85.95555556],
		['11/12/2016',81,85.84782609],
		['11/19/2016',88,85.89361702],
		['11/26/2016',81,85.79166667],
		['12/3/2016',81,85.69387755],
		['12/10/2016',82,85.62],
		['12/17/2016',82,85.54901961],
		['12/24/2016',102,85.86538462],
		['12/31/2016',115,86.41509434]
	]);
*/
	$.get("../api/" + meterID + "/weekchart", function(csvString) {
		// transform the CSV string into a 2-dimensional array
		var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

		// this new DataTable object holds all the data
		var data = new google.visualization.arrayToDataTable(arrayData);
		// CAPACITY - En-route ATFM delay - YY - CHART
		var crt_week = new google.visualization.ChartWrapper({
			chartType: 'ComboChart',
		//	containerId: 'crt_week',
			containerId: document.getElementById('barchartweek'),
			dataTable: data,
			options:{
				title:'2016 Weekly Water Use',
				width:700,
				height:400,
				vAxis: {title: 'Water Use'},
				hAxis: {slantedText:true, slantedTextAngle:70},
				seriesType:'bars',
				series: {1: {type: 'line'}},
				legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
			}
		});
		crt_week.draw();
	});
/*
	var jsonData = $.ajax({
		url: "getData.php",
		dataType: "json",
		async: false
		}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);

	// Set options for Weekly combo chart.
	var options = {title:'2016 Weekly Water Use',
								width:700,
								height:400,
								vAxis: {title: 'Water Use'},
								hAxis: {slantedText:true, slantedTextAngle:70},
								seriesType:'bars',
								series: {1: {type: 'line'}},
								legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
	};

	// Instantiate and draw the chart for Sarah's pizza.
	var chart = new google.visualization.ComboChart(document.getElementById('barchartweek'));
	chart.draw(data, options);
*/
}

// Callback that draws the combo chart for monthly use when Charts is loaded.
function drawMonthChart() {
/*
	// Create the data table for Monthly combo chart.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Date');
	data.addColumn('number', 'Monthly Use');
	data.addColumn('number', 'Monthly Average');
	data.addRows([
		['1/31/2016',328,328],
		['2/29/2016',421,374.5],
		['3/31/2016',352,367],
		['4/30/2016',300,350.25],
		['5/31/2016',340,348.2],
		['6/30/2016',335,346],
		['7/31/2016',368,349.1428571],
		['8/31/2016',326,346.25],
		['9/30/2016',337,345.2222222],
		['10/31/2016',357,346.4],
		['11/30/2016',321,344.0909091],
		['12/31/2016',309,341.1666667]
	]);
*/
	$.get("../api/" + meterID + "/monthchart", function(csvString) {
		// transform the CSV string into an n-dimensional array, where n is the number of columns in the csv
		var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

		// this new DataTable object holds all the data
		var data = new google.visualization.arrayToDataTable(arrayData);
		// CAPACITY - En-route ATFM delay - YY - CHART
		var crt_month = new google.visualization.ChartWrapper({
			chartType: 'ComboChart',
		//	containerId: 'crt_month',
			containerId: document.getElementById('barchartmonth'),
			dataTable: data,
			options:{
				title:'2016 Monthly Water Use',
				width:700,
				height:400,
				vAxis: {title: 'Water Use'},
				hAxis: {slantedText:true, slantedTextAngle:70},
				seriesType:'bars',
				series: {1: {type: 'line'}},
				legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
			}
		});
		crt_month.draw();
	});
/*
	var jsonData = $.ajax({
		url: "../api/route.php",
		dataType: "json",
		async: false
		}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);

	// Set options for Monthly combo chart.
	var options = {title:'2016 Monthly Water Use',
								width:700,
								height:400,
								vAxis: {title: 'Water Use'},
								hAxis: {slantedText:true, slantedTextAngle:70},
								seriesType:'bars',
								series: {1: {type: 'line'}},
								legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
	};

	// Instantiate and draw the chart for Sarah's pizza.
	var chart = new google.visualization.ComboChart(document.getElementById('barchartmonth'));
	chart.draw(data, options);
*/
}

// Callback that draws the combo chart for monthly use when Charts is loaded.
function drawDayTotalChart() {
/*
	// Create the data table for Daily total chart.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Date');
	data.addColumn('number', 'Daily Total');
	data.addRows([
		['2/1/2016',24],
		['2/2/2016',41],
		['2/3/2016',48],
		['2/4/2016',50],
		['2/5/2016',70],
		['2/6/2016',74],
		['2/7/2016',96],
		['2/8/2016',99],
		['2/9/2016',115],
		['2/10/2016',139],
		['2/11/2016',148],
		['2/12/2016',165],
		['2/13/2016',189],
		['2/14/2016',206],
		['2/15/2016',223],
		['2/16/2016',244],
		['2/17/2016',251],
		['2/18/2016',258],
		['2/19/2016',262],
		['2/20/2016',285],
		['2/21/2016',288],
		['2/22/2016',309],
		['2/23/2016',318],
		['2/24/2016',334],
		['2/25/2016',351],
		['2/26/2016',368],
		['2/27/2016',368],
		['2/28/2016',375],
		['2/29/2016',397]
	]);
*/
	$.get("../api/" + meterID + "/daytotalchart", function(csvString) {
		// transform the CSV string into a 2-dimensional array
		var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

		// this new DataTable object holds all the data
		var data = new google.visualization.arrayToDataTable(arrayData);
		// CAPACITY - En-route ATFM delay - YY - CHART
		var crt_daytotal = new google.visualization.ChartWrapper({
			chartType: 'ComboChart',
		//	containerId: 'crt_daytotal',
			containerId: document.getElementById('linechartday'),
			dataTable: data,
			options:{
				width: 450, height: 160,
				title: 'EU-wide en-route ATFM delays (year to date)',
				titleTextStyle : {color: 'grey', fontSize: 11},
			}
		});
		crt_daytotal.draw();
	});
/*
	var jsonData = $.ajax({
		url: "getData.php",
		dataType: "json",
		async: false
		}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);
*/
/*
	// Set options for Daily total chart.
	var options = {title:'Febuary Daily Total Water Use',
								width:700,
								height:400,
								vAxis: {title: 'Water Use'},
								hAxis: {slantedText:true, slantedTextAngle:70},
								seriesType:'line',
								legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
	};

	// Instantiate and draw the chart for Daily running total.
	var chart = new google.visualization.ComboChart(document.getElementById('linechartday'));
	chart.draw(data, options);
*/
}

// Callback that draws the combo chart for monthly use when Charts is loaded.
function drawWeekTotalChart() {
/*
	// Create the data table for Weekly total chart.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Date');
	data.addColumn('number', 'Use to Date');
	data.addRows([
		['1/2/2016',26],
		['1/9/2016',92],
		['1/16/2016',172],
		['1/23/2016',267],
		['1/30/2016',335],
		['2/6/2016',422],
		['2/13/2016',537],
		['2/20/2016',633],
		['2/27/2016',716],
		['3/5/2016',804],
		['3/12/2016',909],
		['3/19/2016',974],
		['3/26/2016',1075],
		['4/2/2016',1126],
		['4/9/2016',1217],
		['4/16/2016',1328],
		['4/23/2016',1426],
		['4/30/2016',1517],
		['5/7/2016',1642],
		['5/14/2016',1725],
		['5/21/2016',1779],
		['5/28/2016',1854],
		['6/4/2016',1923],
		['6/11/2016',2020],
		['6/18/2016',2126],
		['6/25/2016',2210],
		['7/2/2016',2280],
		['7/9/2016',2386],
		['7/16/2016',2441],
		['7/23/2016',2538],
		['7/30/2016',2614],
		['8/6/2016',2674],
		['8/13/2016',2819],
		['8/20/2016',2903],
		['8/27/2016',2997],
		['9/3/2016',3115],
		['9/10/2016',3224],
		['9/17/2016',3299],
		['9/24/2016',3378],
		['10/1/2016',3460],
		['10/8/2016',3557],
		['10/15/2016',3644],
		['10/22/2016',3689],
		['10/29/2016',3801],
		['11/5/2016',3868],
		['11/12/2016',3949],
		['11/19/2016',4037],
		['11/26/2016',4118],
		['12/3/2016',4199],
		['12/10/2016',4281],
		['12/17/2016',4363],
		['12/24/2016',4465],
		['12/31/2016',4580]
	]);
*/
	$.get("../api/" + meterID + "/weektotalchart", function(csvString) {
		// transform the CSV string into a 2-dimensional array
		var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

		// this new DataTable object holds all the data
		var data = new google.visualization.arrayToDataTable(arrayData);
		// CAPACITY - En-route ATFM delay - YY - CHART
		var crt_weektotal = new google.visualization.ChartWrapper({
			chartType: 'ComboChart',
		//	containerId: 'crt_weektotal',
			containerId: document.getElementById('linechartweek'),
			dataTable: data,
			options:{
				width: 450, height: 160,
				title: 'EU-wide en-route ATFM delays (year to date)',
				titleTextStyle : {color: 'grey', fontSize: 11},
			}
		});
		crt_weektotal.draw();
	});
/*
	var jsonData = $.ajax({
		url: "getData.php",
		dataType: "json",
		async: false
		}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);

	// Set options for Weekly total chart.
	var options = {title:'2016 Weekly Total Water Use',
								width:700,
								height:400,
								vAxis: {title: 'Water Use'},
								hAxis: {slantedText:true, slantedTextAngle:70},
								seriesType:'line',
								legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
	};

	// Instantiate and draw the chart for Sarah's pizza.
	var chart = new google.visualization.ComboChart(document.getElementById('linechartweek'));
	chart.draw(data, options);
*/
}

// Callback that draws the combo chart for monthly use when Charts is loaded.
function drawMonthTotalChart() {
/*
	// Create the data table for Monthly total chart.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Date');
	data.addColumn('number', 'Use to Date');
	data.addRows([
		['1/31/2016',348],
		['2/29/2016',745],
		['3/31/2016',1112],
		['4/30/2016',1517],
		['5/31/2016',1898],
		['6/30/2016',2266],
		['7/31/2016',2625],
		['8/31/2016',3059],
		['9/30/2016',3454],
		['10/31/2016',3827],
		['11/30/2016',4162],
		['12/31/2016',4580]
	]);
*/
	$.get("../api/" + meterID + "/monthtotalchart", function(csvString) {
		// transform the CSV string into a 2-dimensional array
		var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

		// this new DataTable object holds all the data
		var data = new google.visualization.arrayToDataTable(arrayData);
		// CAPACITY - En-route ATFM delay - YY - CHART
		var crt_monthtotal = new google.visualization.ChartWrapper({
			chartType: 'ComboChart',
		//	containerId: 'crt_monthtotal',
			containerId: document.getElementById('linechartmonth'),
			dataTable: data,
			options:{
				width: 450, height: 160,
				title: 'EU-wide en-route ATFM delays (year to date)',
				titleTextStyle : {color: 'grey', fontSize: 11},
			}
		});
		crt_monthtotal.draw();
	});
/*
	var jsonData = $.ajax({
		url: "getData.php",
		dataType: "json",
		async: false
		}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);

	// Set options for Monthly total chart.
	var options = {title:'2016 Monthly Total Water Use',
								width:700,
								height:400,
								vAxis: {title: 'Water Use'},
								hAxis: {slantedText:true, slantedTextAngle:70},
								seriesType:'line',
								legend: { position: 'right', textStyle: {fontSize: 10 }, maxLines: 6, alignment: 'center'},
	};

	// Instantiate and draw the chart for Sarah's pizza.
	var chart = new google.visualization.ComboChart(document.getElementById('linechartmonth'));
	chart.draw(data, options);
*/
}

function drawDayTable() {
/*
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Date');
	data.addColumn('number', 'Daily Use');
	data.addColumn('number', 'Monthly Total');
	data.addColumn('number', 'Yearly Total');
	data.addColumn('number', 'Daily Average for Febuary');
	data.addColumn('number', 'Daily Average Year to Date');
	data.addRows([
		['2/1/2016',24,24,372,24,11.625],
		['2/2/2016',17,41,389,20.5,11.78787879],
		['2/3/2016',7,48,396,16,11.64705882],
		['2/4/2016',2,50,398,12.5,11.37142857],
		['2/5/2016',20,70,418,14,11.61111111],
		['2/6/2016',4,74,422,12.33333333,11.40540541],
		['2/7/2016',22,96,444,13.71428571,11.68421053],
		['2/8/2016',3,99,447,12.375,11.46153846],
		['2/9/2016',16,115,463,12.77777778,11.575],
		['2/10/2016',24,139,487,13.9,11.87804878],
		['2/11/2016',9,148,496,13.45454545,11.80952381],
		['2/12/2016',17,165,513,13.75,11.93023256],
		['2/13/2016',24,189,537,14.53846154,12.20454545],
		['2/14/2016',17,206,554,14.71428571,12.31111111],
		['2/15/2016',17,223,571,14.86666667,12.41304348],
		['2/16/2016',21,244,592,15.25,12.59574468],
		['2/17/2016',7,251,599,14.76470588,12.47916667],
		['2/18/2016',7,258,606,14.33333333,12.36734694],
		['2/19/2016',4,262,610,13.78947368,12.2],
		['2/20/2016',23,285,633,14.25,12.41176471],
		['2/21/2016',3,288,636,13.71428571,12.23076923],
		['2/22/2016',21,309,657,14.04545455,12.39622642],
		['2/23/2016',9,318,666,13.82608696,12.33333333],
		['2/24/2016',16,334,682,13.91666667,12.4],
		['2/25/2016',17,351,699,14.04,12.48214286],
		['2/26/2016',17,368,716,14.15384615,12.56140351],
		['2/27/2016',0,368,716,13.62962963,12.34482759],
		['2/28/2016',7,375,723,13.39285714,12.25423729],
		['2/29/2016',22,397,745,13.68965517,12.41666667]
	]);
*/
	$.get("../api/" + meterID + "/daytable", function(csvString) {
		// transform the CSV string into a 2-dimensional array
		var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

		// this new DataTable object holds all the data
		var data = new google.visualization.arrayToDataTable(arrayData);
		// CAPACITY - En-route ATFM delay - YY - CHART
		var crt_daytable = new google.visualization.ChartWrapper({
			chartType: 'Table',
		//	containerId: 'crt_daytable',
			containerId: document.getElementById('daytable'),
			dataTable: data,
			options:{
				showRowNumber: true,
				width: '100%',
				height: '100%'			}
		});
		crt_daytable.draw();
	});
/*
	var jsonData = $.ajax({
		url: "getData.php",
		dataType: "json",
		async: false
		}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);

	var table = new google.visualization.Table(document.getElementById('daytable'));

	table.draw(data, {showRowNumber: true,
						width: '100%',
						height: '100%'});
*/
}

function drawWeekTable() {
/*
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Date');
	data.addColumn('number', 'Weekly Total');
	data.addColumn('number', 'Yearly Total');
	data.addColumn('number', 'Weekly Average');
	data.addRows([
		['1/2/2016',26,26,26],
		['1/9/2016',66,92,46],
		['1/16/2016',80,172,57.33333333],
		['1/23/2016',95,267,66.75],
		['1/30/2016',68,335,67],
		['2/6/2016',87,422,70.33333333],
		['2/13/2016',115,537,76.71428571],
		['2/20/2016',96,633,79.125],
		['2/27/2016',83,716,79.55555556],
		['3/5/2016',88,804,80.4],
		['3/12/2016',105,909,82.63636364],
		['3/19/2016',65,974,81.16666667],
		['3/26/2016',101,1075,82.69230769],
		['4/2/2016',51,1126,80.42857143],
		['4/9/2016',91,1217,81.13333333],
		['4/16/2016',111,1328,83],
		['4/23/2016',98,1426,83.88235294],
		['4/30/2016',91,1517,84.27777778],
		['5/7/2016',125,1642,86.42105263],
		['5/14/2016',83,1725,86.25],
		['5/21/2016',54,1779,84.71428571],
		['5/28/2016',75,1854,84.27272727],
		['6/4/2016',69,1923,83.60869565],
		['6/11/2016',97,2020,84.16666667],
		['6/18/2016',106,2126,85.04],
		['6/25/2016',84,2210,85],
		['7/2/2016',70,2280,84.44444444],
		['7/9/2016',106,2386,85.21428571],
		['7/16/2016',55,2441,84.17241379],
		['7/23/2016',97,2538,84.6],
		['7/30/2016',76,2614,84.32258065],
		['8/6/2016',60,2674,83.5625],
		['8/13/2016',145,2819,85.42424242],
		['8/20/2016',84,2903,85.38235294],
		['8/27/2016',94,2997,85.62857143],
		['9/3/2016',118,3115,86.52777778],
		['9/10/2016',109,3224,87.13513514],
		['9/17/2016',75,3299,86.81578947],
		['9/24/2016',79,3378,86.61538462],
		['10/1/2016',82,3460,86.5],
		['10/8/2016',97,3557,86.75609756],
		['10/15/2016',87,3644,86.76190476],
		['10/22/2016',45,3689,85.79069767],
		['10/29/2016',112,3801,86.38636364],
		['11/5/2016',67,3868,85.95555556],
		['11/12/2016',81,3949,85.84782609],
		['11/19/2016',88,4037,85.89361702],
		['11/26/2016',81,4118,85.79166667],
		['12/3/2016',81,4199,85.69387755],
		['12/10/2016',82,4281,85.62],
		['12/17/2016',82,4363,85.54901961],
		['12/24/2016',102,4465,85.86538462],
		['12/31/2016',115,4580,86.41509434]
	]);
*/
	$.get("../api/" + meterID + "/weektable", function(csvString) {
		// transform the CSV string into a 2-dimensional array
		var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

		// this new DataTable object holds all the data
		var data = new google.visualization.arrayToDataTable(arrayData);
		// CAPACITY - En-route ATFM delay - YY - CHART
		var crt_weektable = new google.visualization.ChartWrapper({
			chartType: 'Table',
		//	containerId: 'crt_weektable',
			containerId: document.getElementById('weektable'),
			dataTable: data,
			options:{
				showRowNumber: true,
				width: '100%',
				height: '100%'
			}
		});
		crt_weektable.draw();
	});
/*
	var jsonData = $.ajax({
		url: "getData.php",
		dataType: "json",
		async: false
		}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);

	var table = new google.visualization.Table(document.getElementById('weektable'));

	table.draw(data, {showRowNumber: true,
						width: '100%',
						height: '100%'});
*/
}

function drawMonthTable() {
/*
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Date');
	data.addColumn('number', 'Monthly Total');
	data.addColumn('number', 'Yearly Total');
	data.addColumn('number', 'Monthly Average');
	data.addRows([
		['1/31/2016',348,348,348],
		['2/29/2016',397,745,372.5],
		['3/31/2016',367,1112,370.6666667],
		['4/30/2016',405,1517,379.25],
		['5/31/2016',381,1898,379.6],
		['6/30/2016',368,2266,377.6666667],
		['7/31/2016',359,2625,375],
		['8/31/2016',434,3059,382.375],
		['9/30/2016',395,3454,383.7777778],
		['10/31/2016',373,3827,382.7],
		['11/30/2016',335,4162,378.3636364],
		['12/31/2016',418,4580,381.6666667]
	]);
*/
	$.get("../api/" + meterID + "/monthtable", function(csvString) {
		// transform the CSV string into a 2-dimensional array
		var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

		// this new DataTable object holds all the data
		var data = new google.visualization.arrayToDataTable(arrayData);
		// CAPACITY - En-route ATFM delay - YY - CHART
		var crt_monthtable = new google.visualization.ChartWrapper({
			chartType: 'Table',
		//	containerId: 'crt_monthtable',
			containerId: document.getElementById('monthtable'),
			dataTable: data,
			options:{
				showRowNumber: true,
				width: '100%',
				height: '100%'
			}
		});
		crt_monthtable.draw();
	});
/*
	var jsonData = $.ajax({
		url: "getData.php",
		dataType: "json",
		async: false
		}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);

	var table = new google.visualization.Table(document.getElementById('monthtable'));

	table.draw(data, {showRowNumber: true,
						width: '100%',
						height: '100%'});
*/
}
