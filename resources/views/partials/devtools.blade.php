@if($devtoolsProtection ?? false)
<script>
(function () {
    let triggered = false;
    const threshold = 160;

    function detect() {
        const w = window.outerWidth - window.innerWidth;
        const h = window.outerHeight - window.innerHeight;

        if (w > threshold || h > threshold) {
            if (!triggered) {
                triggered = true;

                fetch('/devtools-detected', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN':
                            document.querySelector('meta[name="csrf-token"]')?.content
                    }
                }).catch(() => {});
            }
        }
    }

    setInterval(detect, 1000);
})();
</script>
@endif
