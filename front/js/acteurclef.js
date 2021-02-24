	// // Helper function to compile webGL program
	// createWebGLProgram = function(ctx, vertexShaderSource, fragmentShaderSource) {

	// 	this.ctx = ctx;

	// 	this.compileShader = function(shaderSource, shaderType) {
	// 		var shader = this.ctx.createShader(shaderType);
	// 		this.ctx.shaderSource(shader, shaderSource);
	// 		this.ctx.compileShader(shader);
	// 		return shader;
	// 	};

	// 	var program = this.ctx.createProgram();
	// 	this.ctx.attachShader(program, this.compileShader(vertexShaderSource, this.ctx.VERTEX_SHADER));
	// 	this.ctx.attachShader(program, this.compileShader(fragmentShaderSource, this.ctx.FRAGMENT_SHADER));
	// 	this.ctx.linkProgram(program);
	// 	this.ctx.useProgram(program);

	// 	return program;

	// }

	// var image = new Image();
	// image.crossOrigin = "Anonymous";
	// image.src = "../assets/images/image_acteur.png";
	
	// document.querySelector('main').appendChild(image);

	// image.onload = function(){
	// 	applyEffect(image);
	// }
	
	
	// function applyEffect(image) {

	// 	var canvas = document.createElement('canvas');
	// 	var mousePos = {};

	// 	image.parentNode.insertBefore(canvas, image);
	// 	canvas.width  = image.width;
	// 	canvas.height = image.height;
	// 	image.parentNode.removeChild(image);

	// 	var ctx;
	// 	try {
	// 	  ctx = canvas.getContext("webgl")  || canvas.getContext("experimental-webgl");
	// 	} catch(e) {}

	// 	if (!ctx) {
	// 		// You could fallback to 2D methods here
	// 		alert("Sorry, it seems WebGL is not available.");
	// 	}

	// 	var fragmentShaderSource = document.getElementById("fragment-shader").text;
	// 	var vertexShaderSource = document.getElementById("vertex-shader").text;
	// 	var program = createWebGLProgram(ctx, vertexShaderSource, fragmentShaderSource);

	// 	// Expose canvas width and height to shader via u_resolution
	//   var resolutionLocation = ctx.getUniformLocation(program, "u_resolution");
	//   ctx.uniform2f(resolutionLocation, canvas.width, canvas.height);

	// 	var mousePosition = ctx.getUniformLocation(program, "u_mouse");
	// 	ctx.uniform2f(mousePosition, .5,.5);

	// 	// Position rectangle vertices (2 triangles)
	//   var positionLocation = ctx.getAttribLocation(program, "a_position");
	//   var buffer = ctx.createBuffer();
	//   ctx.bindBuffer(ctx.ARRAY_BUFFER, buffer);
	// 	ctx.bufferData(ctx.ARRAY_BUFFER, new Float32Array([
	//      0, 0,
	//      image.width, 0,
	//      0, image.height,
	//      0, image.height,
	//      image.width, 0,
	//      image.width, image.height]), ctx.STATIC_DRAW);
	// 	ctx.enableVertexAttribArray(positionLocation);
	//   ctx.vertexAttribPointer(positionLocation, 2, ctx.FLOAT, false, 0, 0);

	// 	//Position texture
	//   var texCoordLocation = ctx.getAttribLocation(program, "a_texCoord");
	//   var texCoordBuffer = ctx.createBuffer();
	//   ctx.bindBuffer(ctx.ARRAY_BUFFER, texCoordBuffer);
	//   ctx.bufferData(ctx.ARRAY_BUFFER, new Float32Array([
	// 		0.0, 0.0,
	// 		1.0, 0.0,
	// 		0.0, 1.0,
	// 		0.0, 1.0,
	// 		1.0, 0.0,
	// 		1.0, 1.0]), ctx.STATIC_DRAW);
	//   ctx.enableVertexAttribArray(texCoordLocation);
	//   ctx.vertexAttribPointer(texCoordLocation, 2, ctx.FLOAT, false, 0, 0);

	//   // Create a texture.
	//   var texture = ctx.createTexture();
	//   ctx.bindTexture(ctx.TEXTURE_2D, texture);
	//   // Set the parameters so we can render any size image.
	//   ctx.texParameteri(ctx.TEXTURE_2D, ctx.TEXTURE_WRAP_S, ctx.CLAMP_TO_EDGE);
	//   ctx.texParameteri(ctx.TEXTURE_2D, ctx.TEXTURE_WRAP_T, ctx.CLAMP_TO_EDGE);
	//   ctx.texParameteri(ctx.TEXTURE_2D, ctx.TEXTURE_MIN_FILTER, ctx.NEAREST);
	//   ctx.texParameteri(ctx.TEXTURE_2D, ctx.TEXTURE_MAG_FILTER, ctx.NEAREST);
	//   // Load the image into the texture.
	//   ctx.texImage2D(ctx.TEXTURE_2D, 0, ctx.RGBA, ctx.RGBA, ctx.UNSIGNED_BYTE, image);

	//   // Draw the rectangle.
	//   ctx.drawArrays(ctx.TRIANGLES, 0, 6);

	// 	canvas.addEventListener('mousemove', function(evt) {
	// 		mousePos = (function(canvas, evt){
	// 			var rect = canvas.getBoundingClientRect();
	// 			return {
	// 				x: (evt.clientX - rect.left) / canvas.width,
	// 				y: (evt.clientY - rect.top) / canvas.height
	// 			};
	// 		})(canvas, evt);
	// 		// Expose local mouse coords
	// 	  ctx.uniform2f(mousePosition, mousePos.x,  mousePos.y);
	// 		ctx.drawArrays(ctx.TRIANGLES, 0, 6);
	// 	});
	// }


	var options = {
		imgSrc : "https://unsplash.it/g/1024/768?image=874",
		containerName : "placeholder",
		rows:5,
		columns:5,
		margin:2.5,
		animTime: 0.3
	  }
	  
	  function ImageGrid(defaults)
	  {
		var r = defaults.rows;
		var c = defaults.columns;
		var margin = defaults.margin;
		  
		var placeholder = document.getElementsByClassName(defaults.containerName)[0];
		var container = document.createElement('div');
		container.className = "gridContainer";
		placeholder.appendChild(container); 
		  
		var gridTile;  
	  
		var w = (container.offsetWidth / c) -margin;
		var h = (container.offsetHeight / r) -margin;
		var arr = [];
		  
		for (var i=0, l=r*c; i < l; i++)
		{    
		  gridTile = document.createElement('div');
		  gridTile.className = "gridTile";
		  gridTile.style.backgroundImage = "url("+defaults.imgSrc+")";
		  
			 
		  arr = [(w+margin)*(i%c), (h+margin)*Math.floor(i/c), ((w+margin)*(i%c)+w-margin), (h+margin)*Math.floor(i/c), ((w+margin)*(i%c)+w-margin), ((h+margin)*Math.floor(i/c) + h-margin), (w+margin)*(i%c), ((h+margin)*Math.floor(i/c) + h-margin)];
			  
		 // console.log(i + " ====>>> " + arr + " ||||| " + i%c  + " |||||| " + i/c);  
		  
			  
		  TweenMax.set(gridTile, {webkitClipPath:'polygon('+arr[0]+'px '+ arr[1]+'px,'+arr[2]+'px '+arr[3]+'px, '+arr[4]+'px '+ arr[5] +'px, '+arr[6]+'px '+ arr[7] +'px)', clipPath:'polygon('+arr[0]+'px '+ arr[1]+'px,'+arr[2]+'px '+arr[3]+'px, '+arr[4]+'px '+ arr[5] +'px, '+arr[6]+'px '+ arr[7] +'px)'});
			 
		  container.appendChild(gridTile);    
		  
		  fixTilePosition(gridTile, i);
		}
		
		placeholder.addEventListener("mouseover", function(e){
		  var allTiles = e.currentTarget.querySelectorAll(".gridTile");
		  for (var t=0, le = allTiles.length; t < le; t++)
			{
			  TweenMax.to(allTiles[t], defaults.animTime, {css:{backgroundPosition:"0px 0px"}, ease:Power1.easeOut});
			}
		})
								   
		placeholder.addEventListener("mouseleave", function(e){
		  var allTiles = e.currentTarget.querySelectorAll(".gridTile");
		  for (var ti=0, len = allTiles.length; ti < len; ti++)
			{
			  fixTilePosition(allTiles[ti], ti, defaults.animTime);
			}
		})
		
		function fixTilePosition(tile, ind, time)
		{
		  if(time==null)time=0;
		  var centr, centrCol, centrRow, offsetW, offsetH, left, top;
		  
		  centr = Math.floor(c * r / 2);
		  centrCol = Math.ceil(centr/c);
		  centrRow = Math.ceil(centr/r);
			  
		  offsetW = w/centrCol;
		  offsetH = h/centrRow;
		  
		  left = (Math.round((ind % c - centrCol + 1) * offsetW));
		  top = (Math.round((Math.floor(ind/c) - centrRow + 1) * offsetH));
		  
		  //console.log(left, top)
		  
		  TweenMax.to(tile, time, {css:{backgroundPosition:left+"px "+top+"px"}, ease:Power1.easeOut});
		}
	  }
	  
	  ImageGrid(options);