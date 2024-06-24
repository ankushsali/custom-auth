@extends("layouts.app")

@section("title", "Register")

@section("content")
<form class="form" action="{{ route('register') }}" method="post">
    @csrf
    <h2>Register</h2>
    <div class="form-group">
        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Name">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Phone">
        @error('phone')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Password">
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit">Register</button>
    </div>
    <div class="form-group">
        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</form>
@endsection