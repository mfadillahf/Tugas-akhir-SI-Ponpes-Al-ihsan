@extends('layouts.auth')

@section('title', 'Login | Ponpes Al-Ihsan')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="/login"><b>Ponpes</b> Al-Ihsan</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Silakan Login</p>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required />
                    <div class="input-group-text"><span class="bi bi-person"></span></div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                </div>

                {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" />
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <a href="#" class="text-decoration-none">I forgot my password</a>
                </div> --}}
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
            </form>
        </div>
    </div>
</div>
@endsection
