<div class="card" style="width: 18rem;">
    <img src="{{asset("storage/{$user->logo}")}}" class="card-img-top" alt="{{$user->name}}">
    <div class="card-body">
        <h5 class="card-title">{{$user->name}}</h5>
        <p class="card-text">{{$user->email}}</p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">{{$user->is_admin = 1 ? 'Admin' : 'User'}}</li>
        <li class="list-group-item">ID: {{$user->id}}</li>
    </ul>
    <div class="card-body">
        <a href="#" class="card-link">Edit</a>
        <a href="#" class="card-link">Delete</a>
    </div>
</div>
