<!DOCTYPE html>
<html>
	<head>
		<meta content="ru" http-equiv="Content-Language">
		<meta charset="utf-8">
		<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
		<?php if($_POST["delete-id"] || $_POST["edit-id"] || $_POST["add-login"] || $_POST["edit-email-text"]){ ?>
			<meta http-equiv="refresh" content="0.1; url=http://kartina-tv.mediaplayer.com.ua/admin/" />
		<?php } ?>
		<title>[Админка] Kartina.TV</title>
		<link href="/favicon.ico" rel="icon" />
		<link href="/style.css" rel="stylesheet" media="all" />
		<style>
			.d2 {
    			font-size: 16px;
			}
			FORM.admin {
				color: #000;
				margin-left: 150px;
				margin-top: 30px;
				padding: 3px;
			}
			FORM.admin P {
				orphans: 3;
				widows: 3;
				margin: 0.3em 0 1.1em;
			}
			FORM.admin input[type="text"] {
				width: 200px;
				background: #fff none repeat scroll 0 0;
				border: medium none;
				border-radius: 3px;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1) inset;
				color: #525252;
				padding: 6px 0;
				float: none;
			}
			FORM.admin input:focus, FORM.admin textarea:focus {
				background: #ffd;
				color: black;
			}
			tr.data-out:hover {
				text-decoration: underline; /* text-decoration: underline overline; */
			}
			a.edit-delete {
				opacity:0.4;
			}
			a.edit-delete:hover {
				opacity:1;
			}
			
			textarea {
				border:0;
				width:100%;
				padding:3px;
				background: #ffd;
			}
			#edit-email-text, #button-show-email-text {
				display: none;
			}
/* 			#admin iframe html body { */
/* 			#content {
				margin-top: -70px;
			} */
			
			#blockscreen, #modalwindow {
				position: fixed;
			}
			#blockscreen {
				background: rgba(0, 0, 0, .4);
				left: 0;
				right: 0;
				top: 0;
				bottom: 0;
				z-index: 10;
			}
			#modalwindow {
				z-index: 11;
				background: #fff;
				padding: 0;
				border: 1px solid #000;
				box-shadow: 0 0 10px #444;

			}
		</style>
		<!-- 		<script src="//code.jquery.com/jquery-1.10.2.js"></script> -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="/js/jquery.inputmask.js" type="text/javascript"></script>
		<script src="/js/jquery.bind-first-0.1.min.js" type="text/javascript"></script>
		<script src="/js/jquery.inputmask-multi.js" type="text/javascript"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script type="text/javascript">
			<!--
			/*
			 * URL: http://stackoverflow.com/questions/1027663/how-to-make-tabbed-view-in-html
			 * URL: http://stackoverflow.com/questions/9139075/confirm-message-before-delete
			 * URL: http://www.tutorialspoint.com/javascript/javascript_dialog_boxes.htm
			 */
			function activateTab(pageId) {
				var tabCtrl        = document.getElementById('tabCtrl');
				var pageToActivate = document.getElementById(pageId);
					for (var i = 0; i < tabCtrl.childNodes.length; i++) {
					var node = tabCtrl.childNodes[i];
					if (node.nodeType == 1) { /* Element */
						node.style.display = (node == pageToActivate) ? 'block' : 'none';
					}
				}
			}
			
// 			function del_product(id) {
// 				var form = document.createElement("form");
// 				input = document.createElement("input");
// 				form.action = "";
// 				form.method = "post"
// 				input.name = "delete-id";
// 				input.value = id;
// 				form.appendChild(input);
// 				document.body.appendChild(form);
// 				form.submit();
// 			}
			
			function edit_email_text() {
				document.getElementById("show-email-text").style.display = "none";
				document.getElementById("edit-email-text").style.display = "block";
			}
      //-->
		</script>
	</head>
	<body>
		<nav id="top_menu">
			<table border="0" width="100%">
				<tr>
					<td width="16.3%"></td>
					<td width="50.3%">
 						<a href="javascript:activateTab('sendmail')">Рассылка на почту</a>&nbsp; &bull; &nbsp;
						<a href="javascript:activateTab('check-ip')">Проверка по IP</a>&nbsp; &bull; &nbsp;
						<a href="javascript:activateTab('payment')">Модуль оплатиты</a>
					</td>
					<td width="33.3%" align="right">
						<nobr>
						<?php
							require_once('../config.php');
							
							/*
							 *  URL:  http://php.net/manual/ru/features.http-auth.php
							 *      ( http://php.ru/manual/features.http-auth.html )
							 */
							$auth_realm = 'My realm';
							require_once 'auth.php';
							echo "<b>{$_SESSION['username']}</b>";
							echo ' [<a href="?action=logOut" style="text-decoration: underline;">Выйти</a>]';
							
							$_home = '..';
						?>
						</nobr>
					</td>
				</tr>
			</table>
		</nav>
		
		<div class="content">
			<div class="d2 d2-fix">
 				<div id="tabCtrl">
					<div id="sendmail" style="display: block;"><?php include 'content_sendmail.php'; ?></div>
					<div id="check-ip" style="display: block;"><?php include 'content_ipcheck.php'; ?></div>
					<div id="payment" style="display: none;"><?php include 'content_payment.php'; ?></div>
				</div>
			</div>
		</div>

<!-- URL: http://habrahabr.ru/post/93655/ -->
<!-- URL: http://www.skype.com/en/features/skype-buttons/create-skype-buttons/ -->
<!-- URL: http://www.skype.com/ru/download-skype/click-to-call/downloading/ -->
<!-- URL: http://community.skype.com/t5/Как-это-работает/bd-p/ru_welcome -->
<!-- URL: https://msdn.microsoft.com/ru-ru/library/office/dn745883.aspx -->
<!-- URL: https://support.skype.com/ru/skype/windows-desktop/calling/click-to-call/ -->

<!-- <script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
<a href="skype:NZeraF?call"><img src="http://mystatus.skype.com/bigclassic/NZeraF" style="border: none;" width="182" height="44" alt="My status" /></a>
<a href="skype:nzeraf?call"><img src="http://mystatus.skype.com/bigclassic/nzeraf" style="border: none;" width="182" height="44" alt="My status" /></a>
<br /><a href="http://www.skype.com/go/download">Скачай Skype</a> и звони мне бесплатно!<br /><br />

<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
<div id="SkypeButton_Call_sashakmets_1">
  <script type="text/javascript">
    Skype.ui({
      "name": "",
      "element": "SkypeButton_Call_sashakmets_1",
      "participants": ["sashakmets"],
      "imageSize": 16
    });
  </script>
</div> -->

<!-- 		
		<div class="footer">
			<div class="red"></div>
			<div class="foot"></div>
		</div>
-->
	</body>
	<script language="text/javascript">
/* 		document.getElementById('qwe').contentWindow.document.body.style.background ='#000'; */
	</script>
</html>

