var height = 100;
var width = height * 1.618;

var c = document.getElementById("canvas1");
var ctx = c.getContext("2d");

ctx.fillStyle = "#FF0000";
ctx.shadowColor="gray";
ctx.shadowBlur=8;
ctx.shadowOffsetX = 8;
ctx.shadowOffsetY = 8;
ctx.fillRect(5,5,width,height);

ctx.moveTo(5, 200);
ctx.lineTo(200,200);
ctx.stroke();

ctx.beginPath();
ctx.arc(250,50,40,0,2*Math.PI);
ctx.strokeStyle="#FF0000";
ctx.stroke();

ctx.font = "30px Arial";
ctx.fillText("Hello World",5,300);
ctx.strokeText("Привет HTML5",5,350);

// Create gradient
var grd = ctx.createLinearGradient(202,202,width + 202,202);
grd.addColorStop(0,"red");
grd.addColorStop(1,"white");

// Fill with gradient
ctx.fillStyle = grd;
ctx.fillRect(202,202, width, height);

