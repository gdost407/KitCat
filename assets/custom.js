// aniket s golhar | custom Kitcat chat theme | March 2024
// =======================================================

function toastTrigger(img="assets/KitCat-Logo.jpg", name='KitCat Notification', message="Welcome to Kitcat chat"){
    $('#toast-img').attr('src', img);
    $('#toast-name').html(name);
    $('#toast-message').html(message);
    $('#liveToast').show();
    $("#event-audio")[0].play();
    setTimeout(() => {
        $('#liveToast').hide();
    }, 3000);

    Push.create(name, {
        body: message,
        icon: 'assets/KitCat-Logo.jpg',
        timeout: 4000,
        onClick: function () {
            window.focus();
            this.close();
        }
    });
}