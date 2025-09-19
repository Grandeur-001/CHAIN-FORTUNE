
<style>
    .rating-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: transparent;
        backdrop-filter: blur(4px);
        color: var(--text-clr);
        font-family: 'Arial', sans-serif;
        width: 100%;
        z-index: 9999999;
        position: fixed;
        top: 0;
        left: 0;
        visibility: hidden;
        opacity: 0;
        overflow-y: auto;
        padding: clamp(1rem, 4vw, 3rem);
        box-sizing: border-box;
    }

    .rating-wrapper.show {
        visibility: visible;
        opacity: 1;
    }

    .rating-container {
        position: relative;
        width: 100%;
        max-width: min(400px, 90vw);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .rating-card {
        background: var(--base-clr);
        border: 1px solid var(--line-clr);
        border-radius: 7px;
        padding: clamp(1.5rem, 5vw, 2.5rem);
        text-align: center;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(20px);
        transform: scale(0) rotate(10deg);
        opacity: 0;
        transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        width: 100%;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: clamp(1rem, 3vw, 1.5rem);
    }

    .rating-card.show {
        transform: scale(1) rotate(0deg);
        opacity: 1;
    }

    .rating-card.hide {
        transform: scale(0.8) translateY(-20px);
        opacity: 0;
    }

    .star-icon {
        width: clamp(40px, 10vw, 50px);
        height: clamp(40px, 10vw, 50px);
        background: var(--accent-clr);
        border-radius: clamp(8px, 2vw, 12px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(1.2rem, 3vw, 1.5rem);
        animation: pulse 2s infinite;
        flex-shrink: 0;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .rating-title {
        font-size: clamp(1.5rem, 5vw, 2rem);
        font-weight: 700;
        color: var(--text-clr);
        line-height: 1.2;
        margin: 0;
    }

    .rating-description {
        color: var(--secondary-text-clr);
        line-height: 1.6;
        font-size: clamp(0.9rem, 3vw, 1rem);
        margin: 0;
        max-width: 100%;
    }

    .rating-numbers {
        display: flex;
        gap: clamp(0.5rem, 2vw, 0.75rem);
        justify-content: center;
        flex-wrap: wrap;
        width: 100%;
        max-width: 300px;

        .rating-number {
            width: clamp(40px, 12vw, 50px);
            height: clamp(40px, 12vw, 50px);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            background: var(--base-clr);
            color: var(--secondary-text-clr);
            font-size: clamp(0.9rem, 3vw, 1.1rem);
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }
    }



    .rating-number::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, var(--accent-clr), var(--info-clr));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .rating-number:hover {
        border-color: var(--accent-clr);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(94, 99, 255, 0.2);
    }

    .rating-number:hover::before {
        opacity: 0.1;
    }

    .rating-number.selected {
        border-color: var(--accent-clr);
        background: var(--accent-clr);
        color: white;
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(94, 99, 255, 0.4);
    }

    .rating-number.selected::before {
        opacity: 0;
    }

    .submit-btn {
        width: 100%;
        max-width: 280px;
        padding: clamp(0.8rem, 3vw, 1rem) clamp(1.5rem, 4vw, 2rem);
        background: var(--accent-clr);
        border: none;
        border-radius: 7px;
        color: white;
        font-size: clamp(0.9rem, 3vw, 1.1rem);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        opacity: 0.5;
        pointer-events: none;
        box-sizing: border-box;
    }

    .submit-btn.active {
        opacity: 1;
        pointer-events: all;
    }

    .submit-btn:hover {
        background-color: #4a4fff;
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .no-thanks {
        width: 100%;
        max-width: 280px;
        padding: clamp(0.8rem, 3vw, 1rem) clamp(1.5rem, 4vw, 2rem);
        background: transparent;
        border: 1px solid var(--line-clr);
        border-radius: 7px;
        color: var(--secondary-text-clr);
        font-size: clamp(0.9rem, 3vw, 1.1rem);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-sizing: border-box;
    }

    .no-thanks:hover {
        border-color: var(--accent-clr);
        color: var(--accent-clr);
    }

    /* Thank You Card Styles */
    .thank-you-card {
        background: var(--base-clr);
        border: 1px solid var(--line-clr);
        border-radius: 7px;
        padding: clamp(1.5rem, 5vw, 2.5rem);
        text-align: center;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        overflow: hidden;
        backdrop-filter: blur(20px);
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.4),
            0 0 0 1px rgba(255, 255, 255, 0.05);
        transform: scale(0) rotate(-10deg);
        opacity: 0;
        transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        width: 100%;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: clamp(1rem, 3vw, 1.5rem);
    }

    .thank-you-card.show {
        transform: scale(1) rotate(0deg);
        opacity: 1;
    }

    .thank-you-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, 
            rgba(16, 185, 129, 0.1) 0%, 
            transparent 50%, 
            rgba(94, 99, 255, 0.05) 100%);
        pointer-events: none;
    }

    .thank-you-illustration {
        width: clamp(80px, 20vw, 120px);
        height: clamp(80px, 20vw, 120px);
        position: relative;
        animation: float 3s ease-in-out infinite;
        flex-shrink: 0;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .phone-icon {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(2rem, 8vw, 4rem);
    }

    .rating-badge {
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        color: white;
        padding: clamp(0.5rem, 2vw, 0.75rem) clamp(1rem, 3vw, 1.5rem);
        border-radius: 25px;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        font-size: clamp(0.8rem, 2.5vw, 1rem);
        text-align: center;
        max-width: 100%;
        box-sizing: border-box;
    }

    .thank-you-title {
        font-size: clamp(1.8rem, 6vw, 2.5rem);
        font-weight: 700;
        background: linear-gradient(135deg, var(--positive-text-clr), var(--accent-clr));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
        margin: 0;
    }

    .thank-you-message {
        color: var(--secondary-text-clr);
        line-height: 1.6;
        font-size: clamp(0.9rem, 3vw, 1rem);
        margin: 0;
        max-width: 100%;
    }

    /* Enhanced responsive breakpoints */
    @media (max-width: 480px) {
        .rating-wrapper {
            padding: 1rem;
        }
        
        .rating-container {
            max-width: 100%;
        }
        
        .rating-numbers {
            gap: 0.4rem;
            max-width: 280px;
        }
        
        .rating-number {
            min-width: 40px;
            min-height: 40px;
        }
    }

    @media (max-width: 360px) {
        .rating-wrapper {
            padding: 0.75rem;

            .rating-numbers {
                gap: 0.3rem;
                max-width: 260px;
            }
            
            .rating-number {
                min-width: 38px;
                min-height: 38px;
                font-size: 0.9rem;
            }
            
            .submit-btn,
            .no-thanks {
                font-size: 0.9rem;
                letter-spacing: 0.5px;
            }
        }
        
 
    }

    @media (max-width: 320px) {
        .rating-wrapper {
            padding: 0.5rem;
        }
        
        .rating-card,
        .thank-you-card {
            padding: 1.25rem;
            gap: 1rem;
        }
        
        .rating-numbers {
            gap: 0.25rem;
            max-width: 240px;
        }
        
        .rating-number {
            min-width: 36px;
            min-height: 36px;
            font-size: 0.85rem;
        }
        
        .star-icon {
            width: 36px;
            height: 36px;
            font-size: 1.1rem;
        }
        
        .submit-btn,
        .no-thanks {
            padding: 0.75rem 1.25rem;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .rating-badge {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
        }
    }

    /* Ensure no horizontal overflow */
    * {
        box-sizing: border-box;
    }
    
    .rating-wrapper,
    .rating-container,
    .rating-card,
    .thank-you-card {
        max-width: 100%;
        overflow-x: hidden;
    }
</style>
    <div class="rating-wrapper">
        <div class="rating-container">
            <!-- Rating Card -->
            <div class="rating-card" id="ratingCard">
                <div class="star-icon">⭐</div>
                <h1 class="rating-title">Your opinion matters to us!</h1>
                <p class="rating-description">
                    Please let us know how we did with your support request. All feedback is appreciated to help us improve our offering!
                </p>
                
                <div class="rating-numbers" id="ratingNumbers">
                    <div class="rating-number" data-rating="1">1</div>
                    <div class="rating-number" data-rating="2">2</div>
                    <div class="rating-number" data-rating="3">3</div>
                    <div class="rating-number" data-rating="4">4</div>
                    <div class="rating-number" data-rating="5">5</div>
                </div>
                
                <button class="submit-btn" id="submitBtn">Submit</button>
                <button class="no-thanks" id="noThanks">No Thanks</button>
            </div>

            <!-- Thank You Card -->
            <div class="thank-you-card" id="thankYouCard">
                <div class="thank-you-illustration">
                    <div class="phone-icon">
                        <div class="phone-screen">
                            <img src="https://ahmedchannani.github.io/intteractive-rating-app/images/illustration-thank-you.svg" alt="">
                        </div>
                    </div>
                    <div class="floating-card"></div>
                    <div class="floating-dot"></div>
                </div>
                
                <div class="rating-badge" id="ratingBadge">
                    You selected 5 out of 5
                </div>
                
                <h1 class="thank-you-title">Thank you!</h1>
                <p class="thank-you-message">
                    We appreciate you taking the time to give a rating. If you ever need more support, don't hesitate to get in touch!
                </p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let selectedRating = null;
        const ratingWrapper = $('.rating-wrapper');
        const ratingCard = $('#ratingCard');
        const thankYouCard = $('#thankYouCard');
        const ratingNumbers = $('.rating-number');
        const submitBtn = $('#submitBtn');
        const noThanks = $('#noThanks');
        noThanks.on('click', function() {
            ratingWrapper.removeClass('show');
            ratingCard.removeClass('show');
            thankYouCard.removeClass('show');
            ratingCard.hide();
            thankYouCard.hide();
        });
        const ratingBadge = $('#ratingBadge');

        function showRatingPopup() {
            ratingWrapper.addClass('show');
            ratingCard.addClass('show');

        }
        // showRatingPopup();

        ratingNumbers.on('click', function() {
            ratingNumbers.removeClass('selected');
            $(this).addClass('selected');
            selectedRating = parseInt($(this).attr('data-rating'));
            submitBtn.addClass('active');
        });

        submitBtn.on('click', function() {
            if (selectedRating === null) return;

            console.log(`You rated our app ${selectedRating}`);
            Swal.fire({
                title: 'Submitting your rating...',
                text: 'Please wait while we process your feedback.',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            setTimeout(() => {
                $.ajax({
                    type: 'POST',
                    url: '/chain-fortune/action/submit_rating',
                    data: {
                        rating: selectedRating
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            ratingBadge.text(`You selected ${selectedRating} out of 5`);
                            ratingCard.addClass('hide');

                            setTimeout(() => {
                                thankYouCard.addClass('show');
                            }, 1000);

                            setTimeout(() => {
                                ratingWrapper.removeClass('show');
                                ratingCard.removeClass('show');
                                thankYouCard.hide();
                            }, 100000);
                        }else{
                            showToast('error', data.message);
                        }
                    },
                    error: function () {
                        showToast('error', 'An error occurred. Please try again.');
                    }
                });
            }, 1000); 
        });

        ratingNumbers.hover(
            function() {
                if (!$(this).hasClass('selected')) {
                    $(this).css('transform', 'translateY(-2px) scale(1.05)');
                }
            },
            function() {
                if (!$(this).hasClass('selected')) {
                    $(this).css('transform', '');
                }
            }
        );

    </script>
