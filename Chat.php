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
                    <ul class="ps-0">
                        <li class="user-item">
                            <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">User 1</div>
                                <div class="last-msg">Last message from User 1...</div>
                            </div>
                        </li>
                        <li class="user-item">
                            <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">User 1</div>
                                <div class="last-msg">Last message from User 1...</div>
                            </div>
                        </li>
                        <li class="user-item">
                            <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">User 1</div>
                                <div class="last-msg">Last message from User 1...</div>
                            </div>
                        </li>
                        <li class="user-item">
                            <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">User 1</div>
                                <div class="last-msg">Last message from User 1...</div>
                            </div>
                        </li>
                        <li class="user-item">
                            <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">User 1</div>
                                <div class="last-msg">Last message from User 1...</div>
                            </div>
                        </li>
                        <li class="user-item">
                            <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">User 1</div>
                                <div class="last-msg">Last message from User 1...</div>
                            </div>
                        </li>
                        <li class="user-item">
                            <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">User 1</div>
                                <div class="last-msg">Last message from User 1...</div>
                            </div>
                        </li>
                        <li class="user-item">
                            <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">User 1</div>
                                <div class="last-msg">Last message from User 1...</div>
                            </div>
                        </li>
                        <li class="user-item">
                            <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">User 1</div>
                                <div class="last-msg">Last message from User 1...</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-5 bg-light p-0 position-relative" style="height: 100vh;" id="section-chat">
                <div class="mb-1 py-2 px-2" style="display: flex; align-items: center; background-color: #FFFFFF;">
                    <div class="ps-2 pe-3 d-block d-sm-none" onclick="$('.section-list').fadeIn();
                    $('#section-chat').hide();"><i class="fa-solid fa-left-long"></i></div>
                    <img src="assets/KitCat-Logo.jpg" alt="User 1" class="user-avatar" id="user-avatar-chat">
                    <div class="user-details" style="border: none;">
                        <div class="user-name">User 1</div>
                        <div class="last-msg">Last message from User 1...</div>
                    </div>
                    <div class="pe-1">
                        <button class="btn rounded-circle" style="color: #5F369F;"><i class="fa-solid fa-paperclip"></i></button>
                    </div>
                </div>
                <div id="chat-content" class="px-1">
                    <ul class="ps-0">
                        <li>
                            <div class="left-message">
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                                <div class="chat-message">
                                    Hi Kit Cat. <span>1:25 am</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="left-message">
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                                <div class="chat-message">
                                    Hi Kit Cat, this is html base chat module. <span>1:25 am</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="left-message">
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                                <div class="chat-message">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam quam odio, ab distinctio est ipsa fugit dicta praesentium incidunt amet veniam possimus? Ipsum beatae cupiditate modi sapiente quas ullam expedita. <span>1:25 am</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="right-message">
                                <div class="chat-message">
                                    Hi Kit Cat, this is html base chat module. <span>1:25 am</span>
                                </div>
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                            </div>
                        </li>
                        <li>
                            <div class="right-message">
                                <div class="chat-message">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam praesentium facilis ex ut quia, rem sapiente accusantium quidem aliquid aliquam dolorum. Ab repellat minima maiores vitae ratione enim, quaerat hic. <span>1:25 am</span>
                                </div>
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                            </div>
                        </li>
                        <li>
                            <div class="left-message">
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                                <div class="chat-message">
                                    Hi Kit Cat. <span>1:25 am</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="left-message">
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                                <div class="chat-message">
                                    Hi Kit Cat, this is html base chat module. <span>1:25 am</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="left-message">
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                                <div class="chat-message">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam quam odio, ab distinctio est ipsa fugit dicta praesentium incidunt amet veniam possimus? Ipsum beatae cupiditate modi sapiente quas ullam expedita. <span>1:25 am</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="right-message">
                                <div class="chat-message">
                                    Hi Kit Cat, this is html base chat module. <span>1:25 am</span>
                                </div>
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                            </div>
                        </li>
                        <li>
                            <div class="right-message">
                                <div class="chat-message">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam praesentium facilis ex ut quia, rem sapiente accusantium quidem aliquid aliquam dolorum. Ab repellat minima maiores vitae ratione enim, quaerat hic. <span>1:25 am</span>
                                </div>
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                            </div>
                        </li>
                        <li>
                            <div class="left-message">
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                                <div class="chat-message">
                                    Hi Kit Cat. <span>1:25 am</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="left-message">
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                                <div class="chat-message">
                                    Hi Kit Cat, this is html base chat module. <span>1:25 am</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="left-message">
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                                <div class="chat-message">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam quam odio, ab distinctio est ipsa fugit dicta praesentium incidunt amet veniam possimus? Ipsum beatae cupiditate modi sapiente quas ullam expedita. <span>1:25 am</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="right-message">
                                <div class="chat-message">
                                    Hi Kit Cat, this is html base chat module. <span>1:25 am</span>
                                </div>
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                            </div>
                        </li>
                        <li>
                            <div class="right-message">
                                <div class="chat-message">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam praesentium facilis ex ut quia, rem sapiente accusantium quidem aliquid aliquam dolorum. Ab repellat minima maiores vitae ratione enim, quaerat hic. <span>1:25 am</span>
                                </div>
                                <img src="assets/KitCat-Logo.jpg" class="chat-avatar">
                            </div>
                        </li>
                    </ul>
                </div>
                <emoji-picker class="light"></emoji-picker>
                <div class="position-absolute p-2" style="bottom: 0rem; left: 0rem; right: 0rem; background-color: #FFFFFF;">
                    <div style="display: flex; align-items: center;">
                        <div class="pe-1">
                            <button class="btn btn-primary px-4 rounded-pill" onclick="$('emoji-picker').slideToggle('slow')"><i class="fa-solid fa-face-smile"></i></button>
                        </div>
                        <div style="flex: 1;">
                            <textarea type="text" id="chat-text-message" class="form-control rounded-pill" rows="1" placeholder="Type a cat message .. . .."></textarea>
                        </div>
                        <div class="ps-1">
                            <button class="btn btn-primary px-4 rounded-pill"><i class="fa-solid fa-paper-plane"></i></button>
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
                <h1 class="text-center my-3" id="displayName">User Full Name</h1>
                <h6 class="text-center" id="displayNumber">1524512451</h6>
                <h6 class="text-center" id="displayEmail">example@gmail.com</h6>
                <hr class="w-75 m-auto my-2">
                <div class="px-2" id="image-gallary">
                    <div class="row m-0">
                        <div class="col-4 p-1">
                            <img src="assets/KitCat-Logo.jpg" alt="Profile">
                        </div>
                        <div class="col-4 p-1">
                            <img src="assets/KitCat-Logo.jpg" alt="Profile">
                        </div>
                        <div class="col-4 p-1">
                            <img src="assets/KitCat-Logo.jpg" alt="Profile">
                        </div>
                        <div class="col-4 p-1">
                            <img src="assets/KitCat-Logo.jpg" alt="Profile">
                        </div>
                        <div class="col-4 p-1">
                            <img src="assets/KitCat-Logo.jpg" alt="Profile">
                        </div>
                        <div class="col-4 p-1">
                            <img src="assets/KitCat-Logo.jpg" alt="Profile">
                        </div>
                        <div class="col-4 p-1">
                            <img src="assets/KitCat-Logo.jpg" alt="Profile">
                        </div>
                        <div class="col-4 p-1">
                            <img src="assets/KitCat-Logo.jpg" alt="Profile">
                        </div>
                        <div class="col-4 p-1">
                            <img src="assets/KitCat-Logo.jpg" alt="Profile">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- custom js -->
    <script src="assets/custom.js"></script>
    <!-- emoji picker module js -->
    <script type="module" src="assets/emoji-picker.js"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
        import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-auth.js";
        import { getFirestore, onSnapshot, query, collection, where, limit, doc, setDoc} from "https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js";
        import { firebaseConfig } from './assets/config.js';


        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const db = getFirestore(app);

        // check user login or not
        onAuthStateChanged(auth, async (user) => {
            if (user) {
                // console.log("User is signed in:", user);
            } else {
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

        // get user list
        const query1 = query(collection(db, "chatbook"), where("users", "array-contains", currentUser.uid));
        onSnapshot(query1, async (snapshot1) => {
            for (const doc1 of snapshot1.docs) {
                var memberData = doc1.data();
                console.log(memberData);
                if (memberData.users.length === 1) {
                    console.log('self user');
                }else{
                    console.log('other user');
                }
            }
        });
    </script>
</body>
</html>