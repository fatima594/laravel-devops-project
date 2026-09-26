<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    // READ (list)
    public function index()
    {
        $socialMedias = SocialMedia::all();
        return view('admin.social_media.index', compact('socialMedias'));
    }

    // CREATE (form)
    public function create()
    {
        return view('admin.social_media.create');
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'instagram' => 'nullable|url',
            'linkedin'  => 'nullable|url',
            'facebook'  => 'nullable|url',
            'github'    => 'nullable|url',
            'twitter'   => 'nullable|url',
        ]);

        SocialMedia::create($data);

        return redirect()->route('admin.social-media.index')
            ->with('success', 'Social media added successfully');
    }

    // EDIT (form)
    public function edit(SocialMedia $socialMedia)
    {
        return view('admin.social_media.edit', compact('socialMedia'));
    }

    // UPDATE
    public function update(Request $request, SocialMedia $socialMedia)
    {
        $data = $request->validate([
            'instagram' => 'nullable|url',
            'linkedin'  => 'nullable|url',
            'facebook'  => 'nullable|url',
            'github'    => 'nullable|url',
            'twitter'   => 'nullable|url',
        ]);

        $socialMedia->update($data);

        return redirect()->route('admin.social-media.index')
            ->with('success', 'Social media updated successfully');
    }

    // DELETE
    public function destroy(SocialMedia $socialMedia)
    {
        $socialMedia->delete();

        return redirect()->route('admin.social-media.index')
            ->with('success', 'Social media deleted successfully');
    }
}
