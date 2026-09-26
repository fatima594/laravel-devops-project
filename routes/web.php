<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailsController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\SubscriberController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\SitemapController;
use App\Models\About;
use App\Models\SocialMedia;
use App\Models\Post;
use App\Models\Category;



Route::get('/', function () {
    $headerposts = Post::whereHas('category', function ($query) {
    $query->where('name', 'Learning Laravel');
})
->where('slug', 'how-to-fix-the-419-page-expired-error-in-laravel-beginnerfriendly-guide')
->get();
    $learnposts=Post::whereHas('category' ,function ($query){
    $query->where('name', 'networking' );
    })->take(1)->get();
    $tipsposts=Post::whereHas('category' ,function ($query){
    $query->where('name',  'English for Developers' );
    })->take(3)->get();
    $posts=Post::all();
    $categories=Category::all();
    $socialMedias=SocialMedia::all();


    return view('layouts.master' ,compact('headerposts' ,'learnposts' ,'tipsposts' , 'posts','categories'));
});

Route::get('/scan-results' , [ScanController::class, 'show']);
Route::get('/run-scan', [ScanController::class, 'run']);
// Redirect old links to correct URLs
$redirects = [
    '/single/gtitle-title-title-title' => '/single-post/my-first-laravel-project-how-one-simple-app-changed-everything',
    '/single/my-first-laravel-project' => '/single-post/my-first-laravel-project-how-one-simple-app-changed-everything',
    '/single/learning-laravel-without-a-cs-degree' => '/single-post/learning-laravel-without-a-cs-degree-how-i-built-confidence-skills-and-real-projects-from-zero',
    '/single/keep-learning-laravel' => '/single-post/my-journey-with-laravel-how-this-framework-transformed-the-way-i-learn-think-and-build',

];

foreach ($redirects as $old => $new) {
    Route::redirect($old, $new, 301);
}

Route::get('/subscribe', function () {
    return redirect('/', 301);
});



Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');


Route::get('/contact', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/about-me', function() {
    $abouts= About::all();
    $socialMedias=SocialMedia::all();

    return view('layouts.aboutus' , compact('abouts' , 'socialMedias'));
});

Route::get('/contact', function() {
    return view('layouts.contact');
});
Route::get('/category', function() {
    $categories=Category::all();
    $posts=Post::all();
    $socialMedias=SocialMedia::all();

    return view('layouts.category' , compact('categories' , 'posts' ,'socialMedias'));
});
Route::get('/single-post', function() {
    $categories=Category::all();
    return view('layouts.single-post' , compact('categories'));
});

Route::get('/privacy', function() {
    return view('layouts.privacy');
});

Route::get('/Terms&Conditions', function() {
    return view('layouts.Terms&Conditions');
});


Route::get('/test', function () {
    return 'Test successful!';
});
// ======================================
// OLD LARAVEL ARTICLES → MAIN JOURNEY
// ======================================
Route::redirect(
    '/single-post/my-biggest-laravel-learning-mistakes',
    '/single-post/my-journey-with-laravel-how-this-framework-transformed-the-way-i-learn-think-and-build',
    301
);

Route::redirect(
    '/single-post/why-i-chose-laravel-the-framework-that-changed-how-i-learn-and-build',
    '/single-post/my-journey-with-laravel-how-this-framework-transformed-the-way-i-learn-think-and-build',
    301
);

Route::redirect(
    '/single-post/what-i-wish-i-knew-about-laravel-before-i-started',
    '/single-post/my-journey-with-laravel-how-this-framework-transformed-the-way-i-learn-think-and-build',
    301
);

Route::redirect(
    '/single-post/laravel-was-hard-until-i-understood-this-how-i-learned-laravel-step-by-step',
    '/single-post/my-journey-with-laravel-how-this-framework-transformed-the-way-i-learn-think-and-build',
    301
);
// Session articles → Main Session article

Route::redirect(
    '/single-post/laravel-session-authentication-errors-complete-fix-guide',
    '/single-post/why-sessions-break-in-laravel-understanding-what-actually-happens-behind-the-scenes',
    301
);

Route::redirect(
    '/single-post/laravel-session-expired-error-causes-fix-and-prevention-guide',
    '/single-post/why-sessions-break-in-laravel-understanding-what-actually-happens-behind-the-scenes',
    301
);


Route::get('/post', function () {

    $posts = Post::whereHas('category', function ($query) {
        $query->whereIn('name', [
            'Learning Laravel',
            'Laravel Errors & Solutions',
            'English for Developers'
        ]);
    })->latest()->paginate(50);

    return view('layouts.posts', compact('posts'));

})->name('posts');



Route::get('/networkpost', function () {

    $networkposts = Post::whereHas('category', function ($query) {
        $query->where('name', 'networking');
    })->latest()->paginate(20);

    return view('layouts.network', compact('networkposts'));

})->name('networkposts');



Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');


