$(document).ready(function() {
    const tokens = {
        'bitcoin': {
            id: 'bitcoin',
            symbol: 'BTC',
            name: 'Bitcoin',
            image: 'https://assets.coingecko.com/coins/images/1/small/bitcoin.png'
        },
        'ethereum': {
            id: 'ethereum',
            symbol: 'ETH',
            name: 'Ethereum',
            image: 'https://assets.coingecko.com/coins/images/279/small/ethereum.png'
        },
        'binancecoin': {
            id: 'binancecoin',
            symbol: 'BNB',
            name: 'BNB',
            image: 'https://assets.coingecko.com/coins/images/825/small/bnb-icon2_2x.png'
        },
        'ripple': {
            id: 'ripple',
            symbol: 'XRP',
            name: 'XRP',
            image: 'https://assets.coingecko.com/coins/images/44/small/xrp-symbol-white-128.png'
        },
        'cardano': {
            id: 'cardano',
            symbol: 'ADA',
            name: 'Cardano',
            image: 'https://assets.coingecko.com/coins/images/975/small/cardano.png'
        },
        'solana': {
            id: 'solana',
            symbol: 'SOL',
            name: 'Solana',
            image: 'https://assets.coingecko.com/coins/images/4128/small/solana.png'
        },
        'polkadot': {
            id: 'polkadot',
            symbol: 'DOT',
            name: 'Polkadot',
            image: 'https://assets.coingecko.com/coins/images/12171/small/polkadot.png'
        },
        'dogecoin': {
            id: 'dogecoin',
            symbol: 'DOGE',
            name: 'Dogecoin',
            image: 'https://assets.coingecko.com/coins/images/5/small/dogecoin.png'
        },
        'tron': {
            id: 'tron',
            symbol: 'TRX',
            name: 'TRON',
            image: 'https://assets.coingecko.com/coins/images/1094/small/tron-logo_2.png'
        },
        'usd-coin': {
            id: 'usd-coin',
            symbol: 'USDC',
            name: 'USD Coin',
            image: 'https://assets.coingecko.com/coins/images/6319/small/USD_Coin_icon.png'
        }
    };

    let currentPrices = {};
    let selectedType = null;
    let fromToken = null;
    let toToken = null;
    let updateTimer;

    function populateTokenList(searchTerm = '') {
        const $tokenList = $('.token-list');
        $tokenList.empty();

        const filteredTokens = Object.values(tokens).filter(token =>
            token.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
            token.symbol.toLowerCase().includes(searchTerm.toLowerCase())
        );

        if (filteredTokens.length === 0) {
            $tokenList.append('<div class="token-item no-results">No tokens found</div>');
            return;
        }

        filteredTokens.forEach(token => {
            const $tokenItem = $(`
                <div class="token-item" data-id="${token.id}">
                    <img src="${token.image}" alt="${token.symbol}">
                    <div class="token-info">
                        <div class="token-name">${token.name}</div>
                        <div class="token-symbol">${token.symbol}</div>
                    </div>
                </div>
            `);
            $tokenList.append($tokenItem);
        });
    }

    $('.search-input').on('input', function () {
        const searchTerm = $(this).val().trim();
        populateTokenList(searchTerm);
    });

    $('.token-select').click(function() {
        selectedType = $(this).data('type');
        $('.token-modal, .overlay').addClass('active');
        populateTokenList();
    });

    $('.close-modal, .overlay').click(function() {
        $('.token-modal, .overlay').removeClass('active');
        $('.search-input').val('');
    });

    $(document).on('click', '.token-item', function() {
        const tokenId = $(this).data('id');
        const token = tokens[tokenId];
        
        if (selectedType === 'from') {
            fromToken = token;
            $('#from-token-img').attr('src', token.image);
            $('#from-token-symbol').text(token.symbol);
        } else {
            toToken = token;
            $('#to-token-img').attr('src', token.image);
            $('#to-token-symbol').text(token.symbol);
        }

        $('.token-modal, .overlay').removeClass('active');
        $('.search-input').val('');
        updateSwapButton();
        if (fromToken && toToken) {
            fetchPrices();
        }
    });

    $('.swap-icon').click(function() {
        if (fromToken && toToken) {
            [fromToken, toToken] = [toToken, fromToken];
            $('#from-token-img').attr('src', fromToken.image);
            $('#from-token-symbol').text(fromToken.symbol);
            $('#to-token-img').attr('src', toToken.image);
            $('#to-token-symbol').text(toToken.symbol);
            updateSwapValues();
        }
    });

    function updateSwapButton() {
        const $btn = $('.convert-btn');
        if (!fromToken || !toToken) {
            $btn.text('Select tokens to swap').prop('disabled', true);
        } else {
            $btn.text('Exchange').prop('disabled', false);
        }
    }

    async function fetchPrices() {
        if (!fromToken || !toToken) return;
        
        try {
            const response = await $.get(
                `https://api.coingecko.com/api/v3/simple/price?ids=${fromToken.id},${toToken.id}&vs_currencies=usd`
            );
            currentPrices = {
                from: response[fromToken.id].usd,
                to: response[toToken.id].usd
            };
            updateSwapValues();
        } catch (error) {
            console.error('Error fetching prices:', error);
        }
    }

    function updateSwapValues() {
        if (!fromToken || !toToken || !currentPrices.from || !currentPrices.to){
            showToast('error', 'An error occurred')

            
            return;
        }
            

        const fromAmount = parseFloat($('#from-amount').val()) || 0;
        const fromUsdValue = fromAmount * currentPrices.from;
        const toAmount = fromUsdValue / currentPrices.to;

        $('#from-usd').text(`($${fromUsdValue.toFixed(2)})`);
        $('#to-amount').val(toAmount.toFixed(8));
        $('#to-usd').text(`($${fromUsdValue.toFixed(2)})`);

        const rate = currentPrices.from / currentPrices.to;
        $('#price-info').text(`1 ${fromToken.symbol} = ${rate.toFixed(8)} ${toToken.symbol}`);
    }

    $('#from-amount').on('input', updateSwapValues);

    $('.convert-btn').click(function() {
        if (fromToken && toToken) {
            showToast('success', 'Testing Purpose');
            console.log('fromToken:', fromToken, 'toToken:', toToken);
        } else if (!fromToken || toToken) {
            showToast('error', 'One Coin is missing');
        } else {
            showToast('error', 'No coin selected');
        }

    });


    function startPriceUpdates() {
        fetchPrices();
        updateTimer = setInterval(fetchPrices, 10000);
    }

    $(window).on('unload', function() {
        clearInterval(updateTimer);
    });

    populateTokenList();
    startPriceUpdates();
});

let x;
let y;
let z;



