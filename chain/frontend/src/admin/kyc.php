
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
        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 700;
            color: var(--text-clr);
            margin-bottom: 10px;
        }

        .header p {
            color: var(--secondary-text-clr);
            font-size: 1.1rem;
        }

        .search-container {
            margin-bottom: 30px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 15px 20px;
            background-color: var(--black-clr);
            border: 2px solid var(--line-clr);
            border-radius: 7px;
            color: var(--text-clr);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent-clr);
            background-color: var(--input-focus-clr);
        }

        .search-input::placeholder {
            color: var(--secondary-text-clr);
        }

        .kyc-list {
            display: grid;
            gap: 15px;
        }

        .kyc-item {
            background: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }


        .kyc-item:hover {
            transform: translateY(-2px);
            border-color: var(--accent-clr);
            box-shadow: 0 10px 30px rgba(94, 99, 255, 0.2);
        }



        .kyc-item-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .kyc-info {
            flex: 1;
        }

        .kyc-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-clr);
            margin-bottom: 5px;
        }

        .kyc-id {
            color: var(--secondary-text-clr);
            font-size: 0.9rem;
            font-family: 'Courier New', monospace;
        }

        .kyc-status {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background-color: var(--pending-bg-clr);
            color: var(--pending-text-clr);
        }

        .status-approved {
            background-color: var(--positive-bg-clr);
            color: var(--positive-text-clr);
        }

        .status-rejected {
            background-color: var(--negative-bg-clr);
            color: var(--negative-text-clr);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content {
            background: linear-gradient(135deg, var(--black-clr) 0%, var(--base-clr) 100%);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 30px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--line-clr);
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-clr);
        }

        .close-btn {
            background: none;
            border: none;
            color: var(--secondary-text-clr);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.3s ease;
            height: 40px;
            width: 40px;
            display: grid;
            place-content: center;
        }

        .close-btn:hover {
            background-color: var(--hover-clr);
            color: var(--text-clr);
        }

        .modal-body {
            display: grid;
            gap: 20px;
        }

        .field-group {
            display: grid;
            gap: 8px;
        }

        .field-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--secondary-text-clr);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .field-value {
            font-size: 1rem;
            color: var(--text-clr);
            padding: 12px 16px;
            background-color: var(--black-clr);
            border-radius: 8px;
            border: 1px solid var(--line-clr);
        }

        .image-container {
            display: grid;
            gap: 15px;
        }

        .image-item {
            text-align: center;
        }

        .image-preview {
            width: 100%;
            max-width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid var(--line-clr);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .image-preview:hover {
            border-color: var(--accent-clr);
            transform: scale(1.02);
        }

        .image-label {
            margin-top: 8px;
            font-size: 0.85rem;
            color: var(--secondary-text-clr);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
        }
        .status-badge.pending {
            background-color: var(--pending-bg-clr);
            color: var(--pending-text-clr);
        }
        .status-badge.approved {
            background-color: var(--positive-bg-clr);
            color: var(--positive-text-clr);
        }
        .status-badge.rejected {
            background-color: var(--negative-bg-clr);
            color: var(--negative-text-clr);
        }





        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .kyc-item-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .modal-content {
                padding: 20px;
                margin: 10px;
            }

            .image-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .kyc-item {
                padding: 15px;
            }

            .modal-content {
                padding: 15px;
            }

            .kyc-name {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 320px) {
            .header h1 {
                font-size: 1.5rem;
            }

            .kyc-item {
                padding: 12px;
            }

            .modal-content {
                padding: 12px;
            }

            .field-value {
                padding: 10px 12px;
                font-size: 0.9rem;
            }
        }

        /* Custom scrollbar */
        .modal-content::-webkit-scrollbar {
            width: 4px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: var(--base-clr);
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: var(--line-clr);
            border-radius: 3px;
        }

        .no-results {
            text-align: center;
            padding: 40px 20px;
            color: var(--secondary-text-clr);
            font-size: 1.1rem;
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
            <div class="header">
                <h1>KYC Requests</h1>
                <p>Manage and review customer verification requests</p>
            </div>

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search by name or user ID..." id="searchInput">
            </div>

            <div class="kyc-list" id="kycList">
                <!-- KYC items will be populated by JavaScript -->
            </div>

            <div class="no-results" id="noResults" style="display: none;">
                No KYC requests found matching your search.
            </div>

        </div>

            <!-- Modal -->
            <div class="modal" id="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">KYC Request Details</h2>
                        <button class="close-btn" id="closeBtn">&times;</button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        <!-- Modal content will be populated by JavaScript -->
                    </div>
                </div>
            </div>





    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>

    <script>
        const kycData = [];
        <?php
            include("../../../backend/connection.php");
            $sql = "
                SELECT 
                    k.user_id,
                    k.full_name,
                    k.date_of_birth,
                    k.address,
                    k.utility_bill,
                    k.gov_id,
                    k.status,
                    k.submitted_at,
                    u.firstname,
                    u.lastname
                FROM kyc_requests k
                LEFT JOIN users u ON k.user_id = u.user_id
                ORDER BY k.submitted_at DESC
            ";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user_id = addslashes($row['user_id']);
                    $full_name = addslashes($row['full_name']);
                    $dob = $row['date_of_birth'];
                    $address = addslashes($row['address']);
                    $utility_bill = "/utility_bill/" . addslashes($row['utility_bill']);
                    $gov_id = "/govt_id/" . addslashes($row['gov_id']);
                    $status = addslashes($row['status']);
                    $submitted_at = $row['submitted_at'];

                    $real_firstname = addslashes($row['firstname']);
                    $real_lastname = addslashes($row['lastname']);
                    $real_fullname = trim("$real_firstname $real_lastname");

                    echo "kycData.push({
                        user_id: '$user_id',
                        full_name: '$full_name',
                        date_of_birth: '$dob',
                        address: '$address',
                        utility_bill: '$utility_bill',
                        gov_id: '$gov_id',
                        status: '$status',
                        submitted_at: '$submitted_at',
                        real_name: '$real_fullname'
                    });\n";
                }
            }
        ?>
    </script>


    <script>
        let filteredData = [...kycData];

        const kycList = document.getElementById('kycList');
        const modal = document.getElementById('modal');
        const modalBody = document.getElementById('modalBody');
        const closeBtn = document.getElementById('closeBtn');
        const searchInput = document.getElementById('searchInput');
        const noResults = document.getElementById('noResults');

        function renderKycList(data) {
            if (data.length === 0) {
                kycList.style.display = 'none';
                noResults.style.display = 'block';
                return;
            }

            kycList.style.display = 'grid';
            noResults.style.display = 'none';

            kycList.innerHTML = data.map(item => {
                const [firstName, ...lastNameParts] = item.real_name.split(' ');
                const lastName = lastNameParts.join(' ');
                
                return `
                    <div class="kyc-item" onclick="openModal('${item.user_id}')">
                        <div class="kyc-item-content">
                            <div class="kyc-info">
                                <div class="kyc-name">${firstName} ${lastName}</div>
                                <div class="kyc-id">USR-${item.user_id}</div>
                            </div>
                            <div class="kyc-status status-${item.status.toLowerCase()}">${item.status}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }
       
        function openModal(userId) {
            const item = kycData.find(kyc => kyc.user_id === userId);
            if (!item) return;

            const statusClass = item.status.toLowerCase();

            let confirmButtonHtml = '';
            let declineButtonHtml = '';

            if (item.status === 'Pending') {
                confirmButtonHtml = `
                    <button id="confirmBtn" style="margin-top: 20px; font-size:17px; width: 100%; padding: 12px; background-color: var(--accent-clr); color: #fff; border: none; border-radius: 5px; cursor: pointer;">Confirm</button>
                `;
                declineButtonHtml = `
                    <button id="declineBtn" style="margin-top: 10px; font-size:17px; width: 100%; padding: 12px; background-color: var(--negative-text-clr); color: #fff; border: none; border-radius: 5px; cursor: pointer;">Decline</button>
                `;
            } else if(item.status === 'Rejected') {
                confirmButtonHtml = `
                    <button id="confirmBtn" style="margin-top: 20px; font-size:17px; width: 100%; padding: 12px; background-color: var(--accent-clr); color: #fff; border: none; border-radius: 5px; cursor: pointer;">Confirm</button>
                `;
                declineButtonHtml = ''; 
            }else {
                confirmButtonHtml = '';
                declineButtonHtml = ''; 
            }
            
            modalBody.innerHTML = `
                <div class="field-group">
                    <div class="field-label">User ID</div>
                    <div class="field-value">${item.user_id}</div>
                </div>
                
                <div class="field-group">
                    <div class="field-label">Full Name</div>
                    <div class="field-value">${item.full_name}</div>
                </div>
                
                <div class="field-group">
                    <div class="field-label">Date of Birth</div>
                    <div class="field-value">${new Date(item.date_of_birth).toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    })}</div>
                </div>
                
                <div class="field-group">
                    <div class="field-label">Address</div>
                    <div class="field-value">${item.address}</div>
                </div>
                
                <div class="field-group">
                    <div class="field-label">Status</div>
                    <div class="status-badge ${statusClass}">
                        ${item.status}
                    </div>
                </div>
                
                <div class="field-group">
                    <div class="field-label">Submitted At</div>
                    <div class="field-value">${new Date(item.submitted_at).toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    })}</div>
                </div>
                
                <div class="field-group">
                    <div class="field-label">Documents</div>
                    <div class="image-container">
                        <div class="image-item">
                            <img src="/chain-fortune${item.gov_id}" alt="Government ID" class="image-preview" onclick="openImageModal('/chain-fortune${item.gov_id}')">
                            <div class="image-label">Government ID</div>
                        </div>
                        <div class="image-item">
                            <img src="/chain-fortune${item.utility_bill}" alt="Utility Bill" class="image-preview" onclick="openImageModal('/chain-fortune${item.utility_bill}')">
                            <div class="image-label">Utility Bill</div>
                        </div>
                    </div>
                    ${confirmButtonHtml}
                    ${declineButtonHtml}
                </div>
            `;

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }





        function closeModal() {
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        function handleSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            
            if (searchTerm === '') {
                filteredData = [...kycData];
            } else {
                filteredData = kycData.filter(item => 
                    item.real_name.toLowerCase().includes(searchTerm) ||
                    item.user_id.toLowerCase().includes(searchTerm)
                );
            }
            
            renderKycList(filteredData);
        }

        function openImageModal(imageSrc) {
            window.open(imageSrc, '_blank');
        }

        closeBtn.addEventListener('click', closeModal);
        
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        searchInput.addEventListener('input', handleSearch);

        renderKycList(filteredData);
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
        });

        $(document).on('click', '#confirmBtn', function() {
            const userId = $(this).closest('.modal-content').find('.field-value').first().text();
            Swal.fire({
                title: 'Confirm KYC Request',
                text: `Are you sure you want to approve the KYC request for User ID: ${userId}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve',
                cancelButtonText: 'No, Cancel',
                background: 'var(--hover-clr)',
                color: '#ffffff',
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#f44336'
            }).then((result) => {
                if (result.isConfirmed) {
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
                    setTimeout(() => {
                        $.ajax({
                            url: '/chain-fortune/action/approve_kyc',
                            method: 'POST',
                            data: { user_id: userId },
                            dataType: 'json',
                            success: function(response) {
                                const data = response;
                                if (data.status === 'success') {
                                    showToast('success', data.message);
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'KYC Approved',
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
                                        location.reload();
                                    }
                                });
                                } else {
                                    showToast('error', data.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error:", status, error);
                                console.error("Server Response:", xhr.responseText);
                                showToast('error', 'Server error. Please try again.');
                            }
                        });
                    }, 2000);
                }
            });
        });
        $(document).on('click', '#declineBtn', function() {
            const userId = $(this).closest('.modal-content').find('.field-value').first().text();
            Swal.fire({
                title: 'Decline KYC Request',
                text: `Are you sure you want to decline the KYC request for User ID: ${userId}?, please provide a reason for declining the request.`,
                icon: 'warning',

                input: 'textarea',
                inputPlaceholder: 'Enter  reason for declining',
                inputAttributes: {
                    autocapitalize: 'off',
                    autocorrect: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Yes, Decline',
                cancelButtonText: 'No, Cancel',
                background: 'var(--hover-clr)',
                color: '#ffffff',
                confirmButtonColor: '#f44336',
                cancelButtonColor: '#4caf50'
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    const reason = result.value;
                    if (!reason) {
                        showToast('error', 'Please provide a reason for declining the KYC request.');
                        return;
                    };
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
                    setTimeout(() => {
                        $.ajax({
                            url: '/chain-fortune/action/decline_kyc',
                            method: 'POST',
                            data: { user_id: userId, reason: reason },
                            dataType: 'json',
                            success: function(response) {
                                const data = response;
                                if (data.status === 'success') {
                                    showToast('success', data.message);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'KYC Declined',
                                        text: data.message,
                                        background: 'var(--hover-clr)',
                                        color: '#ffffff',
                                        confirmButtonColor: '#f44336',
                                        allowOutsideClick: false,
                                        customClass: {
                                            popup: 'swal2-dark-popup'
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    showToast('error', data.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error:", status, error);
                                console.error("Server Response:", xhr.responseText);
                                showToast('error', 'Server error. Please try again.');
                            }
                        });
                    }, 2000);
                };
            });
        });
    </script>





</body>
</html>


