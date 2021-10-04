
  
@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')

    @include('Dashboard.commen.feedback')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی سرفصل</p>
            <form action="{{ route('season.update', $season->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input type="text" name="title" placeholder="عنوان سرفصل" class="text" value="{{ $season->title }}" required />
                <input type="text" name="number" placeholder="شماره سرفصل" class="text" value="{{ $season->number }}" />
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی سرفصل</button>
            </form>
        </div>
    </div>
    @section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
@endsection

