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
            <img src="/uploads/course/{{$courseItem->media->files}}" alt="{{ $courseItem->teacher->name }}">
            <span>{{ $courseItem->teacher->name }}</span>
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