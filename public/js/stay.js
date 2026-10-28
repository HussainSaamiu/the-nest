const gallery = document.querySelector('.stay-gallery-dialog');
const photos = [...document.querySelectorAll('.stay-photo img')];
let currentPhoto = 0;
function showPhoto(index) {
    currentPhoto = (index + photos.length) % photos.length;
    const image = document.querySelector('#full-photo');
    image.src = photos[currentPhoto].src;
    image.alt = photos[currentPhoto].alt;
    document.querySelector('#photo-counter').textContent = `${currentPhoto + 1} / ${photos.length} · Illustrative photography`;
}
document.querySelectorAll('[data-photo], [data-open-gallery]').forEach(button => button.addEventListener('click', () => {
    showPhoto(Number(button.dataset.photo ?? 0));
    gallery.showModal();
}));
gallery.querySelector('[data-close]').addEventListener('click', () => gallery.close());
gallery.querySelectorAll('[data-direction]').forEach(button => button.addEventListener('click', () => showPhoto(currentPhoto + Number(button.dataset.direction))));
gallery.addEventListener('keydown', event => {
    if (event.key === 'ArrowLeft') { event.preventDefault(); showPhoto(currentPhoto - 1); }
    if (event.key === 'ArrowRight') { event.preventDefault(); showPhoto(currentPhoto + 1); }
});
gallery.addEventListener('click', event => {
    if (event.target === gallery) {
        const bounds = gallery.getBoundingClientRect();
        if (event.clientX < bounds.left || event.clientX > bounds.right || event.clientY < bounds.top || event.clientY > bounds.bottom) { gallery.close(); }
    }
});
