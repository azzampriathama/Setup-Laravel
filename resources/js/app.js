import './bootstrap';

/**
 * Banner slider di halaman beranda (tombol panah + titik navigasi + autoplay).
 */
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

/**
 * Carousel horizontal "Shop All".
 */
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

/**
 * Halaman keranjang belanja: hitung ulang ringkasan saat item dicentang.
 */
const cartForm = document.querySelector('[data-cart]');

if (cartForm) {
    const shipping = Number(cartForm.dataset.shipping || 0);
    const freeMinimum = Number(cartForm.dataset.freeMin || 0);
    const rows = Array.from(cartForm.querySelectorAll('[data-cart-row]'));
    const checkboxSelectAll = cartForm.querySelector('[data-select-all]');
    const warning = cartForm.querySelector('[data-cart-warning]');

    const formatRupiah = (value) => `Rp. ${value.toLocaleString('id-ID')}`;

    function updateSummary() {
        const subtotal = rows
            .filter((row) => row.querySelector('[data-cart-checkbox]')?.checked)
            .reduce((total, row) => total + Number(row.dataset.subtotal || 0), 0);

        const shippingCost = subtotal === 0 || subtotal >= freeMinimum ? 0 : shipping;
        const total = subtotal + shippingCost;

        const set = (key, value) => {
            const element = cartForm.querySelector(`[data-summary="${key}"]`);
            if (element) {
                element.textContent = value;
            }
        };

        set('subtotal', formatRupiah(subtotal));
        set('shipping', shippingCost === 0 ? 'Gratis' : formatRupiah(shippingCost));
        set('total', formatRupiah(total));

        const selectedCount = rows.filter((row) => row.querySelector('[data-cart-checkbox]')?.checked).length;

        if (checkboxSelectAll) {
            checkboxSelectAll.checked = rows.length > 0 && selectedCount === rows.length;
            checkboxSelectAll.indeterminate = selectedCount > 0 && selectedCount < rows.length;
        }

        warning?.classList.toggle('hidden', selectedCount > 0);
    }

    rows.forEach((row) => {
        row.querySelector('[data-cart-checkbox]')?.addEventListener('change', updateSummary);
    });

    checkboxSelectAll?.addEventListener('change', () => {
        rows.forEach((row) => {
            const checkbox = row.querySelector('[data-cart-checkbox]');
            if (checkbox) {
                checkbox.checked = checkboxSelectAll.checked;
            }
        });

        updateSummary();
    });

    cartForm.addEventListener('submit', (event) => {
        const selectedCount = rows.filter((row) => row.querySelector('[data-cart-checkbox]')?.checked).length;

        if (selectedCount === 0) {
            event.preventDefault();
            warning?.classList.remove('hidden');
        }
    });

    updateSummary();
}
