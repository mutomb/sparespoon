// Close open navigation menus when clicking outside or pressing Escape.
const closeMenus = (except = null) => {
    document.querySelectorAll('details[data-menu][open]').forEach((menu) => {
        if (menu !== except) {
            menu.removeAttribute('open');
        }
    });
};

document.addEventListener('click', (event) => {
    const openMenu = event.target.closest('details[data-menu]');
    closeMenus(openMenu);
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeMenus();
    }
});

// Keep the price field honest when a neighbor chooses "Giveaway".
const listingForm = document.querySelector('[data-listing-form]');

if (listingForm) {
    const typeField = listingForm.querySelector('[data-type-field]');
    const priceWrap = listingForm.querySelector('[data-price-wrap]');
    const priceField = listingForm.querySelector('[data-price-field]');

    const syncPrice = () => {
        const isGiveaway = typeField.value === 'giveaway';

        priceWrap.classList.toggle('opacity-50', isGiveaway);
        priceField.disabled = isGiveaway;

        if (isGiveaway) {
            priceField.value = '0';
        }
    };

    typeField.addEventListener('change', syncPrice);
    syncPrice();
}
