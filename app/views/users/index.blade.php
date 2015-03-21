<!-- app/views/users/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('users') }}">User Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('users') }}">View All Users</a></li>
        <li><a href="{{ URL::to('users/create') }}">Create a User</a>
    </ul>
</nav>

<h1>All the users</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Created</td>
            <td>Updated</td>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $value)
        <tr>
            <td>{{ $value->user_id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->created_at }}</td>
            <td>{{ $value->updated_at }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /users/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

                <!-- show the nerd (uses the show method found at GET /users/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('users/' . $value->id) }}">Show this Nerd</a>

                <!-- edit this nerd (uses the edit method found at GET /users/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('users/' . $value->id . '/edit') }}">Edit this Nerd</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>