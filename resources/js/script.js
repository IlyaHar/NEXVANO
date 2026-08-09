document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.site-header');
    const menuToggle = header?.querySelector('.menu-toggle');
    const navLinks = header?.querySelector('.nav-links');
    const dropdowns = header?.querySelectorAll('.dropdown') ?? [];
    const mobileNavigation = window.matchMedia('(max-width: 900px)');

    const setDropdown = (dropdown, open) => {
        const toggle = dropdown.querySelector('.nav-dropdown-toggle');
        const menu = dropdown.querySelector('.dropdown-menu');

        dropdown.classList.toggle('is-open', open);
        toggle?.setAttribute('aria-expanded', String(open));

        if (menu) {
            if (mobileNavigation.matches) {
                menu.style.display = open ? 'block' : 'none';
            } else {
                menu.style.removeProperty('display');
            }
        }
    };

    const closeDropdowns = (except = null) => {
        dropdowns.forEach((dropdown) => {
            if (dropdown !== except) {
                setDropdown(dropdown, false);
            }
        });
    };

    const setMenu = (open) => {
        if (!menuToggle || !navLinks) return;
        navLinks.classList.toggle('active', open);
        menuToggle.classList.toggle('active', open);
        menuToggle.setAttribute('aria-expanded', String(open));
        document.body.classList.toggle('mobile-menu-open', open);
        if (!open) closeDropdowns();
    };

    menuToggle?.addEventListener('click', (event) => {
        event.stopPropagation();
        setMenu(!navLinks?.classList.contains('active'));
    });

    dropdowns.forEach((dropdown) => {
        const toggle = dropdown.querySelector('.nav-dropdown-toggle');
        toggle?.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();
            const willOpen = !dropdown.classList.contains('is-open');
            closeDropdowns();
            setDropdown(dropdown, willOpen);
        });
    });

    navLinks?.querySelectorAll('.dropdown-menu a, .nav-links > li:not(.dropdown) a').forEach((link) => {
        link.addEventListener('click', () => setMenu(false));
    });

    document.addEventListener('click', (event) => {
        if (header && !header.contains(event.target)) setMenu(false);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') setMenu(false);
    });

    window.addEventListener('resize', () => {
        closeDropdowns();
        if (!mobileNavigation.matches) setMenu(false);
    });

    closeDropdowns();

    const cookieBanner = document.getElementById('cookie-consent');
    if (cookieBanner) {
        const storageKey = 'seedup-cookie-consent-v1';
        let savedChoice = null;

        try { savedChoice = localStorage.getItem(storageKey); } catch (_) {}
        if (!savedChoice) cookieBanner.hidden = false;

        cookieBanner.querySelectorAll('[data-cookie-choice]').forEach((button) => {
            button.addEventListener('click', () => {
                try { localStorage.setItem(storageKey, button.dataset.cookieChoice); } catch (_) {}
                cookieBanner.classList.add('is-hiding');
                window.setTimeout(() => { cookieBanner.hidden = true; }, 220);
            });
        });

        const detailsToggle = cookieBanner.querySelector('.cookie-consent__details-toggle');
        const details = cookieBanner.querySelector('.cookie-consent__details');
        detailsToggle?.addEventListener('click', () => {
            const expanded = detailsToggle.getAttribute('aria-expanded') === 'true';
            detailsToggle.setAttribute('aria-expanded', String(!expanded));
            if (details) details.hidden = expanded;
        });

        document.querySelectorAll('.cookie-settings-button').forEach((button) => {
            button.addEventListener('click', () => {
                cookieBanner.classList.remove('is-hiding');
                cookieBanner.hidden = false;
            });
        });
    }
});
