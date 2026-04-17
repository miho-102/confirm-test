<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class AdminController extends Controller
{
public function index(Request $request)
    {

        $query = Contact::with('category');


        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $request->keyword . '%']);
            });
        }


        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }


        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }


        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }


        $contacts = $query->paginate(7)->appends($request->all());


        $categories = Category::all();


        $detail = null;
        if ($request->filled('id')) {
            $detail = Contact::with('category')->find($request->id);
        }


        return view('admin', compact('categories', 'contacts', 'detail'));
    }


    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin')->with('message', 'お問い合わせを削除しました');
    }
}