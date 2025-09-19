$(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var found = false;

        $(".transactions-list").each(function() {
            var text = $(this).find(".hash-link").text().toLowerCase();
            var match = text.indexOf(value) > -1;
            $(this).toggle(match);
            if (match) found = true; 
        });
        
        if (!found && value.trim() !== "") {
            $('.loading').css({
                display: 'flex',
            });
            showToast('error', 'Transaction not found');
            $(".pagination .prev-next").prop("disabled", true);
            $(".pagination button").prop("disabled", true);

            
        } else {
            $('.loading').css({
                display: 'none',
            });
        }
    });

    const itemsPerPage = 10;
    let currentPage = 1;
    const $transactionList = $(".transactions-list");
    const totalPages = Math.ceil($transactionList.length / itemsPerPage);

    function showPage(page) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        $transactionList.hide().slice(start, end).show();

        updatePaginationButtons();
    }

    function updatePaginationButtons() {
        $(".pagination button").removeClass("active");
        $(`.pagination button:contains(${currentPage})`).addClass("active");

        $(".pagination .prev-next").prop("disabled", false);
        if (currentPage === 1) {
            $(".pagination .prev-next:contains(Prev)").prop("disabled", true);
        }
        if (currentPage === totalPages) {
            $(".pagination .prev-next:contains(Next)").prop("disabled", true);
        }
    }

    function initializePagination() {
        const $pagination = $("#pagination");
        $pagination.empty();

        $pagination.append(`
            <button class="prev-next" ${currentPage === 1 ? 'disabled' : ''}>
                Prev
            </button>
        `);

        for (let i = 1; i <= totalPages; i++) {
            $pagination.append(`<button ${i === currentPage ? 'class="active"' : ''}>${i}</button>`);
        }

        $pagination.append(`
            <button class="prev-next" ${currentPage === totalPages ? 'disabled' : ''}>
                Next
            </button>
        `);

        $(".pagination button").not('.prev-next').click(function() {
            if (!$(this).hasClass('active')) {
                currentPage = parseInt($(this).text());
                showPage(currentPage);
            }
        });

        $(".pagination .prev-next").click(function() {
            if (!$(this).prop('disabled')) {
                if ($(this).text().includes("Prev")) {
                    currentPage--;
                } else {
                    currentPage++;
                }
                showPage(currentPage);
            }
        });
    }

    initializePagination();
    showPage(currentPage);
});
