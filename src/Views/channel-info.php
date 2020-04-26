<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Channel Info</title>
</head>
<body>
    <a style="color: red"><?= isset($params['error']) ? $params['error'] : null ?></a>
    <p>You can loop on the data and show whatever you want.</p>
    <?php print_r(isset($params['channelInfo']) ? $params['channelInfo'] : null) ?>
</body>
</html>
