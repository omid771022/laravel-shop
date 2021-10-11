<div class="episodes-list">
    <div class="episodes-list--title">
        فهرست جلسات
        <span>دریافت همه لینک های دانلود</span>

    </div>
    <div class="episodes-list-section">
   @foreach ($lessons as $key=> $lesson)

   <div class="episodes-list-item ">
    <div class="section-right">
        <span class="episodes-list-number">{{$lesson->proiority}}</span>
       
        <div class="episodes-list-title">
            <a href="{{$lesson->path() }}" > {{$lesson->title}} </a>
      
      </div>
    </div>
    <div class="section-left">
        <div class="episodes-list-details">
            <div class="episodes-list-details">
                <span class="detail-type">
    
                    @foreach (\App\Lesson::$statuses as $key => $value)
                    @if ($key == $lesson->type)
                    {{ $value }}
                    @endif
                @endforeach  
                    


                </span>
                <span class="detail-time">{{$lesson->time}}</span>
                <a class="detail-download">
                    <i class="icon-download"></i>
                </a>
            </div>
        </div>
    </div>
</div>
   @endforeach
      
   
    
    </div>
</div>