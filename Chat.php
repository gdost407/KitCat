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
    <link rel="stylesheet" href="assets/style.css">
    
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
                <h6>Designed & Developed by <a href="https://aniketgolhar.in">ASG</a></h6>
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
    </script>
    <script src="assets/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js"></script>
    <!-- emoji picker module js -->
    <script type="module" src="assets/emoji-picker.js"></script>
    <!-- chat js -->
    <script type="module" src="assets/chat.js"></script>
</body>
</html>