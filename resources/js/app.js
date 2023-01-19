// require('./bootstrap')
import imgpreload from './imgpreload'
import themeselector from './themeselector'

document.addEventListener('DOMContentLoaded', imgpreload)
document.addEventListener('DOMContentLoaded', themeselector)

Livewire.on('rebuildImgPreload', imgpreload)
