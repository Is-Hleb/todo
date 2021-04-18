@extends("layouts.main")

@section("body")
    <nav class="navbar navbar-expand-lg bg-dark mb-5">
        <h2 class="text-center text-white w-100">ToDo</h2>
        <a class="btn btn-danger" href="{{ route("auth.logout") }}">Logout</a>
    </nav>
    <div id="app"></div>
@endsection
