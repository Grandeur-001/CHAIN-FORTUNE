<style>

:root {


  /* Additional design system variables */
  --btc-color: #5966fe;
  --xrp-color: #1f2638;
  --ltc-color: #2c2c3d;
  
  /* Spacing system */
  --spacing-xs: 4px;
  --spacing-sm: 8px;
  --spacing-md: 16px;
  --spacing-lg: 24px;
  --spacing-xl: 32px;
  --spacing-2xl: 48px;
  
  /* Border radius */
  --radius-sm: 4px;
  --radius-md: 8px;
  --radius-lg: 16px;
  
  /* Transition */
  --transition-fast: 0.15s ease;
  --transition-normal: 0.3s ease;
  
  /* Shadows */
  --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
  --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.15);
  --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.2);
}



/* Reset & base styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  height: 100%;
}

/* Remove default button styling */
button {
  border: none;
  background: none;
  font-family: inherit;
  color: inherit;
  cursor: pointer;
  padding: 0;
}

/* Improved focus states */
:focus {
  outline: 2px solid var(--accent-clr);
  outline-offset: 2px;
}

:focus:not(:focus-visible) {
  outline: none;
}

img {
  max-width: 100%;
  height: auto;
  display: block;
}

/* More readable text */
body {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-rendering: optimizeLegibility;
}




.wallet-container-main{
    
}

/* Wallet container */
.wallet-container {
  overflow-x: scroll;
  display: grid;
  grid-template-columns: auto auto auto;
  /* grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); */
  gap: var(--spacing-lg);
  margin-bottom: var(--spacing-2xl);
  padding-block: 30px;
  font-family: 'Inter', sans-serif;

}

.wallet-container::-webkit-scrollbar {
    /* width: 5px; */
    height: 9px;
}

.wallet-container::-webkit-scrollbar-track {
    background: var(--hover-clr);
    border-radius: 4px;
}

.wallet-container::-webkit-scrollbar-thumb {
    background: var(--line-clr);
    border-radius: 4px;
}

.wallet-container::-webkit-scrollbar-thumb:hover {
    background: var(--accent-clr);
}

/* Wallet card styles */
.wallet-card {
  background-color: var(--base-clr);
  border-radius: 7px;
  padding: var(--spacing-xl);
  transition: transform var(--transition-normal), box-shadow var(--transition-normal);
  position: relative;
  overflow: none;
  border: 1px solid var(--line-clr);
}

.wallet-card:hover {
  /* transform: translateY(-4px); */
  box-shadow: var(--shadow-md);
  background: var(--hover-clr);
}





/* Wallet header */
.wallet-header2 {
  display: flex;
  align-items: center;
  margin-bottom: var(--spacing-lg);
  position: relative;
}

.wallet-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: var(--hover-clr);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: var(--spacing-md);
  font-size: 1.25rem;
  font-weight: bold;
}
.wallet-icon img{
    max-width: 100%;
}



.wallet-name {
  font-size: 1.125rem;
  font-weight: 500;
  flex-grow: 1;
}

.copy-btn {
  width: 24px;
  height: 24px;
  position: relative;
  opacity: 0.7;
  transition: opacity var(--transition-fast);
}

.copy-btn:hover {
  opacity: 1;
}

.copy-btn::before, 
.copy-btn::after {
  content: "";
  position: absolute;
  background-color: var(--secondary-text-clr);
  border-radius: 2px;
}

.copy-btn::before {
  width: 14px;
  height: 16px;
  border: 1px solid var(--secondary-text-clr);
  right: 0;
  bottom: 0;
}

.copy-btn::after {
  width: 10px;
  height: 12px;
  border: 1px solid var(--secondary-text-clr);
  left: 2px;
  top: 0;
  background-color: transparent;
}

/* Wallet balance */
.wallet-balance {
  margin-bottom: var(--spacing-xl);
  padding-bottom: var(--spacing-lg);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.crypto-amount {
  font-size: 1.75rem;
  font-weight: 600;
  margin-bottom: var(--spacing-xs);
}

.crypto-amount span {
  font-size: 1.6rem;
  font-weight: 500;
}

.usd-amount {
  font-size: 1rem;
  color: rgba(255, 255, 255, 0.7);
  font-weight: 600;
}

/* Wallet actions */
.wallet-actions {
  display: flex;
  gap: var(--spacing-md);
  
}

.action-btn {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 7px;
  /* background-color: var(--hover-clr); */
  border: 1px solid var(--line-clr);
  color: var(--text-clr);
  font-size: 0.875rem;
  font-weight: 500;
  transition: background var(--transition-fast);
  padding: 10px 17px;

  &:hover{
    background: var(--accent-clr);
    /* border: none; */
  }
}










/* Responsive styles */

/* Large screens (default) */
@media (min-width: 1200px) {
  .wallet-container {
    grid-template-columns: repeat(3, 1fr);
  }
}



body {
  font-family: 'Inter', sans-serif;
  color: var(--text-clr);
  line-height: 1.5;
  min-height: 100vh;
}


</style>
<body>
<br>
  <div class="wallet-container-main">
    <main class="wallet-container">
      <?php  
        include("../../../backend/fetch_big_wallet.php");
      ?>
    </main>
  </div>
</body>
</html>