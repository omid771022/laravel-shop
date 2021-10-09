@extends('layouts.master')
@section('content')
    <article class="container article">
        @include('layouts.header-ads')
        @include('layouts.top-info')
        @include('layouts.latestCourses')
        @include('layouts.popularCourses')
    </article>
    @include('layouts.latestArticles')
@endsection


