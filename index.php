<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo.png">
    <title>TikTok Downloader</title>
    <style>
        :root {
            --primary-color: #fe2c55;
            --secondary-color: #25f4ee;
            --dark-color: #121212;
            --light-color: #ffffff;
            --gray-color: #f8f8f8;
            --text-color: #333333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--gray-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            text-align: center;
            padding: 30px 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .logo {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
        .main-content {
            background-color: var(--light-color);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .input-group {
            display: flex;
            margin-bottom: 20px;
        }
        
        .input-group input {
            flex: 1;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 5px 0 0 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .input-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        .input-group button {
            padding: 0 25px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        
        .input-group button:hover {
            background-color: #e41c47;
        }
        
        .result {
            margin-top: 30px;
            display: none;
        }
        
        .video-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .video-info h3 {
            margin-bottom: 10px;
            color: var(--dark-color);
        }
        
        .video-preview {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .video-preview video {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .download-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        
        .download-btn {
            padding: 12px 20px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }
        
        .download-btn:hover {
            background-color: #e41c47;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(254, 44, 85, 0.3);
        }
        
        .download-btn.watermark {
            background-color: var(--secondary-color);
        }
        
        .download-btn.watermark:hover {
            background-color: #1dd9d4;
            box-shadow: 0 4px 10px rgba(37, 244, 238, 0.3);
        }
        
        .loading {
            text-align: center;
            padding: 20px;
            display: none;
        }
        
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }
        
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        
        .error {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            display: none;
        }
        
        .instructions {
            margin-top: 30px;
            background-color: #f0f8ff;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid var(--secondary-color);
        }
        
        .instructions h3 {
            margin-bottom: 10px;
            color: var(--dark-color);
        }
        
        .instructions ol {
            margin-left: 20px;
        }
        
        .instructions li {
            margin-bottom: 8px;
        }
        
        footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: #777;
            font-size: 0.9rem;
        }
        
        @media (max-width: 600px) {
            .input-group {
                flex-direction: column;
            }
            
            .input-group input {
                border-radius: 5px;
                margin-bottom: 10px;
            }
            
            .input-group button {
                border-radius: 5px;
                padding: 15px;
            }
            
            .download-options {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">⬇️</div>
            <h1>TikTok Downloader</h1>
            <p>Unduh video TikTok tanpa watermark dengan mudah</p>
        </header>
        
        <div class="main-content">
            <form action="api.php" method="GET">
                 <div class="input-section">
                <div class="input-group">
                    <input type="text" name="url" placeholder="Tempel link TikTok di sini..." required>
                    <button id="download-btn">Download</button>
                </div>
            </div>
            <div class="instructions">
                <h3>Cara Menggunakan:</h3>
                <ol>
                    <li>Buka aplikasi TikTok dan pilih video yang ingin diunduh</li>
                    <li>Tekan tombol "Bagikan" dan salin tautan video</li>
                    <li>Tempel tautan di kolom di atas dan tekan tombol "Download"</li>
                    <li>Pilih opsi download sesuai keinginan Anda</li>
                </ol>
            </div>
        </div>
        
        <footer>
            <p>&copy; 2023 TikTok Downloader. Alat ini hanya untuk penggunaan pribadi.</p>
        </footer>
    </div>
</body>
</html>