@extends('layouts.master')

@section('content')
    <main id="single">
        <div class="container">
            <article class="article">
                @include('layouts.header-ads')
                <div class="h-t">
                    <h1 class="title"> {{ $course->name }}</h1>
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="/" title="خانه">خانه</a></li>
                            @if($course->category->parentCategory)
                                <li><a href="{{ $course->category->parentCategory->path() }}"
                                       title="{{ $course->category->parentCategory->name }}">
                                        {{ $course->category->parentCategory->name }}</a>
                            
                                </li>
                            @endif
                            <li><a href="{{ $course->category->path() }}"
                                   title="{{ $course->category->name }}">{{ $course->category->name }}</a></li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
        <div class="main-row container">
            <div class="sidebar-right">
                <div class="sidebar-sticky">
                    <div class="product-info-box">
                        <div class="discountBadge d-none">
                            <p>45%</p>
                            تخفیف
                        </div>
                        <div class="sell_course d-none">
                            <strong>قیمت :</strong>
                            <del class="discount-Price">900,000</del>
                            <p class="price">
                        <span class="woocommerce-Price-amount amount">495,000
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                            </p>
                        </div>
@auth

                        @if(auth()->id() == $course->teacher_id)
                            <p class="mycourse ">شما مدرس این دوره هستید</p>
                        @elseif(auth()->user()->hasAccessToCourse($course->id))
                            <p class="mycourse">شما این دوره رو خریداری کرده اید</p>
                        @else
                            <button class="btn buy">خرید دوره</button>
                        @endif
                        @else
                        <button class="btn buy">خرید دوره</button>
                        @endauth
                        <div class="rating-star">
                            <div class="rating">
                                <div class="star">
                                    <span class="rate" data-rate="1" data-w="100%" data-title="عالی"></span>
                                    <span class="rate" data-rate="2" data-w="80%" data-title="خوب"></span>
                                    <span class="rate" data-rate="3" data-w="60%" data-title="معمولی"></span>
                                    <span class="rate" data-rate="4" data-w="40%" data-title="ضعیف"></span>
                                    <span class="rate" data-rate="5" data-w="20%" data-title="بد"></span>
                                </div>
                                <div class="fstar" style="width: 0">
                                    <span class="frate"></span>
                                    <span class="frate"></span>
                                    <span class="frate"></span>
                                    <span class="frate"></span>
                                    <span class="frate"></span>
                                </div>
                            </div>
                            <div class="schema-stars">
                                <span class="value-rate text-message"> 4 </span>
                                <span class="title-rate"> از </span>
                                <span class="value-rate"> 555 </span>
                                <span class="title-rate">رأی</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-info-box">
                        <div class="product-meta-info-list">
                            <div class="total_sales">
                                تعداد دانشجو : <span>246</span>
                            </div>
                            <div class="meta-info-unit one">
                                <span class="title">تعداد جلسات منتشر شده :  </span>
                                <span class="vlaue">{{ $course->lessonsCount() }}</span>
                            </div>
                            <div class="meta-info-unit two">
                                <span class="title">مدت زمان دوره تا الان : </span>
                                <span class="vlaue">{{ $course->formattedDuration() }}</span>
                            </div>
                            <div class="meta-info-unit three">
                                <span class="title">مدت زمان کل دوره : </span>
                                <span class="vlaue">-</span>
                            </div>
                            <div class="meta-info-unit four">
                                <span class="title">مدرس دوره : </span>
                                <span class="vlaue">{{ $course->teacher->name }}</span>
                            </div>
                            <div class="meta-info-unit five">
                                <span class="title">وضعیت دوره : </span>
                                <span class="vlaue">
                                    
                                  @foreach (\App\Course::$enums as $key => $value)
                                    @if ($key == $course->enum)
                                    {{ $value }}
                                    @endif
                                @endforeach  
                                    
                                   </span>
                            </div>
                            <div class="meta-info-unit six">
                                <span class="title">پشتیبانی : </span>
                                <span class="vlaue">دارد</span>
                            </div>
                        </div>
                    </div>
                    <div class="course-teacher-details">
                        <div class="top-part">
                            <a href="https://webamooz.net/tutor/mohammadnikoo/">
                               @if ($course->teacher->image)
                               <img alt="{{ $course->teacher->image}}" class="img-fluid lazyloaded"
                               src="/uploads/upload/{{ $course->teacher->image}}" loading="lazy" class="img-fluid lazyloaded" >
                               @else
                               <img src="//no-image.jpg" alt="{{ auth()->user()->name }}">

                               @endif
                              
                      
                                <noscript>
                                    <img class="img-fluid" src="/uploads/upload/{{ $course->teacher->image }}" alt="{{ $course->teacher->name }}">
                                </noscript>
                            </a>
                            <div class="name">
                                <a href="https://webamooz.net/tutor/mohammadnikoo/" class="btn-link">
                                    <h6>{{ $course->teacher->name }}</h6>
                                </a>
                                <span class="job-title">{{ $course->teacher->headline }}</span>
                            </div>
                        </div>
                        <div class="job-content">
                           <p>{{ $course->teacher->bio }}</p>
                        </div>
                    </div>
                
                    @include('layouts.sidebar-banners')

                </div>
            </div>
            <div class="content-left">
                <div class="preview">
                    <video width="100%" controls>
                        <source src="intro.mp4" type="video/mp4">
                    </video>
                </div>
                <a href="#" class="episode-download">دانلود این قسمت ({{$lesson->proiority}})</a>
                <div class="course-description">
                    <div class="course-description-title">توضیحات دوره</div>
                    <div>
                        {!! $course->body !!}
                    </div>
                    {{-- <div class="tags">
                        <ul>
                            <li><a href="">ری اکت</a></li>
                            <li><a href="">reactjs</a></li>
                            <li><a href="">جاوااسکریپت</a></li>
                            <li><a href="">javascript</a></li>
                            <li><a href="">reactjs چیست</a></li>
                        </ul>
                    </div> --}}
                </div>
         @include('layouts.episodes-list')
            </div>
        </div>
    </main>
    <br>
@endsection