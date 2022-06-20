<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;




class HomeController extends Controller
{

public function index(){
    $users=User::where('id', '!=' , auth()->user()->id)->get();
    return view('dashboard',compact('users'));
}


public function home(){
    $users=User::where('id', '!=' , auth()->user()->id)->get();
    return view('home',compact('users'));
}

    public function createChat(Request $request)
    {
        // dd($request);÷
        $input = $request->all();
        $message = $input['message'];
        $device_token = $input['device_token'];
        $id=$input['user_id'];
        $chat = new Chat([
            'sender_id' => auth()->user()->id,
            'sender_name' => auth()->user()->name,
            'message' => $message,
            'receiver_id'=>$id
        ]);
    //     // dd($chat);
    
        $resss=$this->broadcastMessage(auth()->user()->name,$message,$device_token);
    // dd($resss);
    if($resss==1){
        $chat->save();
        return redirect()->back();
    }
    else{
        return redirect()->back();
    }
    // $url ="https://fcm.googleapis.com/fcm/send";

    //     $fields=array(
    //         "to"=>'fFm_Ijjf5kyQC_4ona_lDl:APA91bH449kqkLbKhGnRxtTsTJY1z0a98kspQ-d8s0riiOBgrjMtrUlLeiL-bwE6fPoBv_8OcACg7T2bbnDXRjpYqRsS0Chi7CQI3-_MZECgeP0HBgJ-Zc1JPTIJ2yXos6yL6dqlVuOi',
    //         "notification"=>array(
    //             "body"=>'sdfghjkl',
    //             "title"=>'dfghjkl',
                
    //             "click_action"=>"https://google.com"
    //         )
    //     );
    
    //     $headers=array(
    //         'Authorization: key=AAAA6pnq950:APA91bGO8x410eqhrygz-VBMM5RrYwQqxoKyNdIJAM-IUBv-XNrOEuqXcl3lAjx2XGSzrZyjSAHOOvHwt1VZERdoo_u4zBdlG53PuwmJo14TGjwNsUk2VjqfI5XsNOTKQRFaFLBmBVvW',
    //         'Content-Type:application/json'
    //     );
    
    //     $ch=curl_init();
    //     curl_setopt($ch,CURLOPT_URL,$url);
    //     curl_setopt($ch,CURLOPT_POST,true);
    //     curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    //     curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //     curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    //     $result=curl_exec($ch);
    //     print_r($result);
    //     curl_close($ch);
    
    }


private function broadcastMessage($senderName, $message,$d_token)
{
    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60 * 20);

    $notificationBuilder = new PayloadNotificationBuilder('New message from : ' . $senderName);
    $notificationBuilder->setBody($message)
        ->setSound('default')
        ->setClickAction('http://localhost:3000/home');

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData([
        'sender_name' => $senderName,
        'mesage' => $message
    ]);

     $option = $optionBuilder->build();
     $notification = $notificationBuilder->build();
     
     $data = $dataBuilder->build();
    // $tokens = User::whereNotNull('device_token')->pluck('device_token')->all();
     $tokens = $d_token;

    $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
    return $downstreamResponse->numberSuccess();

}


public function get_chat(Request $req){
     $rec_id=$req->rec_id;
     $chats=Chat::where('receiver_id', '=', $rec_id)
     ->orWhere('sender_id', '=', auth()->user()->id)
     ->orWhere('receiver_id', '=', auth()->user()->id)
     ->orWhere('sender_id', '=', $rec_id)
     ->get();
    //    foreach($chats as $chat){
    //        echo $chat->message;
    //    }
      echo json_encode($chats);
    // print_r($chats);
}

}
