google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);


function drawVisualization() {
	// Some raw data (not necessarily accurate)
	var data = google.visualization.arrayToDataTable([
		['Date',	'Daily Use',	'Running Total',	'Average'],
		['3/1/2016',	8,	8,	8],
		['3/2/2016',	10,	18,	9],
		['/3/2016',	7,	25,	8.333333333],
		['/4/2016',	8,	3,	8.25],
		['/5/2016',	7,	40,	8],
		['/6/2016',	15,	55,	9.166666667],
		['/7/2016',	13,	68,	9.714285714],
		['/8/2016',	12,	80,	10],
		['/9/2016',	14,	94,	10.44444444],
		['/10/2016',	11,	105,	10.5],
		['/11/2016',	0,	105,	9.545454545],
		['/12/2016',	7,	112,	9.333333333],
		['/13/2016',	8,	120,	9.230769231]
	]);

	var options = {
		title : 'Daily Water Use',
		vAxis: {title: 'Water Use'},
		hAxis: {title: 'Date'},
		seriesType: 'bars',
		series: {2: {type: 'line'}}
	};

	var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}