Route::get('/showpost/{slug}', [DetailsController::class, 'showpost'])->name('showpost.show');
Route::get('/networkpost', [DetailsController::class, 'networks'])->name('network.show');


Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/single-post/{slug}', [DetailsController::class, 'show'])->name('post.single');

//Route::get('/trending', [DetailsController::class, 'trending'])->name('posts.trending');
Route::get('category/{categoryId}', [DetailsController::class, 'indexByCategory'])->name('posts.indexByCategory');
Route::get('/categories/{slug}', [CategoryController::class, 'index'])->name('category.index');


// مسارات المشرفين مع البريفكس 'admin'
Route::prefix('admin')->name('admin.')->group(function () {
    // عرض نموذج تسجيل الدخول للمشرف
    Route::get('/login', [DashboardController::class, 'showLoginForm'])->name('login');
    // معالجة تسجيل الدخول للمشرف
    Route::post('/login', [DashboardController::class, 'adminlogin'])->name('login.submit');
       Route::get('/register', [DashboardController::class, 'showLoginForm'])->name('register');
    // معالجة تسجيل المشرف
    Route::post('/register', [DashboardController::class, 'adminlogin'])->name('login.submit');
    // عرض نموذج التسجيل للمشرف
    // Route::get('/register', [DashboardController::class, 'showRegistrationForm'])->name('register');
    // // معالجة تسجيل المشرف
    // Route::post('/register', [DashboardController::class, 'adminregister'])->name('register.submit');

    // مسارات محمية للمشرفين فقط
    Route::middleware('auth:admin')->group(function () {
        // Show admin dashboard
        Route::get('/index', [DashboardController::class, 'dashboard'])->name('admin.index');


        // Routes for categories
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('category', [CategoryController::class, 'store'])->name('category.store');
        Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::get('category/{id}', [CategoryController::class, 'show'])->name('category.show');




        // Routes for posts

        Route::get('post', [PostController::class, 'index'])->name('post.index');  // Admin posts index
        Route::get('post/create', [PostController::class, 'create'])->name('post.create');
        Route::post('post', [PostController::class, 'store'])->name('post.store');
        Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::put('post/{post}', [PostController::class, 'update'])->name('post.update');
        Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
        Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');


               // Routes for About

        Route::get('about', [AboutController::class, 'index'])->name('about.index');  // Admin posts index
        Route::get('about/create', [AboutController::class, 'create'])->name('about.create');
        Route::post('about', [AboutController::class, 'store'])->name('about.store');
        Route::get('about/{about}/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('about/{about}', [AboutController::class, 'update'])->name('about.update');
        Route::delete('about/{about}', [AboutController::class, 'destroy'])->name('about.destroy');
        Route::get('about/{about}', [AboutController::class, 'show'])->name('about.show');

        // READ: عرض كل السجلات
        Route::get('/admin/social-media', [SocialMediaController::class, 'index'])->name('social-media.index');

        // CREATE: عرض الفورم لإضافة سجل جديد
        Route::get('/admin/social-media/create', [SocialMediaController::class, 'create'])->name('social-media.create');

        // STORE: حفظ السجل الجديد في قاعدة البيانات
        Route::post('/admin/social-media', [SocialMediaController::class, 'store'])->name('social-media.store');

        // SHOW: عرض تفاصيل سجل واحد
        Route::get('/admin/social-media/{socialMedia}', [SocialMediaController::class, 'show'])->name('social-media.show');

        // EDIT: عرض الفورم لتعديل سجل موجود
        Route::get('/admin/social-media/{socialMedia}/edit', [SocialMediaController::class, 'edit'])->name('social-media.edit');

        // UPDATE: تحديث السجل الموجود في قاعدة البيانات
        Route::put('/admin/social-media/{socialMedia}', [SocialMediaController::class, 'update'])->name('social-media.update');

        // DELETE: حذف السجل
        Route::delete('/admin/social-media/{socialMedia}', [SocialMediaController::class, 'destroy'])->name('social-media.destroy');
            });


        // Routes for comments
        Route::get('comment', [CommentController::class, 'countComments'])->name('admin.comment');
        Route::delete('comment/{id}' , [CommentController::class , 'destroy'])->name('comment.destroy');


        // Routes for contacts
        Route::delete('contact/{id}',[ContactController::class,'destroy'])->name('contact.destroy');

        Route::get('/admin/contacts', [ContactController::class, 'showContacts'])->name('admin.contacts');

        // Routes for subscribers

        Route::get('/admin/subscribers', [SubscriberController::class, 'showSubscribers'])->name('subscribers');
        Route::delete('subscriber/{id}' , [SubscriberController::class , 'destroy'])->name('subscriber.destroy');







});
