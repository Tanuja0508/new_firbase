<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
	<div id="container">
	<aside>
		<!-- <header>
			<input type="text" placeholder="search">
		</header> -->
		<ul>
        @foreach($users as $user )
			<li onclick="mssgdiv('{{$user->device_token}}','{{$user->id}}')">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_01.jpg" alt="">
				<div>
					<h2>{{$user->name}}</h2>
					<h3>
						<span class="status orange"></span>
online					</h3>
				</div>
			</li>
			@endforeach
		</ul>
	</aside>
	<main>
		<header class="chat1">
			 <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_01.jpg" alt=""> -->
			<div>
			<!-- <h2>Chat with Vincent Porter</h2>  -->
				<h3>
                    chat
                </h3>
			</div>
			<!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_star.png" alt="">  -->
		</header>
		
		
	</main>
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
                    // console.log(res);
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
//         messaging.onMessage(function(payload) {
//             console.log('sdfghjk')
// console.log(payload);
// const noteTitle = payload.notification.title;
//                 const noteOptions = {
//                     body: payload.notification.body,
//                     icon: payload.notification.icon,
//                 };
//                 new Notification(noteTitle, noteOptions);

// });
      messaging.onMessage((payload) => {
    console.log('Message received. ', payload);
      });




    //   IntitalizeFireBaseMessaging();
    //  function IntitalizeFireBaseMessaging() {
    //     messaging
    //         .requestPermission()
    //         .then(function () {
    //             console.log("Notification Permission");
    //              return messaging.getToken();
    //         })
    //         .then(function (token) {
    //             console.log("Token : "+token);
    //         })
    //         .catch(function (reason) {
    //             console.log(reason);
    //         });
    // }

  
    //  messaging.onMessage(function (payload) {
    //     console.log('esjhdjehsjdej')
    //     console.log(payload);
    //     const notificationOption={
    //         body:payload.notification.body,
            
    //     };

    //     if(Notification.permission==="granted"){
    //         alert('hghjghjs');
    //         console.log('hdsjhdjhdj');
    //         var notification=new Notification(payload.notification.title,notificationOption);

    //         notification.onclick=function (ev) {
    //             ev.preventDefault();
    //             window.open(payload.notification.click_action,'_blank');
    //             notification.close();
    //         }
    //     }

    // });
    // messaging.onTokenRefresh(function () {
    //     messaging.getToken()
    //         .then(function (newtoken) {
    //             // console.log("New Token : "+ newtoken);
    //         })
    //         .catch(function (reason) {
    //             console.log(reason);
    //         })
    // })

    </script>
    <script>
        function mssgdiv(token,id)
        {
            $.ajaxSetup({
             headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
              });

            $.ajax({
                type:"POST",
                url:"/get_chat_data",
                data:{rec_id:id},
                success:function(response){
                    var res= " " ;
                    var data=JSON.parse(response);
                    console.log(data);
                   res +='<ul id="chat">';
//                     console.log(data.message);
                    $(data).each(function(i,val){
                        res +='<li class="you">'+
                        '<div class="entete">'+
                            '<span class="status green"></span>'+
                            '<h2>'+val.sender_name+'</h2>'+
                            '<h3>10:12AM, Today</h3>'+
                        '</div>'+
                        '<div class="triangle"></div>'+
                        '<div class="message">'+val.message+'</div>'+
                        '</li>';
                    });
                    res +='</ul>';
                   res += '<footer>'+
        '<form action="/send_mssg" method="POST">'+
            '@csrf'+
			'<textarea placeholder="Type your message" name="message"></textarea>'+
            '<input type="hidden" class="token_class" name="device_token">'+
           '<input type="hidden" class="user_id" name="user_id">'+
			'<button type="submit">Send</button>'+
'</form>'+
		'</footer>';
        $('.chat1').append(res);
                    $('.token_class').val(token);
        $('.user_id').val(id);
}
            });



            
               

        
        }
        </script>
@endsection
</x-app-layout>
