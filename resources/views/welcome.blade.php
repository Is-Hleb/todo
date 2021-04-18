@extends("layouts.main")

@push("head")

    <style type="text/css">
        .todo-head {
            background-color: #e9ecef;
        }
    </style>

@endpush

@section("body")
    <header>
        <div class="container-fluid p-5 todo-head">
            <div class="container">
                <h1>ToDo</h1>
                <p>I`is task</p>
                <p>
                    <a class="btn btn-primary" href="{{ route("guest.show_register") }}">Register</a>
                    <a class="btn btn-primary" href="{{ route("guest.show_login") }}">Login</a>
                </p>
            </div>
        </div>
    </header>

@endsection
