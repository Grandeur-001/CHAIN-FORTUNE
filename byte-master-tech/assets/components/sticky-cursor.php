<style>
    .cursor-dot {
        width: 8px;
        height: 8px;
        background-color: white;
        border-radius: 50%;
        position: fixed;
        pointer-events: none;
        z-index: 2000;
        transform: translate(-50%, -50%);
        transition: transform 0.1s ease;
    }
    
    .cursor-outline {
        width: 40px;
        height: 40px;
        border: 2px solid rgba(180, 180, 180, 0.8);
        border-radius: 50%;
        position: fixed;
        pointer-events: none;
        z-index: 2000;
        transform: translate(-50%, -50%);
        transition: transform 0.15s ease, width 0.2s ease, height 0.2s ease;
    }
        

        

</style>
<div class="cursor-dot" id="cursor-dot"></div>
<div class="cursor-outline" id="cursor-outline"></div>
<script>
    // Get cursor elements
    const cursorDot = document.getElementById('cursor-dot');
    const cursorOutline = document.getElementById('cursor-outline');
    
    // Set initial position off-screen
    cursorDot.style.opacity = 0;
    cursorOutline.style.opacity = 0;
    
    // Mouse position tracking variables
    let mouseX = 0;
    let mouseY = 0;
    
    // Smoothing variables for the outline
    let outlineX = 0;
    let outlineY = 0;
    
    // Track mouse position
    document.addEventListener('mousemove', (e) => {
        // Update mouse position
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        // Show cursors if they were hidden
        if (cursorDot.style.opacity === '0') {
            cursorDot.style.opacity = 1;
            cursorOutline.style.opacity = 1;
        }
        
        // Update dot position immediately
        cursorDot.style.left = `${mouseX}px`;
        cursorDot.style.top = `${mouseY}px`;
    });
    
    // Handle cursor on interactive elements
    const interactiveElements = document.querySelectorAll('a, button, .interactive');
    
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            // Expand the outline on hover
            cursorOutline.style.width = '60px';
            cursorOutline.style.height = '60px';
            cursorOutline.style.borderColor = 'rgba(255, 255, 255, 0.8)';
            cursorDot.style.transform = 'translate(-50%, -50%) scale(1.5)';
        });
        
        el.addEventListener('mouseleave', () => {
            // Return to normal size
            cursorOutline.style.width = '40px';
            cursorOutline.style.height = '40px';
            cursorOutline.style.borderColor = 'rgba(180, 180, 180, 0.8)';
            cursorDot.style.transform = 'translate(-50%, -50%) scale(1)';
        });
    });
    
    // Animation loop for smooth cursor movement
    function animateCursor() {
        // Calculate smooth movement for outline with easing
        const easing = 0.2;
        outlineX += (mouseX - outlineX) * easing;
        outlineY += (mouseY - outlineY) * easing;
        
        // Apply positions
        cursorOutline.style.left = `${outlineX}px`;
        cursorOutline.style.top = `${outlineY}px`;
        
        // Continue animation
        requestAnimationFrame(animateCursor);
    }
    
    // Start animation
    animateCursor();
    
    // Hide cursor when mouse leaves window
    document.addEventListener('mouseout', (e) => {
        if (e.relatedTarget === null) {
            cursorDot.style.opacity = 0;
            cursorOutline.style.opacity = 0;
        }
    });
    
    // Show cursor when mouse enters window
    document.addEventListener('mouseover', () => {
        cursorDot.style.opacity = 1;
        cursorOutline.style.opacity = 1;
    });
</script>