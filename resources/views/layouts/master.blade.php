@section('header')
@include('layouts.header')
@show

@section('headerpost')
@include('layouts.headerpost')
@show

   <!-- /Blog Hero Section -->

    <!-- Featured Posts Section -->
    @section('featurepost')
    @include('layouts.featurepost')
   @show
    <!-- /Featured Posts Section -->

    <!-- Category Section Section -->

   @section('categoryhome')
    @include('layouts.categoryhome')
   @show



    @section('calltoaction')
    @include('layouts.calltoaction')
   @show


    <!-- Latest Posts Section -->
    @section('latestpost')
    @include('layouts.latestpost')
    @show
    <!-- /Latest Posts Section -->

    <!-- Call To Action Section -->
     @section('subscriber')
    @include('layouts.subscriber')
    @show
  <!-- /Call To Action Section -->


 @section('footer')
    @include('layouts.footer')
    @show
