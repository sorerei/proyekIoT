<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
  <div class="register-container">
    <h2 class="title">Register Now!</h2>
    <p class="subtitle">
      Silakan daftar untuk membuat akun dan mulai mengakses sistem<br>
      pemantauan serta pengelolaan data secara real-time.
    </p>

    <form class="register-form" method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Username -->
      <div class="form-group">
        <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required
          autocomplete="username">
        @error('username')
      <div class="input-error">{{ $message }}</div>
    @enderror
      </div>

      <!-- Password -->
      <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
      @error('password')
      <div class="input-error">{{ $message }}</div>
    @enderror

      <!-- Confirm Password -->
      <input type="password" name="password_confirmation" placeholder="Confirm Password" required
        autocomplete="new-password">
      @error('password_confirmation')
      <div class="input-error">{{ $message }}</div>
    @enderror

      <!-- Submit -->
      <button type="submit" class="register-btn">Create Account</button>
    </form>

    <!-- Login redirect -->
    <div class="login-redirect">
      <span>Already have an account? <a href="{{ route('login') }}">Log in here.</a></span>
    </div>
  </div>
</body>

</html>