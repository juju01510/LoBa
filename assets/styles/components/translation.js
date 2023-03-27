// Récupération de la balise select et ajout de l'événement "change"
const languageSelect = document.getElementById('language_select');

languageSelect.addEventListener('change', () => {
    // Récupération de la valeur de la langue sélectionnée
    const selectedLanguage = languageSelect.value;

    // Mise à jour de l'URL avec la nouvelle langue
    const currentUrl = window.location.href;
    const newUrl = currentUrl.replace(/\/(fr|en)($|\/)/, `/${selectedLanguage}/`);
    window.location.href = newUrl;
});