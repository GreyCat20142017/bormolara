<form class="text-center p-0 m-0"
      action="{{route($route, [$modelName => $row])}}"
      method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-link" type="submit" title="Внимание! Запись будет удалена!">
        удаление
    </button>
</form>
