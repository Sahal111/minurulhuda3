/**
 * Layout: App (Public Pages)
 * Dark mode toggle, scroll navbar, mobile bottom nav
 */

function toggleDark() {
    const html = document.documentElement;
    html.classList.toggle('dark');
    localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
}

// Check dark mode preference on load
if (localStorage.theme === 'dark') {
    document.documentElement.classList.add('dark');
}

// Scroll-based navbar styling
window.addEventListener('scroll', function () {
    const nav = document.getElementById('main-nav');
    const navContent = document.getElementById('nav-content');
    const navTitle = document.getElementById('nav-title');
    const navSubtitle = document.getElementById('nav-subtitle');
    const navLinks = document.getElementById('nav-links');
    const navLogoIcon = document.getElementById('nav-logo-icon');
    const mobileIcon = document.getElementById('mobile-icon');

    if (!nav || !navContent) return;

    if (window.scrollY > 50) {
        nav.classList.remove('pt-6');
        nav.classList.add('pt-2');
        navContent.classList.add('bg-white/90', 'dark:bg-surface-dark/90', 'backdrop-blur-md', 'shadow-lg', 'border-slate-200/50', 'dark:border-slate-800/50');
        navContent.classList.remove('border-transparent');

        if (navTitle) { navTitle.classList.replace('text-white', 'text-madrasah-green'); navTitle.classList.add('dark:text-white'); }
        if (navSubtitle) navSubtitle.classList.replace('text-white/70', 'text-slate-500');
        if (navLinks) { navLinks.classList.replace('text-white', 'text-slate-600'); navLinks.classList.add('dark:text-slate-300'); }
        if (navLogoIcon) navLogoIcon.classList.replace('text-white', 'text-primary');
        if (mobileIcon) { mobileIcon.classList.replace('text-white', 'text-madrasah-green'); mobileIcon.classList.add('dark:text-white'); }
    } else {
        nav.classList.add('pt-6');
        nav.classList.remove('pt-2');
        navContent.classList.remove('bg-white/90', 'dark:bg-surface-dark/90', 'backdrop-blur-md', 'shadow-lg', 'border-slate-200/50', 'dark:border-slate-800/50');
        navContent.classList.add('border-transparent');

        if (navTitle) { navTitle.classList.replace('text-madrasah-green', 'text-white'); navTitle.classList.remove('dark:text-white'); }
        if (navSubtitle) navSubtitle.classList.replace('text-slate-500', 'text-white/70');
        if (navLinks) { navLinks.classList.replace('text-slate-600', 'text-white'); navLinks.classList.remove('dark:text-slate-300'); }
        if (navLogoIcon) navLogoIcon.classList.replace('text-primary', 'text-white');
        if (mobileIcon) { mobileIcon.classList.replace('text-madrasah-green', 'text-white'); mobileIcon.classList.remove('dark:text-white'); }
    }
});

// Mobile auto-hide nav on scroll
if (window.innerWidth < 768) {
    if (window.scrollY > 100) {
        const mainNav = document.getElementById('main-nav');
        if (mainNav) mainNav.style.transform = 'translateY(-100%)';
    } else {
        const mainNav = document.getElementById('main-nav');
        if (mainNav) mainNav.style.transform = 'translateY(0)';
    }
}

// Mobile Bottom Tab Navigation
function changeTab(el, index) {
    const indicator = document.getElementById('nav-indicator');
    const tabs = document.querySelectorAll('.mobile-tab');

    tabs.forEach(t => t.classList.remove('active'));
    el.classList.add('active');

    const parent = el.parentElement;
    const cell = parent.offsetWidth / 5;
    const x = (cell * index) + (cell / 2) - 32;

    if (indicator) indicator.style.transform = `translateX(${x}px)`;
}

window.addEventListener('load', () => {
    const activeTab = document.querySelector('.mobile-tab.active');
    if (activeTab) changeTab(activeTab, 0);
});
