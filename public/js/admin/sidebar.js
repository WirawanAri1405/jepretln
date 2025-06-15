function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('backdrop');
    const isMobile = window.innerWidth < 768;

    if (isMobile) {
        const isOpen = !sidebar.classList.contains('-translate-x-full');
        if (isOpen) {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
            sidebar.classList.remove('collapsed'); // pastikan tidak collapsed di mobile
            sidebar.classList.add('w-64');
        } else {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            sidebar.classList.remove('collapsed'); // pastikan tidak collapsed di mobile
            sidebar.classList.add('w-64');
        }
    } else {
        // Desktop mode: Collapse sidebar
        sidebar.classList.toggle('w-64');
        sidebar.classList.toggle('w-16');
        sidebar.classList.toggle('collapsed');

        const title = document.getElementById('sidebar-title');
        title.classList.toggle('hidden', sidebar.classList.contains('collapsed'));
    }
}

function closeMobileSidebar() {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('backdrop');
    sidebar.classList.add('-translate-x-full');
    backdrop.classList.add('hidden');
}

// Reset on resize
window.addEventListener('resize', () => {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('backdrop');

    if (window.innerWidth >= 768) {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.add('hidden');
    } else {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
    }
});
