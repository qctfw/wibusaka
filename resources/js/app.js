// require('./bootstrap')
import imgpreload from './imgpreload'
import themeselector from './themeselector'

document.addEventListener('DOMContentLoaded', imgpreload)
/*
document.addEventListener('DOMContentLoaded', function () {
    var opacity = 1
    var loadingScreen = window.setInterval( function () {
        document.getElementById('loading-screen').style.opacity = opacity
        opacity = opacity - 0.25
        if (opacity <= 0) {
            document.getElementById('loading-screen').remove()
            window.clearInterval(loadingScreen)
        }
    }, 100)
})
*/
document.addEventListener('DOMContentLoaded', themeselector)

Livewire.on('rebuildImgPreload', imgpreload)
