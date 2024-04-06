import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
import { getAuth, signInWithPopup, GoogleAuthProvider, setPersistence, inMemoryPersistence } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-auth.js";
import { getFirestore, doc, setDoc} from "https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js";
import { firebaseConfig } from './config.js';


// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

// login with gmail
module.loginGmail = async function loginGmail(){
    console.log('login button click');
    $('.span2').html('Log in with Google <div class="spinner-border" role="status" style="width: 15px; height: 15px;"> <span class="visually-hidden">Loading...</span> </div>');

    const provider = new GoogleAuthProvider();
    signInWithPopup(auth, provider)
    .then(async (result) => {
        // This gives you a Google Access Token. You can use it to access the Google API.
        const credential = GoogleAuthProvider.credentialFromResult(result);
        const token = credential.accessToken;
        // The signed-in user info.
        const user = result.user;
        // Store user details locally
        localStorage.setItem('user', JSON.stringify(user));
        // Save user data to Firestore
        await saveUserDataToFirestore(user);
        window.location.href = 'Chat.php';
    }).catch((error) => {
        // Handle Errors here.
        const errorCode = error.code;
        const errorMessage = error.message;
        console.log(errorMessage);
        // The email of the user's account used.
        const email = error.customData.email;
        // The AuthCredential type that was used.
        const credential = GoogleAuthProvider.credentialFromError(error);
        $('.span2').html('Log in with Google');
    });
}

async function saveUserDataToFirestore(user) {
    try {
        const { displayName, email, emailVerified, phoneNumber, photoURL, uid, metadata } = user;
        // Extract relevant fields from metadata
        const { creationTime, lastSignInTime } = metadata;

        await setDoc(doc(db, "users", user.uid), {
            displayName,
            email,
            emailVerified,
            phoneNumber,
            photoURL,
            uid,
            // Include relevant metadata fields
            metadata: {
                creationTime,
                lastSignInTime
            }
        });
        console.log("User data saved to Firestore successfully!");
    } catch (error) {
        console.error("Error saving user data to Firestore: ", error);
        $('.span2').html('Log in with Google');
    }
}

// automatic login without click
const userData = localStorage.getItem('user');
if (userData) {
  const user = JSON.parse(userData);
  // Directly sign in with user data from localStorage
  localStorage.setItem('user', JSON.stringify(user));
  // Save user data to Firestore
  saveUserDataToFirestore(user)
    .then(() => {
      // Redirect to Chat.html after saving user data
      window.location.href = 'Chat.php';
    })
    .catch((error) => {
      console.error("Error saving user data:", error);
    });
}