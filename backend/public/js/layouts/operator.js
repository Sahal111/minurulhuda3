/**
 * Layout: Operator Panel
 * Alpine.js data component for operator sidebar/header
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('operatorPanel', () => ({
        isDarkMode: false,
        sidebarOpen: false,
        sidebarCollapsed: false,
        activeModal: null,
        submenus: {
            masterData: false,
            akademik: false,
        },
        akademikSetup: [
            { label: 'Tahun Ajaran', icon: 'calendar', href: '/operator/tahun-ajaran' },
            { label: 'Semester', icon: 'layers', href: '/operator/semester' },
            // { label: 'Rombel', icon: 'home', href: '#' },
            { label: 'Pengampu Mapel', icon: 'user-check', href: '/operator/pengampu-mapel' },
        ],
        akademikProses: [
            { label: 'Penempatan Siswa', icon: 'users', href: '/operator/penempatan-siswa' },
            { label: 'Jadwal Pelajaran', icon: 'calendar-days', href: '/operator/jadwal-pelajaran' },
            { label: 'Absensi', icon: 'check-circle', href: '#' },
            { label: 'Nilai', icon: 'bar-chart-3', href: '#' },
            { label: 'Raport', icon: 'file-text', href: '#' },
            { label: 'Kenaikan Kelas', icon: 'trending-up', href: '/operator/kenaikan-kelas' },
        ],
        init() {
            this.isDarkMode = localStorage.getItem('operator-dark-mode') === 'true';
            this.refreshIcons();

            document.addEventListener('livewire:navigated', () => {
                this.sidebarOpen = false;
                this.refreshIcons();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        },
        toggleDarkMode() {
            this.isDarkMode = !this.isDarkMode;
            localStorage.setItem('operator-dark-mode', this.isDarkMode);
            this.refreshIcons();
        },
        toggleSubmenu(id) {
            this.submenus[id] = !this.submenus[id];
            this.refreshIcons();
        },
        openModal(id) {
            this.activeModal = id;
            this.refreshIcons();
        },
        closeModal() {
            this.activeModal = null;
        },
        filterTable(type) {
            const input = document.getElementById('search-' + type);
            const tableBody = document.getElementById('table-' + type);

            if (!input || !tableBody) return;

            const filter = input.value.toLowerCase();
            tableBody.querySelectorAll('tr').forEach((row) => {
                row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
            });
        },
        refreshIcons() {
            this.$nextTick(() => { if (typeof lucide !== 'undefined') lucide.createIcons(); });
        },
    }));
});
