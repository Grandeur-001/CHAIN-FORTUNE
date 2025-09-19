window.addEventListener('load', () => {
    // Scene setup
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.insertBefore(renderer.domElement, document.body.firstChild);

    // Create background stars
    const starsGeometry = new THREE.BufferGeometry();
    const starsMaterial = new THREE.PointsMaterial({
        color: 0xFFFFFF,
        size: 0.1,
        transparent: true
    });

    // Generate random star positions
    const starsVertices = [];
    for (let i = 0; i < 15000; i++) {
        const x = (Math.random() - 0.5) * 2000;
        const y = (Math.random() - 0.5) * 2000;
        const z = (Math.random() - 0.5) * 2000;
        starsVertices.push(x, y, z);
    }

    starsGeometry.setAttribute('position', new THREE.Float32BufferAttribute(starsVertices, 3));
    const stars = new THREE.Points(starsGeometry, starsMaterial);
    scene.add(stars);

    // Create prominent stars
    const prominentStarsGeometry = new THREE.BufferGeometry();
    const prominentStarsMaterial = new THREE.PointsMaterial({
        color: 0xFFFAF0,
        size: 1.2,
        transparent: true,
        opacity: 0.95
    });

    // Generate prominent star positions
    const prominentStarsVertices = [];
    for (let i = 0; i < 150; i++) {
        const x = (Math.random() - 0.5) * 1200;
        const y = (Math.random() - 0.5) * 1200;
        const z = (Math.random() - 0.5) * 1200;
        prominentStarsVertices.push(x, y, z);
    }

    prominentStarsGeometry.setAttribute('position', new THREE.Float32BufferAttribute(prominentStarsVertices, 3));
    const prominentStars = new THREE.Points(prominentStarsGeometry, prominentStarsMaterial);
    scene.add(prominentStars);

    // Create extra large stars
    const largeStarsGeometry = new THREE.BufferGeometry();
    const largeStarsMaterial = new THREE.PointsMaterial({
        color: 0xFFE5CC,
        size: 2.5,
        transparent: true,
        opacity: 1
    });

    // Generate large star positions
    const largeStarsVertices = [];
    for (let i = 0; i < 50; i++) {
        const x = (Math.random() - 0.5) * 600;
        const y = (Math.random() - 0.5) * 600;
        const z = (Math.random() - 0.5) * 600;
        largeStarsVertices.push(x, y, z);
    }

    largeStarsGeometry.setAttribute('position', new THREE.Float32BufferAttribute(largeStarsVertices, 3));
    const largeStars = new THREE.Points(largeStarsGeometry, largeStarsMaterial);
    scene.add(largeStars);

    // Position camera
    camera.position.z = 5;

    // Animation variables
    let mouseX = 0;
    let mouseY = 0;
    let targetX = 0;
    let targetY = 0;
    const windowHalfX = window.innerWidth / 2;
    const windowHalfY = window.innerHeight / 2;

    // Mouse move event listener
    document.addEventListener('mousemove', (event) => {
        mouseX = (event.clientX - windowHalfX);
        mouseY = (event.clientY - windowHalfY);
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });

    // Animation loop
    function animate() {
        requestAnimationFrame(animate);

        // Smooth camera movement
        targetX = mouseX * 0.001;
        targetY = mouseY * 0.001;
        
        stars.rotation.y += 0.0005;
        prominentStars.rotation.y += 0.0003;
        largeStars.rotation.y += 0.0002;

        camera.rotation.x += (targetY - camera.rotation.x) * 0.05;
        camera.rotation.y += (targetX - camera.rotation.y) * 0.05;

        renderer.render(scene, camera);
    }

    animate();
});