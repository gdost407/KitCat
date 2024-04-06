// aniket s golhar | custom Kitcat chat theme | March 2024
// =======================================================

$('document').ready(function(){
    var chatContainer = document.getElementById("chat-content");
    chatContainer.scrollTop = chatContainer.scrollHeight;
});

$('.user-item').click(function() {
    if ((screen.width<992)) {
        $('.section-list').hide();
        $('#section-chat').fadeIn();
    }
});
$('#user-avatar-chat').click(function() {
    if ((screen.width<992)) {
        $('#section-chat').hide();
        $('#section-profile').fadeIn();
    }
});