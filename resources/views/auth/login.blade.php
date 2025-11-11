@extends('auth.layouts')

@section('content')
<style>
    :root {
        --primary-red: #DC143C;
        --accent-pink: #F75270;
        --soft-pink: #F7CAC9;
        --cream: #FDEBD0;
    }

    /* Hanya area login ini */
    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--cream) 0%, var(--soft-pink) 100%);
        padding: 40px 16px;
    }

    .login-card {
        width: 420px;
        /* tetap, mencegah card jadi terlalu sempit */
        max-width: 95%;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        background: #fff;
        border: 1px solid rgba(247, 82, 112, 0.06);
    }

    .login-card .card-header {
        background: linear-gradient(90deg, var(--primary-red), var(--accent-pink));
        color: #fff;
        padding: 20px 24px;
        text-align: center;
        font-weight: 700;
        font-size: 1.25rem;
        line-height: 1.1;
        /* pastikan tidak memecah kata */
        letter-spacing: 0.2px;
    }

    .login-card .card-body {
        padding: 1.6rem;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        border: 1.5px solid var(--soft-pink);
        padding: 10px 12px;
    }

    .form-control:focus {
        border-color: var(--accent-pink);
        box-shadow: 0 0 10px rgba(247, 82, 112, 0.12);
        outline: none;
    }

    .btn-login {
        background: linear-gradient(90deg, var(--accent-pink), var(--primary-red));
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 14px;
        font-weight: 700;
        width: 100%;
    }

    .btn-login:hover {
        background: #fff;
        color: var(--accent-pink);
        border: 2px solid var(--accent-pink);
    }

    .alert-danger {
        border-radius: 10px;
    }

    /* responsive: shrink card vertical spacing on small screens */
    @media (max-width: 480px) {
        .login-card {
            width: 340px;
        }

        .login-card .card-header {
            padding: 16px;
            font-size: 1.15rem;
        }
    }
</style>

<div class="login-page">
    <div class="login-card card">
        @if ($errors->any())
        <div class="p-3">
            <div class="alert alert-danger mb-0">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="card-header">
            Login
        </div>

        <div class="card-body">
            <form action="{{ route('login.submit') }}" method="POST" autocomplete="off">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-login mt-2">Masuk</button>
            </form>
        </div>
    </div>
</div>
@endsection