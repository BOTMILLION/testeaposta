// firebase.js
import { initializeApp } from 'firebase/app';
import { getAuth } from 'firebase/auth';
import { getFirestore } from 'firebase/firestore';

const firebaseConfig = {
  apiKey: "AIzaSyCKw5ZcJBcTvf1onPtkzgvJqlRAsbUqauk",
  authDomain: "robo-7937c.firebaseapp.com",
  projectId: "robo-7937c",
  storageBucket: "robo-7937c.appspot.com",
  messagingSenderId: "444396924434",
  appId: "1:444396924434:web:46b93323f9c22d90ac32cb",
  measurementId: "G-G4NYL1GXGW"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

export { auth, db };
