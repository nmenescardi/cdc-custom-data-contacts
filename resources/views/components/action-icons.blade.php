@props(['routeEdit' => false, 'routeDelete' => false])

<div class="action-column">
    @if($routeEdit)
    <a href="{{$routeEdit}}" class="action-icon"><i class="fas fa-edit"></i></a>
    @endif

    @if($routeDelete)
    <form action="{{$routeDelete}}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="action-icon"><i class="fas fa-trash-alt"></i></button>
    </form>
    @endif

</div>
