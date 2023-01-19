function changeTheme() {
    const selectedTheme = ('theme' in localStorage) ? localStorage.theme : 'default'
    document.querySelectorAll('[data-setting=theme] span').forEach(function (el) {
        (el.parentNode.dataset.option == selectedTheme) ? el.classList.remove('hidden') : el.classList.add('hidden')
    })

    if (selectedTheme === 'dark' || (selectedTheme === 'default' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    }
    else {
        document.documentElement.classList.remove('dark')
    }
}

export default () => {
    changeTheme()
    document.querySelectorAll('[data-setting=theme]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            if (e.target.dataset.option == 'default') {
                localStorage.removeItem('theme')
            }
            else {
                localStorage.theme = e.target.dataset.option;
            }
            changeTheme()
        });
    });
}
