<!-- =================================== chat module =============================== -->
<style>
  #chatPopup{
    /* height: 85vh; */
    position: fixed;
    bottom: 5px;
    right: 0;
    left: 80vh;
    /* background: #ddddddaa; */
    z-index: 11111;
    overflow-y: auto;
    display: none;
  }
  #chatPopup .container{
    height: 85vh !important;
  }
  #chatPopup .custom-scrollbar{
    height: 60vh !important;
  }
  .chat-scroller{
    height: 61vh !important;
  }
  .about-left{
    border-radius: 10px;
    border-top-left-radius: 0px;
    border: 1px solid #dddddd;
    /* background: aliceblue; */
    max-width: 75%;
  }
  .about-right{
    border-radius: 10px;
    border-bottom-right-radius: 0px;
    border: 1px solid #dddddd;
    /* background: antiquewhite; */
    max-width: 75%;
    float: right !important;
  }
  .about-left span, .about-right span{
    float: right;
  }
  #chat-message{
    width: 100%;
    padding: 5px;
    border: 2px solid orange;
    border-radius: 5px;
    outline: none;
    padding-right: 3rem;
    padding-left: 3rem;
    overflow: hidden;
  }
  #chat-submit-btn{
    position: absolute;
    bottom: 1px;
    right: 1px;
    z-index: 124;
    background: orange;
    padding: 4px 14px;
    border: 2px solid orange;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
  }
  #chat-file-btn{
    position: absolute;
    bottom: 1px;
    left: 0px;
    z-index: 125;
    background: orange;
    padding: 4px 14px;
    border: 2px solid orange;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    margin-bottom: 0 !important;
  }
  #back-to-chat{
    float: left;
    padding: 3px 30px 0px 10px;
    font-size: 30px;
    cursor: pointer;
    display: none;
  }
  .user-image{
    object-fit: cover !important;
  }
  .Online{
    background: #80cf00;
  }
  .Offline{
    background: #fd517d;
  }
  @media screen and (max-width: 768px){
    #chatPopup{
      left: 0vh;
      /* height: 95vh; */
    }
    #chatPopup .container{
      height: 95vh !important;
    }
    #chatPopup .custom-scrollbar{
      height: 83vh !important;
    }
    .chat-scroller{
      height: 75vh !important;
      max-height: 75vh !important;
    }
    #chat-right-block{
      display: none;
    }
    #back-to-chat{
      display: block;
    }
  }
</style>
<div style="padding: 16px; transition: margin-left .5s;">
  <?php
  $chat_fsm_img = $this->session->userdata('user_data')->tsp_profile_image;
  $default_img_url = "https://prosolstechapps.co.in/universal/uploads/admin/default.png";

  if($chat_fsm_img != $default_img_url) {
    $fsm_path = base_url($chat_fsm_img);
  } else {
    $fsm_path = base_url('assets/Web-Fsm/images/user/2.png');
  }
  ?>
  <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#chatPopup').toggle('slow'); get_user_in_chat('GROUP', '<?= $this->session->userdata('user_data')->id;?>', '<?= $this->session->userdata('user_data')->tsp_business_name;?> Group', 'All Team Chat', '<?= $fsm_path;?>');" style="position: fixed; top: 94%; right: 23px; border-radius: 100px; transform: translateY(-50%); z-index: 9999; padding: 0.6rem 1rem;" id="float-chat-icon"><i class="fa fa-weixin"></i><br>Chat</a>
</div>

