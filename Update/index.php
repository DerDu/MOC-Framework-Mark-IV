<!DOCTYPE html>
<html>
<head>
	<title>MOC Mark IV - Update</title>
	<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
	<script src="jQuery.ReleaseNotes/2014-09-09-13-06/js/libs/marked.js"></script>
	<script src="jQuery.ReleaseNotes/2014-09-09-13-06/js/releasenotes.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic|Open+Sans:300' rel='stylesheet'
	      type='text/css'>
	<link rel="stylesheet" href="Style/theme.css"/>
	<link rel="stylesheet" href="jQuery.ReleaseNotes/2014-09-09-13-06/css/releasenotes.plugin.css"/>
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
			<a>Current Version: <span class="Color HighLight" id="CurrentVersion">Loading...</span></a>
		</li>
	</ul>
</div>

<div class="Channel">
	<h1 style="background-color: #69c469;">Channel Release</h1>

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

<div class="Channel">
	<h1>Release Notes</h1>

	<div id="ChannelNotes">
		<div class="Search Color HighLight">Loading...</div>
	</div>
</div>

<div id="BottomBar">
	<ul>
		<li>Powered by <a href="http://github.com"
		                 style="background: transparent url('../Core/Update/Gui/Logo/GitHub-Mark-Light-32px.png') no-repeat left center; padding-left: 42px; margin-left: 5px;">GitHub</a>
		</li>
		<li>
			Api Request-Limit<a href="http://developer.github.com/v3/rate_limit/"><span class="Color HighLight"
			                                                                              id="CurrentLimit">Loading...</span></a>
		</li>
	</ul>
</div>

<script type="text/javascript">
	jQuery( function() {
		var CurrentVersion = jQuery( '#CurrentVersion' );
		var CurrentLimit = jQuery( '#CurrentLimit' );

		var ChannelRelease = jQuery( '#ChannelRelease' );
		var ChannelPreview = jQuery( '#ChannelPreview' );
		var ChannelNightly = jQuery( '#ChannelNightly' );

		jQuery.get( "../Core/Update/Gui/EndPoint/CurrentVersion.php" )
			.done( function( Response ) {
				CurrentVersion.html( Response );

			} )
			.fail(function( Response ) {
				CurrentVersion.html( '<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>' );
			} ).always( function() {

				jQuery.get( "../Core/Update/Gui/EndPoint/SearchRelease.php" )
					.done( function( Response ) {
						ChannelRelease.html( Response );
					} )
					.fail(function( Response ) {
						ChannelRelease.html( '<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>' );
					} ).always( function() {

						jQuery.get( "../Core/Update/Gui/EndPoint/SearchPreview.php" )
							.done( function( Response ) {
								ChannelPreview.html( Response );
							} )
							.fail(function( Response ) {
								ChannelPreview.html( '<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>' );
							} ).always( function() {

								jQuery.get( "../Core/Update/Gui/EndPoint/SearchNightly.php" )
									.done( function( Response ) {
										ChannelNightly.html( Response );
									} )
									.fail(function( Response ) {
										ChannelNightly.html( '<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>' );
									} ).always( function() {

										jQuery.get( "../Core/Update/Gui/EndPoint/CurrentLimit.php" )
											.done( function( Response ) {
												Response = Response.split( '/' );
												CurrentLimit.html( Math.round( 100 - ( 100 / parseInt( Response[1] ) * parseInt( Response[0] ) ) ) + '% (' + Response[0] + '/' + Response[1] + ')' );
											} )
											.fail(function( Response ) {
												CurrentLimit.html( '<div class="Search Color HighLight"><h2>Error ' + Response.status + '</h2><div class="Information">' + Response.statusText + '</div></div>' );
											} ).always( function() {

											} );
									} );
							} );
					} );
			} );
		/*
		 jQuery( "#ChannelNotes" ).releaseNotes( {
		 milestonesShown: 10,
		 phpApi: true,
		 phpApiPath: 'jQuery.ReleaseNotes/2014-09-09-13-06/',
		 showDescription: true,
		 showComments: true,
		 // Used if phpAPI is false
		 repo: 'MOC-Framework-Mark-IV',
		 username: 'DerDu'
		 } );*/
	} );
</script>

</body>
</html>
