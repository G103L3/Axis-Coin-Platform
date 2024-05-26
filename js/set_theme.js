
// Immediately invoked function to set the theme on initial load
(function () {
    let themeName;
   // window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", event => {
            if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
                themeName = 'theme-dark';
            } else {
                themeName = 'theme-light';
            }
        //});
    document.documentElement.className = themeName;
})();