<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Kreait\Firebase\Messaging;

class FCMController extends Controller
{
    //
    public function index(Request $req){
        $input = $req->all();
        // // return print_r($req);
        // // return response()->json($input);
        $fcm_token = $input['fcm_token'];
        $user_id = $input['user_id'];
     
     
         $user = User::findOrFail($user_id);
     
        $user->device_token = $fcm_token;
        $user->save();
        return response()->json([
            'success'=>true,
            'message'=>'User token updated successfully.'
        ]);
     
     }
    }
?>
