function barChartDefaultSettings(){
	return {
		margintop: 20,
		marginright: 20,
		marginbottom: 30,
		marginleft: 50,
		wide: 960,
		tall: 500
	};
}

function loadBarChart(elementId, config) {
	if(config == null) config = liquidFillGaugeDefaultSettings();

	var chart = d3.select("#" + elementId);

	var margin = {top: config.margintop, right: config.marginright, bottom: config.marginbottom, left: config.marginleft},
			width = config.wide - margin.left - margin.right,
			height = config.tall - margin.top - margin.bottom;

	var formatDate = d3.time.format("%d-%b-%y");

	var x = d3.time.scale()
			.range([0, width]);

	var y = d3.scale.linear()
			.range([height, 0]);

	var xAxis = d3.svg.axis()
			.scale(x)
			.orient("bottom");

	var yAxis = d3.svg.axis()
			.scale(y)
			.orient("left");

	var line = d3.svg.line()
			.x(function(d) { return x(d.date); })
			.y(function(d) { return y(d.close); });

	var lchart = d3.select("#" + elementId).append("svg")
			.attr("width", width + margin.left + margin.right)
			.attr("height", height + margin.top + margin.bottom)
		.append("g")
			.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	d3.tsv("data.tsv", type, function(error, data) {
		if (error) throw error;

		x.domain(d3.extent(data, function(d) { return d.date; }));
		y.domain(d3.extent(data, function(d) { return d.close; }));

		lchart.append("g")
				.attr("class", "x axis")
				.attr("transform", "translate(0," + height + ")")
				.call(xAxis);

		lchart.append("g")
				.attr("class", "y axis")
				.call(yAxis)
			.append("text")
				.attr("transform", "rotate(-90)")
				.attr("y", 6)
				.attr("dy", ".71em")
				.style("text-anchor", "end")
				.text("Price ($)");

		lchart.append("path")
				.datum(data)
				.attr("class", "line")
				.attr("d", line);
	});

	function type(d) {
		d.date = formatDate.parse(d.date);
		d.close = +d.close;
		return d;
	}
}