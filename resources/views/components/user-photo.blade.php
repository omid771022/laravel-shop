<form action="{{route('user.photo')}}" method="post" enctype="multipart/form-data">
<div class="profile__info border cursor-pointer text-center">
    @csrf
    <div class="avatar__img">
        <img src="/uploads/upload/{{auth()->user()->image}}" > 
        <input type="file" accept="image/*" class="hidden avatar-img__input" onchange="this.form.submit();" name="userphoto">
        <div class="v-dialog__container" style="display: block;"></div>
        <div class="box__camera default__avatar"></div>
    </div>
    <span class="profile__name">کاربر : {{auth()->user()->name}}</span>
</div>
</form>