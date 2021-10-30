<form action="{{route('user.photo')}}" method="post" enctype="multipart/form-data">
<div class="profile__info border cursor-pointer text-center">
    @csrf
    <div class="avatar__img">
        @if (auth()->user()->image)
        <img src="/uploads/upload/{{auth()->user()->image}}" > 
        @else
      <img  src="/img/no-image.jpg" alt="{{auth()->user()->name}}">
        @endif

        <input type="file" accept="image/*" class="hidden avatar-img__input" onchange="this.form.submit();" name="userphoto">
        <div class="v-dialog__container" style="display: block;"></div>
        <div class="box__camera default__avatar"></div>
    </div>
    <span class="profile__name">کاربر : {{auth()->user()->name}}</span>
</div>
</form>