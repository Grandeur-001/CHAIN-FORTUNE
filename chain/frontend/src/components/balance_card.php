<style>
    :root {
        --card-gradient: linear-gradient(145deg, #1a1b2e, #0e0f17);
        --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        --border-radius: 20px;
        --button-radius: 50%;
        --transition: all 0.3s ease;
    }

    .balance-container {
        width: 100%;
        max-width: 100%;
        /* margin: 0 auto; */
    }

    /* Balance Card Styles */
    .balance-card {
      background: var(--card-gradient);
      border-radius: var(--border-radius);
      padding: 24px;
      box-shadow: var(--card-shadow);
      position: relative;
      overflow: hidden;
      width: 100%;
    }

    .balance-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--accent-clr), transparent);
      opacity: 0.3;
    }

    /* Balance Header */
    .balance-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }

    .balance-title {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .balance-title h2 {
      font-size: 18px;
      font-weight: 500;
      color: var(--secondary-text-clr);
    }

    .currency-badge {
      background-color: rgba(94, 99, 255, 0.15);
      color: var(--accent-clr);
      padding: 3px 8px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
    }

    .settings-button {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: rgba(66, 67, 74, 0.2);
      transition: var(--transition);
    }

    .settings-button:hover {
      background-color: var(--hover-clr);
    }

    .settings-icon {
      width: 18px;
      height: 18px;
      position: relative;
      display: grid;
      place-content: center;

      > svg{
        fill: var(--accent-clr);
      }

      &:hover svg{
        fill:var(--secondary-text-clr);
      }
    }





    /* Balance Amount */
    .balance-amount {
      margin-bottom: 8px;
    }

    .balance-amount h1 {
      font-size: 36px;
      font-weight: 700;
      letter-spacing: -0.5px;
    }

    .decimal {
      font-weight: 400;
      font-size: 24px;
      opacity: 0.8;
    }

    /* Balance Change */
    .balance-change {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 32px;
      font-size: 15px;
      font-weight: 500;
   
    }
    
    .balance-change.positive {
      color: var(--positive-text-clr);
    }

    .balance-change.negative {
      color: var(--negative-text-clr);
    }

    .balance-change.pending {
      color: var(--pending-text-clr);
    }

    .change-arrow {
      font-size: 16px;
    }

    .change-percentage {
      opacity: 0.9;
    }

    /* Action Buttons */
    .action-buttons {
      display: flex;
      justify-content: space-between;
      padding-top: 8px;
    }

    .action-button {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: var(--transition);
      width: 64px;
    }

    .action-button:hover .button-icon {
      background-color: rgba(94, 99, 255, 0.2);
      transform: translateY(-2px);
    }

    .button-icon {
      width: 48px;
      height: 48px;
      background-color: rgba(66, 67, 74, 0.3);
      border-radius: var(--button-radius);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      transition: var(--transition);
    }

    .button-label {
      color: var(--secondary-text-clr);
      font-size: 13px;
      font-weight: 500;
      transition: var(--transition);
    }

    .action-button:hover .button-label {
      color: var(--text-clr);
    }

    /* Button Icons */
    .action-button .send-icon::before,
    .action-button .receive-icon::before,
    .action-button .swap-icon::before,
    .action-button .more-icon::before {
      content: '';
      position: absolute;
      background-color: var(--text-clr);
    }

    .action-button .button-icon svg:not(.withdraw-icon){
      stroke: var(--accent-clr);
      fill: var(--accent-clr);
    }
    
    .action-button:hover .button-icon svg:not(.withdraw-icon){
      stroke: var(--text-clr);
      fill: var(--text-clr);
    }

    .withdraw-icon{
      .withdraw-icon-child{
        fill: var(--accent-clr);
      }
    }

    .action-button:hover .button-icon .withdraw-icon .withdraw-icon-child{
      fill: var(--text-clr);
    }


    /* Responsive Styles */

    /* Small Mobile Devices (320px - 374px) */
    @media screen and (max-width: 374px) {
      .balance-card {
        padding: 18px;
      }
      
      .balance-title h2 {
        font-size: 16px;
      }
      
      .currency-badge {
        padding: 2px 6px;
        font-size: 10px;
      }
      
      .balance-amount h1 {
        font-size: 28px;
      }
      
      .decimal {
        font-size: 20px;
      }
      
      .balance-change {
        font-size: 13px;
        margin-bottom: 24px;
      }
      
      .action-button {
        width: 56px;
      }
      
      .button-icon {
        width: 42px;
        height: 42px;
      }
      
      .button-label {
        font-size: 11px;
      }
    }

    /* Medium Mobile Devices (375px - 424px) */
    @media screen and (min-width: 375px) and (max-width: 424px) {
      .balance-amount h1 {
        font-size: 32px;
      }
      
      .button-icon {
        width: 44px;
        height: 44px;
      }
    }

    /* Large Mobile Devices (425px - 767px) */
    @media screen and (min-width: 425px) and (max-width: 767px) {
      .balance-amount h1 {
        font-size: 34px;
      }
    }

    /* Tablets (768px - 1023px) */
    @media screen and (min-width: 768px) {
      .balance-card {
        padding: 28px;
      }
      
      .balance-title h2 {
        font-size: 20px;
      }
      
      .balance-amount h1 {
        font-size: 42px;
      }
      
      .decimal {
        font-size: 28px;
      }
      
      .balance-change {
        font-size: 16px;
        margin-bottom: 36px;
      }
      
      .action-button {
        width: 72px;
      }
      
      .button-icon {
        width: 56px;
        height: 56px;
      }
      
      .button-label {
        font-size: 14px;
      }
    }

    /* Desktop (1024px and above) */
    @media screen and (min-width: 1024px) {
      .balance-container {
        max-width: 500px;
      }
      
      .balance-card {
        padding: 32px;
        transition: transform 0.3s ease;
      }
      
      .balance-card:hover {
        transform: translateY(-5px);
      }
      
      .balance-amount h1 {
        font-size: 48px;
      }
      
      .decimal {
        font-size: 32px;
      }
      
      .action-button {
        width: 80px;
      }
      
      .button-icon {
        width: 60px;
        height: 60px;
      }
    }
</style>


<div class="balance-container">
    <div class="balance-card">
    <div class="balance-header">
        <div class="balance-title">
        <h2>Current Balance</h2>
        <div class="currency-badge">USD</div>
        </div>
        <button class="settings-button" aria-label="Settings">
          <div class="settings-icon" title="Settings">
            <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M924.8 625.7l-65.5-56c3.1-19 4.7-38.4 4.7-57.8s-1.6-38.8-4.7-57.8l65.5-56a32.03 32.03 0 009.3-35.2l-.9-2.6a443.74 443.74 0 00-79.7-137.9l-1.8-2.1a32.12 32.12 0 00-35.1-9.5l-81.3 28.9c-30-24.6-63.5-44-99.7-57.6l-15.7-85a32.05 32.05 0 00-25.8-25.7l-2.7-.5c-52.1-9.4-106.9-9.4-159 0l-2.7.5a32.05 32.05 0 00-25.8 25.7l-15.8 85.4a351.86 351.86 0 00-99 57.4l-81.9-29.1a32 32 0 00-35.1 9.5l-1.8 2.1a446.02 446.02 0 00-79.7 137.9l-.9 2.6c-4.5 12.5-.8 26.5 9.3 35.2l66.3 56.6c-3.1 18.8-4.6 38-4.6 57.1 0 19.2 1.5 38.4 4.6 57.1L99 625.5a32.03 32.03 0 00-9.3 35.2l.9 2.6c18.1 50.4 44.9 96.9 79.7 137.9l1.8 2.1a32.12 32.12 0 0035.1 9.5l81.9-29.1c29.8 24.5 63.1 43.9 99 57.4l15.8 85.4a32.05 32.05 0 0025.8 25.7l2.7.5a449.4 449.4 0 00159 0l2.7-.5a32.05 32.05 0 0025.8-25.7l15.7-85a350 350 0 0099.7-57.6l81.3 28.9a32 32 0 0035.1-9.5l1.8-2.1c34.8-41.1 61.6-87.5 79.7-137.9l.9-2.6c4.5-12.3.8-26.3-9.3-35zM788.3 465.9c2.5 15.1 3.8 30.6 3.8 46.1s-1.3 31-3.8 46.1l-6.6 40.1 74.7 63.9a370.03 370.03 0 01-42.6 73.6L721 702.8l-31.4 25.8c-23.9 19.6-50.5 35-79.3 45.8l-38.1 14.3-17.9 97a377.5 377.5 0 01-85 0l-17.9-97.2-37.8-14.5c-28.5-10.8-55-26.2-78.7-45.7l-31.4-25.9-93.4 33.2c-17-22.9-31.2-47.6-42.6-73.6l75.5-64.5-6.5-40c-2.4-14.9-3.7-30.3-3.7-45.5 0-15.3 1.2-30.6 3.7-45.5l6.5-40-75.5-64.5c11.3-26.1 25.6-50.7 42.6-73.6l93.4 33.2 31.4-25.9c23.7-19.5 50.2-34.9 78.7-45.7l37.9-14.3 17.9-97.2c28.1-3.2 56.8-3.2 85 0l17.9 97 38.1 14.3c28.7 10.8 55.4 26.2 79.3 45.8l31.4 25.8 92.8-32.9c17 22.9 31.2 47.6 42.6 73.6L781.8 426l6.5 39.9zM512 326c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm79.2 255.2A111.6 111.6 0 01512 614c-29.9 0-58-11.7-79.2-32.8A111.6 111.6 0 01400 502c0-29.9 11.7-58 32.8-79.2C454 401.6 482.1 390 512 390c29.9 0 58 11.6 79.2 32.8A111.6 111.6 0 01624 502c0 29.9-11.7 58-32.8 79.2z"></path></svg>
          </div>
        </button>
    </div>
    
    <div class="balance-amount" id="CURRENT_BALANCE">
        <?php
            if (!isset($_SESSION['user_id'])) {
                die('Session user_id not set!');
            }

            include('../../../backend/connection.php');

            function getTotalBalance($userId, $conn) {
                $query = "SELECT SUM(uw.amount) AS total_balance FROM users_wallet uw WHERE uw.user_id = ?";

                $stmt = $conn->prepare($query);
                if (!$stmt) {
                    error_log("Prepare failed: " . $conn->error);
                    return 0;
                }

                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $stmt->bind_result($total);
                $stmt->fetch();
                $stmt->close();

                return $total ?? 0;
            }

            $user_id = $_SESSION['user_id'];
            $totalBalance = getTotalBalance($user_id, $conn);
            
            $formatted = number_format($totalBalance, 2);
            list($intPart, $decimalPart) = explode('.', $formatted);
            echo '<h1>$' . $intPart . '.<span class="decimal">' . $decimalPart . '</span></h1>';
        ?>
    </div>
    
    <div class="balance-change positive">
        <span class="change-arrow">↑</span>
        <span class="change-amount">$85,894.32</span>
        <span class="change-percentage">(+24.2%)</span>
    </div>
    
    <div class="action-buttons">
        <button class="action-button">
        <div class="button-icon send-icon">
          <svg style="transform: rotate(-30deg) translateY(-0px) translateX(3px);" width="21" height="21" xmlns="http://www.w3.org/2000/svg" class="edited-svg" stroke="" fill="" viewBox="64 64 896 896" focusable="false"><defs><style></style></defs><path d="M931.4 498.9L94.9 79.5c-3.4-1.7-7.3-2.1-11-1.2a15.99 15.99 0 00-11.7 19.3l86.2 352.2c1.3 5.3 5.2 9.6 10.4 11.3l147.7 50.7-147.6 50.7c-5.2 1.8-9.1 6-10.3 11.3L72.2 926.5c-.9 3.7-.5 7.6 1.2 10.9 3.9 7.9 13.5 11.1 21.5 7.2l836.5-417c3.1-1.5 5.6-4.1 7.2-7.1 3.9-8 .7-17.6-7.2-21.6zM170.8 826.3l50.3-205.6 295.2-101.3c2.3-.8 4.2-2.6 5-5 1.4-4.2-.8-8.7-5-10.2L221.1 403 171 198.2l628 314.9-628.2 313.2z"></path></svg>
        </div>
        <span class="button-label">Send</span>
        </button>
        
        <button class="action-button" onclick="location.href=`<?php echo $withdraw_url; ?>`">
        <div class="button-icon receive-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="21" class="withdraw-icon" height="21" viewBox="0 0 24 24" fill="none">
          <path class="withdraw-icon-child" d="M12 9C11.4477 9 11 9.44771 11 10V15.5856L9.70711 14.2928C9.3166 13.9024 8.68343 13.9024 8.29292 14.2928C7.90236 14.6834 7.90236 15.3165 8.29292 15.7071L11.292 18.7063C11.6823 19.0965 12.3149 19.0968 12.7055 18.707L15.705 15.7137C16.0955 15.3233 16.0955 14.69 15.705 14.2996C15.3145 13.909 14.6814 13.909 14.2908 14.2996L13 15.5903V10C13 9.44771 12.5523 9 12 9Z" />
          <path class="withdraw-icon-child" fill-rule="evenodd" clip-rule="evenodd" d="M21 1C22.6569 1 24 2.34315 24 4V8C24 9.65685 22.6569 11 21 11H19V20C19 21.6569 17.6569 23 16 23H8C6.34315 23 5 21.6569 5 20V11H3C1.34315 11 0 9.65685 0 8V4C0 2.34315 1.34315 1 3 1H21ZM22 8C22 8.55228 21.5523 9 21 9H19V7H20C20.5523 7 21 6.55229 21 6C21 5.44772 20.5523 5 20 5H4C3.44772 5 3 5.44772 3 6C3 6.55229 3.44772 7 4 7H5V9H3C2.44772 9 2 8.55228 2 8V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V8ZM7 7V20C7 20.5523 7.44772 21 8 21H16C16.5523 21 17 20.5523 17 20V7H7Z"/>
        </svg>
        </div>
        <span class="button-label">Withdraw</span>
        </button>
        
        <button class="action-button" onclick="location.href=`<?php echo $exchange_url; ?>`">
        <div class="button-icon swap-icon">
          <svg style="transform: rotate(90deg);" xmlns="http://www.w3.org/2000/svg" width="21px" fill="" viewBox="64 64 896 896" focusable="false"><path d="M847.9 592H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h605.2L612.9 851c-4.1 5.2-.4 13 6.3 13h72.5c4.9 0 9.5-2.2 12.6-6.1l168.8-214.1c16.5-21 1.6-51.8-25.2-51.8zM872 356H266.8l144.3-183c4.1-5.2.4-13-6.3-13h-72.5c-4.9 0-9.5 2.2-12.6 6.1L150.9 380.2c-16.5 21-1.6 51.8 25.1 51.8h696c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path></svg>
        </div>
        <span class="button-label">Exchange</span>
        </button>
        
        <button class="action-button">
        <div class="button-icon more-icon">
          <svg style="transform: rotate(90deg);" width="26" height="26" xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M456 231a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0z"/></svg>
        </div>
        <span class="button-label">More</span>
        </button>
    </div>
    </div>
</div>