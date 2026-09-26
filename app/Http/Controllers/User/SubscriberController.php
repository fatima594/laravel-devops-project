<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:subscribers,email',
    ]);

    Subscriber::create([
        'email' => $request->email,
    ]);

    // إذا كان الطلب AJAX نرجع JSON
    if ($request->ajax()) {
        return response()->json([
            'success' => 'You have successfully subscribed!'
        ]);
    }

    return back()->with('success', 'You have successfully subscribed!');
}


public function destroy($id){

    $subscriber = Subscriber::findOrFail($id);

         if ($subscriber) {
        // حذف العنصر
        $subscriber->delete();

        // رسالة نجاح بعد الحذف
        return redirect()->back()->with('success', 'Your Success Deleted Successfully');
    } else {
        // إذا كان العنصر غير موجود، إرجاع رسالة خطأ
        return redirect()->back()->with('error', 'Not found on subscription');
    }
}

}
