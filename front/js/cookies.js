let togg2 = document.getElementById("togg2");
let d1 = document.getElementById("d1");

togg2.addEventListener("click", () => {
    if(getComputedStyle(d1).display != "none"){
      d1.style.display = "none";
    } else {
      d1.style.display = "block";
    }
  })
