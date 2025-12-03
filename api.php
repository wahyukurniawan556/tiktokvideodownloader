<?php

// $allowed = "https://tikdownloader.42web.io/";

// if (!isset($_SERVER['HTTP_REFERER']) ||
//     strpos($_SERVER['HTTP_REFERER'], $allowed) !== 0) {
//     http_response_code(403);
//     die("403 Forbidden");
// }


// $secret = "kuncisuperrahasia123";

// if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
//     die("Unauthorized");
// }


if (!isset($_GET['url'])) {
    die("URL tidak ditemukan.");
}

$url = $_GET['url'];

$api_url = "https://tikwm.com/api/";

// CURL POST
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    "url" => $url,
    "hd"  => 1
]);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "User-Agent: Mozilla/5.0"
]);

$response = curl_exec($ch);
curl_close($ch);

// Decode JSON
$data = json_decode($response, true);

if (!$data || $data['code'] != 0) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die("Gagal mengambil data video. Pastikan link benar & bukan private.");
}

$video_no_wm = $data['data']['play']; // remove Wm
$judul = $data['data']['title'];      // title


$judul_bersih = preg_replace('/[^a-zA-Z0-9-_ ]/', '', $judul);
$nama_file = $judul_bersih . "_tikdownloader.mp4";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <title>Download Video</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; padding:40px; text-align:center; }
        .box { background:white; padding:30px; border-radius:12px; max-width:600px; margin:auto; }
        video { width:100%; border-radius:10px; }
        a { display:block; margin-top:20px; background:#ff335e; padding:12px; border-radius:8px; color:white; text-decoration:none;}
    </style>
</head>
<body>

<div class="box">
    <h2>Video Siap Diunduh</h2>

    <video controls>
        <source src="<?= $video_no_wm ?>">
    </video>

    <a href="download.php?url=<?= urlencode($video_no_wm) ?>&name=<?= urlencode($nama_file) ?>">
    Download Video Tanpa Watermark
</a>

</div>

</body>
</html>
