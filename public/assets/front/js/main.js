const slidePage = document.querySelector(".slidePage"); 
const firstNextBtn = document.querySelector(".next-btn");  
const prevBtn1 = document.querySelector(".prev1-btn");     
const secNextBtn = document.querySelector(".next1-btn");

const progressText = document.querySelectorAll(".step p"); 
const progressCheck = document.querySelectorAll(".step .check");  
const bullet = document.querySelectorAll(".step .bullet");   

let current = 1;

firstNextBtn.addEventListener("click", function(){
    slidePage.style.marginRight = "-25%";             
    bullet[current - 1].classList.add("active");      
    progressText[current - 1].classList.add("active"); 
    progressCheck[current - 1].classList.add("active"); 
    current +=1;
});

secNextBtn.addEventListener("click", function(){
    bullet[current - 1].classList.add("active");
    progressText[current - 1].classList.add("active");
    progressCheck[current - 1].classList.add("active");
    current +=1;
});

prevBtn1.addEventListener("click", function(){
    slidePage.style.marginRight = "0%";
    bullet[current - 2].classList.remove("active");
    progressText[current - 2].classList.remove("active");
    progressCheck[current - 2].classList.remove("active");
    current -=1;
});





var incrementButton = document.getElementsByClassName('inc');
var decrementButton = document.getElementsByClassName('dec');

// increment
for(var i = 0; i < incrementButton.length; i++){
    var button = incrementButton[i];
    button.addEventListener('click', function(e){

        var buttonClicked = e.target;
        var inputField = buttonClicked.parentElement.children[1];
        var inputValue = inputField.value;
        var newValue = parseInt(inputValue) + 1;
        inputField.value = newValue;
        // console.log(newValue);
    });
}

// decrement
for(var i = 0; i < decrementButton.length; i++){
    var button = decrementButton[i];
    button.addEventListener('click', function(e){

        var buttonClicked = e.target;
        var inputField = buttonClicked.parentElement.children[1];
        var inputValue = inputField.value;
        var newValue = parseInt(inputValue) - 1;
        // condition not negative number
        if(newValue > 0){
            inputField.value = newValue;
        }else{
            inputField.value = 0;
        }
        });
}
