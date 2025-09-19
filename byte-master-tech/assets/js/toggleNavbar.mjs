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
