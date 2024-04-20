import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-auth.js";
import { getFirestore, onSnapshot, query, collection, where, orderBy, limit, doc, addDoc, setDoc, getDoc, getDocs, documentId } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js";
import { getStorage, ref, uploadBytesResumable, getDownloadURL } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-storage.js";
import { firebaseConfig } from './config.js';


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