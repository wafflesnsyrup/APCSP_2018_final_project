<?php
  // Let this file be used as a css file
  header("Content-type: text/css; charset: UTF-8");

  // Start the session
  session_start();

  // Choses color scheme
  $mode = "lightmode";
?>

@import '/system/assets/fonts/fonts.css';
@import '/system/assets/css/bootstrap-overrides.css';
@import '/system/assets/css/positioning.css';
@import '/system/assets/css/<?php echo $mode; ?>.css';
@import '/system/assets/css/galleryColumns.css';

hr .seperator {
  width: 100%;
  border: 10px solid white;
}

.no-padding {
  padding: 0px;
}

.img-container .img {
  width: 100%;
	height: 100%;
	background-repeat: no-repeat;
	background-position: center center;
	border: 1px solid #222222;
	background-size: cover;
}

.shadow-in {
  -moz-box-shadow:    inset 0 0 15px #000000;
  -webkit-box-shadow: inset 0 0 15px #000000;
  box-shadow:         inset 0 0 15px #000000;
}

.shadow-out {
  -moz-box-shadow:    0 0 15px #000000;
  -webkit-box-shadow: 0 0 15px #000000;
  box-shadow:         0 0 15px #000000;
}

.landing {
  height: 600px;
  pading: 0px;
  margin: 0px;
}

.img {
  width: 100%;
  height: auto;
}

.vid {
  width: 100%;
  height: auto;
}

.fsh {
  width: 100%;
  min-height: 600px;
}

.album-header {
  height: 33vh;
  width: 100%;
  position: relative;
}

.album-header .title {
  background-color: rgba(0, 0, 0, 0.5);
  padding: 5px;
}

.pop {
  margin: 0px;
  min-height: 50px;
  padding: 10px;
}

.pad-top {
  padding-top: 10px;
}

.pad-bot {
  padding-bottom: 10px;
}

.mar-top {
  margin-top: 32px;
}

.mar-bot {
  margin-bottom: 32px;
}

.auto-height {
  height: auto;
}

.album-info {
  min-height: 50px;
}

.preview-thumb {
  height: 175px;
}

.lowercase {text-transform: lowercase; }
.uppercase { text-transform: uppercase; }
.capitalize { text-transform: capitalize; }
