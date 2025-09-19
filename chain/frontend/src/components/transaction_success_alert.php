<!-- 55381567 -->
<!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    /* Base styles */
:root {
  --popup-bg: #18181b;
  --popup-text: #ffffff;
  --popup-border: #27272a;
  --success-color: #10b981;
  --card-bg: #27272a;
  --text-secondary: #a1a1aa;
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
  :root {
    --popup-bg: #ffffff;
    --popup-text: #18181b;
    --popup-border: #e4e4e7;
    --card-bg: #f4f4f5;
    --text-secondary: #71717a;
  }
}

.currency-transfer-popup {
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%) translateY(-120%);
  width: 100%;
  max-width: 320px;
  background-color: var(--popup-bg);
  color: var(--popup-text);
  border: 1px solid var(--popup-border);
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  padding: 24px;
  z-index: 9999;
  opacity: 0;
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), 
              opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  backdrop-filter: blur(8px);
}

.currency-transfer-popup.show {
  transform: translateX(-50%) translateY(0);
  opacity: 1;
}

.currency-transfer-popup.hide {
  transform: translateX(-50%) translateY(-120%);
  opacity: 0;
}

.popup-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 16px;
}

.checkmark-container {
  position: relative;
  width: 80px;
  height: 80px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.checkmark-blur {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(16, 185, 129, 0.15);
  border-radius: 50%;
  filter: blur(15px);
  opacity: 0;
  transform: scale(0.8);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.currency-transfer-popup.show .checkmark-blur {
  opacity: 1;
  transform: scale(1);
}

.checkmark-svg {
  position: relative;
  z-index: 2;
  width: 80px;
  height: 80px;
}

.checkmark-circle {
  stroke: var(--success-color);
  stroke-width: 4;
  fill: transparent;
  stroke-dasharray: 283;
  stroke-dashoffset: 283;
  stroke-linecap: round;
  transform-origin: 50% 50%;
}

.checkmark-path {
  stroke: var(--success-color);
  stroke-width: 4;
  fill: transparent;
  stroke-dasharray: 70;
  stroke-dashoffset: 70;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.currency-transfer-popup.show .checkmark-circle {
  animation: circle-draw 1.5s ease-in-out forwards;
}

.currency-transfer-popup.show .checkmark-path {
  animation: check-draw 1.5s ease-in-out 0.2s forwards;
}

@keyframes circle-draw {
  to {
    stroke-dashoffset: 0;
  }
}

@keyframes check-draw {
  to {
    stroke-dashoffset: 0;
  }
}

.popup-title {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: -0.5px;
  opacity: 0;
  transform: translateY(5px);
  transition: opacity 0.4s ease, transform 0.4s ease;
  transition-delay: 1s;
}

.currency-transfer-popup.show .popup-title {
  opacity: 1;
  transform: translateY(0);
}

.transfer-details {
  width: 100%;
  background-color: rgba(39, 39, 42, 0.5);
  border: 1px solid rgba(39, 39, 42, 0.5);
  border-radius: 12px;
  padding: 12px;
  opacity: 0;
  transform: scale(0.95);
  transition: opacity 0.4s ease, transform 0.4s ease;
  transition-delay: 1.2s;
}

@media (prefers-color-scheme: dark) {
  .transfer-details {
    background-color: rgba(244, 244, 245, 0.5);
    border: 1px solid rgba(228, 228, 231, 0.5);
  }
}

.currency-transfer-popup.show .transfer-details {
  opacity: 1;
  transform: scale(1);
}

.transfer-row {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.transfer-row + .transfer-row {
  margin-top: 8px;
  padding-top: 8px;
  border-top: 1px solid rgba(161, 161, 170, 0.3);
}

.transfer-label {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  font-weight: 500;
  color: var(--text-secondary);
}

.transfer-label svg {
  width: 12px;
  height: 12px;
}

.transfer-value {
  display: flex;
  align-items: center;
  gap: 10px;
}

.currency-symbol {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 28px;
  height: 28px;
  background-color: var(--popup-bg);
  border: 1px solid var(--popup-border);
  border-radius: 8px;
  font-size: 14px;
  font-weight: 500;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s ease;
}

.transfer-value:hover .currency-symbol {
  transform: scale(1.05);
}

.amount {
  font-weight: 500;
}

.exchange-rate {
  width: 100%;
  text-align: center;
  font-size: 12px;
  color: var(--text-secondary);
  margin-top: 8px;
  opacity: 0;
  transition: opacity 0.4s ease;
  transition-delay: 1.4s;
}

.currency-transfer-popup.show .exchange-rate {
  opacity: 1;
}

/* Demo controls styling */
.demo-controls {
  display: flex;
  gap: 10px;
  margin: 20px;
  justify-content: center;
}

.demo-controls button {
  padding: 10px 15px;
  background-color: #3b82f6;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 500;
  transition: background-color 0.2s;
}

.demo-controls button:hover {
  background-color: #2563eb;
}
  </style>
 </head>
 <body>
    <div class="demo-controls">
      <button onclick="showTransferSuccess({fromAmount: 500, fromCurrency: 'USD', toAmount: 460, toCurrency: 'EUR'})">
        Show USD to EUR Transfer
      </button>
      <button onclick="showTransferSuccess({fromAmount: 1000, fromCurrency: 'EUR', toAmount: 1087, toCurrency: 'USD'})">
        Show EUR to USD Transfer
      </button>
    </div>





  
  <script>
    /**
 * Currency Transfer Popup
 * A reusable vanilla JS component for showing transfer success notifications
 */
class CurrencyTransferPopup {
  constructor() {
    this.popupElement = null;
    this.timeoutId = null;
    this.defaultOptions = {
      fromAmount: 100,
      fromCurrency: 'USD',
      toAmount: 92,
      toCurrency: 'EUR',
      duration: 5000, // Auto-dismiss after 5 seconds by default
      onClose: null,  // Callback function when popup closes
    };
    
    // Create popup template
    this.template = `
      <div class="currency-transfer-popup">
        <div class="popup-content">
          <div class="checkmark-container">
            <div class="checkmark-blur"></div>
            <svg class="checkmark-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
              <circle class="checkmark-circle" cx="50" cy="50" r="45"></circle>
              <path class="checkmark-path" d="M30 50L45 65L70 35"></path>
            </svg>
          </div>
          <h2 class="popup-title">Transfer Successful</h2>
          <div class="transfer-details">
            <div class="transfer-row">
              <div class="transfer-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 19V5M5 12l7-7 7 7" />
                </svg>
                From
              </div>
              <div class="transfer-value">
                <span class="currency-symbol from-currency">$</span>
                <span class="amount from-amount">100.00 USD</span>
              </div>
            </div>
            <div class="transfer-row">
              <div class="transfer-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 5v14M5 12l7 7 7-7" />
                </svg>
                To
              </div>
              <div class="transfer-value">
                <span class="currency-symbol to-currency">€</span>
                <span class="amount to-amount">92.00 EUR</span>
              </div>
            </div>
          </div>
          <div class="exchange-rate">Exchange Rate: 1 USD = 0.92 EUR</div>
        </div>
      </div>
    `;
  }

  /**
   * Show the transfer success popup
   * @param {Object} options - Configuration options
   */
  show(options = {}) {
    // Merge default options with provided options
    const config = { ...this.defaultOptions, ...options };
    
    // Remove existing popup if it exists
    this.remove();
    
    // Create new popup element
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = this.template.trim();
    this.popupElement = tempDiv.firstChild;
    
    // Update content with provided options
    this.updateContent(config);
    
    // Add to DOM
    document.body.appendChild(this.popupElement);
    
    // Force reflow to ensure animations work
    void this.popupElement.offsetWidth;
    
    // Show popup with animation
    this.popupElement.classList.add('show');
    
    // Set auto-dismiss timer
    if (config.duration > 0) {
      this.timeoutId = setTimeout(() => {
        this.hide();
      }, config.duration);
    }
    
    // Add click event to dismiss
    this.popupElement.addEventListener('click', () => {
      this.hide();
    });
  }

  /**
   * Update popup content with provided options
   * @param {Object} config - Configuration options
   */
  updateContent(config) {
    // Format currency amounts
    const fromAmountFormatted = this.formatCurrency(config.fromAmount, config.fromCurrency);
    const toAmountFormatted = this.formatCurrency(config.toAmount, config.toCurrency);
    
    // Update currency symbols
    const fromSymbol = this.getCurrencySymbol(config.fromCurrency);
    const toSymbol = this.getCurrencySymbol(config.toCurrency);
    
    this.popupElement.querySelector('.from-currency').textContent = fromSymbol;
    this.popupElement.querySelector('.to-currency').textContent = toSymbol;
    
    // Update amounts
    this.popupElement.querySelector('.from-amount').textContent = `${fromAmountFormatted} ${config.fromCurrency}`;
    this.popupElement.querySelector('.to-amount').textContent = `${toAmountFormatted} ${config.toCurrency}`;
    
    // Calculate and update exchange rate
    const rate = (config.toAmount / config.fromAmount).toFixed(2);
    this.popupElement.querySelector('.exchange-rate').textContent = 
      `Exchange Rate: 1 ${config.fromCurrency} = ${rate} ${config.toCurrency}`;
  }

  /**
   * Hide the popup with animation
   */
  hide() {
    if (!this.popupElement) return;
    
    // Clear timeout if it exists
    if (this.timeoutId) {
      clearTimeout(this.timeoutId);
      this.timeoutId = null;
    }
    
    // Add hide class to trigger animation
    this.popupElement.classList.add('hide');
    this.popupElement.classList.remove('show');
    
    // Remove from DOM after animation completes
    setTimeout(() => {
      this.remove();
      
      // Call onClose callback if provided
      if (typeof this.defaultOptions.onClose === 'function') {
        this.defaultOptions.onClose();
      }
    }, 500); // Match the CSS transition duration
  }

  /**
   * Remove popup from DOM
   */
  remove() {
    if (this.popupElement && this.popupElement.parentNode) {
      this.popupElement.parentNode.removeChild(this.popupElement);
      this.popupElement = null;
    }
  }

  /**
   * Format currency amount
   * @param {number} amount - Amount to format
   * @param {string} currency - Currency code
   * @returns {string} Formatted amount
   */
  formatCurrency(amount, currency) {
    return amount.toFixed(2);
  }

  /**
   * Get currency symbol from currency code
   * @param {string} currency - Currency code
   * @returns {string} Currency symbol
   */
  getCurrencySymbol(currency) {
    const symbols = {
      'USD': '$',
      'EUR': '€',
      'GBP': '£',
      'JPY': '¥',
      'CAD': 'C$',
      'AUD': 'A$',
      'CHF': 'Fr',
      'CNY': '¥',
      'INR': '₹',
      'BRL': 'R$'
    };
    
    return symbols[currency] || currency;
  }
}

// Create singleton instance
const transferPopup = new CurrencyTransferPopup();

/**
 * Global function to show transfer success popup
 * @param {Object} options - Configuration options
 */
function showTransferSuccess(options = {}) {
  transferPopup.show(options);
}

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = { 
    CurrencyTransferPopup,
    showTransferSuccess
  };
}
  </script>
 </body>
 </html>