<div id="chatPopup">
  <div class="container" style="position: relative;">
    <button id="chat-cancel-btn" style="position: absolute; z-index: 99; top: 3px; right: 27px; border: none; background: transparent; color: coral;" onclick="$('#chatPopup').toggle('slow');"><i class="icofont icofont-ui-close"></i></button>
    <div class="row h-100">
      <div class="col-md-4 px-1" id="chat-left-block">
        <div class="card mb-0 py-4 px-2 h-100" style="border-radius: 2rem; background: #ffffff; border: 1px solid gray;">
          <div class="chat-box">
            <div class="people-list" id="people-list">
              <div class="search">
                <form class="theme-form">
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="search"><i class="fa fa-search"></i>
                  </div>
                </form>
              </div>
              <ul class="list mb-2">
                <li class="clearfix clearfix-li position-relative" style="cursor: pointer;" onclick="get_user_in_chat('GROUP', '<?= $this->session->userdata('user_data')->id;?>', '<?= $this->session->userdata('user_data')->tsp_business_name;?> Group', 'All Team Chat', '<?= $fsm_path;?>')">
                  <img class="rounded-circle user-image" src="<?= $fsm_path;?>" alt="">
                  <div class="status-circle online"></div>
                  <div class="about" style="width: calc(100% - 60px); overflow: hidden;">
                    <div class="name" style="white-space: nowrap;"><?= $this->session->userdata('user_data')->tsp_business_name;?> Group</div>
                    <div class="status" style="white-space: nowrap;"><?= $this->session->userdata('user_data')->tsp_fname;?></div>
                  </div>
                </li>
                <?php
                foreach($chat_team_list as $list){
                  if($list->profile_image == ""){
                    $profile_url = base_url('assets/Web-Fsm/images/user/2.png');
                  }else{
                    $profile_url = base_url($list->profile_image);
                  }
                ?>
                <!-- <li class="clearfix clearfix-li" style="cursor: pointer;" onclick="get_user_in_chat('<?= $list->user_id.$this->session->userdata('user_data')->id;?>', '<?= $list->user_id.$this->session->userdata('user_data')->id;?>', '<?= $list->full_name;?>', '<?= $list->email;?>', '<?= $profile_url;?>')">
                  <img class="rounded-circle user-image" src="<?= $profile_url;?>" alt="">
                  <div class="about" style="width: calc(100% - 60px); overflow: hidden;">
                    <div class="name" style="white-space: nowrap;"><?= $list->full_name;?></div>
                    <div class="status" style="white-space: nowrap;"><?= $list->email;?></div>
                  </div>
                </li> -->
                <?php
                }
                ?>
              </ul>
              
              <ul class="list custom-scrollbar" id="firebase_user_list"></ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 px-1" id="chat-right-block">
        <div class="card mb-0 py-4 px-2 h-100" style="border-radius: 2rem; background: #ffffff; border: 1px solid gray;">
          <div class="chat-box">
            <div class="people-list" id="people-list">
              <ul class="list">
                <li class="clearfix">
                  <span id="back-to-chat" onclick="$('#chat-right-block').hide(); $('#chat-left-block').show();">&#8678;</span>
                  <img class="rounded-circle user-image chat_user_image" src="https://admin.pixelstrap.com/poco/assets/images/user/12.png" alt="">
                  <div class="about">
                    <div class="name chat_user_name"><?= $this->session->userdata('user_data')->tsp_business_name;?> Group<!-- <span class="font-primary f-12">Typing...</span> --></div>
                    <div class="status digits chat_user_details">All Team Chat</div>
                  </div>
                </li>
              </ul>
              <hr>
              <div class="chat-history chat-msg-box custom-scrollbar chat-scroller px-2" id="chat_message_box1">
                <ul class="list custom-scrollbar chat-scroller" id="chat_message_box">
                  
                </ul>
                <hr>
                  <div style="height: 15px; position: relative;">
                    <button id="chat-file-btn" onclick="$('#file').click()"><i class="icofont icofont-image fw-bold"></i></button>
                    <!-- <input type="file" id="file" class="d-none" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt" onchange="module.sendFile()"> -->
                    <input type="file" id="file" class="d-none" accept=".jpg,.jpeg,.png,.gif" onchange="module.sendFile()">
                    <input type="hidden" name="chat-to-id" id="chat-to-id" value="<?=$this->session->userdata('user_data')->id?>" required>
                    <input type="hidden" name="chat-uid" id="chat-uid" value="">
                    <input type="hidden" name="chat-to-usertype" id="chat-to-usertype" value="GROUP" required>
                    <textarea name="" id="chat-message" placeholder="Type a message..." rows="1" style="position: absolute; left: 0; right: 0; bottom: 0; z-index: 124;"></textarea>
                    <button id="chat-submit-btn" onclick="module.sendMsg()">&#10148;</button>
                  </div>
                <!-- </form> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  module = {};
  $(document).ready(function(){
    // $(document).on("keydown", function(e) {
    //   // Check if the user pressed the keys typically used for inspecting elements
    //   if ((e.ctrlKey && e.shiftKey && e.keyCode == 73) || // Ctrl+Shift+I
    //       (e.ctrlKey && e.shiftKey && e.keyCode == 67) || // Ctrl+Shift+C
    //       (e.ctrlKey && e.shiftKey && e.keyCode == 74) || // Ctrl+Shift+J
    //       (e.ctrlKey && e.keyCode == 85) ||               // Ctrl+U
    //       (e.ctrlKey && e.keyCode == 83) ||               // Ctrl+S
    //       (e.keyCode == 123)) {                           // F12
    //       e.preventDefault();
    //   }
    // });
  });
  
  // get team user in chat
  function get_user_in_chat(id, user_id, full_name, email, profile_url, uid=''){        
    if(id == 'GROUP'){
      $('#chat-to-usertype').val('GROUP');
      module.getAllMessage('GROUP', user_id);
    }else{
      $('#chat-to-usertype').val('TEAM');
      module.getAllMessage('TEAM', id, uid);
    }
    $('#chat-to-id').val(user_id);
    $('#chat-uid').val(uid);
    $('.chat_user_name').html(full_name);
    $('.chat_user_details').html(email);
    $('.chat_user_image').attr('src', profile_url);
    $('#chat_message_box').html('<li>Conversation is loading...</li>');
    var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    if (screenWidth <= '767') {
      $('#chat-right-block').show(); $('#chat-left-block').hide();
    } else {
      $('#chat-right-block').show(); $('#chat-left-block').show();
    }
    $('#chat-message').focus();
  }

  $('#chat-message').keypress(function(e){
    var chat_message = $("#chat-message").val();
    if(chat_message != ''){
      if(e.which == 13){
        e.preventDefault();
        module.sendMsg();
      }
    }        
  });

  $('#chat-message').on('input', function() {
    this.style.height = 'auto';
    if(this.scrollHeight < 95){
        this.style.height = (this.scrollHeight) + 'px';
        $("#chat-submit-btn").css('height', this.scrollHeight+'px');
        $("#chat-file-btn").css('height', this.scrollHeight+'px');
    }else{
        this.style.height = '95px';
        $("#chat-submit-btn").css('height', '95px');
        $("#chat-file-btn").css('height', '95px');
    }
  });
