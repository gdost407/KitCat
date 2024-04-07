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
        #image-upload-progress-bar{
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

        /* media query */
        @media screen and (max-width: 992px){
            #section-profile{
                display: none;
            }
        }
        @media screen and (max-width: 767px){
            
        }
        @media screen and (max-width: 576px){
            #section-chat, #section-profile{
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
            <div class="col-2 col-sm-1 col-lg-1 py-3 section-list" style="height: 100vh; background-color: #5F369F;">
                <img src="assets/KitCat-Logo.jpg" style="width: 100%;" class="rounded-circle">
            </div>
            <div class="col-10 col-sm-5 col-lg-3 px-0 py-3 section-list" id="section-list" style="height: 100vh; background-color: #FFFFFF;">
                <div class="px-2">
                    <h1>KitCat</h1>
                    <input type="search" name="" id="" class="form-control bg-light rounded-pill" placeholder="&#xF002; Search for chat..." style="font-family:Arial, FontAwesome">
                </div>
                <br>
                <div style="height: 80vh; overflow-y: auto;">
                    <ul class="ps-0" id="kitcat_user_list">
                        
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-5 bg-light p-0 position-relative" style="height: 100vh;" id="section-chat">
                <div class="mb-1 py-2 px-2" style="display: flex; align-items: center; background-color: #FFFFFF;">
                    <div class="ps-2 pe-3 d-block d-sm-none" onclick="$('.section-list').fadeIn();
                    $('#section-chat').hide();"><i class="fa-solid fa-left-long"></i></div>
                    <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar" id="user-avatar-chat">
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
                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="image-upload-progress-bar"></div>
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
            <div class="col-12 col-sm-6 col-lg-3 py-3" style="height: 100vh; background-color: #FFFFFF; color: #5F369F;" id="section-profile">
                <!-- <div class="text-white px-4 " ><i class="fa-solid fa-left-long"></i></div> -->
                <h4 class="text-end"><i class="fa-regular fa-circle-xmark d-block d-lg-none" onclick="$('#section-chat').fadeIn();
                    $('#section-profile').hide();"></i></h4>
                <center>
                    <img src="assets/KitCat-Logo.jpg" alt="Profile" id="displayImage" style="width: 50%; aspect-ratio: 1; object-fit: cover; border-radius: 50%; border: 5px solid #F169BB;">
                </center>
                <h1 class="text-center my-3" id="displayName">KitCat Name</h1>
                <h6 class="text-center" id="displayNumber"></h6>
                <h6 class="text-center" id="displayEmail">kitcat@gmail.com</h6>
                <hr class="w-75 m-auto my-2">
                <div class="px-2" id="image-gallary">
                    <div class="row m-0" id="image-gallary-row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- custom js -->
    <script>
        module = {};
        function downloadImage(imageUrl) {
            fetch(imageUrl)
            .then(response => response.blob())
            .then(blob => {
                // Create a temporary anchor element
                const anchor = document.createElement("a");
                anchor.href = URL.createObjectURL(blob);
                anchor.download = "image.jpeg";

                // Programmatically trigger a click event on the anchor element
                // This will initiate the download process
                anchor.click();

                // Cleanup
                URL.revokeObjectURL(anchor.href);
            })
            .catch(error => console.error("Error downloading image:", error));
        }
    </script>
    <script src="assets/custom.js"></script>
    <!-- emoji picker module js -->
    <script type="module" src="assets/emoji-picker.js"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
        import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-auth.js";
        import { getFirestore, onSnapshot, query, collection, where, orderBy, limit, doc, addDoc, setDoc, getDoc} from "https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js";
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
                console.log("User is signed in:", user);
                await setDoc(doc(db, "users", user.uid), {
                    status:'Online'
                }, { merge: true });
            } else {
                var userData = localStorage.getItem('user');
                var currentUser = JSON.parse(userData);
                await setDoc(doc(db, "users", currentUser.uid), {
                    status:'Offline'
                }, { merge: true });
                console.log("User is signed out");
                window.location="index.php";
            }
        });

        // showing user details
        const userData = localStorage.getItem('user');
        const currentUser = JSON.parse(userData);
        // console.log(currentUser);
        $('#displayName').html(currentUser.displayName);
        $('#displayNumber').html(currentUser.phoneNumber);
        $('#displayEmail').html(currentUser.email);
        $('#displayImage').attr('src', currentUser.photoURL);
        $('#user-name-chat').html(currentUser.displayName);
        $('#user-name-status').html('Online');
        $('#user-avatar-chat').attr('src', currentUser.photoURL);

        // get user list
        const userList = document.getElementById('kitcat_user_list');
        const query1 = query(collection(db, "chatbook"), where("users", "array-contains", currentUser.uid), orderBy("time", "desc"));
        let userlistFunction = null;
        if (userlistFunction) {
            userlistFunction();
        }
        userlistFunction = onSnapshot(query1, async (snapshot1) => {
            var userlistString = '';
            for (const doc1 of snapshot1.docs) {
                var memberData = doc1.data();
                // console.log(memberData);
                if (memberData.users.length === 1) {
                    userlistString += '<li class="user-item" onclick="module.getAllMessage(&#39;'+doc1.id+'&#39;, &#39;0&#39;)"> <img src="'+currentUser.photoURL+'" alt="User 1" class="user-avatar"> <div class="user-details"> <div class="user-name">'+currentUser.displayName+'</div> <div class="last-msg">'+memberData.message+'</div> </div> </li>';
                }else{
                    if(currentUser.uid == memberData.users[0]){
                        var catuid = memberData.users[1];
                        var index = '1';
                    }else{
                        var catuid = memberData.users[0];
                        var index = '0';
                    }
                    const docRef = doc(db, "users", catuid);
                    const docSnap = await getDoc(docRef);
                    if (docSnap.exists()) {
                        userlistString += '<li class="user-item" onclick="module.getAllMessage(&#39;'+doc1.id+'&#39;, &#39;'+index+'&#39;)"> <img src="'+docSnap.data().photoURL+'" alt="User 1" class="user-avatar"> <div class="user-details"> <div class="user-name">'+docSnap.data().displayName+'</div> <div class="last-msg">'+memberData.message+'</div> </div> </li>';
                    }
                }
                
                // userList.insertAdjacentHTML('beforeend', userlistString);
            }
            userList.innerHTML = userlistString;
        });

        // get all message group & user details
        module.getAllMessage = async function getAllMessage(katuid, index){
            $("#chatbook-id").val(katuid);
            
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
                    $('#displayEmail').html(clickUserData.email);
                    $('#displayImage').attr('src', clickUserData.photoURL);
                    $('#user-name-chat').html(clickUserData.displayName);
                    $('#user-name-status').html(clickUserData.status);
                    $('#user-avatar-chat').attr('src', clickUserData.photoURL);

                    const messageList = document.getElementById('kitcat_message_list');
                    const query2 = query(collection(db, "chatstorage"), where("chatid", "==", katuid), orderBy('timestamp'));
                    onSnapshot(query2, async (snapshot2) => {
                        messageList.innerHTML = '';
                        for (const doc1 of snapshot2.docs) {
                            var chatData = doc1.data();
                            // console.log(chatData);
                            if(chatData.type == "text"){
                                if(chatData.uid == currentUser.uid){
                                    var messageString = '<li style="min-height: 55px;"> <div class="right-message"> <div class="chat-message"> '+chatData.message+' <span>'+chatData.time+'</span> </div> <img src="'+currentUser.photoURL+'" class="chat-avatar"> </div> </li>';
                                }else{
                                    var messageString = '<li style="min-height: 55px;"> <div class="left-message"> <img src="'+clickUserData.photoURL+'" class="chat-avatar"> <div class="chat-message"> '+chatData.message+' <span>'+chatData.time+'</span> </div> </div> </li>';
                                }
                            }else{
                                if(chatData.uid == currentUser.uid){
                                    var messageString = '<li style="min-height: 55px;"> <div class="right-message"> <div class="chat-message"> <img src="'+chatData.message+'" style="width: 80px; height: 80px; object-fit: cover;"> <br> <span>'+chatData.time+'</span> </div> <img src="'+currentUser.photoURL+'" class="chat-avatar"> </div> </li>';
                                }else{
                                    var messageString = '<li style="min-height: 55px;"> <div class="left-message"> <img src="'+clickUserData.photoURL+'" class="chat-avatar"> <div class="chat-message"> <img src="'+chatData.message+'" style="width: 80px; height: 80px; object-fit: cover;"> <br> <span>'+chatData.time+'</span> </div> </div> </li>';
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
                            
                            var imageString = '<div class="col-4 p-1"> <img src="'+imageData.message+'" alt="image gallary" onclick="downloadImage(&#39;'+imageData.message+'&#39;)"> </div>';
                            
                            imageGallary.insertAdjacentHTML('beforeend', imageString);
                        }
                    });

                }
            }

            if ((screen.width<992)) {
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

        
    </script>
</body>
</html>