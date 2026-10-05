{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($pages as [$url, $priority])
    <url>
        <loc>{{ $url }}</loc>
        <lastmod>{{ \Illuminate\Support\Carbon::parse($lastmod)->toAtomString() }}</lastmod>
        <priority>{{ $priority }}</priority>
    </url>
@endforeach
</urlset>
