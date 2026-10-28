@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div style="max-width: 400px; margin: 40px auto; padding: 24px; border: 1px solid #e5e7eb; border-radius: 8px; background: #fff;">
        <h2 style="text-align: center; margin-bottom: 20px;">Login Petugas / Admin</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="color: red; margin-bottom: 16px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div style="margin-bottom: 16px;">
                <label for="email" style="display: block; margin-bottom: 6px;">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label for="password" style="display: block; margin-bottom: 6px;">Password:</label>
                <input type="password" name="password" id="password" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label>
                    <input type="checkbox" name="remember"> Ingat Saya
                </label>
            </div>

            <button type="submit" class="btn" style="width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer;">Login</button>
        </form>
    </div>
@endsection