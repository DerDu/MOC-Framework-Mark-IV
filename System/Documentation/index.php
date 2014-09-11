<!DOCTYPE html>
<html>
<head>
	<title>MOC Mark IV - Documentation</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic|Open+Sans:300' rel='stylesheet'
	      type='text/css'>
	<link rel="stylesheet" href="Style/theme.css"/>
</head>
<body>

<div id="TopBar">
	<ul>
		<li><a href="http://derdu.github.io/MOC-Framework-Mark-IV" title="DerDu"
		       onclick="window.open(this.href); return false;">Documentation</a></li>
		<li><a href="https://github.com/DerDu/MOC-Framework-Mark-IV" title="DerDu"
		       onclick="window.open(this.href); return false;">GitHub</a></li>
		<li><a href="https://github.com/DerDu" title="DerDu" onclick="window.open(this.href); return false;">DerDu</a>
		</li>
	</ul>
</div>

<div id="Header">
	<h1>MOC Framework</h1>

	<p>Mark IV</p>
</div>

<div id="Navigation">
	<ul>
		<li>
			<a>Documentation</a>
		</li>
	</ul>
</div>

<div class="Channel">
	<h1>Generating Documentation</h1>

	<div id="ChannelNotes">
		<div class="Search Color HighLight">Loading...</div>
	</div>
</div>

<div id="BottomBar">
	<ul>
		<li>Powered by <a href="http://github.com"
		                  style="background: transparent url('../../Core/Update/GitHub/Gui/Logo/GitHub-Mark-Light-32px.png') no-repeat left center; padding-left: 42px; margin-left: 5px;">GitHub</a>
		</li>
	</ul>
</div>

</body>
</html>
<script type="text/javascript">
	jQuery( function() {
		var ChannelNotes = jQuery( '#ChannelNotes' );

		ChannelNotes.children( 'div' ).html( 'Please wait...' );

		/** @namespace window.open */
		/** @namespace window.setTimeout */
		/** @namespace Response.status */

		jQuery.get( "../../Extension/Documentation/ApiGen/Gui/EndPoint/GenerateDocumentation.php", {
			'ForceBuild': false
		} )
			.done( function( Response ) {
				ChannelNotes.html( '<div class="Search Color HighLight">Redirecting...<div class="Information"><a href="' + Response + '">' + Response + '</a></div></div>' );
				window.setTimeout( 'window.location = "' + Response + '"', 2000 );
			} )
			.fail(function( Response ) {
				ChannelNotes.html( '<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>' );
			} ).always( function() {

			} );
	} )
</script>
