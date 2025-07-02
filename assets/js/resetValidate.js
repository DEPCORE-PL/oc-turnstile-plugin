document.addEventListener('ajax:fail', function(event) {
    const form = event.delegateTarget;
    const captchaContainer = form?.querySelector('.cf-turnstile');

    if (captchaContainer) {
        turnstile.reset(captchaContainer);
    }
});