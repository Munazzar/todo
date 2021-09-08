let firebaseConfig = {
  apiKey: "AIzaSyDUqD_ktYnbbIYybaYYroNxOCTevwirnzI",
  authDomain: "todo-89210.firebaseapp.com",
  databaseURL: "https://todo-89210-default-rtdb.firebaseio.com",
  projectId: "todo-89210",
  storageBucket: "todo-89210.appspot.com",
  messagingSenderId: "794333737525",
  appId: "1:794333737525:web:dddae13afccd88c2a7777c",
  measurementId: "G-C4EXR27BCH"
};

let firebaseApp = window.firebase.initializeApp(firebaseConfig);
let rootView = document.querySelector(".phone");
let session = redirectSession();
let root = document.documentElement;

firebaseApp.auth().onAuthStateChanged((user) => {
  if (user != null) {
    routeTo("demo", rootView, user);
  } else {
    routeTo("signIn", rootView);
  }
});

checkForRedirect(session);

async function checkForRedirect(session) {
  if (!session.isRedirected()) {
    return;
  }
  session.removeLink();
  try {
    const result = await firebaseApp.auth().getRedirectResult();
  } catch(error) {
    switch(error.code) {
      case 'auth/credential-already-in-use': {
        // You can check for the provider it uses
        // firebaseApp.auth().fetchProvidersForEmail(error.email)
        // But in this case we don't want the user to link with 
        // an existing account we would prompt them about an
        // error and prompt them to log in with their account
      }
    }
  }  
}

function routeTo(view, rootView, user) {
  let clone, listeners;
  switch (view) {
    case "signIn": {
      clone = cloneNode("#signIn");
      // This is mostly to keep the code pen simple
      // ideally you'd detach listeners
      listeners = attachSignInListeners;
      break;
    }
    case "demo": {
      clone = cloneNode("#demo");
      // This is mostly to keep the code pen simple
      // ideally you'd detach listeners
      listeners = attachDemoListeners;
      break;
    }
    default:
      throw new Error("???");
      break;
  }
  rootView.innerHTML = "";
  rootView.appendChild(clone);
  listeners(document, firebaseApp, user);
}

function cloneNode(templateSelector) {
  let template = document.querySelector(templateSelector);
  return template.content.cloneNode(true);
}

// This is a performance optimization. Calling the method
// getRedirectResult() will load in code. We can avoid
// loading it before its needed by using sessionStorage
// to signal if the user initiated a redirect
function redirectSession() {
  // Simple helpers for using sessionStorage to
  // indicate if a user is returning from a redirect
  return {
    setLink() {
      sessionStorage.setItem('link', 'true');
    },
    removeLink() {
      sessionStorage.setItem('link', '');
    },
    isRedirected() {
      return !!sessionStorage.getItem('link');
    }
  };
}

function signInGoogle({ link } = { link: false }) {
  let provider = new firebase.auth.GoogleAuthProvider();
  if(link) {
    session.setLink();
    firebaseApp.auth().currentUser.linkWithRedirect(provider);
  } else {
    firebaseApp.auth().signInWithRedirect(provider);
  }
}

function attachSignInListeners(document, firebaseApp) {
  let socialForm = document.querySelector("form.sign-in-social");
  let guestForm = document.querySelector("form.sign-in-guest");

  guestForm.addEventListener("submit", async (submitEvent) => {
    submitEvent.preventDefault();
    let formData = new FormData(guestForm);
    let displayName = formData.get("name");
    let photoURL = await getRandomPhotoURL();
    // Firebase specific code
    let { user } = await firebaseApp.auth().signInAnonymously();
    await user.updateProfile({ displayName, photoURL });
    // End Firebase specific code
  });

  socialForm.addEventListener("submit", (submitEvent) => {
    submitEvent.preventDefault();
    // Firebase specific code
    signInGoogle();
    // End Firebase specific code
  });

  async function getRandomPhotoURL() {
    let response = await fetch("https://picsum.photos/128?blur");
    return response.url;
  }
}

function attachDemoListeners(document, firebaseApp, user) {
  let convertForm = document.querySelector('form.convert');
  let legend = document.querySelector('.legend');
  let marchDoc = firebaseApp.firestore()
    .collection('users')
    .doc(user.uid)
    .collection('expenses')
    .doc('3-2021');
  
  if(user.isAnonymous) {
    convertForm.classList.toggle('hidden');
  }
  convertForm.addEventListener("submit", (submitEvent) => {
    submitEvent.preventDefault();
    signInGoogle({ link: true });
  });
  marchDoc.onSnapshot(snap => {
    legend.innerHTML = '';
    let { factors } = snap.data();
    factors.forEach((factor, index) => {
      let template = cloneNode('#factor');
      let textEl = template.querySelector('.factor__text');
      let percentageEl = template.querySelector('.factor__percentage');
      let factorColorEl = template.querySelector('.factor__color');
      root.style.setProperty(`--pie-${index+1}__value`, `${factor.value}%`);
      textEl.textContent = factor.label;
      percentageEl.textContent = `${factor.value}%`;
      factorColorEl.classList.add(`factor__color--${factor.label.toLowerCase()}`);
      legend.appendChild(template);
    });
    
  });
}

// Creates helpful hot-keys for debugging
// CTRL+O - Sign out
// CTRL+U - Log the current user to the console
document.addEventListener("keydown", async (event) => {
  if (event.ctrlKey && event.key === "o") {
    await firebaseApp.auth().signOut();
    console.log("Signed out!");
  }
  if (event.ctrlKey && event.key === "u") {
    let currentUser = firebaseApp.auth().currentUser;
    console.log(currentUser.toJSON());
  }
});