var config1 = liquidFillGaugeDefaultSettings();
config1.circleColor = "#0099FF";
config1.textColor = "#0055AA";
config1.waveTextColor = "#55DDFF";
config1.waveColor = "#0099FF";
config1.circleThickness = 0.025;
config1.textVertPosition = 0.55;
config1.waveAnimateTime = 1000;
config1.waveHeight = 0.05;
config1.waveAnimate = true;
config1.waveRise = false;
config1.waveHeightScaling = false;
config1.waveOffset = 0.25;
config1.textSize = 0.75;
config1.waveCount = 3;
config1.displayPercent = false;
var gauge1 = loadLiquidFillGauge("fillgauge1", 55, config1);

var config2 = liquidFillGaugeDefaultSettings();
config2.circleColor = "#00CCFF";
config2.textColor = "#0077CC";
config2.waveTextColor = "#0099DD";
config2.waveColor = "#00CCFF";
config2.circleThickness = 0.05;
config2.textVertPosition = 0.8;
config2.waveAnimateTime = 2000;
config2.textVertPosition = 0.2;
config2.waveHeight = 0.3;
config2.waveCount = 1;
config2.displayPercent = false;
var gauge2= loadLiquidFillGauge("fillgauge2", 28, config2);

var config3 = liquidFillGaugeDefaultSettings();
config3.circleThickness = 0.075;
config3.textVertPosition = 0.8;
config3.waveAnimateTime = 5000;
config3.waveHeight = 0.15;
config3.textVertPosition = 0.6;
config3.waveOffset = 0.25;
config3.valueCountUp = false;
config3.displayPercent = false;
var gauge3 = loadLiquidFillGauge("fillgauge3", 60.1, config3);

function NewValue(){
	if(Math.random() > .5){
		return Math.round(Math.random()*100);
	} else {
		return (Math.random()*100).toFixed(1);
	}
}
