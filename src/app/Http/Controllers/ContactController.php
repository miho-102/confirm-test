<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        $inputs['name'] = $request->last__name . ' ' . $request->first__name;$inputs['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        $category = Category::find($request->category_id);
        $inputs['category_content'] = $category ? $category->content : '不明';
        $contact = $inputs;

        return view('confirm',compact('contact'));
    }
    public function store(ContactRequest $request)
    {
        $data = $request->all();
        $data['last_name']  = $request->last__name;
        $data['first_name'] = $request->first__name;
        $data['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        $data['detail'] = $request->content;

        Contact::create($data);

        return view('thanks');
    }
}