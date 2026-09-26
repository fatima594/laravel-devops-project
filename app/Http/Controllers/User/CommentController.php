<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Log;



class CommentController extends Controller
{


    public function store(CommentRequest $request, $postId)
{
    // البيانات جاهزة ومتحقق منها
    $comment = Comment::create([
        'post_id' => $postId,
        'name' => $request->name,
        'body' => $request->body,
        'email' => $request->email,
    ]);

    return response()->json([
        'success' => true,
        'comment' => $comment,
        'message' => 'Your Comment Has Added successfully'
    ]);
}



    public function countComments()
    {
        $commentsCount = Comment::count();
        $comments = Comment::all(); // جلب جميع التعليقات

        return view('admin.dashboard.comment', compact('commentsCount', 'comments'));
    }


    public function destroy($id){

        $comment = Comment::findOrFail($id);

         if ($comment) {
        // حذف العنصر
        $comment->delete();

        // رسالة نجاح بعد الحذف
        return redirect()->back()->with('success', 'تم حذف التعليق بنجاح');
    } else {
        // إذا كان العنصر غير موجود، إرجاع رسالة خطأ
        return redirect()->back()->with('error', 'لم يتم العثور على التعليق');
    }
}



}
