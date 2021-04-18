@extends("layouts.main")

@push("head")
    <style type="text/css">
        :root {
            --input-padding-x: .75rem;
            --input-padding-y: .75rem;
        }

        input {
            min-height: 3em;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .todo-register {
            width: 100%;
            max-width: 420px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group > input,
        .form-label-group > label {
            padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group > label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0; /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown) ~ label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
        }

        .alert {
            background-color: #f9a19e;
        }

    </style>
@endpush

@section("body")
    <form class="todo-register" id="register_form" method="POST">
        <div class="form-label-group">
            <h2 class="py-2">Registration
                <div id="preloader" class="spinner-grow d-none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </h2>
        </div>
        <div class="form-label-group" id="errors">

        </div>
        <div class="form-label-group">
            <input class="form-control" id="login" type="text" placeholder="Enter login">
            <label for="login">Enter login</label>
        </div>
        <div class="form-label-group">
            <input class="form-control" id="email" type="email" placeholder="Enter email">
            <label for="email">Enter email</label>
        </div>
        <div class="form-label-group">
            <input class="form-control" id="password" autocomplete="false" type="password" placeholder="Enter password">
            <label for="password">Enter password</label>
        </div>
        <div class="form-label-group">
            <input class="form-control" id="repit_password" autocomplete="false" type="password"
                   placeholder="Repit password">
            <label for="repit_password">Repit password</label>
        </div>
        <div class="form-label-group">
            <a class="btn btn-primary" href="{{ route("guest.show_login") }}">Login</a>
            <button type="button" id="submit_btn" class="btn btn-success">register</button>
        </div>
    </form>
@endsection



@push("head")
    <script type="text/javascript" src="{{ asset("js/other/register.js") }}" defer>
    </script>
@endpush
