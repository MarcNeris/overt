var config = {
    apiKey: "AIzaSyDQBwFnkee2UvDN_ir4KNSuXgvq8jzjSGw",
    authDomain: "hcmrep-overt.firebaseapp.com",
    databaseURL: "https://hcmrep-overt.firebaseio.com",
    projectId: "hcmrep-overt",
    storageBucket: "hcmrep-overt.appspot.com",
    messagingSenderId: "168435926428"
};

firebase.initializeApp(config);

const FS = firebase.firestore();

//firebase.auth().signOut();


const settings = {timestampsInSnapshots: true};
FS.settings(settings);


firebase.auth().signInWithEmailAndPassword('marceloneris@hotmail.com','angra@@2');



var DB = function(ref,child){
	var FB = firebase.database();
	var DB = FB.ref(ref).child(child);
	return DB;
}
