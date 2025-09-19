    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
       




        @keyframes backgroundShift {
            0%, 100% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(-20px) translateY(-10px); }
            50% { transform: translateX(20px) translateY(10px); }
            75% { transform: translateX(-10px) translateY(20px); }
        }

        .skiptranslate,
        .goog-te-banner-frame {
            display: none !important;
        }

        /* Main translator button */
        .translator-trigger {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--accent-clr), var(--info-clr));
            color: var(--text-clr);
            border: none;
            border-radius: 20px;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 
                0 8px 32px rgba(94, 99, 255, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            z-index: 999;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .translator-trigger:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 
                0 20px 40px rgba(94, 99, 255, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        .translator-trigger:active {
            transform: translateY(-4px) scale(1.02);
        }

        .translator-trigger svg {
            width: 32px;
            height: 32px;
            stroke: var(--text-clr);
            fill: none;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        /* Translator overlay */
        .translator-overlay {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--base-clr);
            backdrop-filter: blur(20px);
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .translator-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .translator-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: var(--base-clr);
            backdrop-filter: blur(20px);
            border: 1px solid var(--line-clr);
            border-radius: 24px 24px 0 0;
            transform: translateY(100%);
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 
                0 -20px 60px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        .translator-overlay.active .translator-container {
            transform: translateY(0);
        }

        .translator-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 28px;
            background: var(--base-clr);
            border-bottom: 1px solid var(--glass-border);
            border-radius: 24px 24px 0 0;
            backdrop-filter: blur(10px);
        }

        .translator-title {
            font-size: 1.4rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-clr), var(--accent-clr));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
        }

        .translator-close {
            background: var(--base-clr);
            border: 1px solid var(--line-clr);
            color: var(--secondary-text-clr);
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .translator-close:hover {
            background: var(--hover-clr);
            border-color: var(--accent-clr);
            color: var(--text-clr);
            transform: scale(1.05);
        }

        .translator-close svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            stroke-width: 2;
        }

        .translator-content {
            background: transparent;
            padding: 28px;
            max-height: 70vh;
            overflow-y: auto;
        }

        .language-search {
            position: relative;
            margin-bottom: 24px;
        }

        .translator-search-input {
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            padding: 0.75rem 1rem;
            border-radius: 7px;
            color: var(--text-clr);
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .translator-search-input:focus {
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }

        .translator-search-input::placeholder {
            color: var(--secondary-text-clr);
            font-weight: 400;
        }

        .translator-search-icon {
            position: absolute;
            right: 12px;
            top: 55%;
            transform: translateY(-50%);
            color: var(--secondary-text-clr);
        }

        .translator-search-input:focus + .search-icon {
            color: var(--accent-clr);
        }

        .languages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .language-item {
            background: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .language-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent, rgba(94, 99, 255, 0.05));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .language-item:hover {
            border-color: var(--accent-clr);
            background: rgba(94, 99, 255, 0.08);
            transform: translateY(-6px) scale(1.02);
            box-shadow: 
                0 12px 40px rgba(94, 99, 255, 0.2),
                0 0 0 1px rgba(94, 99, 255, 0.3);
        }

        .language-item:hover::before {
            opacity: 1;
        }

        .language-item.selected {
            border-color: var(--accent-clr);
            background: linear-gradient(135deg, rgba(94, 99, 255, 0.15), rgba(0, 145, 255, 0.1));
            transform: translateY(-4px);
            box-shadow: 
                0 8px 32px rgba(94, 99, 255, 0.3),
                0 0 0 2px var(--accent-clr);
        }

        .language-item.selected::after {
            content: '';
            position: absolute;
            top: 12px;
            right: 12px;
            width: 20px;
            height: 20px;
            background: linear-gradient(135deg, var(--accent-clr), var(--info-clr));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(94, 99, 255, 0.4);
        }

        .language-item.selected::before {
            content: '';
            position: absolute;
            top: 16px;
            right: 16px;
            width: 12px;
            height: 12px;
            border-right: 2px solid var(--text-clr);
            border-bottom: 2px solid var(--text-clr);
            transform: rotate(45deg);
            z-index: 2;
        }

        .flag-container {
            width: 70px;
            height: 48px;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 16px;
            box-shadow: 
                0 4px 16px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease;
        }

        .language-item:hover .flag-container {
            transform: scale(1.05);
        }

        .flag-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .language-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-clr);
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }

        .language-native {
            font-size: 0.8rem;
            color: var(--secondary-text-clr);
            font-weight: 400;
            opacity: 0.8;
        }

        /* Custom scrollbar */
        .translator-content::-webkit-scrollbar {
            width: 8px;
        }

        .translator-content::-webkit-scrollbar-track {
            background: var(--hover-clr);
            border-radius: 4px;
        }

        .translator-content::-webkit-scrollbar-thumb {
            background: var(--line-clr);
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(94, 99, 255, 0.3);
        }
        
        .translator-content::-webkit-scrollbar-thumb:hover {
            background: var(--accent-clr);
        }

        /* Recently used languages */
        .recent-languages {
            margin-bottom: 28px;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-clr);
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            position: relative;
            padding-left: 16px;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: linear-gradient(135deg, var(--accent-clr), var(--info-clr));
            border-radius: 2px;
        }

        .recent-grid {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding-bottom: 12px;
            scrollbar-width: thin;
            scrollbar-color: var(--accent-clr) transparent;
        }

        .recent-grid::-webkit-scrollbar {
            height: 6px;
        }

        .recent-grid::-webkit-scrollbar-track {
            background: var(--base-clr);
            border-radius: 3px;
        }

        .recent-grid::-webkit-scrollbar-thumb {
            background: var(--accent-clr);
            border-radius: 3px;
        }

        .recent-item {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            min-width: 140px;
        }

        .recent-item:hover {
            border-color: var(--accent-clr);
            background: rgba(94, 99, 255, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(94, 99, 255, 0.2);
        }

        .recent-flag {
            width: 28px;
            height: 20px;
            border-radius: 4px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .recent-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-clr);
        }

        /* Animation */
        @keyframes fadeInUp {
            from { 
                opacity: 0; 
                transform: translateY(30px);
            }
            to { 
                opacity: 1; 
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from { 
                opacity: 0; 
                transform: scale(0.9);
            }
            to { 
                opacity: 1; 
                transform: scale(1);
            }
        }

        .animate-in {
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .animate-scale {
            animation: scaleIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        /* Hidden Google Translate element */
        #google_translate_element2 {
            display: none !important;
        }

        /* Loading state */
        .loading-skeleton {
            background: linear-gradient(90deg, 
                rgba(255, 255, 255, 0.05) 25%, 
                rgba(255, 255, 255, 0.1) 50%, 
                rgba(255, 255, 255, 0.05) 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
            border-radius: 16px;
            height: 140px;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .languages-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 16px;
            }
            
            .translator-content {
                padding: 20px;
            }
            
            .translator-header {
                padding: 20px 24px;
            }
        }

        @media (max-width: 480px) {
            .languages-grid {
                grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
                gap: 12px;
            }
            
            .translator-trigger {
                width: 60px;
                height: 60px;
                bottom: 20px;
                right: 20px;
                border-radius: 16px;
            }
            
            .translator-trigger svg {
                width: 28px;
                height: 28px;
            }
            
            .translator-content {
                padding: 16px;
            }
            
            .language-item {
                padding: 16px;
            }
            
            .flag-container {
                width: 60px;
                height: 40px;
            }
        }

        /* Pulse animation for selected language */
        @keyframes pulse {
            0%, 100% { box-shadow: 0 8px 32px rgba(94, 99, 255, 0.3), 0 0 0 2px var(--accent-clr); }
            50% { box-shadow: 0 8px 32px rgba(94, 99, 255, 0.5), 0 0 0 4px rgba(94, 99, 255, 0.3); }
        }

        .language-item.selected {
            animation: pulse 2s infinite;
        }
    </style>


    <!-- Translator overlay -->
    <div class="translator-overlay" id="translatorOverlay">
        <div class="translator-container">
            <div class="translator-header">
                <h3 class="translator-title">Select Language</h3>
                <button class="translator-close" id="translatorClose" aria-label="Close translator">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="translator-content">
                <!-- Search input -->
                <div class="language-search">
                    <input type="text" class="translator-search-input" id="searchLanguage" placeholder="Search languages...">
                    <span class="translator-search-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                </div>

                <!-- Recently used languages -->
                <div class="recent-languages">
                    <h4 class="section-title">Recently Used</h4>
                    <div class="recent-grid" id="recentLanguages">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>

                <!-- All languages grid -->
                <h4 class="section-title">All Languages</h4>
                <div class="languages-grid" id="languagesGrid">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Google Translate element -->
    <div id="google_translate_element2"></div>

    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
    <!-- <script>
        // Google Translate initialization function
        function googleTranslateElementInit2() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                autoDisplay: false
            }, 'google_translate_element2');
        }

        // GTranslate helper function (from the provided code)
        function GTranslateFireEvent(element, event) {
            try {
                if (document.createEvent) {
                    var evt = document.createEvent("HTMLEvents");
                    evt.initEvent(event, true, true);
                    element.dispatchEvent(evt);
                } else {
                    var evt = document.createEventObject();
                    element.fireEvent('on' + event, evt);
                }
            } catch (e) {}
        }

        // doGTranslate function (from the provided code)
        function doGTranslate(lang_pair) {
            if (lang_pair.value) lang_pair = lang_pair.value;
            if (lang_pair == '') return;
            var lang = lang_pair.split('|')[1];
            var teCombo;
            var selects = document.getElementsByTagName('select');
            for (var i = 0; i < selects.length; i++) {
                if (selects[i].className == 'goog-te-combo') teCombo = selects[i];
            }
            if (document.getElementById('google_translate_element2') == null || document.getElementById('google_translate_element2').innerHTML.length == 0 || teCombo.length == 0 || teCombo.innerHTML.length == 0) {
                setTimeout(function() {
                    doGTranslate(lang_pair);
                }, 500);
            } else {
                teCombo.value = lang;
                GTranslateFireEvent(teCombo, 'change');
                GTranslateFireEvent(teCombo, 'change');
                
                // Send selected language to backend
                sendLanguageToBackend(lang_pair.split('|')[1]);
            }
        }

        // Function to send selected language to backend
        function sendLanguageToBackend(langPair) {
            $.ajax({
                url: '/chain-fortune/action/set_language',
                method: 'POST',
                data: {
                    language: langPair
                },
                success: function(response) {
                    console.log('Language preference saved:', langPair);
                    Swal.fire({
                        icon: 'info',
                        title: 'Language Updated',
                        text: `You have selected ${langPair} as your preferred language.`,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        background: 'var(--hover-clr)',
                        color: 'var(--text-clr)',
                        
                    });
                    
                    const lang = langPair.split('|')[1];
                    addToRecentLanguages(lang);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to save language preference:', error);
                }
            });
        }

        // Remove the hardcoded languages array and replace with:
        let languages = [];
        let countries = {};
        let selectedLanguage = '<?php 
            echo isset($_SESSION['selected_language']) ? $_SESSION['selected_language'] : 'en|English';
        ?>'; // This will be set dynamically from PHP

        // Function to load countries from REST Countries API
        async function loadCountries() {
            try {
                const response = await fetch('https://restcountries.com/v3.1/all?fields=name,cca2,flag');
                const countriesData = await response.json();
                
                // Create a mapping of country codes to country data
                countriesData.forEach(country => {
                    countries[country.cca2.toLowerCase()] = {
                        name: country.name.common,
                        flag: country.flag,
                        code: country.cca2.toLowerCase()
                    };
                });
                
                console.log('Countries loaded:', Object.keys(countries).length);
            } catch (error) {
                console.error('Failed to load countries:', error);
                // Fallback to flagcdn if REST Countries fails
            }
        }

        // Function to load supported languages from Google Translate API
        async function loadSupportedLanguages() {
            try {
                // Show loading skeletons
                showLoadingSkeletons();
                
                // First load countries
                await loadCountries();
                
                // Google Translate supported languages with their country mappings
                const googleLanguages = [
                    { code: 'af', name: 'Afrikaans', native: 'Afrikaans', countries: ['za'] },
                    { code: 'sq', name: 'Albanian', native: 'Shqip', countries: ['al'] },
                    { code: 'am', name: 'Amharic', native: 'አማርኛ', countries: ['et'] },
                    { code: 'ar', name: 'Arabic', native: 'العربية', countries: ['sa', 'ae', 'eg', 'ma', 'dz', 'tn', 'ly', 'sd', 'sy', 'iq', 'jo', 'lb', 'kw', 'qa', 'bh', 'om', 'ye'] },
                    { code: 'hy', name: 'Armenian', native: 'Հայերեն', countries: ['am'] },
                    { code: 'as', name: 'Assamese', native: 'অসমীয়া', countries: ['in'] },
                    { code: 'ay', name: 'Aymara', native: 'Aymar aru', countries: ['bo', 'pe'] },
                    { code: 'az', name: 'Azerbaijani', native: 'Azərbaycanca', countries: ['az'] },
                    { code: 'bm', name: 'Bambara', native: 'Bamanankan', countries: ['ml'] },
                    { code: 'eu', name: 'Basque', native: 'Euskera', countries: ['es'] },
                    { code: 'be', name: 'Belarusian', native: 'Беларуская', countries: ['by'] },
                    { code: 'bn', name: 'Bengali', native: 'বাংলা', countries: ['bd', 'in'] },
                    { code: 'bho', name: 'Bhojpuri', native: 'भोजपुरी', countries: ['in'] },
                    { code: 'bs', name: 'Bosnian', native: 'Bosanski', countries: ['ba'] },
                    { code: 'bg', name: 'Bulgarian', native: 'Български', countries: ['bg'] },
                    { code: 'ca', name: 'Catalan', native: 'Català', countries: ['es', 'ad'] },
                    { code: 'ceb', name: 'Cebuano', native: 'Cebuano', countries: ['ph'] },
                    { code: 'ny', name: 'Chichewa', native: 'Chichewa', countries: ['mw'] },
                    { code: 'zh-cn', name: 'Chinese (Simplified)', native: '简体中文', countries: ['cn'] },
                    { code: 'zh-tw', name: 'Chinese (Traditional)', native: '繁體中文', countries: ['tw', 'hk'] },
                    { code: 'co', name: 'Corsican', native: 'Corsu', countries: ['fr'] },
                    { code: 'hr', name: 'Croatian', native: 'Hrvatski', countries: ['hr'] },
                    { code: 'cs', name: 'Czech', native: 'Čeština', countries: ['cz'] },
                    { code: 'da', name: 'Danish', native: 'Dansk', countries: ['dk'] },
                    { code: 'dv', name: 'Dhivehi', native: 'ދިވެހި', countries: ['mv'] },
                    { code: 'doi', name: 'Dogri', native: 'डोगरी', countries: ['in'] },
                    { code: 'nl', name: 'Dutch', native: 'Nederlands', countries: ['nl', 'be'] },
                    { code: 'en', name: 'English', native: 'English', countries: ['us', 'gb', 'au', 'ca', 'nz', 'ie', 'za'] },
                    { code: 'eo', name: 'Esperanto', native: 'Esperanto', countries: ['eu'] },
                    { code: 'et', name: 'Estonian', native: 'Eesti', countries: ['ee'] },
                    { code: 'ee', name: 'Ewe', native: 'Eʋegbe', countries: ['gh', 'tg'] },
                    { code: 'tl', name: 'Filipino', native: 'Filipino', countries: ['ph'] },
                    { code: 'fi', name: 'Finnish', native: 'Suomi', countries: ['fi'] },
                    { code: 'fr', name: 'French', native: 'Français', countries: ['fr', 'ca', 'be', 'ch', 'mc'] },
                    { code: 'fy', name: 'Frisian', native: 'Frysk', countries: ['nl'] },
                    { code: 'gl', name: 'Galician', native: 'Galego', countries: ['es'] },
                    { code: 'ka', name: 'Georgian', native: 'ქართული', countries: ['ge'] },
                    { code: 'de', name: 'German', native: 'Deutsch', countries: ['de', 'at', 'ch'] },
                    { code: 'el', name: 'Greek', native: 'Ελληνικά', countries: ['gr', 'cy'] },
                    { code: 'gn', name: 'Guarani', native: 'Avañe\'ẽ', countries: ['py'] },
                    { code: 'gu', name: 'Gujarati', native: 'ગુજરાતી', countries: ['in'] },
                    { code: 'ht', name: 'Haitian Creole', native: 'Kreyòl ayisyen', countries: ['ht'] },
                    { code: 'ha', name: 'Hausa', native: 'Harshen Hausa', countries: ['ng', 'ne'] },
                    { code: 'haw', name: 'Hawaiian', native: 'ʻŌlelo Hawaiʻi', countries: ['us'] },
                    { code: 'iw', name: 'Hebrew', native: 'עברית', countries: ['il'] },
                    { code: 'hi', name: 'Hindi', native: 'हिन्दी', countries: ['in'] },
                    { code: 'hmn', name: 'Hmong', native: 'Hmoob', countries: ['cn', 'vn', 'la'] },
                    { code: 'hu', name: 'Hungarian', native: 'Magyar', countries: ['hu'] },
                    { code: 'is', name: 'Icelandic', native: 'Íslenska', countries: ['is'] },
                    { code: 'ig', name: 'Igbo', native: 'Asụsụ Igbo', countries: ['ng'] },
                    { code: 'ilo', name: 'Ilocano', native: 'Ilokano', countries: ['ph'] },
                    { code: 'id', name: 'Indonesian', native: 'Bahasa Indonesia', countries: ['id'] },
                    { code: 'ga', name: 'Irish', native: 'Gaeilge', countries: ['ie'] },
                    { code: 'it', name: 'Italian', native: 'Italiano', countries: ['it', 'ch', 'sm', 'va'] },
                    { code: 'ja', name: 'Japanese', native: '日本語', countries: ['jp'] },
                    { code: 'jw', name: 'Javanese', native: 'Basa Jawa', countries: ['id'] },
                    { code: 'kn', name: 'Kannada', native: 'ಕನ್ನಡ', countries: ['in'] },
                    { code: 'kk', name: 'Kazakh', native: 'Қазақ тілі', countries: ['kz'] },
                    { code: 'km', name: 'Khmer', native: 'ភាសាខ្មែរ', countries: ['kh'] },
                    { code: 'rw', name: 'Kinyarwanda', native: 'Ikinyarwanda', countries: ['rw'] },
                    { code: 'gom', name: 'Konkani', native: 'कोंकणी', countries: ['in'] },
                    { code: 'ko', name: 'Korean', native: '한국어', countries: ['kr', 'kp'] },
                    { code: 'kri', name: 'Krio', native: 'Krio', countries: ['sl'] },
                    { code: 'ku', name: 'Kurdish (Kurmanji)', native: 'Kurdî', countries: ['tr', 'sy', 'iq', 'ir'] },
                    { code: 'ckb', name: 'Kurdish (Sorani)', native: 'کوردی', countries: ['iq', 'ir'] },
                    { code: 'ky', name: 'Kyrgyz', native: 'Кыргызча', countries: ['kg'] },
                    { code: 'lo', name: 'Lao', native: 'ລາວ', countries: ['la'] },
                    { code: 'la', name: 'Latin', native: 'Latinum', countries: ['va'] },
                    { code: 'lv', name: 'Latvian', native: 'Latviešu', countries: ['lv'] },
                    { code: 'ln', name: 'Lingala', native: 'Lingála', countries: ['cd', 'cg'] },
                    { code: 'lt', name: 'Lithuanian', native: 'Lietuvių', countries: ['lt'] },
                    { code: 'lg', name: 'Luganda', native: 'Luganda', countries: ['ug'] },
                    { code: 'lb', name: 'Luxembourgish', native: 'Lëtzebuergesch', countries: ['lu'] },
                    { code: 'mk', name: 'Macedonian', native: 'Македонски', countries: ['mk'] },
                    { code: 'mai', name: 'Maithili', native: 'मैथिली', countries: ['in'] },
                    { code: 'mg', name: 'Malagasy', native: 'Malagasy', countries: ['mg'] },
                    { code: 'ms', name: 'Malay', native: 'Bahasa Melayu', countries: ['my', 'bn'] },
                    { code: 'ml', name: 'Malayalam', native: 'മലയാളം', countries: ['in'] },
                    { code: 'mt', name: 'Maltese', native: 'Malti', countries: ['mt'] },
                    { code: 'mi', name: 'Maori', native: 'Te Reo Māori', countries: ['nz'] },
                    { code: 'mr', name: 'Marathi', native: 'मराठी', countries: ['in'] },
                    { code: 'mni-mtei', name: 'Meiteilon (Manipuri)', native: 'মেইতেই লোন্', countries: ['in'] },
                    { code: 'lus', name: 'Mizo', native: 'Mizo ṭawng', countries: ['in'] },
                    { code: 'mn', name: 'Mongolian', native: 'Монгол', countries: ['mn'] },
                    { code: 'my', name: 'Myanmar (Burmese)', native: 'ဗမာ', countries: ['mm'] },
                    { code: 'ne', name: 'Nepali', native: 'नेपाली', countries: ['np'] },
                    { code: 'no', name: 'Norwegian', native: 'Norsk', countries: ['no'] },
                    { code: 'or', name: 'Odia (Oriya)', native: 'ଓଡ଼ିଆ', countries: ['in'] },
                    { code: 'om', name: 'Oromo', native: 'Afaan Oromoo', countries: ['et'] },
                    { code: 'ps', name: 'Pashto', native: 'پښتو', countries: ['af', 'pk'] },
                    { code: 'fa', name: 'Persian', native: 'فارسی', countries: ['ir', 'af', 'tj'] },
                    { code: 'pl', name: 'Polish', native: 'Polski', countries: ['pl'] },
                    { code: 'pt', name: 'Portuguese', native: 'Português', countries: ['pt', 'br', 'ao', 'mz'] },
                    { code: 'pa', name: 'Punjabi', native: 'ਪੰਜਾਬੀ', countries: ['in', 'pk'] },
                    { code: 'qu', name: 'Quechua', native: 'Runa Simi', countries: ['pe', 'bo', 'ec'] },
                    { code: 'ro', name: 'Romanian', native: 'Română', countries: ['ro', 'md'] },
                    { code: 'ru', name: 'Russian', native: 'Русский', countries: ['ru', 'by', 'kz', 'kg'] },
                    { code: 'sm', name: 'Samoan', native: 'Gagana Sāmoa', countries: ['ws'] },
                    { code: 'sa', name: 'Sanskrit', native: 'संस्कृतम्', countries: ['in'] },
                    { code: 'gd', name: 'Scots Gaelic', native: 'Gàidhlig', countries: ['gb'] },
                    { code: 'nso', name: 'Sepedi', native: 'Sesotho sa Leboa', countries: ['za'] },
                    { code: 'sr', name: 'Serbian', native: 'Српски', countries: ['rs', 'ba', 'me'] },
                    { code: 'st', name: 'Sesotho', native: 'Sesotho', countries: ['ls', 'za'] },
                    { code: 'sn', name: 'Shona', native: 'ChiShona', countries: ['zw'] },
                    { code: 'sd', name: 'Sindhi', native: 'سنڌي', countries: ['pk', 'in'] },
                    { code: 'si', name: 'Sinhala', native: 'සිංහල', countries: ['lk'] },
                    { code: 'sk', name: 'Slovak', native: 'Slovenčina', countries: ['sk'] },
                    { code: 'sl', name: 'Slovenian', native: 'Slovenščina', countries: ['si'] },
                    { code: 'so', name: 'Somali', native: 'Soomaali', countries: ['so', 'et', 'dj'] },
                    { code: 'es', name: 'Spanish', native: 'Español', countries: ['es', 'mx', 'ar', 'co', 've', 'pe', 'ec', 'gt', 'cu', 'bo', 'do', 'hn', 'py', 'sv', 'ni', 'cr', 'pa', 'uy', 'gq'] },
                    { code: 'su', name: 'Sundanese', native: 'Basa Sunda', countries: ['id'] },
                    { code: 'sw', name: 'Swahili', native: 'Kiswahili', countries: ['ke', 'tz', 'ug', 'cd'] },
                    { code: 'sv', name: 'Swedish', native: 'Svenska', countries: ['se', 'fi'] },
                    { code: 'tg', name: 'Tajik', native: 'Тоҷикӣ', countries: ['tj'] },
                    { code: 'ta', name: 'Tamil', native: 'தமிழ்', countries: ['in', 'lk', 'sg'] },
                    { code: 'tt', name: 'Tatar', native: 'Татарча', countries: ['ru'] },
                    { code: 'te', name: 'Telugu', native: 'తెలుగు', countries: ['in'] },
                    { code: 'th', name: 'Thai', native: 'ไทย', countries: ['th'] },
                    { code: 'ti', name: 'Tigrinya', native: 'ትግርኛ', countries: ['er', 'et'] },
                    { code: 'ts', name: 'Tsonga', native: 'Xitsonga', countries: ['za'] },
                    { code: 'tr', name: 'Turkish', native: 'Türkçe', countries: ['tr', 'cy'] },
                    { code: 'tk', name: 'Turkmen', native: 'Türkmen', countries: ['tm'] },
                    { code: 'ak', name: 'Twi', native: 'Twi', countries: ['gh'] },
                    { code: 'uk', name: 'Ukrainian', native: 'Українська', countries: ['ua'] },
                    { code: 'ur', name: 'Urdu', native: 'اردو', countries: ['pk', 'in'] },
                    { code: 'ug', name: 'Uyghur', native: 'ئۇيغۇرچە', countries: ['cn'] },
                    { code: 'uz', name: 'Uzbek', native: 'Oʻzbekcha', countries: ['uz'] },
                    { code: 'vi', name: 'Vietnamese', native: 'Tiếng Việt', countries: ['vn'] },
                    { code: 'cy', name: 'Welsh', native: 'Cymraeg', countries: ['gb'] },
                    { code: 'xh', name: 'Xhosa', native: 'isiXhosa', countries: ['za'] },
                    { code: 'yi', name: 'Yiddish', native: 'ייִדיש', countries: ['il'] },
                    { code: 'yo', name: 'Yoruba', native: 'Yorùbá', countries: ['ng', 'bj'] },
                    { code: 'zu', name: 'Zulu', native: 'isiZulu', countries: ['za'] }
                ];

                // Process languages and assign flags
                languages = googleLanguages.map(lang => {
                    // Use the first country as primary, or fallback to 'un' for unknown
                    const primaryCountry = lang.countries[0] || 'un';
                    
                    return {
                        ...lang,
                        country: primaryCountry,
                        flagUrl: `https://flagcdn.com/w80/${primaryCountry}.png`,
                        flagUrlSmall: `https://flagcdn.com/w40/${primaryCountry}.png`
                    };
                });

                console.log('Languages loaded:', languages.length);
                
                // Render languages after loading
                renderLanguages();
                renderRecentLanguages();
                
            } catch (error) {
                console.error('Failed to load languages:', error);
                // Fallback to a basic set if API fails
                loadFallbackLanguages();
            }
        }

        // Show loading skeletons
        function showLoadingSkeletons() {
            const $grid = $('#languagesGrid');
            $grid.empty();
            
            // Create 12 loading skeletons
            for (let i = 0; i < 12; i++) {
                $grid.append('<div class="loading-skeleton"></div>');
            }
        }

        // Fallback function if APIs fail
        function loadFallbackLanguages() {
            languages = [
                { code: 'en', name: 'English', native: 'English', country: 'us', flagUrl: 'https://flagcdn.com/w80/us.png', flagUrlSmall: 'https://flagcdn.com/w40/us.png' },
                { code: 'es', name: 'Spanish', native: 'Español', country: 'es', flagUrl: 'https://flagcdn.com/w80/es.png', flagUrlSmall: 'https://flagcdn.com/w40/es.png' },
                { code: 'fr', name: 'French', native: 'Français', country: 'fr', flagUrl: 'https://flagcdn.com/w80/fr.png', flagUrlSmall: 'https://flagcdn.com/w40/fr.png' },
                { code: 'de', name: 'German', native: 'Deutsch', country: 'de', flagUrl: 'https://flagcdn.com/w80/de.png', flagUrlSmall: 'https://flagcdn.com/w40/de.png' },
                { code: 'it', name: 'Italian', native: 'Italiano', country: 'it', flagUrl: 'https://flagcdn.com/w80/it.png', flagUrlSmall: 'https://flagcdn.com/w40/it.png' },
                { code: 'pt', name: 'Portuguese', native: 'Português', country: 'pt', flagUrl: 'https://flagcdn.com/w80/pt.png', flagUrlSmall: 'https://flagcdn.com/w40/pt.png' },
                { code: 'ru', name: 'Russian', native: 'Русский', country: 'ru', flagUrl: 'https://flagcdn.com/w80/ru.png', flagUrlSmall: 'https://flagcdn.com/w40/ru.png' },
                { code: 'ja', name: 'Japanese', native: '日本語', country: 'jp', flagUrl: 'https://flagcdn.com/w80/jp.png', flagUrlSmall: 'https://flagcdn.com/w40/jp.png' },
                { code: 'ko', name: 'Korean', native: '한국어', country: 'kr', flagUrl: 'https://flagcdn.com/w80/kr.png', flagUrlSmall: 'https://flagcdn.com/w40/kr.png' },
                { code: 'zh-cn', name: 'Chinese (Simplified)', native: '简体中文', country: 'cn', flagUrl: 'https://flagcdn.com/w80/cn.png', flagUrlSmall: 'https://flagcdn.com/w40/cn.png' }
            ];
            
            renderLanguages();
            renderRecentLanguages();
        }

        // Store recent languages in localStorage
        function addToRecentLanguages(langCode) {
            let recentLangs = JSON.parse(localStorage.getItem('recentLanguages')) || [];
            
            // Remove if already exists
            recentLangs = recentLangs.filter(code => code !== langCode);
            
            // Add to beginning
            recentLangs.unshift(langCode);
            
            // Keep only 5 most recent
            if (recentLangs.length > 5) {
                recentLangs = recentLangs.slice(0, 5);
            }
            
            localStorage.setItem('recentLanguages', JSON.stringify(recentLangs));
            
            // Update UI
            renderRecentLanguages();
        }

        // Update the renderLanguages function to use the new structure and set default selection
        function renderLanguages() {
            const $grid = $('#languagesGrid');
            $grid.empty();
            
            languages.forEach((lang, index) => {
                const isSelected = lang.code === selectedLanguage;
                const $item = $(`
                    <div class="language-item animate-in ${isSelected ? 'selected' : ''}" data-lang-code="${lang.code}" style="animation-delay: ${index * 0.03}s">
                        <div class="flag-container">
                            <img src="${lang.flagUrl}" alt="${lang.name}" class="flag-img" onerror="this.src='https://flagcdn.com/w80/un.png'">
                        </div>
                        <div class="language-name">${lang.name}</div>
                        <div class="language-native">${lang.native}</div>
                    </div>
                `);
                
                $item.on('click', function() {
                    $('.language-item').removeClass('selected');
                    $(this).addClass('selected');
                    selectedLanguage = lang.code;
                    doGTranslate(`en|${lang.code}`);
                    
                    // Close modal after a short delay
                    setTimeout(() => {
                        closeTranslator();
                    }, 500);
                });
                
                $grid.append($item);
            });
        }

        // Update the renderRecentLanguages function
        function renderRecentLanguages() {
            const recentLangs = JSON.parse(localStorage.getItem('recentLanguages')) || [];
            const $recentContainer = $('#recentLanguages');
            
            $recentContainer.empty();
            
            if (recentLangs.length === 0) {
                $recentContainer.append('<div class="recent-item animate-scale" style="opacity: 0.6; cursor: default;">No recent languages</div>');
                return;
            }
            
            recentLangs.forEach((code, index) => {
                const lang = languages.find(l => l.code === code);
                if (lang) {
                    const $item = $(`
                        <div class="recent-item animate-scale" data-lang-code="${lang.code}" style="animation-delay: ${index * 0.1}s">
                            <img src="${lang.flagUrlSmall}" alt="${lang.name}" class="recent-flag" onerror="this.src='https://flagcdn.com/w40/un.png'">
                            <span class="recent-name">${lang.name}</span>
                        </div>
                    `);
                    
                    $item.on('click', function() {
                        $('.language-item').removeClass('selected');
                        $(`.language-item[data-lang-code="${lang.code}"]`).addClass('selected');
                        selectedLanguage = lang.code;
                        doGTranslate(`en|${lang.code}`);
                        
                        // Close modal after a short delay
                        setTimeout(() => {
                            closeTranslator();
                        }, 300);
                    });
                    
                    $recentContainer.append($item);
                }
            });
        }

        // Filter languages based on search
        function filterLanguages(query) {
            const $items = $('.language-item');
            
            if (!query) {
                $items.show();
                return;
            }
            
            query = query.toLowerCase();
            
            $items.each(function() {
                const $item = $(this);
                const code = $item.data('lang-code');
                const lang = languages.find(l => l.code === code);
                
                if (lang && (lang.name.toLowerCase().includes(query) || 
                             lang.native.toLowerCase().includes(query) || 
                             lang.code.toLowerCase().includes(query))) {
                    $item.show();
                } else {
                    $item.hide();
                }
            });
        }

        // Open translator
        function openTranslator() {
            $('#translatorOverlay').addClass('active');
            $('body').css('overflow', 'hidden');
            
            // Focus search input after animation
            setTimeout(() => {
                $('#searchLanguage').focus();
            }, 300);
        }

        // Close translator
        function closeTranslator() {
            $('#translatorOverlay').removeClass('active');
            $('body').css('overflow', '');
            
            // Clear search
            $('#searchLanguage').val('');
            filterLanguages('');
        }

        // Update the document ready function
        $(document).ready(function() {
            // Initialize - load languages from API
            loadSupportedLanguages();
            
            // Event listeners
            $('#translatorTrigger').on('click', openTranslator);
            $('#translatorClose').on('click', closeTranslator);
            
            // Close when clicking outside
            $('#translatorOverlay').on('click', function(e) {
                if (e.target === this) {
                    closeTranslator();
                }
            });
            
            // Search functionality with debounce
            let searchTimeout;
            $('#searchLanguage').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterLanguages($(this).val());
                }, 300);
            });
            
            // Close on escape key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeTranslator();
                }
            });
        });
    </script> -->
