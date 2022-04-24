<?php

namespace App\Http\Controllers;

use App\Models\UserWebsite;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'website_id' => 'required|exists:websites,id',
        ]);

        $model = UserWebsite::firstOrCreate($data);

        return $model;
    }
}
