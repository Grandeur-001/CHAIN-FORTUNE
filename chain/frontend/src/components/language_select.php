<script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <style>
        .language-selector {
            position: relative;
            width: 100%;
        }

        .selected-language-label{
            color: var(--secondary-text-clr);
            font-size: 0.875rem;
            font-weight: 500;
        }
        .selected-language {
            margin-top: 10px;
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .selected-language:active {
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }

        .flag-placeholder {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            margin-right: 12px;
            background-size: cover;
            background-position: center;
        }

        .selected-language > input{
            border: none;
            outline: none;
            background: transparent;
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 100%;

        }

        .chevron {
            transition: transform 0.3s ease;
        }

        .language-list {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--base-clr);
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            border-top: 1px solid var(--line-clr);
            padding-top: 5px;
        }

        .language-list.active {
            transform: translateY(0);
        }

        .search-box {
            position: relative;
            margin-bottom: 16px;
            margin-top: 20px;
        }

        .search-box input {
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            padding: 0.75rem 1rem;
            border-radius: 12px;
            color: var(--text-clr);
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;

        }

        .search-box input:focus {
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }

        .search-box svg {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-text-clr);
        }

        .languages-container {
            overflow-y: auto;
            flex: 1;
        }

        .languages-container::-webkit-scrollbar {
            width: 8px;
        }

        .languages-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .languages-container::-webkit-scrollbar-thumb {
            background: var(--line-clr);
            border-radius: 4px;
        }

        .languages-container::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-text-clr);
        }

        
        .loading {
            display: none;
            justify-content: center;
            align-items: center;
            height: 100px;
            background: var(--base-clr);
            width: 100%;
        }

        .spinner {
            width: 3rem;
            height: 3rem;
            margin: auto;
            border: 3px solid var(--line-clr);
            border-top-color: var(--accent-clr);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }


        .language-option {
            display: flex;
            align-items: center;
            padding: 12px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .language-option:hover {
            background-color: var(--hover-clr);
        }

        .language-option .flag {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            margin-right: 12px;
            background-size: cover;
            background-position: center;
        }

        .language-option span {
            color: var(--text-clr);
            font-size: 16px;
        }

        @media (max-width: 480px) {
            .langauge-container {
                /* padding: 16px; */
            }
            
            .selected-language {
                /* padding: 14px; */
            }
            
            .language-list {
                padding: 16px;
            }

            .search-box {
                margin-top: 0px;
            }

        }

        @media (max-width: 320px) {
            .langauge-container {
                /* padding: 12px; */
            }
            
            .selected-language {
                /* padding: 12px; */
            }
            
            .selected-language span {
                font-size: 14px;
            }
            
            .language-option span {
                font-size: 14px;
            }
        }
    </style>
    <div class="langauge-container">
        <div class="language-selector">
            <label class="selected-language-label" for="selectedLanguage">Select Language</label>
            <div class="selected-language" id="selectedLanguage">
                <img class="flag-placeholder" src="/chain-fortune/images/no-image.jpg" alt="">
                <input type="text" value="Select Language" readonly name="language" id="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chevron"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="language-list" id="languageList">
                <div class="search-box">
                    <input type="text" placeholder="Search language..." id="searchLanguage">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                <div class="languages-container">
                    <div id="loading" style="display: none;">
                        <div class="spinner"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const $loading = $('#loading');
            const languages = {
                'en': 'English',
                'es': 'Spanish',
                'fr': 'French',
                'de': 'German',
                'it': 'Italian',
                'pt': 'Portuguese',
                'ru': 'Russian',
                'zh': 'Chinese',
                'ja': 'Japanese',
                'ko': 'Korean',
                'ar': 'Arabic',
                'hi': 'Hindi',
                'tr': 'Turkish',
                'nl': 'Dutch',
                'pl': 'Polish',
                'vi': 'Vietnamese',
                'th': 'Thai',
                'sv': 'Swedish',
                'da': 'Danish',
                'fi': 'Finnish'
            };

            function getFlagUrl(langCode) {
                const countryMap = {
                    'en': 'gb',
                    'es': 'es',
                    'fr': 'fr',
                    'de': 'de',
                    'it': 'it',
                    'pt': 'pt',
                    'ru': 'ru',
                    'zh': 'cn',
                    'ja': 'jp',
                    'ko': 'kr',
                    'ar': 'sa',
                    'hi': 'in',
                    'tr': 'tr',
                    'nl': 'nl',
                    'pl': 'pl',
                    'vi': 'vn',
                    'th': 'th',
                    'sv': 'se',
                    'da': 'dk',
                    'fi': 'fi'
                };
                return `https://flagcdn.com/48x36/${countryMap[langCode]}.png`;
            }

            Object.entries(languages).forEach(([code, name]) => {
                $('.languages-container').append(`
                    <div class="language-option" data-lang="${code}">
                        <div class="flag" style="background-image: url('${getFlagUrl(code)}')"></div>
                        <span class="language-name">${name}</span>
                    </div>
                `);
            });

            $('#selectedLanguage').click(function() {
                $('.language-list').toggleClass('active');
                $('.chevron').toggleClass('rotate');
            });
            $('#searchLanguage').on('keyup', function() {
                $('.language-list').css('height', '80vh')
                let value = $(this).val().toLowerCase();
                let found = false;

                $(".language-option").each(function() {
                    var text = $(this).find(".language-name").text().toLowerCase();
                    var match = text.indexOf(value) > -1;
                    $(this).toggle(match);
                    if (match) found = true; 
                });

                if (!found && value.trim() !== "") {
                    $loading.show();
                    showToast('error', 'Language not found');
                } else {
                    $loading.hide();
                }
            });


            

            $('.language-option').click(function() {
                const code = $(this).data('lang');
                const name = $(this).find('span').text();
                const flagUrl = getFlagUrl(code);
                
                $('#selectedLanguage .flag-placeholder').attr('src', `${flagUrl}`);
                $('#selectedLanguage input').val(name);
                $('.language-list').removeClass('active');
            });

            $(document).click(function(e) {
                if (!$(e.target).closest('.language-selector').length) {
                    $('.language-list').removeClass('active');
                }
            });
        });
    </script>