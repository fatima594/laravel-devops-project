@php
use Illuminate\Support\Facades\Request;

// خريطة الصفحات لعرض الاسم الصحيح في البreadcrumb
$pages = [
    '/' => 'Home',
    'aboutus' => 'About',
    'category' => 'Category',
    'posts' => 'Posts',
    'contact' => 'Contact',
];
$currentPath = Request::path(); // المسار الحالي
@endphp

<div class="page-title">
    <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {{-- الصفحة الأولى دائماً Home --}}
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><i class="bi bi-house"></i> Home</a>
                </li>

                @foreach($pages as $path => $name)
                    @if($currentPath === $path && $currentPath != '/')
                        <li class="breadcrumb-item active" aria-current="page">{{ $name }}</li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</div>
