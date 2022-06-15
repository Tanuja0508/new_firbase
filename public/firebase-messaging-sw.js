importScripts('https://www.gstatic.com/firebasejs/3.6.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.6.1/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
  const firebaseConfig = {
  apiKey: "AIzaSyB4jtkYgM8bqllAlTJqpwURkyAgT8ddYGc",
  authDomain: "chat-app-4ca73.firebaseapp.com",
  projectId: "chat-app-4ca73",
  storageBucket: "chat-app-4ca73.appspot.com",
  messagingSenderId: "1007604660125",
  databaseURL: "https://chat-app-4ca73.firebaseio.com",
  appId: "1:1007604660125:web:3f1301fffa4c8cc4dee174"
};

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
// const messaging = firebase.messaging();

// messaging.setBackgroundMessageHandler(function(payload) {
//   console.log('[firebase-messaging-sw.js] Received background message ', payload);
//   // Customize notification here
//   const notificationTitle = 'Background Message Title';
//   const notificationOptions = {
//     body: 'Background Message body.',
//     icon: 'https://images.theconversation.com/files/93616/original/image-20150902-6700-t2axrz.jpg' //your logo here
//   };

//   return self.registration.showNotification(notificationTitle,
//       notificationOptions);
// });
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();
// messaging.setBackgroundMessageHandler(function(payload) {
//   const {title,body}=payload.notification;

//   // console.log('[firebase-messaging-sw.js] Received background message ', payload);
//   // Customize notification here
//   // const notificationTitle = 'Background Message Title';
//   const notificationOptions = {
//     body,
//   };

//   return self.registration.showNotification(title,
//       notificationOptions);
// });

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body
       
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
});