<?php $this->layout('base::template', ['title' => 'My Node']); 

$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
$ff = ['node_hostname', 'node_ownername', 'node_pubkey', 'node_country', 'node_map_privacy', 'node_map_enabled', 'node_lat', 'node_lng', 'node_msg_privacy', 'node_msg_enabled', 'node_api_enabled', 'node_dev_id', 'node_dev_secret'];
$fn = [];
$fn = $csrf->form_names($ff, false);

$known = false;
$node = $node->get($ip);
if($node !== false && $ip !== 'fcec:ae97:8902:d810:6c92:ec67:efb2:3ec5')
{
	$node_ownername = !empty( $node->ownername ) ? $this->e( $node->ownername ) : "Undefined";
	$node_latency = !empty( $node->latency )? (int) $node->latency : "?";
	$node_version = !empty( $node->cjdns_protocol) ? (int) $node->cjdns_protocol : "?";
	$node_peers = 0;
	$node_hostname = ( !empty( $node->hostname ) && $node->hostname !== null ) ? $this->e( $node->hostname ) : "Hostname not set!";
	$node_pubkey =  ( !empty( $node->public_key ) && $node->public_key !== null ) ? $this->e( $node->public_key ) : "Undefined";
	$node_country = ( !empty( $node->country ) && $node->country !== null ) ? $this->e( $node->country ) : "Undefined";
	$node_lat = ( !empty( $node->lat ) && $node->lat !== null) ? $this->e( $node->lat ) : "Undefined";
	$node_lng = ( !empty( $node->lng ) && $node->lng !== null) ? $this->e( $node->lng ) : "Undefined";
	$node_dev_id = null;//!empty( $node->api_keyid ) ? $this->e( $node->api_keyid ) : 'Generate new key';
	$node_dev_secret = null;//!empty( $node->api_secretkey ) ? $this->e( $node->api_secretkey ) : 'Generate new key';
	$known = true;

	$node_meshmap_privacy = 1;
	$fm_mp1 = $fm_mp2 = $fm_mp3 = null;
	switch ($node_meshmap_privacy) {
		case 1:
		$fm_mp1 = 'disabled';
		break;
		case 2:
		$fm_mp2 = 'disabled';
		break;
		case 3:
		$fm_mp3 = 'disabled';
		break;
		
		default:
		$fm_mp1 = 'disabled';
		break;
	}

	$node_msg_privacy = 1;
	$fm_msg1 = $fm_msg2 = $fm_msg3 = null;
	switch ($node_meshmap_privacy) {
		case 1:
		$fm_msg1 = 'disabled';
		break;
		case 2:
		$fm_msg2 = 'disabled';
		break;
		case 3:
		$fm_msg3 = 'disabled';
		break;
		
		default:
		$fm_msg1 = 'disabled';
		break;
	}
	$node_msg_enabled = 1;//(int) $node->msg_enabled;
	$fm_msg_false = $fm_msg_true = null;
	switch ($node_msg_enabled) {
		case 1:
		$fm_msg_false = 'disabled';
		break;
		case 2:
		$fm_msg_true = 'disabled';
		break;
		
		default:
		$fm_msg_false = 'disabled';
		break;
	}
	$node_api_enabled = 1; // (int) $node->api_enabled;
	$fm_api_false = $fm_api_true = null;
	switch ($node_api_enabled) {
		case 1:
		$fm_api_false = 'disabled';
		break;
		case 2:
		$fm_api_true = 'disabled';
		break;
		
		default:
		$fm_api_false = 'disabled';
		break;
	}

	$node_dev_id = null; // FIXME $node->api_keyid;
	$node_dev_secret = null; // FIXME $node->api_secretkey;


}
else
{
	$node_ownername = "Undefined";
	$node_latency = "?";
	$node_version = "?";
	$node_peers = 0;
	$node_hostname = "Hostname not set";
	$node_pubkey = "Undefined";
	$node_country = "Undefined";
	$node_lat = null;
	$node_lng = null;
	$node_dev_id = "Generate new key";
	$node_dev_secret = "Generate new key";
}

