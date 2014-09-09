<?php
require_once( __DIR__.'/../Api.php' );
set_time_limit( 0 );
ini_set( 'xdebug.var_display_max_children', 32 );
ini_set( 'xdebug.var_display_max_data', 4096 );
ini_set( 'xdebug.var_display_max_depth', 6 );
?>
<!DOCTYPE html>
<html>
<head>
	<title>MOC Mark IV - Update</title>
	<script src="http://code.jquery.com/jquery-1.11.1.js"></script>

	<style>
		body {
			font: 13px/1.5 Verdana, 'Geneva CE', lucida, sans-serif;
			margin: 0;
			padding: 0;
		}

		h1, h2, h3, h4, caption {
			font-family: 'Trebuchet MS', 'Geneva CE', lucida, sans-serif;
		}

		h1 {
			font-size: 230%;
			font-weight: normal;
			margin: .3em 0;
		}

		h2 {
			font-size: 150%;
			font-weight: normal;
			margin: -.3em 0 .3em 0;
		}

		h3 {
			font-size: 1.6em;
			font-weight: normal;
			margin-bottom: 2px;
		}

		h4 {
			font-size: 100%;
			font-weight: bold;
			padding: 0;
			margin: 0;
		}

		caption {
			border: 1px solid #cccccc;
			font-weight: bold;
			font-size: 1.2em;
			padding: 3px 5px;
			text-align: left;
			margin-bottom: 0;
		}

		code, var, pre {
			font-family: monospace;
		}

		var {
			font-weight: bold;
			font-style: normal;
			color: #ca8a04;
		}

		pre {
			margin: 0;
		}

		code a b {
			color: #000000;
		}

		.deprecated {
			text-decoration: line-through;
		}

		.invalid {
			color: #e71818;
		}

		.hidden {
			display: none;
		}

		/* Left side */
		#left {
			overflow: auto;
			width: 270px;
			height: 100%;
			position: fixed;
		}

		/* Menu */
		#menu {
			padding: 10px;
		}

		#menu ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		#menu ul ul {
			padding-left: 10px;
		}

		#menu li {
			white-space: nowrap;
			position: relative;
		}

		#menu #groups span {
			position: absolute;
			top: 4px;
			right: 2px;
			cursor: pointer;
			display: block;
			width: 12px;
			height: 12px;
			background: url('Content/resources/collapsed.png') transparent 0 0 no-repeat;
		}

		#menu #groups span:hover {
			background-position: -12px 0;
		}

		#menu #groups span.collapsed {
			background-position: 0 -12px;
		}

		#menu #groups span.collapsed:hover {
			background-position: -12px -12px;
		}

		#menu #groups ul.collapsed {
			display: none;
		}

		/* Right side */
		#right {
			overflow: auto;
			margin-left: 275px;
			height: 100%;
			position: fixed;
			left: 0;
			right: 0;
		}

		#rightInner {
			max-width: 1000px;
			min-width: 350px;
		}
	</style>
	<script src="Content/elementlist.js"></script>
	<script src="Content/resources/combined.js"></script>
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
	<h1>Channel Release</h1>

	<div id="ChannelRelease">
		<?php

		\MOC\IV\Api::groupExtension()->unitDocumentation()->apiGenerator(
			\MOC\IV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../' ),
			\MOC\IV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/Content/' )
		)->buildDocumentation();

		exit;

		$Content = \MOC\IV\Api::groupExtension()->unitDocumentation()->apiGenerator(
			\MOC\IV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../' ),
			\MOC\IV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/Content/' )
		)->createDocumentation();

		$Content = preg_replace( '!^.*?<body>!is', '', $Content );
		print preg_replace( '!</body>.*?$!is', '', $Content );

		?>
		<div style="clear: both;"></div>
	</div>
</div>

<div id="BottomBar">
	<ul>
		<li><a href="http://github.com"
		       style="background: transparent url('../Core/Update/Gui/Logo/GitHub-Mark-Light-32px.png') no-repeat left center; padding-left: 42px;">Powered
				by GitHub</a>
		</li>
	</ul>
</div>

</body>
</html>
