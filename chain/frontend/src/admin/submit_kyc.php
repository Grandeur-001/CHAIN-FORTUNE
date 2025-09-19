
<?php
    include("../../../backend/section_handler.php");
    include("../../../backend/check_role.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Chain Fortune</title>
    <link rel="stylesheet" href="/chain-fortune/styles/style.css">
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[5]
            sideBarItem.classList.add("active");

            const navItem = document.querySelectorAll("#bottom_nav a")[0];
            navItem.classList.add("active");
        });
    </script>
    <style>
        #main{
            margin-top: 11rem;
            margin-left: 17rem;
            transition: all 300ms ease-in-out;

        }

        .app-container {
            padding: 20px;
        }
        @media (max-width: 800px) {
            #main{
                margin-left: 0;
            }
            .app-container {
                padding: 0.7rem;
            }
        }

        .app-body {
      flex: 1;
      overflow-y: auto;
      padding: 20px;
      position: relative;
      background-color: var(--base-clr);
    }

    .app-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
      padding: 20px;
    }

    .app-icon {
      width: 80px;
      height: 80px;
      background-color: var(--accent-clr);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      box-shadow: 0 10px 20px rgba(94, 99, 255, 0.3);
    }

    .app-icon svg {
      width: 40px;
      height: 40px;
      fill: none;
      stroke: white;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .app-description {
      text-align: center;
      margin-bottom: 30px;
      color: var(--secondary-text-clr);
      font-size: 15px;
    }

    .verify-btn {
      background-color: var(--accent-clr);
      color: var(--text-clr);
      border: none;
      padding: 16px 32px;
      border-radius: 7px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
      box-shadow: 0 4px 12px rgba(94, 99, 255, 0.3);
      width: 100%;
      max-width: 250px;
    }

    .verify-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(94, 99, 255, 0.4);
    }

    .verify-btn:active {
      transform: translateY(0);
      box-shadow: 0 2px 8px rgba(94, 99, 255, 0.3);
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(7, 7, 10, 0.8);
      display: flex;
      justify-content: center;
      align-items: flex-end;
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s, visibility 0.3s;
    }

    .modal-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .modal {
      background-color: var(--base-clr);
      border-radius: 24px 24px 0 0;
      width: 100%;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.3);
      position: relative;
      transform: translateY(100%);
      transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);

        &::-webkit-scrollbar {
            width: 4px;
        }

        &::-webkit-scrollbar-track {
            background: var(--base-clr);
        }

        &::-webkit-scrollbar-thumb {
            background: var(--line-clr);
            border-radius: 3px;
        }
    }

    .modal-overlay.active .modal {
      transform: translateY(0);
    }

    .modal-header {
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      background-color: var(--base-clr);
      z-index: 10;
      border-bottom: 1px solid var(--line-clr);
    }

    .modal-title {
      font-size: 18px;
      font-weight: 600;
    }

    .modal-drag-indicator {
      width: 40px;
      height: 5px;
      background-color: var(--line-clr);
      border-radius: 3px;
      position: absolute;
      top: 8px;
      left: 50%;
      transform: translateX(-50%);
    }

    .close-btn {
      background: none;
      border: none;
      color: var(--secondary-text-clr);
      font-size: 24px;
      cursor: pointer;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      transition: background-color 0.2s;
    }

    .close-btn:hover {
      background-color: var(--hover-clr);
      color: var(--text-clr);
    }

    .modal-body {
      padding: 20px;
    }

    .form-group {
      margin-bottom: 24px;
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      color: var(--secondary-text-clr);
      font-weight: 500;
    }

    input, textarea {
      width: 100%;
      padding: 14px 16px;
      background-color: var(--black-clr);
      border: 1px solid var(--line-clr);
      border-radius: 7px;
      color: var(--text-clr);
      font-size: 16px;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    input:focus, textarea:focus {
      outline: none;
      border-color: var(--accent-clr);
      box-shadow: 0 0 0 3px var(--input-focus-clr);
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .file-input-container {
      position: relative;
    }

    .file-input-label {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 24px;
      background-color: var(--black-clr);
      border: 2px dashed var(--line-clr);
      border-radius: 7px;
      cursor: pointer;
      transition: border-color 0.2s, background-color 0.2s;
    }

    .file-input-label:hover {
      background-color: var(--hover-clr);
      border-color: var(--accent-clr);
    }

    .file-input-label span {
      margin-top: 8px;
      font-size: 14px;
      color: var(--secondary-text-clr);
    }

    .file-input {
      position: absolute;
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      z-index: -1;
    }

    .file-preview {
      margin-top: 16px;
      display: none;
      flex-direction: column;
      align-items: center;
      background-color: var(--black-clr);
      border-radius: 7px;
      padding: 16px;
      border: 1px solid var(--line-clr);
    }

    .file-preview.active {
      display: flex;
    }

    .preview-image {
      max-width: 100%;
      max-height: 200px;
      border-radius: 12px;
      object-fit: contain;
    }

    .file-name {
      margin-top: 12px;
      font-size: 14px;
      color: var(--secondary-text-clr);
      word-break: break-all;
      text-align: center;
    }

    .submit-btn {
      width: 100%;
      padding: 16px;
      background-color: var(--accent-clr);
      color: var(--text-clr);
      border: none;
      border-radius: 7px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
      margin-top: 10px;
      box-shadow: 0 4px 12px rgba(94, 99, 255, 0.3);
    }

    .submit-btn:hover {
      box-shadow: 0 6px 16px rgba(94, 99, 255, 0.4);
    }

    .submit-btn:active {
      transform: translateY(1px);
      box-shadow: 0 2px 8px rgba(94, 99, 255, 0.3);
    }

    .upload-icon {
      width: 48px;
      height: 48px;
      background-color: var(--hover-clr);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 12px;
    }

    .upload-icon svg {
      width: 24px;
      height: 24px;
      stroke: var(--secondary-text-clr);
    }

    /* Status bar styling */
    .status-bar {
      display: flex;
      justify-content: space-between;
      padding: 10px 16px;
      background-color: var(--black-clr);
      font-size: 12px;
      color: var(--secondary-text-clr);
    }

    .status-bar-left {
      display: flex;
      align-items: center;
    }

    .status-bar-right {
      display: flex;
      align-items: center;
    }

    .status-bar-icon {
      margin-left: 6px;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
  

      .modal {
        max-height: 85vh;
      }
    }

    @media (max-width: 320px) {
      .modal-header {
        padding: 15px;
      }

      .modal-body {
        padding: 15px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      input, textarea {
        padding: 12px 14px;
        font-size: 14px;
      }

      .file-input-label {
        padding: 16px;
      }

      .submit-btn {
        padding: 14px;
      }
    }
    </style>
</head>


<body>
    
    <?php include "../components/header.php"; ?>
    <?php include "../components/sidebar.php"; ?>
    <?php include "../components/toastify.php"; ?>

    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/chain-fortune/js/sweet_alert.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <main class="main" id="main">
        <div class="app-container">
            <?php
              include('../../../backend/connection.php');
              $user_id = $_SESSION['user_id'];
              $check = $conn->prepare("SELECT status FROM kyc_requests WHERE user_id = ? LIMIT 1");
              $check->bind_param("s", $user_id);
              $check->execute();
              $check->store_result();
          
              if ($check->num_rows > 0) {
                  $check->bind_result($status);
                  $check->fetch();

                  if ($status === 'Pending') {
                      die( <<<HTML
                          <!DOCTYPE html>
                          <html>
                              <head>
                                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                  <style>
                                      *{
                                          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                                      }
                                      body { margin: 0; background: #000; color: #fff; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;  } 
                                      .swal2-popup {
                                          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                                      }
                                  </style>
                              </head>
                              <body>
                                  <script>
                                      Swal.fire({
                                          icon: 'info',
                                          title: 'KYC Pending',
                                          text: 'Your KYC request is still pending. Please wait for approval.',
                                          background: 'var(--hover-clr)',
                                          confirmButtonColor: '#4caf50',
                                          color: '#ffffff',
                                          showConfirmButton: true,
                                          confirmButtonText: "OK",
                                          allowOutsideClick: false,
                                          allowEscapeKey: false
                                      }).then((result) => {
                                          if (result.isConfirmed) {
                                              window.history.back();
                                          }
                                      });
                                  </script>
                              </body>
                          </html>
                      HTML);
                      exit();
                  } elseif ($status === 'Approved') {
                      die( <<<HTML
                          <!DOCTYPE html>
                          <html>
                              <head>
                                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                  <style>
                                      *{
                                          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                                      }
                                      body { margin: 0; background: #000; color: #fff; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;  } 
                                      .swal2-popup {
                                          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                                      }
                                  </style>
                              </head>
                              <body>
                                  <script>
                                      Swal.fire({
                                          icon: 'success',
                                          title: 'KYC Approved',
                                          text: 'Your KYC request has been approved. You can now access all features.',
                                          background: 'var(--hover-clr)',
                                          confirmButtonColor: '#4caf50',
                                          color: '#ffffff',
                                          showConfirmButton: true,
                                          confirmButtonText: "OK",
                                          allowOutsideClick: false,
                                          allowEscapeKey: false
                                      }).then((result) => {
                                          if (result.isConfirmed) {
                                              window.history.back();
                                          }
                                      });
                                  </script>
                              </body>
                          </html>
                      HTML);
                      exit();
                  } elseif ($status === 'Rejected') {
                  }


              }
              $check->close();
            ?>
            <div class="app-body">
                <div class="app-content">
                    <div class="app-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    </div>
                    <h2>Complete KYC Verification</h2>
                    <p class="app-description">Verify your identity to unlock all features and higher transaction limits.</p>
                    <button class="verify-btn" id="openKycModal">Start Verification</button>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="kycModal">
            <div class="modal">
            <div class="modal-drag-indicator"></div>
            <div class="modal-header">
                <h2 class="modal-title">KYC Verification</h2>
                <button class="close-btn" id="closeModal">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
                </button>
            </div>
            <div class="modal-body">
                <div id="kycForm">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" placeholder="Enter your legal name" required>
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Residential Address</label>
                        <textarea id="address" name="address" rows="3" placeholder="Enter your complete address" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Upload Utility Bill</label>
                        <div class="file-input-container">
                        <label for="utility_bill" class="file-input-label">
                            <div class="upload-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            </div>
                            <span>Upload Electricity, Water, or Gas bill</span>
                            <span>JPG, PNG or PDF (max 5MB)</span>
                        </label>
                        <input type="file" id="utility_bill" name="utility_bill" class="file-input" accept=".jpg,.jpeg,.png,.pdf" required>
                        <div class="file-preview" id="utilityBillPreview">
                            <img class="preview-image" id="utilityBillImage" src="#" alt="Utility Bill Preview">
                            <div class="file-name" id="utilityBillName"></div>
                        </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Upload Government ID</label>
                        <div class="file-input-container">
                        <label for="gov_id" class="file-input-label">
                            <div class="upload-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            </div>
                            <span>Upload Passport, Driver's License, or ID Card</span>
                            <span>JPG, PNG or PDF (max 5MB)</span>
                        </label>
                        <input type="file" id="gov_id" name="gov_id" class="file-input" accept=".jpg,.jpeg,.png,.pdf" required>
                        <div class="file-preview" id="govIdPreview">
                            <img class="preview-image" id="govIdImage" src="#" alt="Government ID Preview">
                            <div class="file-name" id="govIdName"></div>
                        </div>
                        </div>
                    </div>

                    <button type="submit" id="submitKycBtn" class="submit-btn">Submit for Verification</button>
                </div>
            </div>
            </div>
        </div>




    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const openModalBtn = document.getElementById('openKycModal');
        const closeModalBtn = document.getElementById('closeModal');
        const modal = document.getElementById('kycModal');
        const kycForm = document.getElementById('kycForm');
        
        // File upload preview for utility bill
        const utilityBillInput = document.getElementById('utility_bill');
        const utilityBillPreview = document.getElementById('utilityBillPreview');
        const utilityBillImage = document.getElementById('utilityBillImage');
        const utilityBillName = document.getElementById('utilityBillName');
        
        // File upload preview for government ID
        const govIdInput = document.getElementById('gov_id');
        const govIdPreview = document.getElementById('govIdPreview');
        const govIdImage = document.getElementById('govIdImage');
        const govIdName = document.getElementById('govIdName');

        // Open modal
        openModalBtn.addEventListener('click', function() {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        });

        // Close modal
        closeModalBtn.addEventListener('click', function() {
            modal.classList.remove('active');
            document.body.style.overflow = ''; // Re-enable scrolling
        });

        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
            }
        });

        // Handle utility bill file upload and preview
        utilityBillInput.addEventListener('change', function() {
            handleFileUpload(this, utilityBillPreview, utilityBillImage, utilityBillName);
        });

        // Handle government ID file upload and preview
        govIdInput.addEventListener('change', function() {
            handleFileUpload(this, govIdPreview, govIdImage, govIdName);
        });

        // Handle form submission
        kycForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically send the form data to your server
            alert('KYC verification submitted successfully!');
            modal.classList.remove('active');
            document.body.style.overflow = '';
            kycForm.reset();
            utilityBillPreview.classList.remove('active');
            govIdPreview.classList.remove('active');
        });

        // Function to handle file upload and preview
        function handleFileUpload(input, previewContainer, previewImage, fileNameElement) {
            const file = input.files[0];
            
            if (file) {
            const fileName = file.name;
            fileNameElement.textContent = fileName;
            
            // Show preview for images only
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.add('active');
                };
                
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                // For PDF files, show a placeholder
                previewImage.src = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNiMGIzYzEiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cGF0aCBkPSJNMTQgMkg2YTIgMiAwIDAgMC0yIDJ2MTZhMiAyIDAgMCAwIDIgMmgxMmEyIDIgMCAwIDAgMi0yVjh6Ij48L3BhdGg+PHBvbHlsaW5lIHBvaW50cz0iMTQgMiAxNCA4IDIwIDgiPjwvcG9seWxpbmU+PC9zdmc+';
                previewContainer.classList.add('active');
            }
            }
        }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#saveWallet').on('click', function() {
                const currentCryptoId = $('#crypto_id').val();
                const cryptoSymbol = $('#modalTitle').text().split(' ')[0];
                const walletAddress = $('#walletAddress').val();
                const qrCodeFile = $('#qrCodeUpload')[0].files[0];

                console.log('Current Crypto ID:', currentCryptoId);
                console.log('Crypto Symbol:', cryptoSymbol);
                console.log('Wallet Address:', walletAddress);
                console.log('QR Code File:', qrCodeFile);
                console.log('QR Code File Size:', qrCodeFile ? qrCodeFile.size : 'No file selected');

                if (!currentCryptoId) {
                    showToast('error','No cryptocurrency selected');
                    return;
                }
                if (!walletAddress) {
                    showToast('error','Please enter a wallet address');
                    return;
                }
                if (qrCodeFile && qrCodeFile.size > 2 * 1024 * 1024) { 
                    showToast('error','QR code image size exceeds 2MB');
                    return;
                }

                if (currentCryptoId) {
                    const formData = new FormData();
                    formData.append('crypto_id', currentCryptoId);
                    formData.append('crypto_symbol', cryptoSymbol);
                    formData.append('wallet_address', walletAddress);
                    if (qrCodeFile) {
                        formData.append('qr_code', qrCodeFile);
                    }
                    Swal.fire({
                        title: 'Please wait...',
                        text: 'Processing your request',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        background: 'var(--hover-clr)',
                        color: '#ffffff',
                        didOpen: () => {
                        Swal.showLoading();
                        }
                    });
                    setTimeout(()=>{
                        $.ajax({
                            url: '/chain-fortune/action/update_wallet',
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            success: function(response) {
                                const data = response;
                                if (data.status === 'success') {
                                    fetchCryptocurrencies();
                                    showToast('success', data.message);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Wallet Updated',
                                        text: data.message,
                                        background: 'var(--hover-clr)',
                                        color: '#ffffff',
                                        confirmButtonColor: '#4caf50',
                                        allowOutsideClick: false,
                                        customClass: {
                                            popup: 'swal2-dark-popup'
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = response.redirect;
                                        }
                                    });
                                } else {
                                    showToast('error', data.message);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message,
                                        background: 'var(--hover-clr)',
                                        color: '#ffffff',
                                        confirmButtonColor: '#f44336',
                                        customClass: {
                                            popup: 'swal2-dark-popup'
                                        }
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error:", status, error);
                                showToast('error', 'Server error. Please try again.');
                            }
                        });
                    },2000);
                }
            });

            $('#submitKycBtn').on('click', function() {
                const userId = $('#user_id').val(); 
                const fullName = $('#full_name').val();
                const dob = $('#dob').val();
                const address = $('#address').val();
                const utilityBillFile = $('#utility_bill')[0].files[0];
                const govIdFile = $('#gov_id')[0].files[0];

                if (!fullName || !dob || !address || !utilityBillFile || !govIdFile) {
                    showToast('error','Please fill in all fields and upload files');
                    return;
                }

                if (utilityBillFile.size > 5 * 1024 * 1024 || govIdFile.size > 5 * 1024 * 1024) {
                    showToast('error','File size exceeds 5MB');
                    return;
                }

                const formData = new FormData();
                formData.append('user_id', userId);
                formData.append('full_name', fullName);
                formData.append('dob', dob);
                formData.append('address', address);
                formData.append('utility_bill', utilityBillFile);
                formData.append('gov_id', govIdFile);




                Swal.fire({
                    title: 'Please wait...',
                    text: 'Processing your request',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    background: 'var(--hover-clr)',
                    color: '#ffffff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                setTimeout(()=>{
                    $.ajax({
                        url: '/chain-fortune/action/submit_kyc_logic',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(response) {
                            const data = response;
                            if (data.status === 'success') {
                                showToast('success', data.message);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'KYC Submitted',
                                    text: data.message,
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: '#4caf50',
                                    allowOutsideClick: false,
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = response.redirect;
                                    }
                                });
                            } else {
                                showToast('error', data.message);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message,
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: '#f44336',
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                            console.error("Server Response:", xhr.responseText);
                            showToast('error', xhr.responseText || 'Server error. Please try again.');
                        }
                    });
                },2000);
            });
        });
    </script>





</body>
</html>


