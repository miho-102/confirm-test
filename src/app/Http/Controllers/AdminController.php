<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

public function export(Request $request)
{
    $query = Contact::query();

    if ($request->keyword) {
        $query->where(function($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->keyword . '%')
            ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
            ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }
    if ($request->gender) {
        $query->where('gender', $request->gender);
    }
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }
    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    $response = new StreamedResponse(function () use ($query) {
        $handle = fopen('php://output', 'w');
        fputs($handle, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

        fputcsv($handle, ['ID', 'お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容']);

        $query->chunk(1000, function ($contacts) use ($handle) {
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->gender_label,
                    $contact->email,
                    $contact->category->content ?? '',
                    $contact->detail,
                ]);
            }
        });

        fclose($handle);
    }, 200,);

    return $response;
    }
}