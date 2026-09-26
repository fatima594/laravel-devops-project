<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;



class AboutController extends Controller
{
    public function index(){
        $abouts= About::all();
        return view('admin.about.index' , compact('abouts'));
        }

    public function create(){
        return view('admin.about.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([

            'name'=>'required|string',
            'title'=>'required|string',
            'body'=>'required|string',
            'image' => 'nullable|image',
        ]);

        if($request->hasFile('image')){
            $imagePath=$request->file('image')->store('about' , 'public');
        }

        About::create([
            'name'=>$validateData['name'],
            'title'=>$validateData['title'],
            'body'=>$validateData['body'],
            'image'=>$imagePath,
        ]);

        return redirect()->route('admin.about.index')->with('success' , 'About Added Successfully');
    }


    public function show(About $about){
        $about= About::findOrFail($about->id);
        return view('admin.about.show' ,compact('about'));
    }


    public function edit(About $about){
         $about= About::findOrFail($about->id);
        return view('admin.about.edit' ,compact('about'));
    }


    public function update(Request $request , About $about){

         $about= About::findOrFail($about->id);

         $validateData = $request->validate([

            'name'=>'required|string',
            'title'=>'required|string',
            'body'=>'required|string',
            'image' => 'nullable|image',
        ]);

         if ($request->hasFile('image')) {
        $validateData['image'] = $request->file('image')->store('about', 'public');
    }
           $about->update($validateData);

        return redirect()->route('admin.about.index')->with('success' , 'About Updated Successfully');


    }


    public function destroy(About $about){


       $about= About::findOrFail($about->id);

       $about->delete();

       return redirect()->route('admin.about.index')->with('success' , 'About Deleted Successfully');


    }
}
