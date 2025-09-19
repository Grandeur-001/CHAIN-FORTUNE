$('.delete-transaction-btn').each(function() {
    $(this).on('click', function() {
        const userId = $(this).data('user-id'); 

        $.ajax({
            url: '/chain-fortune/action/delete_transaction_logic',
            type: 'POST',
            data: { delete_transaction: true, user_id: userId },
            success: function(response) {
                showToast('info', 'Transaction deleted successfully!');

                const transactionRow = $('#transactions-row-' + userId);
                if (transactionRow.length) {
                    transactionRow.remove();
                }
                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function() {
                showToast('error', 'Error deleting user. Please try again.');
            }
        });
    });
});