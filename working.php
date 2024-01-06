<?php
// Check if a video URL is provided in the query parameters
if (isset($_POST['videoUrl'])) {
    // Get the video URL from the query parameter
    $videoUrl = $_POST['videoUrl'];
    $timestamp = time();
    // Output directory for frames
    $outputDir = 'frames/'.$timestamp.'/';

    // Create frames directory if not exists
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    // Set the frame extraction interval (e.g., every .20 seconds)
    $frameInterval = 0.20;

    // Use FFmpeg to extract frames from the video
    shell_exec("ffmpeg -i $videoUrl -vf fps=1/$frameInterval $outputDir/frame%02d.jpg");

    // Display the created frames
    $frames = glob($outputDir . '*.jpg');
    echo "<pre>";
    print_r($frames);
    echo "</pre>";

    // Cleanup: Remove individual frames
    // foreach ($frames as $frame) {
    //     unlink($frame);
    // }

    echo 'Frames extracted successfully!';
    header("Location: http://localhost:3000//index.php?timestamp=$timestamp");
    exit;
} else {
    // Display a form to enter the video URL
    echo '
        <form action="" method="post">
            <label for="videoUrl">Enter Video URL:</label>
            <input type="text" name="videoUrl" id="videoUrl" required>
            <input type="submit" value="Extract Frames">
        </form>
    ';
}



// // Replace with the path to your FFmpeg executable
// $ffmpegPath = __DIR__ . '/ffmpeg-6.1.1'; // Update this line

// // Replace with your video URL
// $videoUrl = 'https://dsv7iunirnrax.cloudfront.net/7706796556424/dyor_setting_dyor207_cushion_1_18kwhitegold-4.mp4';

// // Output directory for frames
// $outputDir = 'frames/';

// // Create frames directory if not exists
// if (!file_exists($outputDir)) {
//     mkdir($outputDir, 0777, true);
// }

// // Set the frame extraction interval (e.g., every .20 seconds)
// $frameInterval = .20;

// // Use FFmpeg to extract frames from the video
// shell_exec("$ffmpegPath -i $videoUrl -vf fps=1/$frameInterval $outputDir/frame%02d.jpg");

// // Display the created frames
// $frames = glob($outputDir . '*.jpg');
// echo "<pre>";
// print_r($frames);
// echo "</pre>";

// // Cleanup: Remove individual frames
// // foreach ($frames as $frame) {
// //     unlink($frame);
// // }

// echo 'Frames extracted successfully!';

?>
