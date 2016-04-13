var meterID = 7813517;
var selectedYear = "2016";
var selectedMonth = "-02"
var selectedDay = "-28"
var selectedDate = "2016-02-28";

var config1 = liquidFillGaugeDefaultSettings();
config1.circleColor = "#0099FF";
config1.textColor = "#0055AA";
config1.waveTextColor = "#55DDFF";
config1.waveColor = "#0099FF";
config1.circleThickness = 0.025;
config1.textVertPosition = 0.8;
config1.waveAnimateTime = 1000;
config1.waveHeight = 0.05;
config1.waveAnimate = true;
//config1.waveRise = false;
//config1.waveHeightScaling = false;
config1.waveOffset = 0.25;
config1.waveCount = 3;
config1.displayPercent = false;
/*
config1.minValue = 0;
config1.maxValue = 5000;
*/
$.get("../api/" + meterID + "/yeartodate/" + selectedYear, function(csvString) {
	// transform the CSV string into an n-dimensional array, where n is the number of columns in the csv
	var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});
/*	if( arrayData.length > 1) {
		error check here
	} else {
*/
	config1.maxValue = arrayData[0] + 500;
	var gauge1 = loadLiquidFillGauge("fillgauge1", arrayData[0], config1);
});
//var gauge1 = loadLiquidFillGauge("fillgauge1", 4580, config1);

var config2 = liquidFillGaugeDefaultSettings();
config2.circleColor = "#00CCFF";
config2.textColor = "#0077CC";
config2.waveTextColor = "#0099DD";
config2.waveColor = "#00CCFF";
config2.circleThickness = 0.05;
config2.waveAnimateTime = 2000;
config2.textVertPosition = 0.8;
config2.waveHeight = 0.3;
config2.waveCount = 1;
config2.displayPercent = false;
/*
config2.minValue = 0;
config2.maxValue = 500;
*/
$.get("../api/" + meterID + "/monthtodate/" + selectedYear + selectedMonth, function(csvString) {
	// transform the CSV string into an n-dimensional array, where n is the number of columns in the csv
	var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});
/*	if( arrayData.length > 1) {
		error check here
	} else {
*/
	config2.maxValue = arrayData[0] + 50;
//	config2.maxValue = csvString + 50;
	var gauge2= loadLiquidFillGauge("fillgauge2", arrayData[0], config2);
//	var gauge2= loadLiquidFillGauge("fillgauge2", csvString, config2);
});
//var gauge2= loadLiquidFillGauge("fillgauge2", 397, config2);

var config3 = liquidFillGaugeDefaultSettings();
config3.circleThickness = 0.075;
config3.textVertPosition = 0.8;
config3.waveAnimateTime = 5000;
config3.waveHeight = 0.15;
config3.textVertPosition = 0.8;
config3.waveOffset = 0.25;
config3.valueCountUp = false;
config3.displayPercent = false;
/*
config3.minValue = 0;
config3.maxValue = 30;
*/
$.get("../api/" + meterID + "/dayaverage/" + selectedYear + selectedMonth + selectedDay, function(csvString) {
	// transform the CSV string into an n-dimensional array, where n is the number of columns in the csv
	var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});
/*	if( arrayData.length > 1) {
		error check here
	} else {
*/
	config3.maxValue = arrayData[0] + 5;
	var gauge3 = loadLiquidFillGauge("fillgauge3", arrayData[0], config3);
});
//var gauge3 = loadLiquidFillGauge("fillgauge3", 12.41666667, config3);

function NewValue(){
	if(Math.random() > .5){
		return Math.round(Math.random()*100);
	} else {
		return (Math.random()*100).toFixed(1);
	}
}
