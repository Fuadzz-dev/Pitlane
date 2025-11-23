<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PITLANE - Gallery</title>
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

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        .gallery-item {
            position: relative;
            height: 300px;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            <h1>Gallery</h1>
            <p>Our Collection of Motorcycle Services & Projects</p>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="{{ asset('img/1.jpg') }}" alt="Gallery 1">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/2.jpg') }}" alt="Gallery 2">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/3.jpg') }}" alt="Gallery 3">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/4.jpg') }}" alt="Gallery 4">
            </div>
        </div>
    </div>
</body>
</html>