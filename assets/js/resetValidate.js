document.addEventListener('ajax:fail', function(event) {
    let widgetId = event.delegateTarget.querySelector('.cf-turnstile');
    console.log(widgetId);
    if (widgetId !== undefined) {
        turnstile.reset(widgetId);
    }

});