<?php
	session_start();

	if(!isset($_SESSION['user_session']))
	{
		header("Location: index.php");
	}
/*
	include_once '/api/queries/AbzuDB.php';

	$stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['user_session']));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
*/
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Abzu: Water Visualization</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		<link href="/css/signin.css" rel="stylesheet">
		<script src="jquery/jquery-2.2.0.js"></script>
		<script src="jquery/jquery.csv.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="d3/d3.js" language="JavaScript"></script>
		<script src="d3/liquidfill/liquidFillGauge.js" language="JavaScript"></script>
	<!--	<script src="js/barchart.js" language="JavaScript"></script> -->
	<!--	<script src="js/linechart.js" language="JavaScript"></script> -->
		<script src="js/loader.js" language="JavaScript"></script>
	<!--	<script type="text/javascript" src="gchart/multicombo.js"></script> -->
		<script src="js/allcharts.js" language="JavaScript"></script>
		<style>
			.liquidFillGaugeText { font-family: Helvetica; font-weight: bold; }

			.bar {
				fill: steelblue;
			}

			.bar:hover {
				fill: brown;
			}

			.axis path,
			.axis line {
				fill: none;
				stroke: #000;
				shape-rendering: crispEdges;
			}

			.x.axis path {
			}

			.line {
				fill: none;
				stroke: steelblue;
				stroke-width: 1.5px;
			}

		</style>
	</head>
	<body>
		<div class="container">
			<h1>City of Independence Water Use</h1>
		<!--	<div class="dropdown" align="right">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Meter ID
				<span class="caret"></span></button>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
				</ul>
			</div>-->
			<div class="row">
				<div class="col-sm-4 col-md-3">
					<div class="panel-group">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<center><h4>Water Use at a Glance</h4></center>
							</div>
							<div class="panel-body">
								<center>
									<h4>Year to Date</h4>
									<svg id="fillgauge1" width="200" onclick="gauge1.update(NewValue());"></svg>
									<br/>
									<h4>Month to Date</h4>
									<svg id="fillgauge2" width="200" onclick="gauge2.update(NewValue());"></svg>
									<br/>
									<h4>Daily Average</h4>
									<svg id="fillgauge3" width="200" onclick="gauge3.update(NewValue());"></svg>
								</center>
								<script src="js/gauge.js" language="JavaScript"></script>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-8 col-md-9">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
						<li><a data-toggle="tab" href="#graph">Graph</a></li>
						<li><a data-toggle="tab" href="#table">Table</a></li>
						<!--<li><a data-toggle="tab" href="#map">Map</a></li>-->
					</ul>

					<div class="panel panel-primary">
						<div class="panel-body">
							<div class="tab-content">
								<div id="home" class="tab-pane fade in active">
										<div id="ad-pan" class="tab-pane fade in active">
											<div class="panel-heading">
												<h2>Administrator Panel</h2>
											</div>
											<div class="panel-body">
												<form class="well" action="php/upload.php" method="post" enctype="multipart/form-data">
													<div class="form-group">
														<label for="file">Select a file to upload</label>
														<input type="file" name="file">
														<p class="help-block">Only files with .txt and no file extensions are allowed.</p>
													</div>
													<input type="submit" class="btn btn-lg btn-primary" value="Upload">
												</form>
											</div>
										</div>
								</div>

								<div id="graph" class="tab-pane fade">
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#graphday">Day</a></li>
										<li><a data-toggle="tab" href="#graphweek">Week</a></li>
										<li><a data-toggle="tab" href="#graphmonth">Month</a></li>
									</ul>
									<div class="panel panel-primary">
										<div class="panel-body">
											<div class="tab-content">
												<div id="graphday" class="tab-pane fade in active">
													<ul class="nav nav-tabs">
														<li class="active"><a data-toggle="tab" href="#graphdayday">Per Day</a></li>
														<li><a data-toggle="tab" href="#graphdayyear">Month to Date</a></li>
													</ul>
													<div class="panel panel-primary">
														<div class="panel-body">
															<div class="tab-content">
																<div id="graphdayday" class="tab-pane fade in active">
																<!--	<div id="chart_div" style="width: 100%; height: 100%;"></div> -->
																	<div id="barchartday" style="border: 1px solid #ccc"></div>
																</div>

																<div id="graphdayyear" class="tab-pane fade">
																	<div id="linechartday" style="border: 1px solid #ccc"></div>
																<!--	<script src="js/lc.js" language="JavaScript"></script> -->
																</div>
															</div>
														</div>
													</div>
												</div>

												<div id="graphweek" class="tab-pane fade">
													<ul class="nav nav-tabs">
														<li class="active"><a data-toggle="tab" href="#graphweekweek">Per Week</a></li>
														<li><a data-toggle="tab" href="#graphweekyear">Year to Date</a></li>
													</ul>
													<div class="panel panel-primary">
														<div class="panel-body">
															<div class="tab-content">
																<div id="graphweekweek" class="tab-pane fade in active">
																	<div id="barchartweek" style="border: 1px solid #ccc"></div>
																</div>

																<div id="graphweekyear" class="tab-pane fade">
																	<div id="linechartweek" style="border: 1px solid #ccc"></div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div id="graphmonth" class="tab-pane fade">
													<ul class="nav nav-tabs">
														<li class="active"><a data-toggle="tab" href="#graphmonthmonth">Per Month</a></li>
														<li><a data-toggle="tab" href="#graphmonthyear">Year to Date</a></li>
													</ul>
													<div class="panel panel-primary">
														<div class="panel-body">
															<div class="tab-content">
																<div id="graphmonthmonth" class="tab-pane fade in active">
																	<div id="barchartmonth" style="border: 1px solid #ccc"></div>
																</div>

																<div id="graphmonthyear" class="tab-pane fade">
																	<div id="linechartmonth" style="border: 1px solid #ccc"></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- <script src="js/bc.js" language="JavaScript"></script> -->
								<!-- <script src="js/lc.js" language="JavaScript"></script> -->

								<div id="table" class="tab-pane fade">
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#tableday">Day</a></li>
										<li><a data-toggle="tab" href="#tableweek">Week</a></li>
										<li><a data-toggle="tab" href="#tablemonth">Month</a></li>
									</ul>
									<div class="panel panel-primary">
										<div class="panel-body">
											<div class="tab-content">
												<div id="tableday" class="tab-pane fade in active">
													<div id="daytable"></div>
												</div>

												<div id="tableweek" class="tab-pane fade">
													<div id="weektable"></div>
												</div>

												<div id="tablemonth" class="tab-pane fade">
													<div id="monthtable"></div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div id="map" class="tab-pane fade">
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#mapday">Day</a></li>
										<li><a data-toggle="tab" href="#mapweek">Week</a></li>
										<li><a data-toggle="tab" href="#mapmonth">Month</a></li>
									</ul>
									<div class="panel panel-primary">
										<div class="panel-body">
											<div class="tab-content">
												<div id="mapday" class="tab-pane fade in active">
													test day
												</div>

												<div id="mapweek" class="tab-pane fade">
													test week
												</div>

												<div id="mapyear" class="tab-pane fade">
													test year
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
