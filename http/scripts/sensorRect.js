var height = 100;
var width = height * 1.618;
var x0 = 150;
var y0 = 40;
//var c = document.getElementById("canvas");
//var ctx = c.getContext("2d");

function drawRect(canvas, sensor_data, num) {
	var ctx = canvas.getContext("2d");
	var x = x0;
	var y = y0 + num * 110;
	var image_width = 24;
	var image_height = 32;
	var imageObj = new Image();
	var image_x, image_y;

	image_x = x+2*width/3;

	ctx.fillStyle = "#77DAA2";
	ctx.shadowColor="gray";
	ctx.shadowBlur=4;
	ctx.shadowOffsetX = 4;
	ctx.shadowOffsetY = 4;

	ctx.fillRect(x,y,width,height);

	ctx.beginPath();

	ctx.strokeStyle="#00FF00";
	ctx.arc(x + width/3,y + height/2,30,0,2*Math.PI);
	ctx.lineWidth = 2;
	ctx.stroke();

//	ctx.strokeStyle="#FF0000";
//	ctx.arc(image_x,y + height/2,6,0,2*Math.PI);
//	ctx.lineWidth = 2;
//	ctx.stroke();

	ctx.fillStyle = "#000000";

	// Sensor address
	ctx.font = "12px Arial";
	ctx.fillText(sensor_data['name'], x+2, y+10);
	ctx.font = "10px Arial";
	ctx.fillText(sensor_data['date'], x+width-86, y+height-4);

	// Sensor data
	ctx.font = "Bold 16px Arial";
	ctx.fillText(sensor_data['value'] + "\xB0", x+width/3 - 20, y+height/2 + 5);
	ctx.fillText(sensor_data[4], x+width/3 - 20, y+height/2 + 45);

	if (sensor_data[4] < -0.1) {
		imageObj.src = 'img/redUpArrow.png';
		image_y = y + height/2 - image_height;
	} else {
		imageObj.src = 'img/blueDownArrow.png';
		image_y = y + height/2;
	}
	imageObj.onload = function() {
		ctx.drawImage(imageObj, image_x, image_y, image_width, image_height);
	};

//	print('<map name=sensor_data['address'] + "_map">');
//	print("/map>");
//	tempUp(ctx);
}

function tempUp(ctx) {
	var arrowWidth = 1;

	ctx.beginPath();
	ctx.lineWidth = arrowWidth;
	ctx.arc(x0 + 2*width/3,y0 + height/2,arrowWidth/5,0,Math.PI);

	ctx.moveTo(x0 + 2*width/3, y0 + height/2);
	ctx.lineTo(x0 + 2*width/3, y0 + 5);

	ctx.moveTo(x0 + 2*width/3 + 1, y0 + 5);
	ctx.lineTo(x0 + 2*width/3 - 3, y0 + 16);

	ctx.moveTo(x0 + 2*width/3 - 1, y0 + 5);
	ctx.lineTo(x0 + 2*width/3 + 3, y0 + 16);

//	ctx.strokeStyle = "#F58C26";
	ctx.strokeStyle = "#000000";
	ctx.stroke();
}

function move(event) {
	return;
	ctx.clearRect(0,0,w,h);
	var x = event.offsetX;
	var y = event.offsetY;

	ctx.beginPath();
	ctx.moveTo(w/2, h/2);
	ctx.lineTo(x,y);
	ctx.stroke();
}

