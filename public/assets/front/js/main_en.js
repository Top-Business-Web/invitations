const slidePage = document.querySelector(".slidePage"); 
const firstNextBtn = document.querySelector(".next-btn");  
const prevBtn1 = document.querySelector(".prev1-btn");     
const secNextBtn = document.querySelector(".next1-btn");

const progressText = document.querySelectorAll(".step p"); 
const progressCheck = document.querySelectorAll(".step .check");  
const bullet = document.querySelectorAll(".step .bullet");   

let current = 1;

firstNextBtn.addEventListener("click", function(){

    // show in english

    slidePage.style.marginLeft = "-25%"; 

    // show  in ar

    // slidePage.style.marginRight = "-25%"; 

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

    // show in english

    slidePage.style.marginLeft = "0%";

    // show  in ar

    // slidePage.style.marginRight = "0%";
    
    bullet[current - 2].classList.remove("active");
    progressText[current - 2].classList.remove("active");
    progressCheck[current - 2].classList.remove("active");
    current -=1;
});


