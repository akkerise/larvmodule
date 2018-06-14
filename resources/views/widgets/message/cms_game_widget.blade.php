@if(session()->has('msg'))
    <ul class="task-list">
        <li>
            <a href="javascript:void(0)" onload="$('.task-list').show(0).delay(5000).hide(0);" class="task-close text-{{ session()->get('msg')['alert'] }}"><i class="fa fa-times"></i></a>
            <label class="checkbox-inline">
                {{ session()->get('msg')['message'] }}
            </label>
        </li>
    </ul>
@endif
