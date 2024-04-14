<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitCat</title>
    <!-- title icon -->
    <link rel="icon" href="assets/KitCat-Logo.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/KitCat-Logo.jpg" type="image/x-icon">
    <!-- bootstrap css cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- fontawsome css cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- bootstrap js cdn-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- google jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- custom css -->
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap');
        body{
            background-image: url('assets/KitCat-bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            box-shadow: inset 0 0 0 100vh rgb(217 199 251 / 70%);
            font-family: "Noto Serif", serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
        #section-list1, #section-list2, #section-list3{
            display: none;
        }
        .user-item {
            display: flex;
            align-items: center;
            padding: 10px;
            transition: 0.2s;
            cursor: pointer;
            /* border-radius: 5rem; */
            border-left: 5px solid #FFFFFF;
        }
        .user-item:hover{
            background-color: #9352E033;
            border-left: 5px solid #F169BB;
        }
        .user-active{
            background-color: #9352E033;
            border-left: 5px solid #F169BB;
        }
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }    
        .user-details {
            flex: 1;
            /* border-bottom: 1px solid #9352E0; */
            overflow: hidden;
        }   
        .user-name {
            font-weight: bold;
            transition: 0.5s;
        }    
        .last-msg {
            color: #6c757d;
            transition: 0.5s;
            display: inline-block;
            white-space: nowrap;
        }
        .Online{
            width: 10px;
            height: 10px;
            background: #5F369F;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: -8px;
        }
        .Offline{
            width: 10px;
            height: 10px;
            background: red;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: -8px;
        }
        #section-chat{
            background-image: url('assets/KitCat-bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            box-shadow: inset 0 0 0 100vh #FFFFFFDD;
            border-left: 1px solid #5F369F;
            border-right: 1px solid #5F369F;
        }
        #chat-content{
            height: 81vh;
            overflow-y: auto;
        }
        #chat-content .left-message{
            display: flex;
            align-items: end;
            padding-bottom: 5px;
            padding-right: 4rem;
            width: 100%;
        }
        #chat-content .left-message .chat-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
            object-fit: cover;
        }
        #chat-content .left-message .chat-message {
            border: 2px solid #F169BB;
            background-color: #F169BB11;
            border-radius: 10px;
            border-bottom-left-radius: 0px;
            padding: 10px;
        }
        #chat-content .left-message .chat-message span{
            color: #5F369F;
            font-size: 10px;
            padding-top: 7px;
            float: inline-end;
        }
        #chat-content .right-message{
            display: flex;
            align-items: end;
            padding-bottom: 5px;
            float: right;
            padding-left: 4rem;
        }
        #chat-content .right-message .chat-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: 5px;
            object-fit: cover;
        } 
        #chat-content .right-message .chat-message {
            border: 2px solid #5F369F;
            background-color: #9352E033;
            border-radius: 10px;
            border-bottom-right-radius: 0px;
            padding: 10px;
            /* color: #D9C7FB; */
            /* max-width: 75%; */
        }
        #chat-content .right-message .chat-message span{
            color: #F169BB;
            font-size: 10px;
            padding-top: 7px;
            float: inline-end;
        }
        #image-upload-progress-bar, #profile-upload-progress-bar{
            display: none;
        }
        #image-gallary{
            overflow-y: auto;
            height: 49vh;
        }
        #image-gallary img{
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            border: 2px solid #5F369F;
            border-radius: 10px;
        }
        emoji-picker{
            position: absolute;
            bottom: 6.5vh;
            left: 0;
            right: 0;
            width: 100%;
            height: 370px;
            display: none;
        }
        #section-chat, #section-profile{
            display: none;
        }
        /* media query */
        @media screen and (max-width: 992px){
            /* #section-profile{
                display: none;
            } */
        }
        @media screen and (max-width: 767px){
            
        }
        @media screen and (max-width: 576px){
            #section-start, #section-chat, #section-profile{
                display: none;
            }
            #chat-content{
                height: 85vh;
            }
            #image-gallary{
                height: 55vh;
            }
        }

        /* scroll bar css */
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #ad80e4;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #9352E0;
        }

        /* bootstrap class modify */
        .btn-primary{
            background-color: #5F369F !important;
            border-color: #5F369F !important;
        }
        .btn-primary:hover{
            background-color: #60339C !important;
            border-color: #60339C !important;
        }
        .form-control{
            border-color: #60339C;
        }
        .form-control:focus{
            box-shadow: 0 0 0 0.25rem #60339C22;
        }
    </style>
    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- menu -->
            <div class="col-2 col-sm-1 col-lg-1 py-3 px-0 section-list" style="height: 100vh; background-color: #5F369F; overflow-y: auto;">
                <div class="px-2">
                    <img onerror="this.src='assets/KitCat-Logo.jpg';" src="assets/KitCat-Logo.jpg" style="width: 100%;" class="rounded-circle">
                </div>
                <div class="my-5">
                    <h6 class="text-center" style="color: #F169BB; cursor: pointer;" onclick="$('#section-list').fadeIn(); $('#section-list1').hide(); $('#section-list2').hide(); $('#section-list3').hide();">
                        <i class="fa-solid fa-book h3 text-white"></i><br>
                        Contact
                    </h6>
                </div>
                <div class="my-5">
                    <h6 class="text-center" style="color: #F169BB; cursor: pointer;" onclick="$('#section-list1').fadeIn(); $('#section-list').hide(); $('#section-list2').hide(); $('#section-list3').hide();">
                        <i class="fa-solid fa-plus h3 text-white"></i><br>
                        Add
                    </h6>
                </div>
                <div class="my-5">
                    <h6 class="text-center" style="color: #F169BB; cursor: pointer;" onclick="$('#section-list2').fadeIn(); $('#section-list').hide(); $('#section-list1').hide(); $('#section-list3').hide();">
                        <i class="fa-solid fa-code-pull-request h3 text-white"></i><br>
                        Request
                    </h6>
                </div>
                <div class="my-5">
                    <h6 class="text-center" style="color: #F169BB; cursor: pointer;" onclick="$('#section-list3').fadeIn(); $('#section-list').hide(); $('#section-list1').hide(); $('#section-list2').hide();">
                        <i class="fa-solid fa-user h3 text-white"></i><br>
                        Profile
                    </h6>
                </div>
                <div class="my-5">
                    <h6 class="text-center" style="color: #F169BB; cursor: pointer;" onclick="module.logout()">
                        <i class="fa-solid fa-power-off h3 text-white"></i><br>
                        Logout
                    </h6>
                </div>
            </div>
            <!-- user list -->
            <div class="col-10 col-sm-5 col-lg-3 px-0 py-3 section-list" id="section-list" style="height: 100vh; background-color: #FFFFFF;">
                <div class="px-2">
                    <h1>KitCat</h1>
                    <input type="search" name="" id="" class="form-control bg-light rounded-pill" placeholder="&#xF002; Search for chat..." style="font-family:Arial, FontAwesome">
                </div>
                <br>
                <div style="height: 80vh; overflow-y: auto;">
                    <ul class="ps-0" id="kitcat_user_list">
                        <li class="user-item"> 
                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #eeeeee; margin-right: 5px;">
                            </div> 
                            <div class="user-details"> 
                                <div class="user-name"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${currentUser.memberData}</span></div> 
                                <div class="last-msg"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${memberData.message.memberData}</span></div> 
                            </div> 
                        </li>
                        <li class="user-item"> 
                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #eeeeee; margin-right: 5px;">
                            </div> 
                            <div class="user-details"> 
                                <div class="user-name"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${currentUser.memberData}</span></div> 
                                <div class="last-msg"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${memberData.message.memberData}</span></div> 
                            </div> 
                        </li>
                        <li class="user-item"> 
                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #eeeeee; margin-right: 5px;">
                            </div> 
                            <div class="user-details"> 
                                <div class="user-name"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${currentUser.memberData}</span></div> 
                                <div class="last-msg"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${memberData.message.memberData}</span></div> 
                            </div> 
                        </li>
                        <li class="user-item"> 
                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #eeeeee; margin-right: 5px;">
                            </div> 
                            <div class="user-details"> 
                                <div class="user-name"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${currentUser.memberData}</span></div> 
                                <div class="last-msg"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${memberData.message.memberData}</span></div> 
                            </div> 
                        </li>
                        <li class="user-item"> 
                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #eeeeee; margin-right: 5px;">
                            </div> 
                            <div class="user-details"> 
                                <div class="user-name"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${currentUser.memberData}</span></div> 
                                <div class="last-msg"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${memberData.message.memberData}</span></div> 
                            </div> 
                        </li>
                        <li class="user-item"> 
                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #eeeeee; margin-right: 5px;">
                            </div> 
                            <div class="user-details"> 
                                <div class="user-name"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${currentUser.memberData}</span></div> 
                                <div class="last-msg"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${memberData.message.memberData}</span></div> 
                            </div> 
                        </li>
                        <li class="user-item"> 
                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #eeeeee; margin-right: 5px;">
                            </div> 
                            <div class="user-details"> 
                                <div class="user-name"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${currentUser.memberData}</span></div> 
                                <div class="last-msg"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${memberData.message.memberData}</span></div> 
                            </div> 
                        </li>
                        <li class="user-item"> 
                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #eeeeee; margin-right: 5px;">
                            </div> 
                            <div class="user-details"> 
                                <div class="user-name"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${currentUser.memberData}</span></div> 
                                <div class="last-msg"><span style="background-color: #eeeeee; color: #eeeeee; border-radius: 50px;">${memberData.message.memberData}</span></div> 
                            </div> 
                        </li>
                    </ul>
                </div>
            </div>
            <!-- new added user list -->
            <div class="col-10 col-sm-5 col-lg-3 px-0 py-3" id="section-list1" style="height: 100vh; background-color: #FFFFFF;">
                <div class="px-2">
                    <h1>KitCat Add</h1>
                    <input type="search" name="" id="" class="form-control bg-light rounded-pill" placeholder="&#xF002; Search for add..." style="font-family:Arial, FontAwesome">
                </div>
                <br>
                <div style="height: 80vh; overflow-y: auto;">
                    <ul class="ps-0" id="kitcat_add_user_list">
                    </ul>
                </div>
            </div>
            <!-- friend request list -->
            <div class="col-10 col-sm-5 col-lg-3 px-0 py-3" id="section-list2" style="height: 100vh; background-color: #FFFFFF;">
                <div class="px-2">
                    <h1>KitCat Request</h1>
                    <input type="search" name="" id="" class="form-control bg-light rounded-pill" placeholder="&#xF002; Search for request..." style="font-family:Arial, FontAwesome">
                </div>
                <br>
                <div style="height: 80vh; overflow-y: auto;">
                    <ul class="ps-0" id="kitcat_request_user_list">
                    </ul>
                </div>
            </div>
            <!-- profile details -->
            <div class="col-10 col-sm-5 col-lg-3 px-0 py-3" id="section-list3" style="height: 100vh; background-color: #FFFFFF;">
                <div class="px-2">
                    <h1>KitCat Profile</h1>
                </div>
                <hr>
                <div class="px-3" style="height: 80vh; overflow-y: auto;">
                    <center>
                        <div class="position-relative" style="width: 100px; height: 100px;">
                            <img src="assets/KitCat-Logo.jpg" id="profileImage1" alt="" style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 50%;">
                            <i class="fa-solid fa-camera p-2 position-absolute bottom-0 end-0" style="background-color: #F169BB; color: #5F369F; border-radius: 50%;" onclick="$('#profileImage2').click()"></i>
                            <input type="file" class="d-none" id="profileImage2" onchange="document.getElementById('profileImage1').src = window.URL.createObjectURL(this.files[0]); module.updateProfileImage();">
                        </div>
                        <div class="progress mt-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="height: 7px; background-color: transparent;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="profile-upload-progress-bar" style="background-color: #5F369F;"></div>
                        </div>
                    </center>
                    <div class="row mt-3">
                        <!-- profile name -->
                        <div class="col-1 pt-2">
                            <i class="fa-solid fa-user h-3" style="color: #5F369F;"></i>
                        </div>
                        <div class="col-9">
                            <span style="font-size: 12px; color: #F169BB;">Name</span>
                            <h6 class="profileName" id="profileName1"></h6>
                            <input type="text" id="profileName2" placeholder="Display Name" style="display: none;" class="form-control form-control-sm profileName" onchange="$('#profileName1').html($(this).val()); module.updateProfile();" autocomplete="off">
                        </div>
                        <div class="col-2 pt-2">
                            <i class="fa-solid fa-pen h-3" style="color: #5F369F; cursor: pointer;" onclick="$('.profileName').toggle(); $(this).toggleClass('fa-pen fa-check');"></i>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-11"><span style="font-size: 12px; color: #F169BB;">This is not your username. This name will be visible to your KitCat contacts.</span><hr></div>

                        <!-- about self -->
                        <div class="col-1 pt-2">
                            <i class="fa-solid fa-circle-info h-3" style="color: #5F369F;"></i>
                        </div>
                        <div class="col-9">
                            <span style="font-size: 12px; color: #F169BB;">About</span>
                            <h6 class="profileAbout" id="profileAbout1"></h6>
                            <input type="text" id="profileAbout2" placeholder="About" style="display: none;" class="form-control form-control-sm profileAbout" onchange="$('#profileAbout1').html($(this).val()); module.updateProfile();" autocomplete="off">
                        </div>
                        <div class="col-2 pt-2">
                            <i class="fa-solid fa-pen h-3" style="color: #5F369F; cursor: pointer;" onclick="$('.profileAbout').toggle(); $(this).toggleClass('fa-pen fa-check');"></i>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-11"><hr></div>

                        <!-- mobile self -->
                        <div class="col-1 pt-2">
                            <i class="fa-solid fa-phone h-3" style="color: #5F369F;"></i>
                        </div>
                        <div class="col-9">
                            <span style="font-size: 12px; color: #F169BB;">Phone</span>
                            <h6 class="profilePhone" id="profilePhone1"></h6>
                            <input type="text" id="profilePhone2" placeholder="00-0000-0000" style="display: none;" class="form-control form-control-sm profilePhone" onchange="$('#profilePhone1').html($(this).val()); module.updateProfile();" autocomplete="off">
                        </div>
                        <div class="col-2 pt-2">
                            <i class="fa-solid fa-pen h-3" style="color: #5F369F; cursor: pointer;" onclick="$('.profilePhone').toggle(); $(this).toggleClass('fa-pen fa-check');"></i>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-11"><hr></div>

                        <!-- DOB self -->
                        <div class="col-1 pt-2">
                            <i class="fa-solid fa-cake-candles h-3" style="color: #5F369F;"></i>
                        </div>
                        <div class="col-9">
                            <span style="font-size: 12px; color: #F169BB;">Date of Birth</span>
                            <h6 class="profileDOB" id="profileDOB1"></h6>
                            <input type="date" id="profileDOB2" style="display: none;" class="form-control form-control-sm profileDOB" onchange="$('#profileDOB1').html($(this).val()); module.updateProfile();">
                        </div>
                        <div class="col-2 pt-2">
                            <i class="fa-solid fa-pen h-3" style="color: #5F369F; cursor: pointer;" onclick="$('.profileDOB').toggle(); $(this).toggleClass('fa-pen fa-check');"></i>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-11"><hr></div>
                    </div>
                </div>
            </div>
            <!-- startup page -->
            <div class="col-12 col-sm-6 col-lg-8 bg-light p-0 position-relative text-center" style="height: 100vh;" id="section-start">
                <img src="assets/Laptop-Chat-Image.png" alt="" class="mt-5" style="filter: hue-rotate(67deg) drop-shadow(2px 4px 6px black); max-width: 400px; width: 100%;">
                <h1 style="color: #5F369F;">KitCat</h1>
                <h3 style="color: #F169BB;">Get experience as lively as a Tom & Jerry brawl</h3>
                <h6>Designed & Developed by ASG</h6>
            </div>
            <!-- chat body -->
            <div class="col-12 col-sm-6 col-lg-5 bg-light p-0 position-relative" style="height: 100vh;" id="section-chat">
                <div class="mb-1 py-2 px-2" style="display: flex; align-items: center; background-color: #FFFFFF;">
                    <div class="ps-2 pe-3 d-block d-sm-none" onclick="$('.section-list').fadeIn();
                    $('#section-chat').hide();"><i class="fa-solid fa-left-long"></i></div>
                    <img onerror="this.src='assets/KitCat-Logo.jpg';" src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar" id="user-avatar-chat">
                    <div class="user-details" style="border: none;">
                        <div class="user-name" id="user-name-chat">KitCat</div>
                        <div class="last-msg" id="user-name-status">...</div>
                    </div>
                    <div class="pe-1">
                        <button class="btn rounded-circle" style="color: #5F369F;" onclick="$('#chat-image-message').click()"><i class="fa-solid fa-paperclip"></i></button>
                    </div>
                </div>
                <div id="chat-content" class="px-1">
                    <ul class="ps-0" id="kitcat_message_list">
                        
                    </ul>
                </div>
                <div class="progress" style="background: transparent;" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="image-upload-progress-bar" style="background-color: #5F369F;"></div>
                </div>
                <emoji-picker class="light"></emoji-picker>
                <div class="position-absolute p-2" style="bottom: 0rem; left: 0rem; right: 0rem; background-color: #FFFFFF;">
                    <div style="display: flex; align-items: center;">
                        
                        <div class="pe-1">
                            <button class="btn btn-primary px-4 rounded-pill" onclick="$('emoji-picker').slideToggle('slow')"><i class="fa-solid fa-face-smile"></i></button>
                        </div>
                        <div style="flex: 1;">
                            <input type="hidden" id="chatbook-id">
                            <input type="file" id="chat-image-message" class="d-none" accept=".jpg,.jpeg,.png,.gif" onchange="module.sendImage()">
                            <textarea type="text" id="chat-text-message" class="form-control rounded-pill" rows="1" placeholder="Type a cat message .. . .."></textarea>
                        </div>
                        <div class="ps-1">
                            <button class="btn btn-primary px-4 rounded-pill" onclick="module.sendMsg()"><i class="fa-solid fa-paper-plane"></i></button>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- user profile & media -->
            <div class="col-12 col-sm-6 col-lg-3 py-3" style="height: 100vh; background-color: #FFFFFF; color: #5F369F;" id="section-profile">
                <!-- <div class="text-white px-4 " ><i class="fa-solid fa-left-long"></i></div> -->
                <h4 class="text-end"><i class="fa-regular fa-circle-xmark d-block d-lg-none" onclick="$('#section-chat').fadeIn();
                    $('#section-profile').hide();"></i></h4>
                <center>
                    <img onerror="this.src='assets/KitCat-Logo.jpg';" src="assets/KitCat-Logo.jpg" alt="Profile" id="displayImage" style="width: 50%; aspect-ratio: 1; object-fit: cover; border-radius: 50%; border: 5px solid #F169BB;">
                </center>
                <h1 class="text-center my-3" id="displayName">KitCat Name</h1>
                <h6 class="text-center" id="displayNumber"></h6>
                <!-- <h6 class="text-center" id="displayEmail">kitcat@gmail.com</h6> -->
                <h6 class="text-center" id="displayAbout"></h6>
                <hr class="w-75 m-auto my-2">
                <div class="px-2" id="image-gallary">
                    <span style="color: #F169BB; font-size: 12px;">Media Gallary</span>
                    <div class="row m-0" id="image-gallary-row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- notification toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <img src="assets/KitCat-Logo.jpg" id="toast-img" class="rounded me-2" onerror="this.src='assets/KitCat-Logo.jpg';" style="width: 25px;">
            <strong class="me-auto" id="toast-name">KitCat</strong>
            <small>Just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body" id="toast-message">
            Hello Jerry, request sended to Tom
          </div>
        </div>
    </div>
    <!-- notification sound -->
    <audio src="assets/event.mp3" id="event-audio"></audio>

    <!-- custom js -->
    <script>
        module = {};
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

    </script>
    <script src="assets/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js"></script>
    <!-- emoji picker module js -->
    <script type="module" src="assets/emoji-picker.js"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
        import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-auth.js";
        import { getFirestore, onSnapshot, query, collection, where, orderBy, limit, doc, addDoc, setDoc, getDoc, getDocs, documentId } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js";
        import { getStorage, ref, uploadBytesResumable, getDownloadURL } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-storage.js";
        import { firebaseConfig } from './assets/config.js';


        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const db = getFirestore(app);
        const storage = getStorage(app);

        // check user login or not
        onAuthStateChanged(auth, async (user) => {
            if (user) {
                // console.log("User is signed in:", user);
                console.log("User is signed in:");
                await setDoc(doc(db, "users", user.uid), {
                    status:'Online'
                }, { merge: true });
            } else {
                var userData = localStorage.getItem('user');
                var currentUser = JSON.parse(userData);
                localStorage.removeItem('user');
                console.log("User is signed out");
                window.location="index.php";
            }
        });

        // logout user from session & cookies
        module.logout = async function logout(){
            // Perform Firebase sign out
            auth.signOut().then(() => {
                // Sign-out successful.
                console.log("User signed out successfully");
            }).catch((error) => {
                // An error happened.
                console.error("Error signing out:", error);
            });
        }


        // showing user details
        const userData = localStorage.getItem('user');
        const currentUser = JSON.parse(userData);
        console.log(currentUser);
        $("#profileName1").html(currentUser.displayName);
        $("#profileName2").val(currentUser.displayName);
        $("#profileAbout1").html(currentUser.about);
        $("#profileAbout2").val(currentUser.about);
        $("#profilePhone1").html(currentUser.phoneNumber);
        $("#profilePhone2").val(currentUser.phoneNumber);
        $("#profileDOB1").html(currentUser.dob);
        $("#profileDOB2").val(currentUser.dob);
        $('#profileImage1').attr('src', currentUser.photoURL);

        // get user list
        const userList = document.getElementById('kitcat_user_list');
        const adduserList = document.getElementById('kitcat_add_user_list');
        const requestuserList = document.getElementById('kitcat_request_user_list');
        let userlistFunction = null;
        let adduserlistFunction = null;
        let requestuserlistFunction = null;
        
        // Define a function to update user list
        const updateUserList = async () => {
            const query1 = query(collection(db, "chatbook"), where("users", "array-contains", currentUser.uid), where("request", "==", 'Accepted'), orderBy("time", "desc"));
            
            // Unsubscribe previous listener if it exists
            if (userlistFunction) {
                userlistFunction();
            }

            userlistFunction = onSnapshot(query1, async (snapshot1) => {
                var userlistString = '';
                var katuid = $("#chatbook-id").val();
                for (const doc1 of snapshot1.docs) {
                    var memberData = doc1.data();
                    
                    if (memberData.users.length === 1) {
                        if(katuid == doc1.id){
                            var useractive = 'user-active';
                        }else{
                            var useractive = '';
                        }
                        userlistString += `<li class="user-item `+useractive+`" onclick="module.getAllMessage('${doc1.id}', '0')" id="userlist${doc1.id}"> 
                                                <div style="position: relative;"> 
                                                    <img onerror="this.src='assets/KitCat-Logo.jpg';" src="${currentUser.photoURL}" alt="User 1" class="user-avatar"> 
                                                    <div class="Online"></div> 
                                                </div> 
                                                <div class="user-details"> 
                                                    <div class="user-name">${currentUser.displayName}</div> 
                                                    <div class="last-msg">${memberData.message}</div> 
                                                </div> 
                                            </li>`;
                    } else {
                        if(katuid == doc1.id){
                            var useractive = 'user-active';
                        }else{
                            var useractive = '';
                        }
                        if(memberData.users[0] == currentUser.uid){
                            var indexNo = '1';
                        }else{
                            var indexNo = '0';
                        }
                        const catuid = memberData.users.find(uid => uid !== currentUser.uid);
                        const docRef = doc(db, "users", catuid);
                        const docSnap = await getDoc(docRef);
                        if (docSnap.exists()) {
                            userlistString += `<li class="user-item `+useractive+`" onclick="module.getAllMessage('${doc1.id}', `+indexNo+`)" id="userlist${doc1.id}"> 
                                                    <div style="position: relative;"> 
                                                        <img onerror="this.src='assets/KitCat-Logo.jpg';" src="${docSnap.data().photoURL}" alt="User 1" class="user-avatar"> 
                                                        <div class="${docSnap.data().status}"></div> 
                                                    </div> 
                                                    <div class="user-details"> 
                                                        <div class="user-name">${docSnap.data().displayName}</div> 
                                                        <div class="last-msg">${memberData.message}</div> 
                                                    </div> 
                                                </li>`;
                            if(katuid != doc1.id && memberData.seen === 'unseen' && memberData.notifyTo != currentUser.id){
                                toastTrigger('', docSnap.data().displayName, memberData.message);
                                await setDoc(doc(db, "chatbook", doc1.id), {
                                    seen:'seen',
                                }, { merge: true });
                            }
                        }
                    }
                }
                userList.innerHTML = userlistString;
            });
        };

        // new added user list
        const updateAddList = async () => {
            let contactList = [];
            const query1 = query(collection(db, "chatbook"), where("users", "array-contains", currentUser.uid), orderBy("time", "desc"));
            
            // Unsubscribe previous listener if it exists
            if (adduserlistFunction) {
                adduserlistFunction();
            }

            adduserlistFunction = onSnapshot(query1, async (snapshot1) => {
                for (const doc1 of snapshot1.docs) {
                    var memberData = doc1.data();
                    
                    if (memberData.users.length === 1) {
                        contactList.push(doc1.id);
                    }else{
                        const catuid = memberData.users.find(uid => uid !== currentUser.uid);
                        const docRef = doc(db, "users", catuid);
                        const docSnap = await getDoc(docRef);
                        if (docSnap.exists()) {
                            contactList.push(catuid);
                        }
                    }
                }
                
                // new added users list
                // console.log(contactList);
                var userlistString1 = '';
                const query5 = query(collection(db, "users"), where(documentId(), 'not-in', contactList), orderBy('metadata.lastSignInTime', 'desc'));
                const querySnapshot5 = await getDocs(query5);
                querySnapshot5.forEach((doc5) => {
                    // console.log(doc5.id, " => ", doc5.data());
                    userlistString1 += `<li class="user-item" onclick="module.sendRequest('${doc5.id}')"> 
                                <div style="position: relative;"> 
                                    <img onerror="this.src='assets/KitCat-Logo.jpg';" src="${doc5.data().photoURL}" alt="User 1" class="user-avatar"> 
                                    <div class="${doc5.data().status}"></div> 
                                </div> 
                                <div class="user-details"> 
                                    <div class="user-name">${doc5.data().displayName}</div> 
                                    <div class="last-msg">Send request to newcomer</div> 
                                </div> 
                            </li>`;
                });
                adduserList.innerHTML = userlistString1;
            });
        };

        // new friend request list
        const updateRequestList = async () => {
            const query1 = query(collection(db, "chatbook"), where("request", "==", 'Waiting'), where("notifyTo", "==", currentUser.uid), orderBy("time", "desc"));
            
            // Unsubscribe previous listener if it exists
            if (requestuserlistFunction) {
                requestuserlistFunction();
            }

            requestuserlistFunction = onSnapshot(query1, async (snapshot1) => {
                var userlistString6 = '';
                for (const doc6 of snapshot1.docs) {
                    var memberData = doc6.data();
                    var docRef = doc(db, "users", doc6.data().users[1]);
                    var docSnap = await getDoc(docRef);
                    if (docSnap.exists()) {
                        userlistString6 += `<li class="user-item" onclick="module.acceptRequest('${doc6.id}')"> 
                            <div style="position: relative;"> 
                                <img onerror="this.src='assets/KitCat-Logo.jpg';" src="${docSnap.data().photoURL}" alt="User 1" class="user-avatar"> 
                                <div class="${docSnap.data().status}"></div> 
                            </div> 
                            <div class="user-details"> 
                                <div class="user-name">${docSnap.data().displayName}</div> 
                                <div class="last-msg">Getting new friend request</div> 
                            </div> 
                        </li>`;

                        if(memberData.seen === 'unseen'){
                            toastTrigger('', 'KitCat Request', "Friend request from "+docSnap.data().displayName);
                            await setDoc(doc(db, "chatbook", doc6.id), {
                                message:'Friend request deliverd',
                                seen:'seen',
                            }, { merge: true });
                        }
                    }
                }
                requestuserList.innerHTML = userlistString6;
            });
        };

        // Call updateUserList initially
        updateUserList();
        updateAddList();
        updateRequestList();

        // Listen for changes in the 'users' collection
        const query4 = query(collection(db, 'users'));
        onSnapshot(query4, async (snapshot4) => {
            updateUserList(); updateAddList(); updateRequestList();
        });

        // send friend request to user
        module.sendRequest = async function sendRequest(frndid){
            await addDoc(collection(db, "chatbook"), {
                message:'Friend request from '+currentUser.displayName,
                seen:'unseen',
                status:'online',
                notifyTo:frndid,
                request:'Waiting',
                time:new Date(),
                users:[frndid, currentUser.uid]
            });
            toastTrigger('', 'KitCat Notification', "Friend request send");
        }

        // accept friend request 
        module.acceptRequest = async function acceptRequest(chatbook_id){
            if(confirm('Upgrade your friend list, accept request?')){
                await setDoc(doc(db, "chatbook", chatbook_id), {
                    message:'Friend request accepted',
                    seen:'unseen',
                    request:'Accepted',
                    time:new Date(),
                }, { merge: true });
            }else{
                // alert('reject');
            }
            
        }

        // get all message group & user details
        module.getAllMessage = async function getAllMessage(katuid, index){
            $("#chatbook-id").val(katuid);
            $(".user-active").removeClass("user-active");
            $("#userlist"+katuid).addClass("user-active");
            const messageList = document.getElementById('kitcat_message_list');
            messageList.innerHTML = `<li style="min-height: 55px;"> <div class="left-message"> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> <div class="chat-message" style="color: #f169bb00;"> Lorem, ipsum dolor sit amet </div> </div> </li>
                        <li style="min-height: 55px;"> <div class="right-message"> <div class="chat-message" style="color: #9352E000;"> Lorem, ipsum dolor sit amet </div> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> </li>
                        <li style="min-height: 55px;"> <div class="left-message"> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> <div class="chat-message" style="color: #f169bb00;"> Lorem, ipsum dolor sit amet </div> </div> </li>
                        <li style="min-height: 55px;"> <div class="right-message"> <div class="chat-message" style="color: #9352E000;"> Lorem, ipsum dolor sit amet </div> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> </li>
                        <li style="min-height: 55px;"> <div class="left-message"> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> <div class="chat-message" style="color: #f169bb00;"> Lorem, ipsum dolor sit amet </div> </div> </li>
                        <li style="min-height: 55px;"> <div class="right-message"> <div class="chat-message" style="color: #9352E000;"> Lorem, ipsum dolor sit amet </div> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> </li>
                        <li style="min-height: 55px;"> <div class="left-message"> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> <div class="chat-message" style="color: #f169bb00;"> Lorem, ipsum dolor sit amet </div> </div> </li>
                        <li style="min-height: 55px;"> <div class="right-message"> <div class="chat-message" style="color: #9352E000;"> Lorem, ipsum dolor sit amet </div> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> </li>
                        <li style="min-height: 55px;"> <div class="left-message"> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> <div class="chat-message" style="color: #f169bb00;"> Lorem, ipsum dolor sit amet </div> </div> </li>
                        <li style="min-height: 55px;"> <div class="right-message"> <div class="chat-message" style="color: #9352E000;"> Lorem, ipsum dolor sit amet </div> <img src="assets/KitCat-Logo.jpg" class="chat-avatar"> </div> </li>`;
            const docRef1 = doc(db, "chatbook", katuid);
            const docSnap1 = await getDoc(docRef1);
            if (docSnap1.exists()) {
                // console.log(docSnap1.data());
                var clickUser = docSnap1.data().users[index];

                const docRef2 = doc(db, "users", clickUser);
                const docSnap2 = await getDoc(docRef2);
                if (docSnap2.exists()) {
                    // console.log(docSnap2.data());
                    const clickUserData = docSnap2.data();
                    $('#displayName').html(clickUserData.displayName);
                    $('#displayNumber').html(clickUserData.phoneNumber);
                    // $('#displayEmail').html(clickUserData.email);
                    $('#displayAbout').html(clickUserData.about);
                    $('#displayImage').attr('src', clickUserData.photoURL);
                    $('#user-name-chat').html(clickUserData.displayName);
                    $('#user-name-status').html(clickUserData.status);
                    $('#user-avatar-chat').attr('src', clickUserData.photoURL);

                    const query2 = query(collection(db, "chatstorage"), where("chatid", "==", katuid), orderBy('timestamp'));
                    onSnapshot(query2, async (snapshot2) => {
                        messageList.innerHTML = '';
                        for (const doc1 of snapshot2.docs) {
                            var chatData = doc1.data();
                            // console.log(chatData);
                            if(chatData.type == "text"){
                                if(chatData.uid == currentUser.uid){
                                    var messageString = '<li style="min-height: 55px;"> <div class="right-message"> <div class="chat-message"> '+chatData.message+' <span>'+chatData.time+'</span> </div> <img onerror="this.src=&#39;assets/KitCat-Logo.jpg&#39;;" src="'+currentUser.photoURL+'" class="chat-avatar"> </div> </li>';
                                }else{
                                    var messageString = '<li style="min-height: 55px;"> <div class="left-message"> <img onerror="this.src=&#39;assets/KitCat-Logo.jpg&#39;;" src="'+clickUserData.photoURL+'" class="chat-avatar"> <div class="chat-message"> '+chatData.message+' <span>'+chatData.time+'</span> </div> </div> </li>';
                                }
                            }else{
                                if(chatData.uid == currentUser.uid){
                                    var messageString = '<li style="min-height: 132px;"> <div class="right-message"> <div class="chat-message"> <img onerror="this.src=&#39;assets/KitCat-Logo.jpg&#39;;" src="'+chatData.message+'" style="width: 80px; height: 80px; object-fit: cover;"> <br> <span>'+chatData.time+'</span> </div> <img onerror="this.src=&#39;assets/KitCat-Logo.jpg&#39;;" src="'+currentUser.photoURL+'" class="chat-avatar"> </div> </li>';
                                }else{
                                    var messageString = '<li style="min-height: 132px;"> <div class="left-message"> <img onerror="this.src=&#39;assets/KitCat-Logo.jpg&#39;;" src="'+clickUserData.photoURL+'" class="chat-avatar"> <div class="chat-message"> <img onerror="this.src=&#39;assets/KitCat-Logo.jpg&#39;;" src="'+chatData.message+'" style="width: 80px; height: 80px; object-fit: cover;"> <br> <span>'+chatData.time+'</span> </div> </div> </li>';
                                }
                            }
                            
                            messageList.insertAdjacentHTML('beforeend', messageString);
                        }
                        
                        var chatContainer = document.getElementById("chat-content");
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    });

                    const imageGallary = document.getElementById('image-gallary-row');
                    const query3 = query(collection(db, "chatstorage"), where("chatid", "==", katuid), where("type", "==", 'img'), orderBy('timestamp', 'desc'));
                    onSnapshot(query3, async (snapshot3) => {
                        imageGallary.innerHTML = '';
                        for (const doc1 of snapshot3.docs) {
                            var imageData = doc1.data();
                            // console.log(imageData);
                            
                            var parts = imageData.message.split("?");
                            var baseUrl = parts[0];
                            var urlParts = baseUrl.split("/");
                            var lastPart = urlParts[urlParts.length - 1];
                            var decodedPart = decodeURIComponent(lastPart);
                            var file_name = decodedPart.substring(decodedPart.lastIndexOf("/") + 1);
                            
                            var imageString = '<div class="col-4 p-1"> <img onerror="this.src=&#39;assets/KitCat-Logo.jpg&#39;;" src="'+imageData.message+'" alt="image gallary"> </div>';
                            
                            imageGallary.insertAdjacentHTML('beforeend', imageString);
                        }
                    });

                }
            }

            if ((screen.width>992)) {
                $('#section-start').hide();
                $('#section-chat').fadeIn();
                $('#section-profile').fadeIn();
            }
            if ((screen.width<992)) {
                $('#section-start').hide();
                $('.section-list').hide();
                $('#section-chat').fadeIn();
            }
        }

        // send message to chatbook
        module.sendMsg = async function sendMsg(){
            var message = $('#chat-text-message').val();
            var chatbook_id = $('#chatbook-id').val();
            var timestamp = new Date();
            if(message == ""){
                return false;
            }else{
                // get time of msg send
                let hours = timestamp.getHours();
                var minutes = timestamp.getMinutes();
                var ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12;
                hours = hours ? hours : 12;
                var formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
                var send_time = hours + ':' + formattedMinutes + ampm;
                // ==================================================
                
                await addDoc(collection(db, "chatstorage"), {
                    message:message,
                    type:'text',
                    chatid:chatbook_id,
                    timestamp:timestamp,
                    time:send_time,
                    uid:currentUser.uid,
                    name:currentUser.displayName,
                    seen:'unseen'
                });
                await setDoc(doc(db, "chatbook", chatbook_id), {
                    message:message,
                    notifyTo:currentUser.uid,
                    seen:'unseen',
                    time:timestamp,
                }, { merge: true });
                
                $('#chat-text-message').val('')
            }
        }

        // onenter button message is send
        $('#chat-text-message').keypress(function(e){
            var chat_message = $("#chat-text-message").val();
            if(chat_message != ''){
                if(e.which == 13){
                    e.preventDefault();
                    module.sendMsg();
                }
            }
        });

        // image send in message
        module.sendImage = async function sendImage() {
            var file = document.getElementById('chat-image-message').files[0];
            var chatbook_id = $('#chatbook-id').val();
            var extension = file.name.split('.').pop();
            var fileName = (new Date()).getTime() + '_' + chatbook_id.substring(0, 10) + "." + extension;
            // console.log(fileName);
            var fileType = file.type.split('/')[0]; // Get file type
            var type;
            if (fileType === 'image') {
                type = 'img';
            } else if (fileType === 'application' && file.type === 'application/pdf') {
                type = 'pdf';
            } else {
                type = 'file';
            }
            const storageRef = ref(storage, 'ChatDocs/'+fileName);

            const uploadTask = uploadBytesResumable(storageRef, file);
            uploadTask.on('state_changed',
                (snapshot) => {
                    const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    // console.log('Upload is ' + progress + '% done');
                    $('#image-upload-progress-bar').css({'width': progress + '%', 'display': 'block'});
                    switch (snapshot.state) {
                        case 'paused':
                            console.log('Upload is paused');
                            break;
                        case 'running':
                            console.log('Upload is running');
                            break;
                    }
                },
                async (error) => {
                    console.log('Upload failed : ' + error);
                    $('#image-upload-progress-bar').css({'width': '0%', 'display': 'none'});
                },
                async () => {
                    const downloadURL = await getDownloadURL(uploadTask.snapshot.ref);
                    var message = downloadURL;
                    var chatbook_id = $('#chatbook-id').val();
                    var timestamp = new Date();
                    // get time of msg send
                    let hours = timestamp.getHours();
                    var minutes = timestamp.getMinutes();
                    var ampm = hours >= 12 ? 'pm' : 'am';
                    hours = hours % 12;
                    hours = hours ? hours : 12;
                    var formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
                    var send_time = hours + ':' + formattedMinutes + ampm;
                    // ==================================================
                    
                    await addDoc(collection(db, "chatstorage"), {
                        message:message,
                        type:type,
                        chatid:chatbook_id,
                        timestamp:timestamp,
                        time:send_time,
                        uid:currentUser.uid,
                        name:currentUser.displayName,
                        seen:'unseen'
                    });
                    await setDoc(doc(db, "chatbook", chatbook_id), {
                        message:'Image is shared',
                        seen:'unseen',
                        time:timestamp,
                    }, { merge: true });
                    
                    $('#image-upload-progress-bar').css({'width': '0%', 'display': 'none'});
                }
            );
        }

        // if user goes other side then offline
        async function updateUserStatus(live_status) {
            try {
                await setDoc(doc(db, "users", currentUser.uid), {
                    status: live_status,
                }, { merge: true });
            } catch (error) {
                console.error("Error updating user status:", error);
            }
        }

        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'hidden') {
                updateUserStatus('Offline'); // Call the asynchronous function
            }else{
                updateUserStatus('Online');
            }
        });
        $(window).on('beforeunload', function(){
            updateUserStatus('Offline'); // Call the asynchronous function
        });

        // update user profile details
        module.updateProfile = async function updateProfile(){
            var profileName     = $("#profileName2").val();
            var profileAbout    = $("#profileAbout2").val();
            var profilePhone    = $("#profilePhone2").val();
            var profileDOB      = $("#profileDOB2").val();
            await setDoc(doc(db, "users", currentUser.uid), {
                displayName: profileName,
                about: profileAbout,
                phoneNumber: profilePhone,
                dob: profileDOB,
            }, { merge: true });

            const docRef = doc(db, "users", currentUser.uid);
            const docSnap = await getDoc(docRef);
            if (docSnap.exists()) {
                localStorage.setItem('user', JSON.stringify(docSnap.data()));
            }
        }

        // update profile image
        module.updateProfileImage = async function updateProfileImage() {
            var file = document.getElementById('profileImage2').files[0];
            var extension = file.name.split('.').pop();
            var fileName = (new Date()).getTime() + '_' + currentUser.uid.substring(0, 10) + "." + extension;
            // console.log(fileName);
            
            const storageRef = ref(storage, 'ChatDocs/'+fileName);

            const uploadTask = uploadBytesResumable(storageRef, file);
            uploadTask.on('state_changed',
                (snapshot) => {
                    const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    // console.log('Upload is ' + progress + '% done');
                    $('#profile-upload-progress-bar').css({'width': progress + '%', 'display': 'block'});
                    switch (snapshot.state) {
                        case 'paused':
                            console.log('Upload is paused');
                            break;
                        case 'running':
                            console.log('Upload is running');
                            break;
                    }
                },
                async (error) => {
                    console.log('Upload failed : ' + error);
                    $('#profile-upload-progress-bar').css({'width': '0%', 'display': 'none'});
                },
                async () => {
                    const downloadURL = await getDownloadURL(uploadTask.snapshot.ref);
                    var photoURL = downloadURL;
                    
                    await setDoc(doc(db, "users", currentUser.uid), {
                        photoURL: photoURL
                    }, { merge: true });

                    const docRef = doc(db, "users", currentUser.uid);
                    const docSnap = await getDoc(docRef);
                    if (docSnap.exists()) {
                        localStorage.setItem('user', JSON.stringify(docSnap.data()));
                    }
                    
                    $('#profile-upload-progress-bar').css({'width': '0%', 'display': 'none'});
                }
            );
        }

        
    </script>
</body>
</html>