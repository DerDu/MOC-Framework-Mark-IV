<!DOCTYPE html>
<html>
<head>
	<title>MOC Mark IV - Update</title>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<h1>Current Version</h1>
<div id="CurrentVersion">

</div>

<h1>Channel Release</h1>
<div id="ChannelRelease">

</div>

<h1>Channel Preview</h1>
<div id="ChannelPreview">

</div>

<h1>Channel Nightly</h1>
<div id="ChannelNightly">

</div>

<script type="text/javascript">
	jQuery(function () {
		var CurrentVersion = jQuery('#CurrentVersion');

		var ChannelRelease = jQuery('#ChannelRelease');
		var ChannelPreview = jQuery('#ChannelPreview');
		var ChannelNightly = jQuery('#ChannelNightly');

		jQuery.get("Core/Update/Gui/EndPoint/CurrentVersion.php")
			.done(function ( Response ) {
				CurrentVersion.html( Response );
			})
			.fail(function () {
				CurrentVersion.html( 'Error' );
			});

		jQuery.get("Core/Update/Gui/EndPoint/SearchRelease.php")
			.done(function ( Response ) {
				ChannelRelease.html( Response );
			})
			.fail(function () {
				ChannelRelease.html( 'Error' );
			});

		jQuery.get("Core/Update/Gui/EndPoint/SearchPreview.php")
			.done(function ( Response ) {
				ChannelPreview.html( Response );
			})
			.fail(function () {
				ChannelPreview.html( 'Error' );
			});

		jQuery.get("Core/Update/Gui/EndPoint/SearchNightly.php")
			.done(function ( Response ) {
				ChannelNightly.html( Response );
			})
			.fail(function () {
				ChannelNightly.html( 'Error' );
			});
	});
</script>

</body>
</html>
