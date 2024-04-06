// aniket s golhar | custom Kitcat chat theme | March 2024
// =======================================================

import 'https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js'
// import insertText from 'https://cdn.jsdelivr.net/npm/insert-text-at-cursor@0.3.0/index.js'
$('emoji-picker').on('emoji-click', function(e) {
    $('#chat-text-message').val(function(_, text) {
        return text + e.detail.unicode;
    });
});