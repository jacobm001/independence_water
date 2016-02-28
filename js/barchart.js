function barChartDefaultSettings(){
	return {
		margintop: 20,
		marginright: 20,
		marginbottom: 30,
		marginleft: 40,
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

	var x = d3.scale.ordinal()
			.rangeRoundBands([0, width], .1);

	var y = d3.scale.linear()
			.range([height, 0]);

	var xAxis = d3.svg.axis()
			.scale(x)
			.orient("bottom");

	var yAxis = d3.svg.axis()
			.scale(y)
			.orient("left")
			.ticks(10, "%");

	var bar = d3.select("#" + elementId).append("svg")
			.attr("width", width + margin.left + margin.right)
			.attr("height", height + margin.top + margin.bottom)
		.append("g")
			.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	d3.tsv("bar.tsv", type, function(error, data) {
		if (error) throw error;

		x.domain(data.map(function(d) { return d.letter; }));
		y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

		bar.append("g")
				.attr("class", "x axis")
				.attr("transform", "translate(0," + height + ")")
				.call(xAxis);

		bar.append("g")
				.attr("class", "y axis")
				.call(yAxis)
			.append("text")
				.attr("transform", "rotate(-90)")
				.attr("y", 6)
				.attr("dy", ".71em")
				.style("text-anchor", "end")
				.text("Frequency");

		bar.selectAll(".bar")
				.data(data)
			.enter().append("rect")
				.attr("class", "bar")
				.attr("x", function(d) { return x(d.letter); })
				.attr("width", x.rangeBand())
				.attr("y", function(d) { return y(d.frequency); })
				.attr("height", function(d) { return height - y(d.frequency); });
	});

	function type(d) {
		d.frequency = +d.frequency;
		return d;
	}
}
