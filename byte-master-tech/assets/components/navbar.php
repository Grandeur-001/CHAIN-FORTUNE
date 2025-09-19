<?php include("./assets/components/loader.php"); ?>
  <script src="./assets/js/Three.mjs"></script>
  <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
  <style>
      #canvas-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1000;
        opacity: 0.4;
    }
    /* Base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    body{
      overflow-x: hidden;
    }

    html::-webkit-scrollbar {
        width: 8px;
    }

    html::-webkit-scrollbar-track {
        background: transparent;
    }

    html::-webkit-scrollbar-thumb {
        background: var(--line-clr);
        border-radius: 4px;
    }

    html::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-text-clr);
    }

    .bg-grid {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: 30px 30px;
      background-image: linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
      linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
      z-index: -1;
    }

    /* Navbar styles */
    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 1.5rem;
      backdrop-filter: blur(4px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      position: relative;
      z-index: 9999;
      transition: all 1s ease;
      position: fixed;
      top: 0;
      width: 100%;
  
  
      
    }
    .navbar.show{
      top: -1000px
    }
    


    .logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
      color: white;
    }

    .logo-icon {
      color: var(--accent-clr);
    }

    .logo-text {
      font-size: 1.25rem;
      font-weight: 500;
    }

    .nav-links {
      display: none;
    }

    .nav-link {
      color: var(--secondary-text-clr);
      text-decoration: none;
      position: relative;
      transition: color 0.3s;
      font-size: 18px;
      font-weight: 400;
    }

    .nav-link:hover {
      color: var(--accent-clr);
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 0;
      height: 2px;
      background-color: var(--accent-clr);
      transition: width 0.3s;
    }

    .nav-link:hover::after {
      width: 100%;
    }


    .auth-buttons {
      display: none;
    }

    .btn {
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      border: none;
      font-size: 0.875rem;
    }

    .btn-ghost {
      background: transparent;
      color: white;
    }

    .btn-ghost:hover {
      color: var(--accent-clr);
    }

    .btn-primary {
      background-color: var(--accent-clr);
      color: white;
    }

    .btn-primary:hover {
      background-color: #7e22ce;
    }

    .btn-outline {
      background: transparent;
      border: 1px solid #a855f7;
      color: white;
    }

    .btn-outline:hover {
      background-color: rgba(168, 85, 247, 0.2);
    }

    .menu-button {
      background: transparent;
      border: none;
      color: white;
      cursor: pointer;
      font-size: 1.5rem;
      z-index: 101; /* Higher than sidebar */
    }

    /* Mobile Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: -280px; /* Start off-screen */
      width: 280px;
      height: 100vh;
      background-color: var(--black-clr);
      backdrop-filter: blur(10px);
      z-index: 100;
      transition: left 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
      border-left: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      flex-direction: column;
      padding: 5rem 1.5rem 2rem;
      overflow-y: auto;
    }

    .sidebar.open {
      left: 0;
    }

    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 99;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .sidebar-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .sidebar-nav {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      padding: 0.75rem 1rem;
      color: var(--secondary-text-clr);
      text-decoration: none;
      border-radius: 0.375rem;
      font-size: 1.125rem;

      transform: translateX(-150px);
      visibility: hidden;
      transition: transform .4s ease-out, visibility .4s;
    }

    .sidebar-link:nth-child(1) {
      transition-delay: .1s;
    }
    .sidebar-link:nth-child(2) {
      transition-delay: .2s;
    }
    .sidebar-link:nth-child(3) {
      transition-delay: .3s;
    }
    .sidebar-link:nth-child(4) {
      transition-delay: .4s;
    }
    .sidebar-link:nth-child(5) {
      transition-delay: .5s;
    }

    .sidebar.open .sidebar-link {
      transform: translateX(0);
      visibility: visible;
    }

    .sidebar-link:hover {
      background-color: var(--hover-clr);
      color: var(--text-clr);
    }

    .sidebar-link svg {
      margin-right: 0.75rem;
    }

    .sidebar-divider {
      height: 1px;
      background-color: rgba(255, 255, 255, 0.1);
      margin: 1rem 0;
      width: 100%;
    }

    .sidebar-buttons {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      margin-top: auto;
      overflow-x: hidden;
      text-align: center;

      transform: translateX(-150px);
      visibility: hidden;
      transition: transform .4s ease-out, visibility .4s;
      transition-delay: .6s;
    }
  
    .sidebar.open .sidebar-buttons {
      transform: translateX(0);
      visibility: visible;
    }



    /* Hero section styles */
    .hero {
      position: relative;
      min-height: calc(100vh - 76px);
      display: flex;
      align-items: center;
      overflow: hidden;
    }

    .container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1.5rem;
      position: relative;
      z-index: 10;
    }

    .hero-content {
      max-width: 48rem;
      margin: 0 auto;
      text-align: center;
      padding: 5rem 0;
    }

    .hero-title {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.5s, transform 0.5s;
    }

    .hero-title.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .gradient-text {
      background: linear-gradient(to right, #c084fc, var(--accent-clr));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .hero-description {
      color: #9ca3af;
      font-size: 1.25rem;
      margin-bottom: 2rem;
      max-width: 36rem;
      margin-left: auto;
      margin-right: auto;
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.5s 0.2s, transform 0.5s 0.2s;
    }

    .hero-description.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .hero-buttons {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.5s 0.4s, transform 0.5s 0.4s;
    }

    .hero-buttons.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .btn-large {
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    /* Floating papers */
    .floating-papers {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      pointer-events: none;
    }

    .paper {
      position: absolute;
      width: 4rem;
      height: 5rem;
      background-color: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(4px);
      border-radius: 0.5rem;
      border: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s;
    }

    .paper-icon {
      width: 2rem;
      height: 2rem;
      color: rgba(168, 85, 247, 0.5);
    }

    /* Robot animation */
    .robot-container {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 24rem;
      height: 24rem;
      display: flex;
      align-items: center;
      justify-content: center;
      pointer-events: none;
    }

    .robot {
      position: relative;
      animation: float 4s ease-in-out infinite;
    }

    .robot-glow {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 10rem;
      height: 10rem;
      background-color: rgba(168, 85, 247, 0.2);
      border-radius: 50%;
      filter: blur(2rem);
      animation: pulse 4s ease-in-out infinite;
    }

    .robot-icon {
      position: relative;
      width: 8rem;
      height: 8rem;
      color: #a855f7;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-20px);
      }
    }

    @keyframes pulse {
      0%, 100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.5;
      }
      50% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0.8;
      }
    }

    /* Particles canvas */
    #particles-canvas {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }

    /* Media queries */
    @media (min-width: 768px) {
      .nav-links {
        display: flex;
        align-items: center;
        gap: 2rem;
      }

      .auth-buttons {
        display: flex;
        align-items: center;
        gap: 1rem;
      }

      .menu-button {
        display: none;
      }

      .hero-title {
        font-size: 3.75rem;
      }

      .hero-buttons {
        flex-direction: row;
        justify-content: center;
      }
    }

    @media (min-width: 1024px) {
      .hero-title {
        font-size: 4.5rem;
      }
    }
  </style>


