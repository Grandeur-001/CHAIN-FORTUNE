const cursorDot = document.getElementById('cursor-dot');
const cursorOutline = document.getElementById('cursor-outline');

cursorDot.style.opacity = 0;
cursorOutline.style.opacity = 0;

let mouseX = 0;
let mouseY = 0;

let outlineX = 0;
let outlineY = 0;

document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    
    if (cursorDot.style.opacity === '0') {
        cursorDot.style.opacity = 1;
        cursorOutline.style.opacity = 1;
    }
    
    cursorDot.style.left = `${mouseX}px`;
    cursorDot.style.top = `${mouseY}px`;
});

const interactiveElements = document.querySelectorAll('a, button, .interactive');

interactiveElements.forEach(el => {
    el.addEventListener('mouseenter', () => {
        cursorOutline.style.width = '60px';
        cursorOutline.style.height = '60px';
        cursorOutline.style.borderColor = 'rgba(255, 255, 255, 0.8)';
        cursorDot.style.transform = 'translate(-50%, -50%) scale(1.5)';
    });
    
    el.addEventListener('mouseleave', () => {
        cursorOutline.style.width = '40px';
        cursorOutline.style.height = '40px';
        cursorOutline.style.borderColor = 'rgba(180, 180, 180, 0.8)';
        cursorDot.style.transform = 'translate(-50%, -50%) scale(1)';
    });
});

function animateCursor() {
    const easing = 0.2;
    outlineX += (mouseX - outlineX) * easing;
    outlineY += (mouseY - outlineY) * easing;
    
    cursorOutline.style.left = `${outlineX}px`;
    cursorOutline.style.top = `${outlineY}px`;
    
    requestAnimationFrame(animateCursor);
}

animateCursor();

document.addEventListener('mouseout', (e) => {
    if (e.relatedTarget === null) {
        cursorDot.style.opacity = 0;
        cursorOutline.style.opacity = 0;
    }
});

document.addEventListener('mouseover', () => {
    cursorDot.style.opacity = 1;
    cursorOutline.style.opacity = 1;
});