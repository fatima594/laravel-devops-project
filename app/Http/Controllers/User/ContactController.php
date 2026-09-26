<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('layouts.contact');
    }

    // تخزين رسالة الاتصال
  public function store(ContactRequest $request)
{
    // ✅ حفظ الرسالة في قاعدة البيانات
    Contact::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'message' => $request->message,
    ]);

    // نص الرسالة الذي سيتم إرساله
    $text = "Name: " . $request->name . "\n\n" .
            "Email: " . $request->email . "\n" .
            "Message:\n" . $request->message;

    // ارسال البريد كنص خام
    Mail::raw($text, function ($mail) use ($request) {
        $mail->from('fatimalkhl33@gmail.com', 'Your Website Growthawakening');
        $mail->to('fatimalkhl33@gmail.com')
             ->replyTo($request->email, $request->name);
    });

    return response()->json([
        'message' => 'Your message has been sent. Thank you!'
    ], 200);
}


    public function showContacts()
    {
        // جلب جميع الرسائل من قاعدة البيانات
        $contacts = Contact::all();

        // حساب عدد الرسائل
        $messageCount = $contacts->count();

        // تمرير البيانات إلى الـ View
        return view('admin.dashboard.contacts', compact('contacts', 'messageCount'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'the message has deleted successfully');
    }
}
