const navLinks = document.querySelectorAll('.navlink a');
const pathname = window.location.pathname;
const pathSegments = pathname.split('/');
const fileName = pathSegments[pathSegments.length - 1];

navLinks.forEach(link => {
    const linkPathSegments = link.getAttribute('href').split('/');
    const href = linkPathSegments[linkPathSegments.length - 1];
    if (href === fileName) {
        link.classList.add('active');
    }
})