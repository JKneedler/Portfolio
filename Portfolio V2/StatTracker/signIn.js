var config = {
    apiKey: "AIzaSyCbhSoNxF2GQzo369cW7txfEfxTAfUnQqo",
    authDomain: "personal-tracker-dcde2.firebaseapp.com",
    databaseURL: "https://personal-tracker-dcde2.firebaseio.com",
    projectId: "personal-tracker-dcde2",
    storageBucket: "",
    messagingSenderId: "753322332522"
  };
firebase.initializeApp(config);
var db = firebase.firestore();

var curScreen;

function LogIn() {
  emailInput = document.getElementById("email").value;
  pwInput = document.getElementById("password").value;
  console.log(emailInput + ", " + pwInput);

  firebase.auth().signInWithEmailAndPassword(emailInput, pwInput).catch(function(error) {
    // Handle Errors here.
    var errorCode = error.code;
    var errorMessage = error.message;
    // ...
    console.error("Failed to sign in", error);
    document.getElementById("errorLabel").innerHTML = error;
  });
}

function Back() {
  window.history.back(-1);
}

function SignOut() {
  firebase.auth().signOut().then(function() {
    // Sign-out successful.
    console.log("Signed Out");
    window.location.replace('index.html');
  }).catch(function(error) {
    // An error happened.
    console.log("Failed to sign out");
  });
}

firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    StartLoadProgram();
  } else {

  }
});

function StartLoadProgram(){
  console.log(firebase.auth().currentUser);
  curDay = new Date();
  logIn = document.getElementById("logIn");
  logIn.setAttribute("style", "display: none;");
  OpenHours();
  UpdateDayHours();
  SetDayClickEvents();
  ChangeDayDisplay();
  StartUpFoodsPage();
}

function OpenHours() {
  curScreen = 0;
  document.getElementById("hoursProgram").setAttribute("style", "display: block");
  document.getElementById("foodProgram").setAttribute("style", "display: none");
  document.getElementById("workoutProgram").setAttribute("style", "display: none");
  document.getElementById("moneyProgram").setAttribute("style", "display: none");
}

function OpenFood() {
  curScreen = 1;
  document.getElementById("hoursProgram").setAttribute("style", "display: none");
  document.getElementById("foodProgram").setAttribute("style", "display: block");
  document.getElementById("workoutProgram").setAttribute("style", "display: none");
  document.getElementById("moneyProgram").setAttribute("style", "display: none");
}

function OpenWorkout() {
  curScreen = 2;
  document.getElementById("hoursProgram").setAttribute("style", "display: none");
  document.getElementById("foodProgram").setAttribute("style", "display: none");
  document.getElementById("workoutProgram").setAttribute("style", "display: block");
  document.getElementById("moneyProgram").setAttribute("style", "display: none");
}

function OpenMoney() {
  curScreen = 3;
  document.getElementById("hoursProgram").setAttribute("style", "display: none");
  document.getElementById("foodProgram").setAttribute("style", "display: none");
  document.getElementById("workoutProgram").setAttribute("style", "display: none");
  document.getElementById("moneyProgram").setAttribute("style", "display: block");
}
