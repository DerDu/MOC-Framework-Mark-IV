<!DOCTYPE html>
<html>
<head>
	<title>MOC Mark IV - Update</title>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic|Open+Sans:300' rel='stylesheet'
	      type='text/css'>
	<link rel="stylesheet" href="Update.css"/>
</head>
<body>

<div id="TopBar">
	<ul>
		<li><a>Documentation</a></li>
		<li><a>GitHub</a></li>
		<li><a>DerDu</a></li>
	</ul>
</div>

<div id="Header">
	<h1>
		<a>MOC Framework</a>
	</h1>

	<p>Mark IV</p>
</div>

<div id="Navigation">
	<ul>
		<li>
			<a>Current Version: <span class="Color HighLight" id="CurrentVersion">Loading...</span></a>
		</li>
	</ul>
</div>

<div class="Channel">
	<h1>Channel Release</h1>

	<div id="ChannelRelease">
		<div class="Search Color HighLight">Loading...</div>
	</div>
</div>

<div class="Channel">
	<h1>Channel Preview</h1>

	<div id="ChannelPreview">
		<div class="Search Color HighLight">Loading...</div>
	</div>
</div>

<div class="Channel">
	<h1>Channel Nightly</h1>

	<div id="ChannelNightly">
		<div class="Search Color HighLight">Loading...</div>
	</div>

</div>

<div id="BottomBar">
	<ul>
		<li><a href="http://github.com" style="background: transparent url('Core/Update/Gui/Logo/GitHub-Mark-Light-32px.png') no-repeat left center; padding-left: 42px;">Powered by GitHub</a></li>
	</ul>
</div>

<script type="text/javascript">
	jQuery(function () {
		var CurrentVersion = jQuery('#CurrentVersion');

		var ChannelRelease = jQuery('#ChannelRelease');
		var ChannelPreview = jQuery('#ChannelPreview');
		var ChannelNightly = jQuery('#ChannelNightly');

		jQuery.get("Core/Update/Gui/EndPoint/CurrentVersion.php")
			.done(function (Response) {
				CurrentVersion.html(Response);


			})
			.fail(function (Response) {
				CurrentVersion.html('<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>');
			}).always(function () {


				jQuery.get("Core/Update/Gui/EndPoint/SearchRelease.php")
					.done(function (Response) {
						ChannelRelease.html(Response);
					})
					.fail(function (Response) {
						ChannelRelease.html('<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>');
					}).always(function () {

						jQuery.get("Core/Update/Gui/EndPoint/SearchPreview.php")
							.done(function (Response) {
								ChannelPreview.html(Response);
							})
							.fail(function (Response) {
								ChannelPreview.html('<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>');
							}).always(function () {

								jQuery.get("Core/Update/Gui/EndPoint/SearchNightly.php")
									.done(function (Response) {
										ChannelNightly.html(Response);
									})
									.fail(function (Response) {
										ChannelNightly.html('<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>');
									});

							});
					});
			});

	});
</script>

</body>
</html>