</head>
  <!-- Background grid -->
  <div class="bg-grid"></div>

  <!-- Three.js particles container -->
  <div id="particles-canvas"></div>

  <!-- Mobile sidebar overlay -->
  <div class="sidebar-overlay" id="sidebar-overlay"></div>

  <!-- Mobile sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-nav">
      <a href="index.php" class="sidebar-link">
      <svg width="20" height="20" viewBox="64 64 896 896" fill="none"  stroke="currentColor" focusable="false"><path d="M512.1 172.6l-370 369.7h96V868H392V640c0-22.1 17.9-40 40-40h160c22.1 0 40 17.9 40 40v228h153.9V542.3H882L535.2 195.7l-23.1-23.1zm434.5 422.9c-6 6-13.1 10.8-20.8 13.9 7.7-3.2 14.8-7.9 20.8-13.9zm-887-34.7c5 30.3 31.4 53.5 63.1 53.5h.9c-31.9 0-58.9-23-64-53.5zm-.9-10.5v-1.9 1.9zm.1-2.6c.1-3.1.5-6.1 1-9.1-.6 2.9-.9 6-1 9.1z" fill="none" /><path d="M951 510c0-.1-.1-.1-.1-.2l-1.8-2.1c-.1-.1-.2-.3-.4-.4-.7-.8-1.5-1.6-2.2-2.4L560.1 118.8l-25.9-25.9a31.5 31.5 0 00-44.4 0L77.5 505a63.6 63.6 0 00-16 26.6l-.6 2.1-.3 1.1-.3 1.2c-.2.7-.3 1.4-.4 2.1 0 .1 0 .3-.1.4-.6 3-.9 6-1 9.1v3.3c0 .5 0 1 .1 1.5 0 .5 0 .9.1 1.4 0 .5.1 1 .1 1.5 0 .6.1 1.2.2 1.8 0 .3.1.6.1.9l.3 2.5v.1c5.1 30.5 32.2 53.5 64 53.5h42.5V940h691.7V614.3h43.4c8.6 0 16.9-1.7 24.5-4.9s14.7-7.9 20.8-13.9a63.6 63.6 0 0018.7-45.3c0-14.7-5-28.8-14.3-40.2zM568 868H456V664h112v204zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7 23.1 23.1L882 542.3h-96.1z" fill="currentColor" /></svg>
        Home
      </a>
      <a href="about-us.php" class="sidebar-link">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
        </svg>
        About
      </a>
      <a href="services.php" class="sidebar-link">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
          <path d="M12 17h.01"></path>
        </svg>
        Services
      </a>
      <a href="contact.php" class="sidebar-link">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect width="7" height="7" x="3" y="3" rx="1"></rect>
          <rect width="7" height="7" x="14" y="3" rx="1"></rect>
          <rect width="7" height="7" x="14" y="14" rx="1"></rect>
          <rect width="7" height="7" x="3" y="14" rx="1"></rect>
        </svg>
        Contact
      </a>
      <a href="#" class="sidebar-link">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 2v20"></path>
          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
        </svg>
        Blog
      </a>
    </div>
    
    <div class="sidebar-divider"></div>
    
    <div class="sidebar-buttons">
        <?php 
          $buttonText = "Get Started";
          $buttonHref = "contact.php";
          include("./assets/components/button.php"); 
        ?>
        <!--  -->
         <?php 
          $buttonText = "Pay";
          $buttonHref = "https://flutterwave.com/pay/bytemasters-pay";
          include("./assets/components/button2.php"); 
        ?>
    </div>
  </div>

  <!-- Main content -->
  <div class="relative">
    <!-- Navbar -->
    <nav class="navbar">
      <a style="font-size: 30px;" href="index.php" class="logo">
        ⚡
        <span class="logo-text">ByteMasters</span>
      </a>

      <div class="nav-links">
        <a href="index.php" class="nav-link">Home</a>
        <a href="about-us.php" class="nav-link">About</a>
        <a href="services.php" class="nav-link">Services</a>
        <a href="contact.php" class="nav-link">Contact</a>
        <a href="#" class="nav-link">Blog</a>
      </div>

      <div class="auth-buttons">
      <?php 
          $buttonText = "Pay";
          $buttonHref = "https://flutterwave.com/pay/bytemasters-pay";
          include("./assets/components/button2.php"); 
        ?>
      <?php 
          $buttonText = "Get Started";
          $buttonHref = "contact.php";
          include("./assets/components/button.php"); 
        ?>
      </div>

      <button class="menu-button" id="menu-button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="4" x2="20" y1="12" y2="12"></line>
          <line x1="4" x2="20" y1="6" y2="6"></line>
          <line x1="4" x2="20" y1="18" y2="18"></line>
        </svg>
      </button>
    </nav>


  </div>

  <script>
    const navbar = document.querySelector('.navbar');

    window.addEventListener(`scroll`, () =>{
        if(window.scrollY > 500){
          navbar.classList.add('show')
          setTimeout(() =>{
            navbar.classList.remove('show');
            navbar.style.background = "var(--base-clr)";
          }, 1000);
        }
        else{
          navbar.classList.remove('show')
          navbar.style.background = "transparent";
        }
    });

    function initSidebar() {
      const menuButton = document.getElementById('menu-button');
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebar-overlay');
      
      menuButton.addEventListener('click', () => {
        toggleSidebar();
      });
      
      overlay.addEventListener('click', () => {
        closeSidebar();
      });
      
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          closeSidebar();
        }
      });
      
      function toggleSidebar() {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
        
        if (sidebar.classList.contains('open')) {
          menuButton.innerHTML = `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 6 6 18"></path>
              <path d="m6 6 12 12"></path>
            </svg>
          `;
        } else {
          menuButton.innerHTML = `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="4" x2="20" y1="12" y2="12"></line>
              <line x1="4" x2="20" y1="6" y2="6"></line>
              <line x1="4" x2="20" y1="18" y2="18"></line>
            </svg>
          `;
        }
        
        document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
      }
      
      function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
        
        menuButton.innerHTML = `
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="4" x2="20" y1="12" y2="12"></line>
            <line x1="4" x2="20" y1="6" y2="6"></line>
            <line x1="4" x2="20" y1="18" y2="18"></line>
          </svg>
        `;
      }
    }
    
    document.addEventListener('DOMContentLoaded', () => {
      initSidebar();
    });

    document.addEventListener('DOMContentLoaded', () => {
      setTimeout(() => {
        document.querySelector('.hero-title').classList.add('visible');
      }, 100);
      
      setTimeout(() => {
        document.querySelector('.hero-description').classList.add('visible');
      }, 300);
      
      setTimeout(() => {
        document.querySelector('.hero-buttons').classList.add('visible');
      }, 500);

      createFloatingPapers();
      
      initParticles();
    });

  </script>
  
  <script>
      window.addEventListener('load', () => {
          const scene = new THREE.Scene();
          const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
          const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
          
          renderer.setSize(window.innerWidth, window.innerHeight);
          document.getElementById('canvas-container').appendChild(renderer.domElement);

          // Create texture loader
          const textureLoader = new THREE.TextureLoader();
          
          // Create programming language logos
          const logos = [];
          const logoGeometry = new THREE.BoxGeometry(1, 1, 1);
          
          // Define logo image paths - replace these with your actual image paths
          const logoMaterials = [
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/C++-Logo.wine (1).svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/PHP-Logo.wine.svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/Dart_(programming_language)-Logo.wine.svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/Swift_(programming_language)-Logo.wine.svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/Python_(programming_language)-Logo.wine.svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/React_(web_framework)-Logo.wine.svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/Java_(programming_language)-Logo.wine.svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/Node.js-Logo.wine.svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/Ruby_on_Rails-Logo.wine.svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/Laravel-Logo.wine.svg') }), 
              new THREE.MeshBasicMaterial({ map: textureLoader.load('./assets/images/Go_(programming_language)-Logo.wine.svg') })  
          ];

          for (let i = 0; i < 20; i++) {
              const material = logoMaterials[Math.floor(Math.random() * logoMaterials.length)];
              const logo = new THREE.Mesh(logoGeometry, material);
              
              logo.position.x = Math.random() * 20 - 10;
              logo.position.y = Math.random() * 20 - 10;
              logo.position.z = Math.random() * 20 - 10;
              
              logo.velocity = {
                  x: (Math.random() - 0.5) * 0.05,
                  y: (Math.random() - 0.5) * 0.05,
                  z: (Math.random() - 0.5) * 0.05
              };
              
              logos.push(logo);
              scene.add(logo);
          }

          camera.position.z = 15;

          function animate() {
              requestAnimationFrame(animate);

              logos.forEach(logo => {
                  logo.rotation.x += 0.01;
                  logo.rotation.y += 0.01;
                  
                  logo.position.x += logo.velocity.x;
                  logo.position.y += logo.velocity.y;
                  logo.position.z += logo.velocity.z;
                  
                  // Bounce off boundaries
                  if (Math.abs(logo.position.x) > 10) logo.velocity.x *= -1;
                  if (Math.abs(logo.position.y) > 10) logo.velocity.y *= -1;
                  if (Math.abs(logo.position.z) > 10) logo.velocity.z *= -1;
              });

              renderer.render(scene, camera);
          }

          animate();

          // Handle window resize
          window.addEventListener('resize', () => {
              camera.aspect = window.innerWidth / window.innerHeight;
              camera.updateProjectionMatrix();
              renderer.setSize(window.innerWidth, window.innerHeight);
          });
      });
  </script>



