
  // Floating papers animation
  function createFloatingPapers() {
    const container = document.getElementById('floating-papers');
    const paperCount = 6;
    
    for (let i = 0; i < paperCount; i++) {
      const paper = document.createElement('div');
      paper.className = 'paper';
      
      // Add paper icon
      paper.innerHTML = `
        <svg class="paper-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
        </svg>
      `;
      
      // Set random initial position
      const windowWidth = window.innerWidth;
      const windowHeight = window.innerHeight;
      
      paper.style.left = `${Math.random() * windowWidth}px`;
      paper.style.top = `${Math.random() * windowHeight}px`;
      
      container.appendChild(paper);
      
      // Animate the paper
      animatePaper(paper, windowWidth, windowHeight);
    }
  }

  function animatePaper(paper, windowWidth, windowHeight) {
    // Generate random positions for animation
    const positions = [
      {
        x: Math.random() * windowWidth,
        y: Math.random() * windowHeight,
        rotation: Math.random() * 360
      },
      {
        x: Math.random() * windowWidth,
        y: Math.random() * windowHeight,
        rotation: Math.random() * 360
      },
      {
        x: Math.random() * windowWidth,
        y: Math.random() * windowHeight,
        rotation: Math.random() * 360
      }
    ];
    
    // Animation duration between 20-30 seconds
    const duration = 20000 + Math.random() * 10000;
    let startTime = null;
    let currentPosition = 0;
    
    function animate(timestamp) {
      if (!startTime) startTime = timestamp;
      const elapsed = timestamp - startTime;
      
      // Calculate progress between current position and next position
      const positionProgress = (elapsed % (duration / 3)) / (duration / 3);
      const currentIndex = Math.floor((elapsed % duration) / (duration / 3));
      const nextIndex = (currentIndex + 1) % 3;
      
      // Interpolate between positions
      const currentPos = positions[currentIndex];
      const nextPos = positions[nextIndex];
      
      const x = currentPos.x + (nextPos.x - currentPos.x) * positionProgress;
      const y = currentPos.y + (nextPos.y - currentPos.y) * positionProgress;
      const rotation = currentPos.rotation + (nextPos.rotation - currentPos.rotation) * positionProgress;
      
      // Apply the new position
      paper.style.transform = `translate(${x}px, ${y}px) rotate(${rotation}deg)`;
      
      requestAnimationFrame(animate);
    }
    
    requestAnimationFrame(animate);
  }

  // Three.js particles
  function initParticles() {
    // Create scene
    const scene = new THREE.Scene();
    
    // Create camera
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 50;
    
    // Create renderer
    const renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setClearColor(0x000000, 0);
    
    // Add renderer to DOM
    document.getElementById('particles-canvas').appendChild(renderer.domElement);
    
    // Create particles
    const particlesGeometry = new THREE.BufferGeometry();
    const particleCount = 1000; // Increased from 100 to 1000
    
    const positions = new Float32Array(particleCount * 3);
    const sizes = new Float32Array(particleCount);
    
    for (let i = 0; i < particleCount; i++) {
      // Position
      positions[i * 3] = (Math.random() - 0.5) * 100;
      positions[i * 3 + 1] = (Math.random() - 0.5) * 100;
      positions[i * 3 + 2] = (Math.random() - 0.5) * 100;
      
      // Size - making particles smaller
      sizes[i] = Math.random() * 0.3 + 0.1; // Reduced from 0.8+0.6 to 0.3+0.1
    }
    
    particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    particlesGeometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1));
    
    // Create material
    const particlesMaterial = new THREE.PointsMaterial({
      color: 0xffffff,
      size: 0.2, // Reduced from 1 to 0.5
      transparent: true,
      opacity: 0.8,
      sizeAttenuation: true
    });
    
    // Create points
    const particles = new THREE.Points(particlesGeometry, particlesMaterial);
    scene.add(particles);
    
    // Mouse interaction
    let mouseX = 0;
    let mouseY = 0;
    
    document.addEventListener('mousemove', (event) => {
      mouseX = (event.clientX / window.innerWidth) * 2 - 1;
      mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
      
      // Add this to make particles move in the direction of mouse movement
      const positions = particlesGeometry.attributes.position.array;
      for (let i = 0; i < particleCount; i++) {
        // Apply a small force in the mouse direction
        positions[i * 3] += mouseX * 0.1;
        positions[i * 3 + 1] += mouseY * 0.1;
      }
      particlesGeometry.attributes.position.needsUpdate = true;
    });
    
    // Animation loop
    function animate() {
      requestAnimationFrame(animate);
      
      // Rotate particles
      particles.rotation.x += 0.0009;
      particles.rotation.y += 0.0009;
      
      // Mouse interaction
      particles.rotation.x += mouseY * 0.02; // Increased from 0.0005 to 0.02
      particles.rotation.y += mouseX * 0.02; // Increased from 0.0005 to 0.02
      
      // Update particle positions
      const positions = particlesGeometry.attributes.position.array;
      
      for (let i = 0; i < particleCount; i++) {
        // Slow movement
        positions[i * 3] += Math.sin(i + Date.now() * 0.0001) * 0.01;
        positions[i * 3 + 1] += Math.cos(i + Date.now() * 0.0001) * 0.01;
      }
      
      particlesGeometry.attributes.position.needsUpdate = true;
      
      renderer.render(scene, camera);
    }
    
    animate();
    
    // Handle window resize
    window.addEventListener('resize', () => {
      camera.aspect = window.innerWidth / window.innerHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(window.innerWidth, window.innerHeight);
    });
  }