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
    function get_user_in_chat(id, user_id, full_name, email, profile_url){        
      if(id == 'GROUP'){
        $('#chat-to-usertype').val('GROUP');
        module.getAllMessage('GROUP', user_id);
      }else{
        $('#chat-to-usertype').val('TEAM');
        module.getAllMessage('TEAM', id);
      }
      $('#chat-to-id').val(user_id);
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
    import { getFirestore, addDoc, collection, getDocs, query, where, orderBy, limit, doc, getDoc, onSnapshot } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js";
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
  
    // const firebaseConfig = {
    //     apiKey: "AIzaSyA8MlxSEmdLDeEeMtG_qnjKTeYE-7DAqVs",
    //     authDomain: "lockenewebchat.firebaseapp.com",
    //     projectId: "lockenewebchat",
    //     storageBucket: "lockenewebchat.appspot.com",
    //     messagingSenderId: "199089201988",
    //     appId: "1:199089201988:web:5d3449b10a76efcae46d11",
    //     measurementId: "G-Z7CFRG13N8"
    // };
  
  
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
          const docRef = await addDoc(collection(db, "groups", "GROUP", "chats"), {
            from_id:'',
            from_usertype:'FSM',
            username:'',
            message:message,
            message_type:'text',
            to_id:to_id,
            to_usertype:to_usertype,
            time:now,
            uid:fsm_uid
          });
        }else{
          const docRef = await addDoc(collection(db, "chatroom", to_id, "chats"), {
            from_id:'',
            from_usertype:'FSM',
            username:'',
            message:message,
            message_type:'text',
            to_id:to_id,
            to_usertype:to_usertype,
            time:now,
            uid:fsm_uid
          });
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
                  const docRef = await addDoc(collection(db, "groups", "GROUP", "chats"), {
                      from_id:'',
                      from_usertype:'FSM',
                      username:'',
                      message:message,
                      message_type:message_type,
                      to_id:to_id,
                      to_usertype:to_usertype,
                      time:now,
                      uid:fsm_uid
                  });
              } else {
                  const docRef = await addDoc(collection(db, "chatroom", to_id, "chats"), {
                      from_id:'',
                      from_usertype:'FSM',
                      username:'',
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
    module.getAllMessage = async function getAllMessage(key1, key2){
      console.log(key1);
      console.log(key2);
  
      // var q = query(collection(db, "chatmessage"), 
      //               where("to_usertype", "==", key1),
      //               where("to_id", "==", key2),
      //               orderBy("time", "asc"));
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
              if(from_id == '' && from_usertype == 'FSM'){
                htmlString = '<li class="clearfix" id="'+key+'"> <div> <div class="about px-2 about-right"> <div class="status digits">You &nbsp; &nbsp; <span class="font-primary f-12">'+time+'</span></div> <div class="name">'+message+'</div> </div> </div> </li>';
              }else{
                htmlString = '<li class="clearfix" id="'+key+'"> <img class="rounded-circle user-image" src="https://admin.pixelstrap.com/poco/assets/images/user/12.png" alt="" style="width: 20px; height: 20px; object-fit: cover;"> <div class="about px-2 about-left"> <div class="status digits">'+username+'&nbsp;&nbsp;<span class="font-primary f-12">'+time+'</span></div> <div class="name">'+message+'</div> </div> </li>';
              }
            }else if(message_type == 'img'){
              if(from_id == '' && from_usertype == 'FSM'){
                htmlString = '<li class="clearfix" id="'+key+'"> <div> <div class="about px-2 about-right"> <div class="status digits">You &nbsp; &nbsp; <span class="font-primary f-12">'+time+'</span></div> <div class="name"><img src="'+message+'" width="100" onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)"></div> </div> </div> </li>';
              }else{
                htmlString = '<li class="clearfix" id="'+key+'"> <img class="rounded-circle user-image" src="https://admin.pixelstrap.com/poco/assets/images/user/12.png" alt="" style="width: 20px; height: 20px; object-fit: cover;"> <div class="about px-2 about-left"> <div class="status digits">'+username+'&nbsp;&nbsp;<span class="font-primary f-12">'+time+'</span></div> <div class="name"><img src="'+message+'" width="100" onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)"></div> </div> </li>';
              }
            }else if(message_type == 'pdf'){
              if(from_id == '' && from_usertype == 'FSM'){
                htmlString = '<li class="clearfix" id="'+key+'"> <div> <div class="about px-2 about-right"> <div class="status digits">You &nbsp; &nbsp; <span class="font-primary f-12">'+time+'</span></div> <div class="name"><object data="'+message+'" type="application/pdf" width="100%"></object><br><span onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)" style="cursor: pointer;">'+file_name+'</span></div> </div> </div> </li>';
              }else{
                htmlString = '<li class="clearfix" id="'+key+'"> <img class="rounded-circle user-image" src="https://admin.pixelstrap.com/poco/assets/images/user/12.png" alt="" style="width: 20px; height: 20px; object-fit: cover;"> <div class="about px-2 about-left"> <div class="status digits">'+username+'&nbsp;&nbsp;<span class="font-primary f-12">'+time+'</span></div> <div class="name"><object data="'+message+'" type="application/pdf" width="100%"></object><br><span onclick="alert(&quot;Download feature exclusively available on mobile app.&quot;)" style="cursor: pointer;">'+file_name+'</span></div> </div> </li>';
              }
            }else{
              if(from_id == '' && from_usertype == 'FSM'){
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
    }
    // get data from firestore =======================================
  
    // get team member list ==========================================
  //   const adminId = '';
  // try {
  //     const q1 = query(collection(db, "Team Members"), where("adminId", "==", adminId));
      
  //     // Subscribe to changes using onSnapshot
  //     const unsubscribe = onSnapshot(q1, (querySnapshot1) => {
  //         const promises = [];
          
  //         querySnapshot1.forEach((doc1) => {
  //             const memberData = doc1.data();
  //             const key = doc1.id;
  //             const email = memberData.email;
  //             const name = memberData.name;
  //             const team_id = memberData.team_id;
  //             const uid = memberData.uid;
  //             const fcm_token = memberData.fcm_token;
  
  //             const q2 = query(collection(db, "chatroom", team_id + adminId, 'chats'), orderBy("time", "desc"), limit(1));
              
  //             // Subscribe to changes in the chatroom collection
  //             const unsubscribe2 = onSnapshot(q2, (querySnapshot2) => {
  //                 querySnapshot2.forEach((chatDoc) => {
  //                     const lastMsgData = chatDoc.data();
  //                     const lastMsgTime = lastMsgData.time.toDate();
  
  //                     // Update UI or perform other actions here
  //                     const userlistString = '<li class="clearfix clearfix-li" style="cursor: pointer;" onclick="get_user_in_chat(&#39;' + team_id + adminId + '&#39;, &#39;' + team_id + adminId + '&#39;, &#39;' + name + '&#39;, &#39;' + email + '&#39;, &#39;<?= base_url('assets/Web-Fsm/images/user/2.png');?>&#39;)"> <img class="rounded-circle user-image" src="<?= base_url('assets/Web-Fsm/images/user/2.png');?>" alt=""> <div class="about" style="width: calc(100% - 60px); overflow: hidden;"> <div class="name" style="white-space: nowrap;">' + name + '</div> <div class="status" style="white-space: nowrap;">' + email + '</div> </div> </li>';
  
  //                     userList.insertAdjacentHTML('beforeend', userlistString);
  //                 });
  //             });
  
  //             // Push unsubscribe function into promises array
  //             promises.push(unsubscribe2);
  //         });
  
  //         // Clean up existing UI before updating with new data
  //         userList.innerHTML = '';
  
  //         // Execute any remaining tasks after all promises are resolved
  //         Promise.all(promises).then(() => {
  //             console.log('UI updated successfully');
  //         }).catch((error) => {
  //             console.error('Error updating UI: ', error);
  //         });
  //     });
  // } catch (error) {
  //     console.error("Error fetching documents: ", error);
  // }
  
  
  
    var userlistString;
    const adminId = '';
    try {
        const q1 = query(collection(db, "Team Members"), where("adminId", "==", adminId));
        const querySnapshot1 = await getDocs(q1);
  
        const promises = [];
  
        // Use for...of loop instead of forEach
        for (const doc1 of querySnapshot1.docs) {
            const memberData = doc1.data();
            var key = doc1.id;
            var email = memberData.email;
            var name = memberData.name;
            var team_id = memberData.team_id;
            var uid = memberData.uid;
            var fcm_token = memberData.fcm_token;
            // console.log(memberData);
            
            // Query teamchat collection to get last message time
            const q2 = query(collection(db, "chatroom", team_id + adminId, 'chats'), orderBy("time", "desc"), limit(1));
            const querySnapshot2 = await getDocs(q2);
  
            // Use for...of loop instead of forEach
            for (const chatDoc of querySnapshot2.docs) {
                const lastMsgData = chatDoc.data();
                const lastMsgTime = lastMsgData.time.toDate();
                // console.log(team_id + ' : ' + lastMsgTime);
  
                // Push a promise into the promises array
                promises.push({
                    key: key,
                    email: email,
                    name: name,
                    team_id: team_id,
                    uid: uid,
                    fcm_token: fcm_token,
                    lastMsgTime: lastMsgTime
                });
            }
        }
  
        console.log('Promises : ', promises);
  
        promises.sort((a, b) => b.lastMsgTime - a.lastMsgTime);
        
        promises.forEach((result) => {
            // console.log(`Member ID: ${result.key}, Last Message Time: ${result.lastMsgTime}`);
            userlistString = '<li class="clearfix clearfix-li" style="cursor: pointer;" onclick="get_user_in_chat(&#39;' + result.team_id + adminId + '&#39;, &#39;' + result.team_id + adminId + '&#39;, &#39;' + result.name + '&#39;, &#39;' + result.email + '&#39;, &#39;&#39;)"> <img class="rounded-circle user-image" src="" alt=""> <div class="about" style="width: calc(100% - 60px); overflow: hidden;"> <div class="name" style="white-space: nowrap;">' + result.name + '</div> <div class="status" style="white-space: nowrap;">' + result.email + '</div> </div> </li>';
  
            userList.insertAdjacentHTML('beforeend', userlistString);
        });
    } catch (error) {
        console.error("Error fetching documents: ", error);
    }
  
    // get team member list ==========================================
  </script>