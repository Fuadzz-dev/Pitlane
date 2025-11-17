<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PITLANE Login</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      background: radial-gradient(circle at top left, #f9f9f9, #e8e8e8);
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .login-container {
      display: flex;
      align-items: center;
      background: #fff;
      border-radius: 25px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      width: 900px;
      height: 700px;
      animation: fadeIn 1s ease;
    }

    .image-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .image-container img {
      width: 90%;
      border-radius: 30px;
    }

    .form-container {
      flex: 1;
      padding: 60px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      animation: slideIn 1.2s ease;
    }

    .form-container .logo {
      width: 50px;
      height: auto;
      margin-bottom: 10px;
      animation: spin 6s linear infinite;
    }

    .form-container h2 {
      margin: 0;
      font-size: 32px;
      letter-spacing: 1px;
    }

    .form-container p {
      color: #777;
      margin: 8px 0 25px 0;
      font-size: 14px;
    }

    .form-container input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-container input:focus {
      border-color: #333;
      outline: none;
      box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
    }

    .form-container button {
      width: 100%;
      padding: 14px;
      background: #222;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
      transition: all 0.3s ease;
    }

    .form-container button:hover {
      background: #444;
      transform: scale(1.03);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .form-container a {
      color: #007bff;
      text-decoration: none;
      font-weight: 500;
    }

    .form-container a:hover {
      text-decoration: underline;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes slideIn {
      from {
        transform: translateX(50px);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="image-container">
      <!-- Ganti dengan gambar motor kamu -->
      <img src="Untitled-13.png" alt="Motorbike Image" />
    </div>

    <div class="form-container">
      <!-- Logo di atas tulisan SIGN IN -->
      <img src="gerigi.png" alt="Logo" class="logo" />
      <h2>SIGN IN</h2>
      <p>Masukkan data secara benar dan sebenarnya</p>

      <!-- Form dengan action ke route register.post -->
      <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <input 
          type="text" 
          name="nama" 
          placeholder="Nama" 
          value="{{ old('nama') }}" 
          required 
        />
        

        <input 
          type="email" 
          name="email" 
          placeholder="Email" 
          value="{{ old('email') }}" 
          required 
        />
        

        <input 
          type="text" 
          name="no_hp" 
          placeholder="No HP" 
          value="{{ old('phone') }}" 
          required 
        />
        <!-- @error('phone')
          <div class="error-message">{{ $message }}</div>
        @enderror -->

        <input 
          type="password" 
          name="password" 
          placeholder="Password (minimal 8 karakter)" 
          required 
        />  

        <input 
          type="password" 
          name="password_confirmation" 
          placeholder="Konfirmasi Password" 
          required 
        />

        <!-- Tampilkan semua error jika ada -->
      @if ($errors->any())
        <div class="alert-error">
          @foreach ($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
        </div>
      @endif  

        <button type="submit">SIGN UP </button>
      </form>

      <p style="margin-top: 20px;">Sudah punya akun? <a href="{{ route('login') }}">login</a></p>
      
    </div>
  </div>
</body>
</html>
