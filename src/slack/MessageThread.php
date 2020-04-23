<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class MessageThread extends BaseModel implements BaseInterface
{
	/**
     * The Slack api url for getting channels replies.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/channels.replies?';

    /** @inheritdoc */
	public function response($params = null): ?array
	{
		try {
			$data = '&channel=' . $params['channel'];
			$data .= '&thread_ts=' . $params['thread'];

			return $this->fetchData($this->url, $data)->messages;
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function getThread(): ?array
{
	try {
		return (new MessageThread)->response($_GET);
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Replying Message</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">
            <a href="ChannelMessages.php?channel=<?= $_GET['channel'] ?>">&#8592; Back</a>
        </div>
    </div>

    <hr />

    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Message</th>
                        <th>Delete Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(getThread() as $key) { ?>
                        <tr>
                            <td><?= $key->user ?? null ?></td>
                            <td><?= $key->text ?></td>
                            <td><?= '<a class="btn btn-danger" target="_blank" href="DeleteMessage.php?channel=' . $_GET['channel'] . '&ts=' . $key->ts . '">Remove this message.</a>' ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

	<hr />

	<div class="container">
		<form method="post" action="ReplyMessage.php">
			<div class="row">
				<div class="col-10">
					<input class="form-control" type="text" name="text" placeholder="Type your reply...">
					<input type="hidden" name="channel" value="<?= $_GET['channel'] ?>">
					<input type="hidden" name="thread" value="<?= $_GET['thread'] ?>">
				</div>
				<div class="col-2">
					<button class="btn btn-success">Send Reply</button>
				</div>
			</div>
		</form>
	</div>

</body>
</html>
