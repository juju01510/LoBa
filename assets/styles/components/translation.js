const select = document.getElementById('language_select');

select.addEventListener('change', (e) => {
    const value = select.value;

    let currentPath = window.location.pathname;
    let newPath;

    if (currentPath === "/") {
        newPath = "/" + value;
    } else {
        newPath = currentPath + "/" + value;
    }

    window.location.href = newPath;
});