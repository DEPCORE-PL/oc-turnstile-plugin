document.addEventListener('ajax:fail', function(event) {
    const form = event.target instanceof HTMLFormElement
        ? event.target
        : event.target?.closest?.('form');
    const captchaContainer = form?.querySelector('.cf-turnstile');

    if (captchaContainer && window.turnstile) {
        window.turnstile.reset(captchaContainer);
    }
});