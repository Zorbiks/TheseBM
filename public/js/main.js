const navLinks = document.querySelectorAll('.navlink a');

// Extracts the current page's filename from the URL path
const pathname = window.location.pathname;
const pathSegments = pathname.split('/');
const fileName = pathSegments[pathSegments.length - 1];

// Highlights the navigation link that matches the current page's filename.
navLinks.forEach(link => {
    const linkPathSegments = link.getAttribute('href').split('/');
    const href = linkPathSegments[linkPathSegments.length - 1];
    if (href === fileName) {
        link.classList.add('active');
    }
})