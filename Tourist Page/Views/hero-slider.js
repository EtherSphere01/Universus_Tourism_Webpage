const left = document.querySelector('.left');
const right = document.querySelector('.right');
const slider = document.querySelector('.slider');
const images = document.querySelectorAll('.image');

let slideNumber = 1;
const length = images.length;

const  nextSlide = ()=>{
    slider.style.transform = `translateX(-${slideNumber*95}vw)`; 
    slideNumber++;
}

const prevSlide = ()=>{
    slider.style.transform = `translateX(-${(slideNumber-2)*95}vw)`; 
    slideNumber--;
}


const getFirstSlide = ()=>{
    slider.style.transform = `translateX(0px)`; 
    slideNumber=1;
}

const getLastSlide = ()=>{
    slider.style.transform = `translateX(-${(length-1)*95}vw)`; 
    slideNumber=length;
}



right.addEventListener('click', ()=>{
    if(slideNumber<length){nextSlide();}
    else{getFirstSlide();};
});

left.addEventListener('click', ()=>{
    if(slideNumber>1){
        prevSlide();
    }
    else{
        getLastSlide();
    };
});

