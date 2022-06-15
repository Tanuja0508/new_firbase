<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="card-body">
                        <!-- <div class="chat-container">
                    
                           <p class="chat chat-right">
                               <b>A :</b><br>
                                        message1                              </p>
                                    <p class="chat chat-left">
                                        <b>B :</b><br>
                                        message 2
                                    </p>
                     


                        </div> -->
                        <div class="chat-container">
    @if(count($chats)==0)
        <p>There is no chat yet.</p>
    @endif
    @foreach($chats as $chat )
        @if($chat->sender_id === auth()->user()->id)
            <p class="chat chat-right">
                <b>{{$chat->sender_name}} :</b><br>
                {{$chat->message}}                                    </p>
        @else
            <p class="chat chat-left">
                <b>{{$chat->sender_name}} :</b><br>
                {{$chat->message}}
            </p>
        @endif
    @endforeach


</div>

          

                    </div>


                    <div class="message-input-container">
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label>Message</label>
                <input type="text" name="message" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">SEND MESSAGE</button>
            </div>
        </form>
    </div>


    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div> -->
    @section('scripts')
    <script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-messaging.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
<!-- <script>


const messaging = firebase.messaging();
// messaging.usePublicVapidKey("BP_JEOiKXVqNqzoDT0FUDJeA6zwdG_mSOSLWS3IPZea-ttj0we9IUx5peZAVl_4CAyw0DO9eEJ_6cBxY91lH4xs");
Notification.requestPermission().then((permission) => {
              if (permission === 'granted') {
                // navigator.serviceWorker.register('http://127.0.0.1:8000/firebase-messaging-sw.js')
                getRegToken();
}
});
	function getRegToken(argument) {
		messaging.getToken()
		  .then(function(currentToken) {
		    if (currentToken) {
		      saveToken(currentToken);
		      console.log(currentToken);
		      setTokenSentToServer(true);
		    } else {
		      console.log('No Instance ID token available. Request permission to generate one.');
		      setTokenSentToServer(false);
		    }
		  })
		  .catch(function(err) {
		    console.log('An error occurred while retrieving token. ', err);
		    setTokenSentToServer(false);
		  });
	}
	function setTokenSentToServer(sent) {
	    window.localStorage.setItem('sentToServer', sent ? 1 : 0);
	}
	function isTokenSentToServer() {
	    return window.localStorage.getItem('sentToServer') == 1;
	}
	messaging.onMessage(function(payload) {
	  console.log("Message received. ", payload);
	  notificationTitle = payload.data.title;
	  notificationOptions = {
	  	body: payload.data.body,
	  	icon: payload.data.icon,
	  	image:  payload.data.image
	  };
	  var notification = new Notification(notificationTitle,notificationOptions);
	});
  </script> 
 -->
<script>
    const messaging = firebase.messaging();
    messaging.usePublicVapidKey("BP_JEOiKXVqNqzoDT0FUDJeA6zwdG_mSOSLWS3IPZea-ttj0we9IUx5peZAVl_4CAyw0DO9eEJ_6cBxY91lH4xs");

    function sendTokenToServer(fcm_token) {
        // alert('sdfghjk');
            const user_id = '{{auth()->user()->id}}';
            console.log(fcm_token);
            // console.log(user_id);

            axios.post('/api/save-token', {
                fcm_token, user_id
            })
                .then(res => {
                    console.log(res);
                })

        }

        function retreiveToken(){
            messaging.getToken().then((currentToken) => {
                if (currentToken) {
                    sendTokenToServer(currentToken);
                    // updateUIForPushEnabled(currentToken);
                } else {
                    // Show permission request.
                    //console.log('No Instance ID token available. Request permission to generate one.');
                    // Show permission UI.
                    //updateUIForPushPermissionRequired();
                    //etTokenSentToServer(false);
                    alert('You should allow notification!');
                }
            }).catch((err) => {
                console.log(err);
                // showToken('Error retrieving Instance ID token. ', err);
                // setToackenSentToServer(false);
            });
        }
        retreiveToken();
        messaging.onTokenRefresh(()=>{
            retreiveToken();


        });
        messaging.onMessage(function(payload) {
            console.log('sdfghjk')
console.log(payload);
});

    //     messaging.onMessage((payload)=>{
    //         alert('dfghjk');
    //         console.log('Message received');
    //         console.log(payload);
    //         location.reload();
    // //         var notify;
    // // notify = new Notification(payload.notification.title,{
    // //     body: payload.notification.body,
    // //     icon: payload.notification.icon,
    // //     tag: "Dummy"
    // // });
    // // console.log(payload.notification);

    //         // location.reload();
    //     });



    //firebase.initializeApp(config);


    </script>
@endsection
</x-app-layout>
