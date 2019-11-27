<div class='btn-group'>
    <a class="btn btn-sm btn-primary mx-1" href="{{route($modelName . '.create', ['parent' => $parent ?? null])}}">
        Создать {{trans('common.' . $modelName)}}
    </a>
    <a class="btn btn-sm btn-primary mx-1" href={{url()->previous()}}>Назад</a>
</div>
