<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitCat</title>
    <meta name="description" content="KitCat is an engaging chat platform designed by Aniket Golhar. Experience lively, fun-filled conversations and make new friends—just as exciting as a Tom & Jerry brawl. Log in to join the fun!">
    <meta name="keywords" content="KitCat, Aniket Golhar, chatting platform, chat with friends, make friends, online chat, social platform, instant messaging, fun chat app">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Aniket Golhar">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="KitCat - Aniket Golhar's Fun Platform">
    <meta property="og:description" content="KitCat is an engaging chat platform designed by Aniket Golhar. Experience lively, fun-filled conversations and make new friends—just as exciting as a Tom & Jerry brawl. Log in to join the fun!">
    <meta property="og:image" content="https://kitcat.aniketgolhar.in/assets/KitCat-Logo.jpg">
    <meta property="og:url" content="https://kitcat.aniketgolhar.in">
    <meta property="og:type" content="website">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="KitCat - Aniket Golhar's Fun Platform">
    <meta name="twitter:description" content="KitCat is an engaging chat platform designed by Aniket Golhar. Experience lively, fun-filled conversations and make new friends—just as exciting as a Tom & Jerry brawl. Log in to join the fun!">
    <meta name="twitter:image" content="https://kitcat.aniketgolhar.in/assets/KitCat-Logo.jpg">
    <meta name="twitter:url" content="https://kitcat.aniketgolhar.in">

    <!-- Title Icon -->
    <link rel="icon" href="assets/KitCat-Logo.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/KitCat-Logo.jpg" type="image/x-icon">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/login-style.css">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://kitcat.aniketgolhar.in">
</head>

<body>
    <div class="container-fluid" style="height: 100vh;">
        <div class="card">
            <div class="row m-0">
                <div class="col-sm-6 card-left d-none d-sm-block">
                    <div class="left-inner">
                        <div class="m-auto text-center">
                            <img src="assets/tom-jerry.png" alt="tomjerry" style="width: 90%;">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-right">
                    <div class="m-auto text-center position-relative">
                        <img src="assets/KitCat-Logo.jpg" alt="" style="width: 120px; border-radius: 50%;">
                        <h3 class="p-3 fw-bold">Kit-Cat</h3>
                        <h6 class="py-4">Get experience as lively as a Tom & Jerry brawl<br><br>Login to join & fun!</h6>
                        <button class="w-75 mt-4" onclick="module.loginGmail()">
                            <div class="span1"><img src="assets/google.png" alt="" style="width: 25px;"></div>
                            <div class="span2">Log in with Google</div>
                        </button>
                        <h6 class="text-white position-absolute footer">Designed & Developed by ASG</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        module = {};
    </script>
    <script type="module" src="assets/login.js"></script>
</body>
</html>