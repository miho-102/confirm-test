<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        $inputs = $request->all();
        $inputs['name'] = $request->last__name . ' ' . $request->first__name;$inputs['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        $category = Category::find($request->category_id);
        $inputs['category_content'] = $category ? $category->content : '不明';
        $contact = $inputs;

        return view('confirm',compact('contact'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['detail'] = $request->content;

        Contact::create($data);

        return view('thanks');
    }
}