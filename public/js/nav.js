//alert(1) 
//to do
var btns =  
$("#navbar1 .navbar-nav mr-auto .nav-link"); 

for (var i = 0; i < btns.length; i++) { 
btns[i].addEventListener("click", 
                      function () { 
    var current = document
        .getElementsByClassName("active"); 

    current[0].className = current[0] 
        .className.replace(" active", ""); 

    this.className += " active"; 
}); 
} 
