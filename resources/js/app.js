// require('./bootstrap')
const imgpreload = require('./imgpreload')

document.addEventListener('DOMContentLoaded', imgpreload)

Livewire.on('rebuildImgPreload', imgpreload);