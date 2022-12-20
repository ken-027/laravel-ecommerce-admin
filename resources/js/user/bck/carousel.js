document.addEventListener('DOMContentLoaded', event => {
    setInterval(() => {
        slide();
    }, 5000);
})

const slides = document.querySelectorAll('.slide')
const carouselIndicators = document.querySelector('.carousel-indicators')

function getSlideIndex() {
    let index = 0;
    slides.forEach((slide, i) => {
        if (slide.hasAttribute("data-active")) return index = i;
    });
    return index;
}

function slide() {
    const dataCarousel = document.querySelector('[data-carousel]');
    const activeIndicator = dataCarousel.querySelector('.active');
    let index = getSlideIndex();
    const activeSlide = slides[index]
    if (index < slides.length) index++;
    if (index >= slides.length) index = 0;
    slides[index].dataset.active = true
    delete activeSlide.dataset.active
    carouselIndicatorActive(index)
}

function carouselIndicatorActive(index) {
    const indicatorLists = [...carouselIndicators.children];
    const activeIndicator = carouselIndicators.querySelector('.active');
    activeIndicator.classList.remove('active');
    indicatorLists[index].classList.add('active');
}