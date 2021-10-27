<div class="col">
    <a href="{{$courseItem->path()}}">
        <div class="course-status">
            @foreach (\App\Course::$enums as $key => $value)
            @if ($key ==$courseItem->enum)
                {{ $value }}
            @endif
        @endforeach
            
         
        </div>
        <div class="discountBadge">
            <p>45%</p>
            تخفیف
        </div>
        <div class="card-img"><img src="/uploads/course/{{$courseItem->media->files}}" alt="{{ $courseItem->title }}"></div>
        <div class="card-title"><h2>{{ $courseItem->title }}</h2></div>
        <div class="card-body">
            @if($courseItem->teacher->image)
            <img src="/uploads/upload/{{$courseItem->teacher->image}}" alt="{{ $courseItem->teacher->name }}">
            @else
            <img src="/img/no-image.jpg" alt="{{ $courseItem->teacher->name }}">
            @endif
        </div>
        <div class="card-details">
            <div class="time">{{ $courseItem->formattedDuration() }}</div>
            <div class="price">
                <div class="discountPrice">{{ $courseItem->getFormattedPrice() }}</div>
                <div class="endPrice">{{ $courseItem->getFormattedPrice() }}</div>
            </div>
        </div>
    </a>
</div>