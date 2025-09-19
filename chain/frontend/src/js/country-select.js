$(document).ready(function() {
    const $select = $('#country-select');
    const $loading = $('#loading');
    const $selectWrapper = $('.select-wrapper');

    $selectWrapper.hide();
    $loading.show();

    $.ajax({
        url: 'https://countriesnow.space/api/v0.1/countries',
        method: 'GET',
        success: function(response) {
            if (response.error) {
                throw new Error(response.msg || 'Error fetching country data');
            }

            const countries = response.data;
            const sortedCountries = countries.sort((a, b) => 
                a.country.localeCompare(b.country)
            );

            sortedCountries.forEach(function(country) {
                $select.append($('<option>', {
                    value: country.country,
                    text: country.country
                }));
            });

            setTimeout(() => {
                $loading.hide();
                $selectWrapper.fadeIn(300);
            }, 500);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching countries:', textStatus, errorThrown);
            $loading.show();
            showToast('error','Error Loading countries' )
        }
    });

    $select.on('change', function() {
        if ($(this).val()) {
            $(this).css('color', 'var(--text-clr)');
        } else {
            $(this).css('color', 'var(--secondary-text-clr)');
        }
    });
});