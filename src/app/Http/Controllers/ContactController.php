<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        $contact = $request->only(['name','gender','email','address','building','category_id','content']);
        $contact['name'] = $request->last__name . ' ' . $request->first__name;
        $contact['tel'] = $request->tel1 . ' ' . $request->tel2 . ' ' . $request->tel3;

        return view('confirm',compact('contact'));
    }
}