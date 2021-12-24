$(window).load(function() {
    const FollowScrollMenu = menuContainer => {
        let lastScrollPosition = window.pageYOffset;

        window.addEventListener('scroll', () => {
            const currentScrollPosition = window.pageYOffset;
            const direction = Math.sign(currentScrollPosition - lastScrollPosition);
            lastScrollPosition = currentScrollPosition;
            const shouldBeHidden = direction > 0 && currentScrollPosition > 0;
            menuContainer.classList.toggle('scrolled', shouldBeHidden);
        })
    }
    FollowScrollMenu(document.querySelector('header'));
});