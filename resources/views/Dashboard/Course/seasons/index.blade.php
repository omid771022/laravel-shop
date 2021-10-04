<div class="col-12 bg-white margin-bottom-15 border-radius-3">
    <p class="box__title">سرفصل ها</p>
    @include('Dashboard.commen.feedback')
    <form action="{{ route('seasons.store', $course->id) }}" method="post" class="padding-30">
        @csrf 
        <input type="text" name="title" placeholder="عنوان سرفصل" class="text"  />
        <x-validation-error field="title" />
        <input type="text" name="number" placeholder="شماره سرفصل" class="text" />
        <x-validation-error field="number" />
        <button type="submit" class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
    <div class="table__box padding-30">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th class="p-r-90">شناسه</th>
                <th>عنوان فصل</th>
                <th>وضعیت </th>
                <th>وضعیت تایید</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
                
            @foreach($course->seasons as $season)
            <tr role="row" class="">
                <td><a href="">{{ $season->number }}</a></td>
                <td><a href="">{{ $season->title }}</a></td>
                <td>
                    @foreach (\App\Season::$confirmationStatus as $key => $value)
                    @if ($key == $season->confirmation_status)
                        {{ $value }}
                    @endif
                @endforeach
                </td>
                <td>
                    
                    @foreach (\App\Season::$statuses as $key => $value)
                    @if ($key == $season['status'])
                        {{ $value }}
                    @endif
                @endforeach
                   </td>
              
                 


                               <td>
                 
                    <a href="{{route('seasons.delete', $season['id'] )}}" onclick="return confirm(' ایا مطمن هستید که میخواهید  این قسمت را حذف کنید')" class="item-delete mlg-15" title="حذف"></a>
                    <a href="{{route('seasons.reject', $season['id'])}}" class="item-reject mlg-15" title="رد"></a>
                    <a href="{{route('seasons.accept', $season['id'])}}" class="item-confirm mlg-15" title="تایید"></a>
                    <a href="{{route('seasons.edit' , $season->id)}}" class="item-edit " title="ویرایش"></a>
                @if ($season['status'] == 'open'  )
                <a href="{{ route('seasons.lock',$season->id) }}"
                    onclick="return confirm('آیا منطمن هستید که می خواهید دوره را در حالت قفل قرار دهید')"
                    class="item-lock mlg-15 text-success"></a>
                @else
                <a href="{{ route('seasons.open',$season->id) }}" 
                    onclick="return confirm('آیا منطمن هستید که می خواهید دوره را در حالت باز قرار دهید')"
                   
                    class="item-lock mlg-15 text-error"></a>
                @endif
                
                  
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div> 