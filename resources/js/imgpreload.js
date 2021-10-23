module.exports = () => {
    if (!'loading' in HTMLImageElement.prototype) {
        document.querySelectorAll('img[loading="lazy"]').forEach(img => img.classList.add('lazyload'))

        const script = document.createElement('script')
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js'
        document.body.appendChild(script)
    }

    document.querySelectorAll('.anime-cover').forEach(imgElement => {
        const cover = imgElement.getElementsByTagName('img')[0]
        const preload = imgElement.getElementsByClassName('spinner')[0]
        
        if (typeof preload === 'undefined') return;

        cover.onload = function () {
            cover.classList.remove('absolute', 'opacity-0')
            preload.remove()
        }

        cover.src = cover.dataset.src
    })
}
