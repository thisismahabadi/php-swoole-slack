<?php
    require __DIR__ . '/../classes/slack/ChannelInfo.php';

    function getInfo()
    {
        try {
            $channelInfo = (new ChannelInfo)->response($_GET['channel']);

            return $channelInfo;
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Channel Info</title>
</head>
<body>
    <p>You can loop on the data and show whatever you want.</p>
    <?php print_r(getInfo()) ?>
</body>
</html>
