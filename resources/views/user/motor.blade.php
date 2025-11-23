<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PITLANE - Motorcycles</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            min-height: 100vh;
            color: #fff;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 100px 40px 40px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .page-header h1 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #888;
            font-size: 18px;
        }

        .motors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .motor-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .motor-card:hover {
            transform: translateY(-10px);
        }

        .motor-image {
            width: 100%;
            height: 200px;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
        }

        .motor-info {
            padding: 20px;
        }

        .motor-info h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .motor-info p {
            color: #888;
            font-size: 14px;
        }

        .back-btn {
            display: inline-block;
            padding: 12px 30px;
            background: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.2);
        }
    </style>
</head>
<body>
    <x-loadingscreen></x-loadingscreen>
    
    <div class="container">
        <a href="{{ route('home') }}" class="back-btn">← Back to Home</a>
        
        <div class="page-header">
            <h1>Motorcycles</h1>
            <p>Browse Our Collection of Supported Motorcycles</p>
        </div>

        <div class="motors-grid">
            @forelse($motors ?? [] as $motor)
            <div class="motor-card">
                <div class="motor-image">🏍️</div>
                <div class="motor-info">
                    <h3>{{ $motor->merk }} {{ $motor->model }}</h3>
                    <p>Year: {{ $motor->tahun }}</p>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 60px;">
                <p style="font-size: 18px; color: #888;">No motorcycles data available yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>