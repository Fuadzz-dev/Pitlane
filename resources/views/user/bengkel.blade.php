<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PITLANE - Workshops</title>
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

        .workshops-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .workshop-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 30px;
            transition: transform 0.3s ease;
        }

        .workshop-card:hover {
            transform: translateY(-5px);
            border-color: #00bcd4;
        }

        .workshop-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .workshop-name {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .workshop-info {
            color: #aaa;
            font-size: 14px;
            line-height: 1.8;
        }

        .workshop-info div {
            margin-bottom: 8px;
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
        <a href="{{ Route('user.home') }}" class="back-btn">← Back to Home</a>
        
        <div class="page-header">
            <h1>Our Workshops</h1>
            <p>Find the Best Workshop Near You</p>
        </div>

        <div class="workshops-grid">
            @forelse($workshops ?? [] as $workshop)
            <div class="workshop-card">
                <div class="workshop-icon">🏪</div>
                <div class="workshop-name">{{ $workshop->nama_bengkel }}</div>
                <div class="workshop-info">
                    <div>📍 {{ $workshop->alamat }}</div>
                    @if($workshop->no_hp)
                    <div>📞 {{ $workshop->no_hp }}</div>
                    @endif
                    @if($workshop->email)
                    <div>📧 {{ $workshop->email }}</div>
                    @endif
                    @if($workshop->jam_operasional)
                    <div>🕐 {{ $workshop->jam_operasional }}</div>
                    @endif
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 60px;">
                <p style="font-size: 18px; color: #888;">No workshops available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>