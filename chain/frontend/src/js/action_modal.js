$('.delete-btn').each(function() {
    $(this).on('click', function() {
        const userId = $(this).data('user-id'); 

        $.ajax({
            url: '/chain-fortune/action/delete_user',
            type: 'POST',
            data: { delete_user: true, user_id: userId },
            success: function(response) {
                showToast('info', 'User deleted successfully!');

                const userRow = $('#user-row-' + userId);
                if (userRow.length) {
                    userRow.remove();
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



$('.edit_btn').each(function() {
    $(this).on('click', function() {
        const userId = $(this).data('user-id');
        const modal = $('#edit_user_' + userId);
        
        const firstname = modal.find('input[name="firstname"]').val().trim();
        const lastname = modal.find('input[name="lastname"]').val().trim();
        const email = modal.find('input[name="email"]').val().trim();
        
        if (!firstname || !lastname || !email) {
            showToast('error', 'All fields are required.');
            return;
        }

        $.ajax({
            url: '/chain-fortune/action/edit_user',
            type: 'POST',
            data: {
                user_id: userId,
                firstname,
                lastname,
                email
            },
            success: function(response) {

                try {
                    const data = JSON.parse(response);
                    if (data.status === 'success') {
                        $('.edit_btn').attr('disabled',true);
                        showToast('success', data.message);
                        setTimeout(() =>{
                            location.reload();
                        },2000);
                    } else {
                        // showToast('error', data.message);
                    }
                } catch (error) {
                    console.error('Invalid JSON response:', response);
                    showToast('error', 'An unexpected error occurred.');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                showToast('error', 'An unexpected error occurred. Please try again later.');
            }
        });
    });
});

