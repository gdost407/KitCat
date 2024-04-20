import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
import { getAuth, signInWithPopup, GoogleAuthProvider, setPersistence, inMemoryPersistence, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-auth.js";
import { getFirestore, doc, setDoc, getDoc, updateDoc } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js";
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
    try {
        const result = await signInWithPopup(auth, provider);
        // This gives you a Google Access Token. You can use it to access the Google API. The signed-in user info.
        const credential = GoogleAuthProvider.credentialFromResult(result);
        const token = credential.accessToken;
        const user = result.user;

        // Save user data to Firestore
        const currentTime = new Date().getTime();
        const randomNumber = Math.floor(Math.random() * 10000);
        const timestamp = currentTime.toString() + randomNumber.toString();
        const docRef = doc(db, "users", user.uid);
        const docSnap = await getDoc(docRef);

        if (docSnap.exists()) {
            // Store user details locally
            localStorage.setItem('user', JSON.stringify(docSnap.data()));

            // Document exists, update data
            await updateDoc(docRef, {
                email: user.email,
                emailVerified: user.emailVerified,
                metadata: {
                    creationTime: user.metadata.creationTime,
                    lastSignInTime: user.metadata.lastSignInTime
                }
            });
            console.log("Document updated successfully");
        } else {
            // Store user details locally
            localStorage.setItem('user', JSON.stringify(user));

            // Document doesn't exist, add new data
            await setDoc(docRef, {
                displayName: user.displayName,
                email: user.email,
                emailVerified: user.emailVerified,
                phoneNumber: user.phoneNumber,
                photoURL: user.photoURL,
                uid: user.uid,
                // Include relevant metadata fields
                metadata: {
                    creationTime: user.metadata.creationTime,
                    lastSignInTime: user.metadata.lastSignInTime
                }
            });
            await setDoc(doc(db, "chatbook", user.uid), {
                message:'Account Created',
                seen:'seen',
                status:'online',
                notifyTo:user.uid,
                request:'Accepted',
                time:new Date(),
                users:[user.uid]
            });
            console.log("New document added successfully");
        }

        window.location.href = 'Chat.php';
    } catch (error) {
        // Handle Errors here.
        const errorCode = error.code;
        const errorMessage = error.message;
        console.log(errorMessage);
        const email = error.customData.email;
        const credential = GoogleAuthProvider.credentialFromError(error);
        $('.span2').html('Log in with Google');
    }
}

let locationChanged = false;
const authStateChangedListener = async (user) => {
    if(!locationChanged){
        if (user) {
            const docRef = doc(db, "users", user.uid);
            const docSnap = await getDoc(docRef); // Ensure to await here

            if (docSnap.exists()) {
                localStorage.setItem('user', JSON.stringify(docSnap.data()));
            }
            console.log("User is signed in:", user); // Set the flag to true to indicate that location change has been executed
            window.location = "Chat.php";
        } else if (!user) {
            console.log("User is signed out");
        }
        locationChanged = true;
        console.log(locationChanged);
    }
};
onAuthStateChanged(auth, authStateChangedListener);