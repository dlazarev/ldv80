var h, w;
var blur_size = 8;
var s_data;
var cur_canvas;

function displaySensor(canvas) {
	var ctx = canvas.getContext("2d");
	var image_w = 36;
	var image_h = 64;
	var imageObj = new Image();
	var image_x, image_y;
	var address = canvas.id.substr(6);
	var date, sensor_name, sensor_desc, temp;
	var	background_color = "#13BAED";

	ctx.clearRect(0,0,canvas.width,canvas.height);

	$.ajax({
		type: "POST",
		url: "scripts/getSensorData.php",
		data: "address=" + address,
		complete: function () {
//			setTimeout(displaySensor(canvas), 15000);
		},

		success: function(msg) {
			var arr = JSON.parse(msg);

			w = canvas.width - 2 * blur_size;
			h = canvas.height - 2 * blur_size;
			image_x = 2*w/3;

			ctx.beginPath();
			// drawing background
			ctx.fillStyle = background_color;
			ctx.shadowColor="gray";
			ctx.shadowBlur= blur_size;
			ctx.shadowOffsetX = blur_size;
			ctx.shadowOffsetY = blur_size;
			ctx.fillRect(0, 0, w, h);

			// drawing temp circle
			ctx.strokeStyle="#00FF00";
			ctx.arc(w/3,h/2, h/3,0,2*Math.PI);
			ctx.lineWidth = blur_size;

			// temperature difference
			if (arr['temp_diff'] >= 0.5) {
				redGradient();
			} else if (arr['temp_diff'] <= -0.5) {
				blueGradient();
			}

			ctx.stroke();

			ctx.fillStyle = "#000000";

			// sensor address
			ctx.font = "16px Arial";
			ctx.fillText(arr['name'], 6, 18);
			// sensor value data
			ctx.font = "10px Arial";
			ctx.fillText(arr['date'], w-86, h-4);

			// sensor data
			ctx.font = "Bold 28px Arial";
			ctx.blur_size = 0;
			ctx.shadowOffsetX = 0;
			ctx.shadowOffsetY = 0;
			ctx.fillText(arr['temp'] + "\xB0", w/3 - 32, h/2 + 12);
			// temp difference per hour
			ctx.font = "9px Arial";
			ctx.fillText(arr['temp_diff'], 4, h - 4);

/*			// temperature difference
			if (arr['temp_diff'] > 0.1) {
				redUpArrow();
			} else if (arr['temp_diff'] < -0.1) {
				blueDownArrow();
			}
*/
			function redUpArrow() {
				ctx.beginPath();
				ctx.lineWidth = 10;
				ctx.lineCap = 'round';
				ctx.moveTo(2*w/3, h/2);
				ctx.lineTo(2*w/3, 32);
				ctx.moveTo(2*w/3 - 1, 32);
				ctx.lineTo(2*w/3 - 16, 32 + 32);
				ctx.moveTo(2*w/3 + 1, 32);
				ctx.lineTo(2*w/3 + 16, 32 + 32);
				ctx.strokeStyle = "#ff0000";
				ctx.stroke();
				ctx.closePath();
			}

			function blueDownArrow() {
				ctx.beginPath();
				ctx.lineWidth = 10;
				ctx.lineCap = 'round';
				ctx.moveTo(2*w/3, h/2);
				ctx.lineTo(2*w/3, h - 32);
				ctx.moveTo(2*w/3 - 1, h - 32);
				ctx.lineTo(2*w/3 - 16, h - 32 - 32);
				ctx.moveTo(2*w/3 + 1, h - 32);
				ctx.lineTo(2*w/3 + 16, h - 32 - 32);
				ctx.strokeStyle = "#0000ff";
				ctx.stroke();
				ctx.closePath();
			}

			function blueGradient() {
				// blue gradient
				var grad = ctx.createLinearGradient(w/3, h/2 + h/3, h/3, h/3);
				// light blue
				grad.addColorStop(1, '#8ED6FF');
				// dark blue
				grad.addColorStop(0, '#004CB3');
				ctx.fillStyle = grad;
				ctx.fill();
			}

			function redGradient() {
				// blue gradient
				var grad = ctx.createLinearGradient(w/3, h/2 + h/3, h/3, h/3);
				// light red
				grad.addColorStop(1, '#FA8398');
				// dark red
				grad.addColorStop(0, '#B3000D');
				ctx.fillStyle = grad;
				ctx.fill();
			}
		}
	});

}

function move(event) {
	canvas = event.target;
//	ctx = canvas.getContext("2d");
//	ctx.clearRect(0,0,w,h);
	var x = event.offsetX;
	var y = event.offsetY;

//	displaySensor(canvas, s_data, "#EFF318");
//	ctx.beginPath();
//	ctx.moveTo(w/2, h/2);
//	ctx.lineTo(x,y);
//	ctx.stroke();
}

function mouseclick(event) {
	var x = event.offsetX;
	var y = event.offsetY;
//	window.open(null, "popup", 100, 200);
}
