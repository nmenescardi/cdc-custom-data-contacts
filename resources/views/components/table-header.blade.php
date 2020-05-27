@props(['title', 'route' => false])

<div class="card-header cdc-table__header">
    <h5 class="d-inline cdc-table__title">{{$title}}</h5>
    @if($route)
    <a href="{{$route}}" class="btn btn-primary btn-plus btn-plus--small">
        <i class="fa fa-plus"></i>
    </a>
    @endif
</div>
