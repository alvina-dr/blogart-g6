// var options = {
//     container:document.querySelector(".collage_container"),
//     piecesNum:50,
//     imgSrc : "https://unsplash.it/800/500?image=433"
//     // imgSrc : "../assets/images/insolite.png"

//   }
  
  
//   function ImageCollage(defaults)
//   {
//     var container = defaults.container;
//     var containerWidth = container.offsetWidth;
//     var containerHeight = container.offsetHeight;
//     var containerStyle = container.currentStyle || window.getComputedStyle(container);
//     var piecesNum = defaults.piecesNum;
//     var levelIndex = Math.floor(piecesNum * 0.75);
//     var maxsizeX = Math.round(container.offsetWidth/2);
//     var maxsizeY = Math.round(container.offsetHeight/2);
//     var offset = 15;
//     var strength = 3;
    
//     for (var i=0; i < piecesNum; i++)
//       {
//         var piece = document.createElement('div');
//         piece.className = "collage_piece";
        
       
//         if(i < levelIndex){
//           piece.classList += " level_1";     
//           piece.dataset.level = 1;
//           piece.style.width = getRandomInt(100,  maxsizeX) + "px";
//           piece.style.height = getRandomInt(100, maxsizeY) + "px";
          
//         }else{
//           piece.classList += " level_2";
//           piece.dataset.level = 2;
//           piece.style.width = getRandomInt(40,  maxsizeX/2) + "px";
//           piece.style.height = getRandomInt(40, maxsizeY/2) + "px";
//         }
              
//         piece.style.backgroundImage = "url("+defaults.imgSrc+")";      
//         container.appendChild(piece);
        
//         piece.dataset.offset = getRandomInt(strength, strength*2*piece.dataset.level);
//         piece.style.backgroundSize = ""+ containerWidth +"px "+ containerHeight +"px";
//         piece.style.left = getRandomInt(0, containerWidth-piece.offsetWidth) + "px";
//         piece.style.top = getRandomInt(0, containerHeight-piece.offsetHeight) + "px";
//         piece.style.backgroundPosition = -(piece.offsetLeft) + "px " + (-piece.offsetTop) + "px";
        
//         console.log(containerStyle.marginLeft, containerStyle.marginTop);
//       }
    
//     window.addEventListener("mousemove", function(e){
//       var pieces = container.querySelectorAll(".collage_piece");
//       var xpos, ypos, mouseX, mouseY, levelNum, off;
      
      
//       if (!mie) {
//           mouseX = e.pageX; 
//           mouseY = e.pageY;
//       }
//       else {
//           mouseX = event.clientX + document.body.scrollLeft;
//           mouseY = event.clientY + document.body.scrollTop;
//       }
      
//       for (var p=0, l=pieces.length; p < l ; p++)
//         {
//           levelNum = pieces[p].dataset.level;
//           off = pieces[p].dataset.offset;
//           xpos = ( -mouseX/2 + containerWidth/2) / (off - levelNum);
//           ypos = ( -mouseY/2 + containerHeight/2) / (off - levelNum);
//           TweenMax.set(pieces[p],  {x:xpos, y:ypos});
//         }
//     })
    
    
//     var mie = (navigator.appName == "Microsoft Internet Explorer") ? true : false;  
//     function getRandomInt(min, max) {
//         return Math.floor(Math.random() * (max - min + 1)) + min;
//     }
//   }
  
//   ImageCollage(options);