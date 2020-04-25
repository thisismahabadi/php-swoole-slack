<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Channels List</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>Channel Name</th>
                <th>Channel Info</th>
                <th>Leave Channel</th>
                <th>Join Channel</th>
                <th>Messages</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($params['channels'] as $key) { ?>
                <tr>
                    <td><?= $key->name ?></td>
                    <td><?= '<a class="btn btn-primary" target="_blank" href="/channels/info?channel=' . $key->id . '">Click to visit channel\'s info.</a>' ?></td>
                    <td><?= '<a class="btn btn-danger" target="_blank" href="/channels/leave?channel=' . $key->id . '">Click to leave this channel.</a>' ?></td>
                    <td><?= '<a class="btn btn-success" target="_blank" href="/channels/join?channelName=' . $key->name . '">Click to join this channel.</a>' ?></td>
                    <td><?= '<a class="btn btn-info" target="_blank" href="/channels/messages?channel=' . $key->id . '">Click here to manage messages in the channel.</a>' ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
