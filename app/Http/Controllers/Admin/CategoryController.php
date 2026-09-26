<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Image\ImageService; // استيراد ImageService
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{

    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;

    }
    public function index()
    {
        $categories = Category::all(); // جلب جميع الفئات
        if (request()->wantsJson()) {
            return response()->json($categories);
        }

        return view('admin.category.index', compact('categories')); // عرض الفئات في العرض
    }



    public function create()
    {
        return view('admin.category.create');
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:8',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|',

        ]);

             // معالجة الصورة باستخدام ImageService
         if ($request->hasFile('image')) {
             $imagePath = $this->imageService->fitAndSave($request->file('image'), 800, 600);

             if ($imagePath) {
        // تعيين مسار الصورة إذا تم معالجتها بنجاح
        $validatedData['image'] = $imagePath;
             } else {
        // التعامل مع الخطأ إذا فشلت معالجة الصورة
        return redirect()->back()->withErrors(['image' => 'فشل في معالجة الصورة.']);
             }
         }
         Category::create([
           'name' => $validatedData['name'],
           'image' => $validatedData ['image'],

         ]);
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }


    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id); // استخدم findOrFail مع ID

        // التحقق من صحة البيانات الواردة
        $validatedData = $request->validate([
            'name' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // معالجة رفع الصورة باستخدام ImageService
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($category->image) {
                Storage::disk('public')->delete($category->image); // حذف الصورة القديمة من التخزين
            }

            // معالجة الصورة الجديدة باستخدام ImageService
            $imagePath = $this->imageService->fitAndSave($request->file('image'), 800, 600); // تغيير الأبعاد حسب الحاجة

            if ($imagePath) {
                // تعيين مسار الصورة الجديدة
                $validatedData['image'] = $imagePath;
            } else {
                // في حالة فشل معالجة الصورة
                return redirect()->back()->withErrors(['image' => 'فشل في معالجة الصورة.']);
            }
        }

        // تحديث المنشور في قاعدة البيانات
        $category->update([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'] ?? $category->image, // إذا لم يتم إرسال صورة جديدة، احتفظ بالصورة القديمة
        ]);


        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
//        return back();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
}



