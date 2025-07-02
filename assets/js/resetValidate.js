document.addEventListener('ajax:fail', function(event) {
    if (typeof turnstile !== 'undefined' && typeof turnstile.reset === 'function') {
        turnstile.reset();
    }
});