if(isset($_POST))
{
	$node = new Node();
	if($csrf->check_valid('post')) {
		(isset($_POST[$fn['node_hostname']]) && !empty($_POST[$fn['node_hostname']]) && strlen($_POST[$fn['node_hostname']]) > 4) ? $node->postUpdate('node_hostname', $_POST[$fn['node_hostname']], $ip) : null;
		(isset($_POST[$fn['node_ownername']]) && !empty($_POST[$fn['node_ownername']]) && strlen($_POST[$fn['node_ownername']]) > 4) ? $node->postUpdate('node_ownername', $_POST[$fn['node_ownername']], $ip) : null;
		(isset($_POST[$fn['node_pubkey']]) && !empty($_POST[$fn['node_pubkey']]) && strlen($_POST[$fn['node_pubkey']]) > 4) ? $node->postUpdate('node_pubkey', $_POST[$fn['node_pubkey']], $ip) : null;
		(isset($_POST[$fn['node_country']]) && !empty($_POST[$fn['node_country']]) && strlen($_POST[$fn['node_country']]) > 4) ? $node->postUpdate('node_country', $_POST[$fn['node_country']], $ip) : null;
		(isset($_POST[$fn['node_map_privacy']]) && !empty($_POST[$fn['node_map_privacy']])) ? $node->postUpdate('node_map_privacy', (int) $_POST[$fn['node_map_privacy']], $ip) : null;
		(isset($_POST[$fn['node_lat']]) && !empty($_POST[$fn['node_lat']])) ? $node->postUpdate('node_lat', (string) $_POST[$fn['node_lat']], $ip) : null;
		(isset($_POST[$fn['node_lng']]) && !empty($_POST[$fn['node_lng']])) ? $node->postUpdate('node_lng', (string) $_POST[$fn['node_lng']], $ip) : null;
		(isset($_POST[$fn['node_msg_enabled']]) && !empty($_POST[$fn['node_msg_enabled']])) ? $node->postUpdate('node_msg_enabled', (int) $_POST[$fn['node_msg_enabled']], $ip) : null;
		(isset($_POST[$fn['node_msg_privacy']]) && !empty($_POST[$fn['node_msg_privacy']])) ? $node->postUpdate('node_msg_privacy', (int) $_POST[$fn['node_msg_privacy']], $ip) : null;
		(isset($_POST[$fn['node_api_enabled']]) && !empty($_POST[$fn['node_api_enabled']])) ? $node->postUpdate('node_api_enabled', (int) $_POST[$fn['node_api_enabled']], $ip) : null;

		header('Location: /me');
	}
	$fn = $csrf->form_names($ff, true);
}
?>
<div class="promo promo-nodes">
	<div class="container">
		<div class="text-center">
			<h1><?= $node_hostname?></h1>
			<p class="lead"><a href="/node/<?= $ip?>"><?= $ip?></a></p>
		</div>
	</div>
</div>
<div class="col-xs-12 col-md-8 col-md-offset-2 centered-pills" style="padding:40px 0;">
	<ul class="nav nav-pills">
		<li role="presentation"><a href="/node/browse">All</a></li>
		<li role="presentation"><a href="/node/browse?ob=3">Recently Added</a></li>
		<li role="presentation"><a href="/node/search">Search</a></li>
		<li role="presentation"><a href="/node/<?= $ip?>">My Node</a></li>
		<li role="presentation" class="active"><a href="/me">Edit Node</a></li>
	</ul>
	<hr>
</div>

