// require('./bootstrap')
import '../css/app.css';
import imgpreload from './imgpreload'

document.addEventListener('DOMContentLoaded', imgpreload)
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

Livewire.on('rebuildImgPreload', imgpreload)