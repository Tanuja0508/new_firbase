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
		<header class="chat1"  id="messages">
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
const firebaseConfig = {
  apiKey: "AIzaSyB4jtkYgM8bqllAlTJqpwURkyAgT8ddYGc",
  authDomain: "chat-app-4ca73.firebaseapp.com",
  databaseURL: "https://chat-app-4ca73-default-rtdb.firebaseio.com",
  projectId: "chat-app-4ca73",
  storageBucket: "chat-app-4ca73.appspot.com",
  messagingSenderId: "1007604660125",
  appId: "1:1007604660125:web:3f1301fffa4c8cc4dee174",
  measurementId: "G-NBKLX3YWWP"
};
firebase.initializeApp(firebaseConfig);


let name="";
// function init() {
//   name = prompt("Please enter your name");
// //   msgRef1.on('child_added', updateMsgs);

// }
// document.addEventListener('DOMContentLoaded', init);


const db = firebase.database();

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
                    // console.log(data);
                 
//                  console.log(data.message);
                    $(data).each(function(i,val){
                        // res +='<li class="you">'+
                        // '<div class="entete">'+
                        //     '<span class="status green"></span>'+
                        //     '<h2>'+val.sender_name+'</h2>'+
                        //     '<h3>10:12AM, Today</h3>'+
                        // '</div>'+
                        // '<div class="triangle"></div>'+
                        // '<div class="message">'+val.message+'</div>'+
                        // '</li>';
                    });
                    // res +='</ul>';
                   res += '<footer>'+
        '<form id="messageForm">'+
            '@csrf'+
			'<textarea placeholder="Type your message"  id="msg-input"></textarea>'+
            '<input type="hidden" id="sender_id">'+
			'<button type="submit" id="msg-btn">Send</button>'+
           '</form>'+
		'</footer>';
        $('.chat1').html(res);
        $('#sender_id').val(id);

        const msgForm = document.getElementById("messageForm"); //the input form
        const msgInput = document.getElementById("msg-input"); //the input element to write messages
        const msgBtn = document.getElementById("msg-btn"); //the Send button
        msgForm.addEventListener('submit', sendMessage);
        const sender_id=$('#sender_id').val();

const msgRef = db.ref("/msgs/"+{{Auth::user()->id}}*sender_id); 

        msgRef.on('child_added', updateMsgs);



          } 
            });


           
   }




   

const updateMsgs = data =>{
// alert('hello');
const msgScreen = document.getElementById("messages"); //the <ul> that displays all the <li> msgs

  const {sendername, text} = data.val(); //get name and text

	console.log(sendername);

  //load messages, display on left if not the user's name. Display on right if it is the user.
  const msg = '<ul id="chat"><li class="you">'+
                        '<div class="entete">'+
                            '<span class="status green"></span>'+
                            '<h2>'+sendername+'</h2>'+
                            '<h3>10:12AM, Today</h3>'+
                        '</div>'+
                        '<div class="triangle"></div>'+
                        '<div class="message">'+text+'</div>'+
                        '</li></ul>';


  $('#messages').prepend(msg);//add the <li> message to the chat window

  //auto scroll to bottom
//   document.getElementById("chat-window").scrollTop = document.getElementById("chat-window").scrollHeight;
}



         //databse_add code
        function sendMessage(e){

            const sender_id=$('#sender_id').val();
            const msgRef = db.ref("/msgs/"+{{Auth::user()->id}}*sender_id); 

        e.preventDefault();
        const text = $("#msg-input").val();
         const uname='{{Auth::user()->name}}';

        if(!text.trim()) return alert('Please type a message'); //no msg submitted
        const msg = {
        sendername: uname,
        text: text
         };

    msgRef.push(msg);
    $("#msg-input").val();
}

        </script>
@endsection
</x-app-layout>
