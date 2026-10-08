@extends('layouts.site')

@section('title', 'Page Not Found')
@section('description', 'The page you are looking for could not be found.')
@section('robots', 'noindex, follow')

@section('content')
    <div class="et_pb_section">
        <div class="et_pb_row row-800">
            <div class="col col-4_4">
                <div class="mod t-center"><p class="error-code">404</p></div>
                <div class="mod mb-10 t-center"><h1 class="h52 c-green">Page not found</h1></div>
                <div class="mod txt16 t-center"><p>Sorry, the page you are looking for doesn't exist or has been moved.</p></div>
                <div class="mod txt16 t-center" style="margin-bottom:30px"><p lang="ur">معذرت، آپ جس صفحے کی تلاش میں ہیں وہ موجود نہیں ہے۔</p></div>
                <div class="mod error-actions">
                    <a class="et_pb_button btn-green" href="{{ route('home') }}">Go Home</a>
                    <a class="et_pb_button btn-green" href="{{ route('products') }}">Our Products</a>
                    <a class="et_pb_button btn-green" href="{{ route('contact') }}">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

@endsection