<div class="col-xs-12 col-md-10 col-md-offset-1" style="min-height:800px;">
	<?php if($known) { ?>
	<div class="panel panel-default">
		<div class="panel-heading"><h1>My Node</h1></div>
		<div class="panel-body">
			<form method="POST" class="form-horizontal" enctype="multipart/form-data">
				<div class="col-xs-6">
					<div class="col-xs-12">
						<input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
						<h3>General Settings</h3>
						<div class="form-group">
							<label class="col-sm-3 control-label">Hostname</label>
							<div class="col-sm-9">
								<input class="form-control" placeholder="<?=$node_hostname?>" value="" type="text" name="<?=$fn['node_hostname'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Owner Name</label>
							<div class="col-sm-9">
								<input class="form-control" placeholder="<?=$node_ownername?>" value="" type="text" name="<?=$fn['node_ownername'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Node Public Key</label>
							<div class="col-sm-9">
								<input class="form-control" placeholder="<?=$node_pubkey?>" value="" type="text" name="<?=$fn['node_pubkey'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Country</label>
							<div class="col-sm-9">
								<input class="form-control" placeholder="<?=$node_country?>" value="" type="text" name="<?=$fn['node_country'];?>" />
							</div>
						</div>
						<hr>
					</div>
					<div class="col-xs-12">
						<h3>MeshMap Settings</h3>
						<div class="form-group">
							<label class="col-sm-3 control-label">Privacy</label>
							<div class="col-sm-9">
								<select class="form-control" name="<?=$fn['node_map_privacy'];?>">
									<option value="" selected disabled>Select MeshMap Privacy level</option>
									<option value="1" <?= $fm_mp1 ?>>Not Listed on MeshMap</option>
									<option value="2" <?= $fm_mp2 ?>>Anonymous listing</option>
									<option value="3" <?= $fm_mp3 ?>>Public listing (ip, name)</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Latitude</label>
							<div class="col-sm-9">
								<input class="form-control" placeholder="<?=$node_lat?>"  type="text" name="<?=$fn['node_lat'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Longitude</label>
							<div class="col-sm-9">
								<input class="form-control" placeholder="<?=$node_lng?>"  type="text" name="<?=$fn['node_lng'];?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="col-xs-12">
						<h3>Message Settings</h3>
						<div class="form-group">
							<label class="col-sm-3 control-label">Enabled</label>
							<div class="col-sm-9">
								<select class="form-control" name="<?=$fn['node_msg_enabled'];?>">
									<option value="" selected disabled>Enabled/Disable Messages</option>
									<option value="1" <?= $fm_msg_false ?>>No</option>
									<option value="2" <?= $fm_msg_true ?>>Yes</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Privacy</label>
							<div class="col-sm-9">
								<select class="form-control" name="<?=$fn['node_msg_privacy'];?>">
									<option value="" selected disabled>Select Message Privacy</option>
									<option value="1" <?= $fm_msg1 ?>>Only Peers</option>
									<option value="2" <?= $fm_msg2 ?>>Any Verified Node</option>
									<option value="3" <?= $fm_msg3 ?>>Anyone</option>
								</select>
							</div>
						</div>
						<hr>
					</div>
					<div class="col-xs-12">
						<h3>Developer Settings</h3>
						<div class="form-group">
							<label class="col-sm-3 control-label">API Access</label>
							<div class="col-sm-9">
								<select class="form-control" name="<?=$fn['node_api_enabled'];?>">
									<option value="" selected disabled>Enabled/Disable API Access</option>
									<option value="1" <?= $fm_api_false ?>>Disabled</option>
									<option value="2" <?= $fm_api_true ?>>Enabled</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">API Dev ID</label>
							<div class="col-sm-9">
								<div class="input-group">
									<textarea class="form-control"><?= $node_dev_id ?></textarea>
									<span class="input-group-btn">
										<button class="btn btn-danger" type="button" onclick="window.location.href='#';">Regenerate</button>
									</span>
								</div><!-- /input-group -->
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">API Dev Secret Key</label>
							<div class="col-sm-9">
								<div class="input-group">
									<textarea class="form-control"><?= $node_dev_secret ?></textarea>
									<span class="input-group-btn">
										<button class="btn btn-danger" type="button" onclick="window.location.href='#';">Regenerate</button>
									</span>
								</div><!-- /input-group -->
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group text-center">
					<button class="btn btn-success" type="submit">Update</button>
				</div>
		</form>
			</div>
	</div>
</div>
<?php } else { ?>
<div class="col-xs-12 col-md-6 col-md-offset-3 alert alert-danger">
	<p>We have no information on your node, please fill out the following information to be added to the NodeDB.</p>
</div>
<div class="panel panel-default">
	<div class="panel-heading"><h3>My Node</h3></div>
	<div class="panel-body">
		<a class="btn btn primary" href="/node/add">Add Node to Database</a>
	</div>
</div>

</div>
<?php } ?>

</div>
