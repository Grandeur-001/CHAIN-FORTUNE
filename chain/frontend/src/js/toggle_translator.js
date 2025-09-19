function googleTranslateElementInit2() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        autoDisplay: false
    }, 'google_translate_element2');
}

function openTranslator() {
    document.getElementById('translatorOverlay').style.visibility = 'visible';
    document.getElementById('translatorOverlay').style.opacity = '1';
    document.querySelector('.translator-content').classList.add('bounce-in');
}

function closeTranslator() {
    document.getElementById('translatorOverlay').style.visibility = 'hidden';
    document.getElementById('translatorOverlay').style.opacity = '0';
    document.querySelector('.translator-content').classList.remove('bounce-in');
}