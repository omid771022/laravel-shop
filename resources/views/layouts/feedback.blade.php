@if(session()->has('feedbacks'))
    @foreach(session()->get('feedbacks') as $message)    
    <p style="direction: ltr; text-align: right">
     {{ $message["body"] }}
    </p>
    @endforeach
@endif