<style>
  
  </style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('asdfvgbhjkl') }}
        </h2>
    </x-slot>
    
    <div class="container">
	<div class="row no-gutters">
	  <div class="col-md-4 border-right">
		<div class="settings-tray">
		  <span class="settings-tray--right">
			<i class="material-icons">cached</i>
			<i class="material-icons">message</i>
			<i class="material-icons">menu</i>
		  </span>
		</div>
		<div class="search-box">
		  <div class="input-wrapper">
			<i class="material-icons">search</i>
			<input placeholder="Search here" type="text">
		  </div>
		</div>
		<div class="friend-drawer friend-drawer--onhover">
		  <div class="text">
			<h6>Robo Cop</h6>
			<p class="text-muted">Hey, you're arrested!</p>
		  </div>
		  <span class="time text-muted small">13:21</span>
		</div>
		<hr>
		<div class="friend-drawer friend-drawer--onhover">
		  <div class="text">
			<h6>Optimus</h6>
			<p class="text-muted">Wanna grab a beer?</p>
		  </div>
		  <span class="time text-muted small">00:32</span>
		</div>
		<hr>
		<div class="friend-drawer friend-drawer--onhover">
		  <div class="text">
			<h6>XXXXX</h6>
			<p class="text-muted">Hi, wanna see something?</p>
		  </div>
		  <span class="time text-muted small">13:21</span>
		</div>
	  </div>
	  <div class="col-md-8">
		<div class="settings-tray">
			<div class="friend-drawer no-gutters friend-drawer--grey">
			<div class="text">
			  <h6>Robo Cop</h6>
			  <p class="text-muted">Layin' down the law since like before Christ...</p>
			</div>
			<span class="settings-tray--right">
			  <i class="material-icons">cached</i>
			  <i class="material-icons">message</i>
			  <i class="material-icons">menu</i>
			</span>
		  </div>
		</div>
		<div class="chat-panel">
		  <div class="row no-gutters">
			<div class="col-md-3">
			  <div class="chat-bubble chat-bubble--left">
				Hello dude!
			  </div>
			</div>
		  </div>
		  <div class="row no-gutters">
			<div class="col-md-3 offset-md-9">
			  <div class="chat-bubble chat-bubble--right">
				Hello dude!
			  </div>
			</div>
		  </div>
		  <div class="row no-gutters">
			<div class="col-md-3 offset-md-9">
			  <div class="chat-bubble chat-bubble--right">
				Hello dude!
			  </div>
			</div>
		  </div>
		  <div class="row no-gutters">
			<div class="col-md-3">
			  <div class="chat-bubble chat-bubble--left">
				Hello dude!
			  </div>
			</div>
		  </div>
		  <div class="row no-gutters">
			<div class="col-md-3">
			  <div class="chat-bubble chat-bubble--left">
				Hello dude!
			  </div>
			</div>
		  </div>
		  <div class="row no-gutters">
			<div class="col-md-3">
			  <div class="chat-bubble chat-bubble--left">
				Hello dude!
			  </div>
			</div>
		  </div>
		  <div class="row no-gutters">
			<div class="col-md-3 offset-md-9">
			  <div class="chat-bubble chat-bubble--right">
				Hello dude!
			  </div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-12">
			  <div class="chat-box-tray">
				<i class="material-icons">sentiment_very_satisfied</i>
				<input type="text" placeholder="Type your message here...">
				<i class="material-icons">mic</i>
				<i class="material-icons">send</i>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
  <script>
$( '.friend-drawer--onhover' ).on( 'click',  function() {
  
  $( '.chat-bubble' ).hide('slow').show('slow');
  
});
    </script>
</x-app-layout>
