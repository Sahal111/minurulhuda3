/**
 * Component: Data Guru (Livewire)
 * Lucide icons re-render after Livewire commit
 */

if (window.lucide) window.lucide.createIcons();

if (typeof $wire !== 'undefined') {
    $wire.$hook('commit', function (payload) {
        payload.succeed(function () {
            if (window.lucide) window.lucide.createIcons();
        });
    });
}
