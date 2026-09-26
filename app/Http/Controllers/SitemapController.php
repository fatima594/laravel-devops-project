<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // الصفحة الرئيسية
        $sitemap->add(
            Url::create(url('/'))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0)
        );

        // روابط المقالات (حسب route name عندك)
        Post::select('slug', 'updated_at')->chunk(500, function ($posts) use ($sitemap) {
            foreach ($posts as $post) {
                $sitemap->add(
                    Url::create(route('post.single', $post->slug))
                        ->setLastModificationDate($post->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8)
                );
            }
        });

        return response($sitemap->render(), 200)
            ->header('Content-Type', 'text/xml');
    }
}
