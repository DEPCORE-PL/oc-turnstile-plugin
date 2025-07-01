
// reset turnstile on validation errors, have the freshest key!
$(document).on('ajaxError', function(event, context, response) {
    turnstile.reset()
});
