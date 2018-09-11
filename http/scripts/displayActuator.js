var h, w;
var blur_size = 8;
var s_data;
var cur_canvas;
var image_w = 64;
var image_h = 32;
var image_x, image_y;
var	background_color = "#A1D8C6";

function displayActuator(canvas) {
	var ctx = canvas.getContext("2d");
	var actuator_id = canvas.id.substr(8);
	var imageObj, imageOption;
	
	imageObj = new Image();
	imageOption = new Image();

	ctx.clearRect(0,0,canvas.width,canvas.height);

	$.ajax({
		type: "POST",
		url: "scripts/getActuatorData.php",
		data: "id=" + actuator_id,
		complete: function () {
//		
		},

		success: function(msg) {
			var arr = JSON.parse(msg);

			w = canvas.width - 2 * blur_size;
			h = canvas.height - 2 * blur_size;
			image_x = 5;
			image_y = w - 10;

			ctx.beginPath();
			// drawing background
			ctx.fillStyle = background_color;
			ctx.shadowColor="gray";
			ctx.shadowBlur= blur_size;
			ctx.shadowOffsetX = blur_size;
			ctx.shadowOffsetY = blur_size;
			ctx.fillRect(0, 0, w, h);

				ctx.stroke();

			ctx.fillStyle = "#000000";

			// sensor address
			ctx.font = "12px Arial";
			ctx.fillText(arr['name'], 6, 18);
			// sensor value data
			ctx.font = "10px Arial";
			ctx.fillText(arr['GPIO_pin'], 4, h-4);

			ctx.shadowBlur= 0;
			ctx.shadowOffsetX = 0;
			ctx.shadowOffsetY = 0;
			
			// Draw image
			imageObj.onload = function() {
				ctx.drawImage(imageObj, image_x, image_y, image_w, image_h);
			};
			if (arr['state']) {
				imageObj.src = '../img/relay_on.png';
			} else {
				imageObj.src = '../img/relay_off.png';
			}

			// Draw option image
			imageOption.onload = function() {
				ctx.drawImage(imageOption, w - 18, h -18, 16, 16);
			}
			imageOption.src = '../img/Options.png';
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
	var ctx = event.currentTarget.getContext("2d");
	var actuator_id = event.currentTarget.id.substr(8);
	var new_state = false;
	
	if (x>9 && x<65 && y>67 && y<95) {
	
		$.ajax({
			type: "POST",
			url: "scripts/getActuatorData.php",
			data: "id=" + actuator_id,
			success: function(msg) {
				var arr = JSON.parse(msg);
				var imageObj = new Image();

				new_state = ! arr['state'];
				
				ctx.fillStyle = background_color;
				ctx.fillRect(6, 64, 65-9+6, 105-77+4);

				imageObj.onload = function() {
					ctx.shadowBlur= 0;
					ctx.shadowOffsetX = 0;
					ctx.shadowOffsetY = 0;
					ctx.drawImage(imageObj, image_x, image_y, image_w, image_h);
				}
				if (new_state) {
					imageObj.src = '../img/relay_on.png';
				} else {
					imageObj.src = '../img/relay_off.png';
				}

				$.ajax({
					type: "POST",
					url: "scripts/setActuatorState.php",
					data: { id: actuator_id, state: new_state },
					success: function(msg) {
						var arr = JSON.parse(msg);
						for (var k in arr) {
							var tmp = arr[k].actuator_id;
							if (arr[k].actuator_id == actuator_id) {
								if (arr[k].state == new_state ) {
									ctx.fillStyle = "#000000";
									ctx.font = "9px Arial";
									if (new_state) {
										ctx.beginPath();
										ctx.arc(52, 80, 6, 0, 2 * Math.PI, false);
										ctx.fillStyle = 'green';
										ctx.fill();
										ctx.lineWidth = 1;
//										ctx.strokeStyle = '#003300';
//										ctx.stroke();
										ctx.closePath();
// 										ctx.fillText('on', 56, 93);
									} else {
										ctx.beginPath();
										ctx.arc(22, 80, 6, 0, 2 * Math.PI, false);
										ctx.fillStyle = 'red';
										ctx.fill();
										ctx.lineWidth = 1;
//										ctx.strokeStyle = '#003300';
//										ctx.stroke();
										ctx.closePath();
//										ctx.fillText('off', 16, 92);
									}
								}
							}
						}
					}
				})
			}
		})
		
			
	}
}
