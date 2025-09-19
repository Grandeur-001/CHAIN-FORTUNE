<?php
include 'connection.php';

$role = 'user'; 
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT role FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();
}

function role_based_url($admin_url, $user_url) {
    global $role;
    return ($role === 'admin') ? $admin_url : $user_url;
}

    $dashboard_url = role_based_url('/chain-fortune/admin/dashboard', '/chain-fortune/dashboard');
    $exchange_url = role_based_url('/chain-fortune/admin/exchange', '/chain-fortune/exchange');
    $wallet_url = role_based_url('/chain-fortune/admin/wallet', '/chain-fortune/wallet');
    $deposit_url = role_based_url('/chain-fortune/admin/deposit', '/chain-fortune/deposit');
    $all_investments = role_based_url('/chain-fortune/admin/all_investments', '/chain-fortune/all_investments');
    $withdraw_url = role_based_url('/chain-fortune/admin/withdraw', '/chain-fortune/withdraw');
    $deposit_transactions_url = role_based_url('/chain-fortune/admin/deposit_transactions', '/chain-fortune/deposit_transactions');
    $withdrawal_transactions_url = role_based_url('/chain-fortune/admin/withdrawal_transactions', '/chain-fortune/withdrawal_transactions');
    $features_url = role_based_url('/chain-fortune/admin/features', '/chain-fortune/features');
    $market_chart_url = role_based_url('/chain-fortune/admin/market_chart', '/chain-fortune/market_chart');
    $profile_url = role_based_url('/chain-fortune/admin/profile', '/chain-fortune/profile');
    $investment_url = role_based_url('/chain-fortune/admin/investment', '/chain-fortune/investment');
    $submit_kyc_url = role_based_url('/chain-fortune/admin/submit_kyc', '/chain-fortune/submit_kyc');
?>
