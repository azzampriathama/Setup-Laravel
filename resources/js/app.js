import './bootstrap';

document.querySelectorAll('[data-slider]').forEach((slider) => {
    const track = slider.querySelector('[data-slider-track]');
    const dotsWrap = slider.querySelector('[data-slider-dots]');

    if (!track) {
        return;
    }

    const slides = Array.from(track.children);
    let index = 0;
    let timer = null;

    const dots = slides.map((_, i) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.setAttribute('aria-label', `Banner ${i + 1}`);
        dot.addEventListener('click', () => show(i));
        dotsWrap?.appendChild(dot);

        return dot;
    });

    function show(next) {
        index = (next + slides.length) % slides.length;
        track.style.transform = `translateX(-${index * 100}%)`;

        dots.forEach((dot, i) => {
            dot.className = i === index
                ? 'h-2 w-6 rounded-full bg-belia-500 transition-all'
                : 'h-2 w-2 rounded-full bg-belia-300/70 transition-all';
        });
    }

    function autoplay() {
        stopAutoplay();
        timer = window.setInterval(() => show(index + 1), 7000);
    }

    function stopAutoplay() {
        if (timer) {
            window.clearInterval(timer);
            timer = null;
        }
    }

    slider.querySelector('[data-slider-prev]')?.addEventListener('click', () => {
        show(index - 1);
        autoplay();
    });

    slider.querySelector('[data-slider-next]')?.addEventListener('click', () => {
        show(index + 1);
        autoplay();
    });

    slider.addEventListener('mouseenter', stopAutoplay);
    slider.addEventListener('mouseleave', autoplay);

    show(0);
    if (slides.length > 1) {
        autoplay();
    }
});

document.querySelectorAll('[data-carousel-prev], [data-carousel-next]').forEach((button) => {
    const target = document.querySelector(
        button.dataset.carouselPrev || button.dataset.carouselNext
    );

    if (!target) {
        return;
    }

    const direction = button.hasAttribute('data-carousel-prev') ? -1 : 1;
    const step = Math.max(target.clientWidth * 0.8, 240);

    button.addEventListener('click', () => {
        target.scrollBy({ left: direction * step, behavior: 'smooth' });
    });
});