</script>
<script type="module">
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
  import { getFirestore, addDoc, setDoc, updateDoc, collection, getDocs, query, where, orderBy, limit, doc, getDoc, onSnapshot } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js";
  import { getStorage, ref, uploadBytesResumable, getDownloadURL } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-storage.js";

  const firebaseConfig = {
    apiKey: "AIzaSyC8yvgvoGZ9pscUtxlqV_Kh6N8uU49UvBY",
    authDomain: "mistri-chacha.firebaseapp.com",
    databaseURL: "https://mistri-chacha.firebaseio.com",
    projectId: "mistri-chacha",
    storageBucket: "mistri-chacha.appspot.com",
    messagingSenderId: "530502524015",
    appId: "1:530502524015:web:53e0ecb48595bfb544c19a",
    measurementId: "G-8VLLQ3FDSM"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const db = getFirestore(app);
  const storage = getStorage(app);
  const chatList = document.getElementById('chat_message_box');
  const userList = document.getElementById('firebase_user_list');

  // save message data in firestore ================================
  module.sendMsg = async function sendMsg(){
    var q = query(collection(db, "users"), where("email", "==", "<?= $this->session->userdata('user_data')->tsp_email;?>"));
    var querySnapshot = await getDocs(q);
    var fsm_uid;
    if(querySnapshot){
      querySnapshot.forEach(async (doc1) => {
        // console.log(doc1.id);
        fsm_uid = doc1.id;
      });
    }
      // console.log(fsm_uid);
    var message = $('#chat-message').val();
    var to_id = $('#chat-to-id').val();
    var uid = $('#chat-uid').val();
    var to_usertype = $('#chat-to-usertype').val();
    var timestamp = new Date().getTime();
    if(message == ""){
      return false;
    }else{
    // get time of msg send ============================
    const now = new Date();
      let hours = now.getHours();
      const minutes = now.getMinutes();
      const ampm = hours >= 12 ? 'pm' : 'am';
      hours = hours % 12;
      hours = hours ? hours : 12;
      const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
      const send_time = hours + ':' + formattedMinutes + ampm;
      // ==================================================
      if(to_usertype === "GROUP"){
        const docRef = await addDoc(collection(db, "groups", "<?= $this->session->userdata('user_data')->id;?>GROUP", "chats"), {
          from_id:'<?= $this->session->userdata('user_data')->id;?>',
          from_usertype:'FSM',
          username:'<?= $this->session->userdata('user_data')->tsp_fname?>',
          message:message,
          message_type:'text',
          to_id:to_id,
          to_usertype:to_usertype,
          time:now,
          uid:fsm_uid
        });
      }else{
        const docRef = await addDoc(collection(db, "chatroom", to_id+'<?= $this->session->userdata('user_data')->id;?>', "chats"), {
          from_id:'<?= $this->session->userdata('user_data')->id;?>',
          from_usertype:'FSM',
          username:'<?= $this->session->userdata('user_data')->tsp_fname?>',
          message:message,
          message_type:'text',
          to_id:to_id,
          to_usertype:to_usertype,
          time:now,
          uid:fsm_uid,
          seen:'unseen'
        });
        
        // const docRef1 = await setDoc(collection(db, "chatroom", to_id+'<?= $this->session->userdata('user_data')->id;?>'), {
        //   message:message,
        //   time:now,
        //   seen:'unseen'
        // }, { merge: true });
        
        const docRef2 = doc(collection(db, "Team Members"), uid);
        const data = {
            message: message,
            time: now,
            seen: 'unseen'
        };
        await setDoc(docRef2, data, { merge: true });
      }
    }
    
    
    // console.log("Document written with ID: ", docRef.id);
    document.getElementById('chat-message').value = '';
    // chatList.innerHTML += '<li class="clearfix"> <div> <div class="about px-2 about-right"> <div class="status digits">You &nbsp; &nbsp; <span class="font-primary f-12">'+send_time+'</span></div> <div class="name">'+message+'</div> </div> </div> </li>';
    
    // var chatContainer = document.getElementById("chat_message_box1");
    // chatContainer.scrollTop = chatContainer.scrollHeight;
    // var chatContainer = document.getElementById("chat_message_box");
    // chatContainer.scrollTop = chatContainer.scrollHeight;
    
    $('#chat-message').css('height', '31px');
    $("#chat-submit-btn").css('height', '31px');
    $("#chat-file-btn").css('height', '31px');
  }
  // save message data in firestore ================================
  
  // upload image in firebase storage & save message data in firestore ================================
  module.sendFile = async function sendFile() {
    var q = query(collection(db, "users"), where("email", "==", "<?= $this->session->userdata('user_data')->tsp_email;?>"));
    var querySnapshot = await getDocs(q);
    var fsm_uid;
    if(querySnapshot){
        for (const doc1 of querySnapshot.docs) {
            fsm_uid = doc1.id;
            break;
        }
    }

    var file = document.getElementById('file').files[0];
    var fileName = (new Date()).getTime() + '_' + file.name;
    var fileType = file.type.split('/')[0]; // Get file type
    var folder;
    var message_type;
    if (fileType === 'image') {
        folder = 'images';
        message_type = 'img';
    } else if (fileType === 'application' && file.type === 'application/pdf') {
        folder = 'pdfs';
        message_type = 'pdf';
    } else {
        folder = 'files';
        message_type = 'file';
    }
    const storageRef = ref(storage, folder+'/'+fileName);

    const uploadTask = uploadBytesResumable(storageRef, file);
    uploadTask.on('state_changed',
        (snapshot) => {
            const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
            console.log('Upload is ' + progress + '% done');
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
        },
        async () => {
            const downloadURL = await getDownloadURL(uploadTask.snapshot.ref);
            var message = downloadURL;
            var to_id = $('#chat-to-id').val();
            var to_usertype = $('#chat-to-usertype').val();
            var timestamp = new Date().getTime();
            const now = new Date();
            if(to_usertype === "GROUP"){
                const docRef = await addDoc(collection(db, "groups", "<?= $this->session->userdata('user_data')->id;?>GROUP", "chats"), {
                    from_id:'<?= $this->session->userdata('user_data')->id;?>',
                    from_usertype:'FSM',
                    username:'<?= $this->session->userdata('user_data')->tsp_fname;?>',
                    message:message,
                    message_type:message_type,
                    to_id:to_id,
                    to_usertype:to_usertype,
                    time:now,
                    uid:fsm_uid
                });
            } else {
                const docRef = await addDoc(collection(db, "chatroom", to_id, "chats"), {
                    from_id:'<?= $this->session->userdata('user_data')->id;?>',
                    from_usertype:'FSM',
                    username:'<?= $this->session->userdata('user_data')->tsp_fname;?>',
                    message:message,
                    message_type:message_type,
                    to_id:to_id,
                    to_usertype:to_usertype,
                    time:now,
                    uid:fsm_uid
                });
            }
            document.getElementById('chat-message').value = '';
            $('#chat-message').css('height', '31px');
            $("#chat-submit-btn").css('height', '31px');
            $("#chat-file-btn").css('height', '31px');
        }
    );
  }
  // upload image in firebase storage & save message data in firestore ================================
  
  // get data from firestore =======================================
  let unsubscribeFunction = null;
  module.getAllMessage = async function getAllMessage(key1, key2, team_uid=''){
    console.log(key1);
    console.log(key2);

    if(key1 == "GROUP"){
      var q = query(collection(db, "groups", key2+key1, "chats"), where("to_usertype", "==", key1), orderBy("time", "asc"));
    }else{
      var q = query(collection(db, "chatroom", key2, "chats"), orderBy("time", "asc"));
    }
    var querySnapshot = await getDocs(q);
    chatList.innerHTML = '';
    // get real time message
    if (unsubscribeFunction) {
        unsubscribeFunction();
    }

    // Set up a listener for real-time updates
    unsubscribeFunction = onSnapshot(q, (snapshot) => {
      snapshot.docChanges().forEach((change) => {
        if (change.type === "added") {
          // const newData = change.doc.data();
          // console.log("New Message Added:", newData);

          var key = change.doc.id;
          var from_id = change.doc.data().from_id;
          var username = change.doc.data().username;
          var from_usertype = change.doc.data().from_usertype;
          var message = change.doc.data().message;
          var message_type = change.doc.data().message_type;
          var to_id = change.doc.data().to_id;
          var to_usertype = change.doc.data().to_usertype;
          var uid = change.doc.data().uid;
          // var time = doc.data().time;
          var firebaseTimestamp = change.doc.data().time;
          var dateObject = firebaseTimestamp.toDate();
          var hours = dateObject.getHours();
          var minutes = dateObject.getMinutes();
          if(hours >= 12){
            var pam = "PM";
          }else{
            var pam = "AM";
          }
          var time = `${hours}:${minutes} ${pam}`;

          var htmlString;
          if(message_type != "text" && message_type != "img"){
            var parts = message.split("?");
            var baseUrl = parts[0];
            var urlParts = baseUrl.split("/");
            var lastPart = urlParts[urlParts.length - 1];
            var decodedPart = decodeURIComponent(lastPart);
            var file_name = decodedPart.substring(decodedPart.lastIndexOf("/") + 1);
          }
          if(message_type == "text"){
            if(from_id == '<?= $this->session->userdata('user_data')->id?>' && from_usertype == 'FSM'){
              htmlString = '<li class="clearfix" id="'+key+'"> <div> <div class="about px-2 about-right"> <div class="status digits">You &nbsp; &nbsp; <span class="font-primary f-12">'+time+'</span></div> <div class="name">'+message+'</div> </div> </div> </li>';
            }else{
              htmlString = '<li class="clearfix" id="'+key+'"> <img class="rounded-circle user-image" src="https://admin.pixelstrap.com/poco/assets/images/user/12.png" alt="" style="width: 20px; height: 20px; object-fit: cover;"> <div class="about px-2 about-left"> <div class="status digits">'+username+'&nbsp;&nbsp;<span class="font-primary f-12">'+time+'</span></div> <div class="name">'+message+'</div> </div> </li>';
            }
          }else if(message_type == 'img'){
            if(from_id == '<?= $this->session->userdata('user_data')->id?>' && from_usertype == 'FSM'){
              htmlString = '<li class="clearfix" id="'+key+'"> <div> <div class="about px-2 about-right"> <div class="status digits">You &nbsp; &nbsp; <span class="font-primary f-12">'+time+'</span></div> <div class="name"><img src="'+message+'" width="100" onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)"></div> </div> </div> </li>';
            }else{
              htmlString = '<li class="clearfix" id="'+key+'"> <img class="rounded-circle user-image" src="https://admin.pixelstrap.com/poco/assets/images/user/12.png" alt="" style="width: 20px; height: 20px; object-fit: cover;"> <div class="about px-2 about-left"> <div class="status digits">'+username+'&nbsp;&nbsp;<span class="font-primary f-12">'+time+'</span></div> <div class="name"><img src="'+message+'" width="100" onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)"></div> </div> </li>';
            }
          }else if(message_type == 'pdf'){
            if(from_id == '<?= $this->session->userdata('user_data')->id?>' && from_usertype == 'FSM'){
              htmlString = '<li class="clearfix" id="'+key+'"> <div> <div class="about px-2 about-right"> <div class="status digits">You &nbsp; &nbsp; <span class="font-primary f-12">'+time+'</span></div> <div class="name"><object data="'+message+'" type="application/pdf" width="100%"></object><br><span onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)" style="cursor: pointer;">'+file_name+'</span></div> </div> </div> </li>';
            }else{
              htmlString = '<li class="clearfix" id="'+key+'"> <img class="rounded-circle user-image" src="https://admin.pixelstrap.com/poco/assets/images/user/12.png" alt="" style="width: 20px; height: 20px; object-fit: cover;"> <div class="about px-2 about-left"> <div class="status digits">'+username+'&nbsp;&nbsp;<span class="font-primary f-12">'+time+'</span></div> <div class="name"><object data="'+message+'" type="application/pdf" width="100%"></object><br><span onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)" style="cursor: pointer;">'+file_name+'</span></div> </div> </li>';
            }
          }else{
            if(from_id == '<?= $this->session->userdata('user_data')->id?>' && from_usertype == 'FSM'){
              htmlString = '<li class="clearfix" id="'+key+'"> <div> <div class="about px-2 about-right"> <div class="status digits">You &nbsp; &nbsp; <span class="font-primary f-12">'+time+'</span></div> <div class="name"><img src="https://upload.wikimedia.org/wikipedia/commons/d/d6/Files_App_icon_iOS.png" style="width: 100px;"><br><span onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)" style="cursor: pointer;">'+file_name+'</span></div> </div> </div> </li>';
            }else{
              htmlString = '<li class="clearfix" id="'+key+'"> <img class="rounded-circle user-image" src="https://admin.pixelstrap.com/poco/assets/images/user/12.png" alt="" style="width: 20px; height: 20px; object-fit: cover;"> <div class="about px-2 about-left"> <div class="status digits">'+username+'&nbsp;&nbsp;<span class="font-primary f-12">'+time+'</span></div> <div class="name"><img src="https://upload.wikimedia.org/wikipedia/commons/d/d6/Files_App_icon_iOS.png" style="width: 100px;"><br><span onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)" style="cursor: pointer;">'+file_name+'</span></div> </div> </li>';
            }
          }
          chatList.insertAdjacentHTML('beforeend', htmlString);
          
          var chatContainer = document.getElementById("chat_message_box1");
          chatContainer.scrollTop = chatContainer.scrollHeight;
          var chatContainer = document.getElementById("chat_message_box");
          chatContainer.scrollTop = chatContainer.scrollHeight;
        }
      });
    });

    // mark document as a seen
    if(key1 == "TEAM"){ 
      const chatroomRef = collection(db, "chatroom", key2, "chats");
      const querySnapshot3 = await getDocs(query(chatroomRef, where("seen", "==", "unseen"), where("from_usertype", "==", "FSM")));
      querySnapshot3.forEach(async (doc) => {
          const docRef = doc.ref;
          await updateDoc(docRef, { seen: "seen" });
      });

      var docRef3 = doc(collection(db, "Team Members"), team_uid);
      var data = {
          seen: 'seen'
      };
      await setDoc(docRef3, data, { merge: true });
    }
  }
  // get data from firestore =======================================

  // get team member list ==========================================
// // Define a reference to the top-level "chatroom" collection
// const documentIds = ["T-102", "T-104", "T-15"];

// // Iterate over each document ID
// documentIds.forEach((documentId) => {
//     // Define a reference to the "chat" subcollection of the current document
//     const chatSubcollectionRef = collection(db, "chatroom").doc(documentId).collection("chat");

//     // Listen for changes in the "chat" subcollection of the current document
//     onSnapshot(chatSubcollectionRef, (chatSnapshot) => {
//         chatSnapshot.forEach((chatDoc) => {
//             const chatData = chatDoc.data();
//             console.log("Chat data:", chatData);
//         });
//     });
// });



  var userlistString;
  let userlistFunction = null;
  const adminId = '<?= $this->session->userdata('user_data')->id;?>';
  const q1 = query(collection(db, "Team Members"), where("adminId", "==", adminId));
  // const querySnapshot1 = await getDocs(q1);

  
  if (userlistFunction) {
    userlistFunction();
  }

  userlistFunction = onSnapshot(q1, async (snapshot1) => { // Note the async keyword here
    const promises = [];
    for (const doc1 of snapshot1.docs) {
          const memberData = doc1.data();
          var key = doc1.id;
          var email = memberData.email;
          var name = memberData.name;
          var team_id = memberData.team_id;
          var uid = memberData.uid;
          var status = memberData.status;
          var lastmsg = memberData.message;
          var fcm_token = memberData.fcm_token;
          // console.log(memberData);
          
          // Query teamchat collection to get last message time
          const q2 = query(collection(db, "chatroom", team_id + adminId, 'chats'), orderBy("time", "desc"), limit(1));
          const querySnapshot2 = await getDocs(q2);

          // Use for...of loop instead of forEach
          for (const chatDoc of querySnapshot2.docs) {
              const lastMsgData = chatDoc.data();
              const lastMsgTime = lastMsgData.time.toDate();
              const seen = lastMsgData.seen;
              const to_usertype = lastMsgData.to_usertype;
              // console.log(team_id + ' : ' + lastMsgTime);

              // Push a promise into the promises array
              promises.push({
                  key: key,
                  email: email,
                  name: name,
                  team_id: team_id,
                  uid: uid,
                  seen: seen,
                  to_usertype: to_usertype,
                  status: status,
                  lastmsg: lastmsg,
                  fcm_token: fcm_token,
                  lastMsgTime: lastMsgTime
              });
          }
      }
      
    await Promise.all(promises);
    console.log('Promises : ', promises);

    promises.sort((a, b) => b.lastMsgTime - a.lastMsgTime);
    console.log('sort : ', promises);
    userList.innerHTML = '';
    var seen_count = 0;
    promises.forEach((result) => {

        console.log(`Member ID: ${result.key}, Last Message Time: ${result.lastMsgTime}`);
        userlistString = '<li class="clearfix clearfix-li position-relative" style="cursor: pointer;" onclick="get_user_in_chat(&#39;' + result.team_id + adminId + '&#39;, &#39;' + result.team_id + '&#39;, &#39;' + result.name + '&#39;, &#39;' + result.email + '&#39;, &#39;<?= base_url('assets/Web-Fsm/images/user/2.png');?>&#39;, &#39;' + result.uid + '&#39;)"> <img class="rounded-circle user-image" src="<?= base_url('assets/Web-Fsm/images/user/2.png');?>" alt=""> <div class="status-circle ' + result.status + '"></div> <div class="about" style="width: calc(100% - 60px); overflow: hidden;"> <div class="name" style="white-space: nowrap;">' + result.name + '</div> <div class="status" style="white-space: nowrap;">' + result.lastmsg + '</div> </div> </li>';

        userList.insertAdjacentHTML('beforeend', userlistString);

        if(result.seen == 'unseen' && result.to_usertype == 'FSM'){
          seen_count++;
        }
    });
    if(seen_count == 0){
      $("#float-chat-icon").html('<i class="fa fa-weixin"></i><br>Chat');
    }else{
      $("#float-chat-icon").html(seen_count+'<br>MSG');
    }
  });

  

  // var userlistString;
  // const adminId = '<?= $this->session->userdata('user_data')->id;?>';
  // try {
  //     const q1 = query(collection(db, "Team Members"), where("adminId", "==", adminId));
  //     const querySnapshot1 = await getDocs(q1);

  //     const promises = [];

  //     // Use for...of loop instead of forEach
  //     for (const doc1 of querySnapshot1.docs) {
  //         const memberData = doc1.data();
  //         var key = doc1.id;
  //         var email = memberData.email;
  //         var name = memberData.name;
  //         var team_id = memberData.team_id;
  //         var uid = memberData.uid;
  //         var fcm_token = memberData.fcm_token;
  //         // console.log(memberData);
          
  //         // Query teamchat collection to get last message time
  //         const q2 = query(collection(db, "chatroom", team_id + adminId, 'chats'), orderBy("time", "desc"), limit(1));
  //         const querySnapshot2 = await getDocs(q2);

  //         // Use for...of loop instead of forEach
  //         for (const chatDoc of querySnapshot2.docs) {
  //             const lastMsgData = chatDoc.data();
  //             const lastMsgTime = lastMsgData.time.toDate();
  //             // console.log(team_id + ' : ' + lastMsgTime);

  //             // Push a promise into the promises array
  //             promises.push({
  //                 key: key,
  //                 email: email,
  //                 name: name,
  //                 team_id: team_id,
  //                 uid: uid,
  //                 fcm_token: fcm_token,
  //                 lastMsgTime: lastMsgTime
  //             });
  //         }
  //     }

  //     console.log('Promises : ', promises);

  //     promises.sort((a, b) => b.lastMsgTime - a.lastMsgTime);
      
  //     promises.forEach((result) => {
  //         // console.log(`Member ID: ${result.key}, Last Message Time: ${result.lastMsgTime}`);
  //         userlistString = '<li class="clearfix clearfix-li" style="cursor: pointer;" onclick="get_user_in_chat(&#39;' + result.team_id + adminId + '&#39;, &#39;' + result.team_id + adminId + '&#39;, &#39;' + result.name + '&#39;, &#39;' + result.email + '&#39;, &#39;<?= base_url('assets/Web-Fsm/images/user/2.png');?>&#39;)"> <img class="rounded-circle user-image" src="<?= base_url('assets/Web-Fsm/images/user/2.png');?>" alt=""> <div class="about" style="width: calc(100% - 60px); overflow: hidden;"> <div class="name" style="white-space: nowrap;">' + result.name + '</div> <div class="status" style="white-space: nowrap;">' + result.email + '</div> </div> </li>';

  //         userList.insertAdjacentHTML('beforeend', userlistString);
  //     });
  // } catch (error) {
  //     console.error("Error fetching documents: ", error);
  // }

  // get team member list ==========================================
</script>
<!-- =================================== chat module =============================== -->
