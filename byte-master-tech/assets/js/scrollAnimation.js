const items = document.querySelectorAll(`.move_in`);
window.addEventListener(`scroll`, startAnimation);


function startAnimation() {
    const trigger = (window.innerHeight / 4.6 * 4);
    items.forEach(box => {
    const boxTop = box.getBoundingClientRect().top;

    if(boxTop < trigger - 100){
        box.classList.add(`visible`);
    }
    else{
        box.classList.remove(`visible`)
    }
    });
}

    
