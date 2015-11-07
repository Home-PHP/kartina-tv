<center>
	<h1>Рассылка на почту</h1>
</center>

				<table width="100%">
					<tr><td align="center"><div><iframe id="qwe" width="850" height="310" frameborder="0" scrolling="no" src="ftp://kartina-tv.mediaplayer.com.ua/public_html/raport/" style="margin-top: -28px;"></iframe></div></td></tr>
					<form method="post" action="">
					<tr>
						<td align="center">
							<div>
								<table border="0" width="802" cellspacing="10" style="background: #FFFFFF; border-radius: 10px 10px 0 0; -moz-border-radius: 10px 10px 0 0; -webkit-border-radius: 10px 10px 0 0; border: 1px solid #AAAAAA;">
									<tr>
										<td style="display: block;">
												<center><b><font style="text-transform: uppercase;">Текст клиентского письма</font></b></center><hr size="1" color="#aaa" />
												<textarea cols="98" rows="21" name="edit-email-text" id="edit-email-text"><?php echo file_get_contents("$_home/$_work/text_email_client.txt"); ?></textarea>
												<span id="show-email-text"><?php echo file_get_contents("$_home/$_work/text_email_client.txt"); ?></span>
										<td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td align="center">
							<div>
								<table border="0" width="802" cellspacing="10" style="background: #FFFFFF; border-radius: 0 0 10px 10px; -moz-border-radius: 0 0 10px 10px; -webkit-border-radius: 0 0 10px 10px; border: 1px solid #AAAAAA;">
										<td align="center">
											<table>
												<tr>
<!-- 													<td><input type="button" id="button-show-email-text" onclick="show_email_text();" value="Отмена" /></td> -->
													<td><input type="button" id="button-edit-email-text" onclick="edit_email_text();" value="Редактировать" /></td>
													<td><input type="submit" id="button-save-email-text" name="save-email-text" value="Сохранить" /></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					</form>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td align="center">
							<table border="0" width="802" height="60" style="background: #FFFFFF; border-radius: 10px 10px 0 0; -moz-border-radius: 10px 10 0 0; -webkit-border-radius: 10px 10px 0 0; border: 1px solid #AAAAAA;">
								<tr>
									<td align="center" valign="middle">
										<table border="0">
											<tr>
												<td>
													<?php
														/*
														 * URL: http://phpclub.ru/detail/article/upload
														 * ******************************************
														 */

														$max_image_size = 64 * 1024;                  // 64K
														$valid_types 	=  array("$_input_file_type");  //$valid_types 		=  array("xlsx", "cvs", "txt", "log");

														if (isset($_FILES["userfile"])) {
															$filename = $_FILES['userfile']['name'];
															$ext      = substr($_FILES['userfile']['name'], 1 + strrpos($_FILES['userfile']['name'], "."));
															if (!in_array($ext, $valid_types)) {
													?><table cellspacing="10"><tr><td align="center"><font color="red">Ошибка: тип файла не поддерживается <b>[</b><a href="">Повторить</a><b>]</b></font></td></tr></table><?php
																exit;
															} 
															if( $_FILES["userfile"]["size"] > $max_image_size ){
													?><table cellspacing="10"><tr><td align="center"><font color='red'>Ошибка: размер файла превышает 64K. <b>[</b><a href="">Повторить</a><b>]</b></font></td></tr></table><?php
																exit;
															}
															if( is_uploaded_file($_FILES["userfile"]["tmp_name"]) ){
																move_uploaded_file($_FILES["userfile"]["tmp_name"], "$_home/$_work/$_xlsx_file_name.$_input_file_type");
													?><table cellspacing="10"><tr><td align="center"><font color='darkgreen'>Файл <a href='ftp://kartina-tv.mediaplayer.com.ua/public_html/<?php print("$_work/$_xlsx_file_name"); ?>' target='_blank'><?php print("$_xlsx_file_name"); ?></a> загружен успешно! <b>[</b><a href=''>Повторить/Отмена</a><b>]</b></td></tr></table>
													<?php }else{ ?><table cellspacing="10"><tr><td align="center"><font color='red'>Ошибка загрузки файла <b>[</b><a href="">Повторить</a><b>]</b></font></td></tr></table>
													<?php }}else{ ?><table cellspacing="10"><form class="admin" method="post" enctype="multipart/form-data" action=""><input type="hidden" name="MAX_FILE_SIZE" value="30000"><tr><td align="right">Excel-файл:</td><td align="left"><input type="file" name="userfile" size="20"></td><td align="center"><input type="submit" value="Загрузить"></td></tr></form></table>
													<?php } ?>
												</td>
												<td rowspan="2" style="border-left: #aaa solid 1px;">
													<table width="230" border="0">
														<tr><td><p>админы:</p></td><td><?php foreach ($mail as &$item) echo "<a href='mailto:$item' target='_blank'>$item</a><br />"; ?></td></tr>
														<tr><td colspan="2" align="center"><input type="button" onclick="modalWindow.show_test(350);" value="Протестировать" /></td></tr>
													</table>
												</td>
											</tr>
											<tr>
<!-- 												<td align="center">Новая запись: &nbsp; &nbsp; <a class="edit-delete" href="javascript:;" onclick="modalWindow.show_add(350);" title="Добавить"><img src="/images/add.png" alt="add" /></a></td> -->
												<td align="center">Новая запись: &nbsp; &nbsp; <a class="edit-delete" href="javascript:;" onclick="modalWindow.show_add(300);" title="Добавить"><img src="/images/add.png" alt="add" /></a></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center">
							<table border="0" style="background: #FFFFFF;  border-radius: 0 0 10px 10px; -moz-border-radius: 0 0 10px 10px; -webkit-border-radius: 0 0 10px 10px; border: 1px solid #AAAAAA;">
								<?php require_once('api.php'); ?>
								<tr>
									<td align="center" valign="middle">
										<table border="0" width="794">
											<tr style="text-transform: uppercase;">
												<th><?php print($_KARTINA_TV[0][0]); ?></th>
												<th><?php print($_KARTINA_TV[0][1]); ?></th>
												<th><?php print($_KARTINA_TV[0][2]); ?></th>
												<th><?php print($_KARTINA_TV[0][3]); ?></th>
												<th><?php print($_KARTINA_TV[0][4]); ?></th>
												<th><?php print($_KARTINA_TV[0][5]); ?></th>
												<th><?php print($_KARTINA_TV[0][6]); ?></th>
												<th><?php print($_KARTINA_TV[0][7]); ?></th>
											</tr>
                                            <tr><td colspan="10"><hr size="1" width="99%" color="#aaa"></td></tr>
											<?php for( $row = 1; $row <= (count($_KARTINA_TV)-1); $row++ ){ ?>
											<tr class="data-out" style="background: <?php print($_KARTINA_TV[$row]['status']); ?>;">
												<td><?php print($_KARTINA_TV[$row][0]); ?></td>
												<td><i><font color="blue"><?php print($_KARTINA_TV[$row][1]); ?></font></i></td>
												<td><i><font color="blue"><?php print($_KARTINA_TV[$row][2]); ?></font></i></td>
												<td><i><font color="blue"><?php print($_KARTINA_TV[$row][3]); ?></font></i></td>
												<td><i><font color="blue"><?php print($_KARTINA_TV[$row][4]); ?></font></i></td>
												<td><?php if($_KARTINA_TV[$row][5]){ ?><nobr><i><a href="mailto:<?php print($_KARTINA_TV[$row][5]); ?>" title="Ответить на почту"><img src="/images/green-favicon.ico" alt="email" /><?php print($_KARTINA_TV[$row][5]); ?></a></i></nobr><?php } ?></td>
												<td><?php if($_KARTINA_TV[$row][6]){ ?><nobr><i><font color="blue"><a href="skype:<?php print($_KARTINA_TV[$row][6]); ?>?call" title="Позвонить через Skype на номер"><img class="rank-icon" alt="" src="http://skypec.i.lithium.com/html/rank_icons/icon_role_skype.png"><?php print($_KARTINA_TV[$row][6]); ?></a></font></i></nobr><?php } ?></td>
												<td><i><font color="blue"><?php print($_KARTINA_TV[$row][7]); ?></font></i></td>
												<td style="background: #FFFFFF;"><a class="edit-delete" href="javascript:;" onclick="modalWindow.show_edit(350, '<?php print($_KARTINA_TV[$row][0]); ?>', '<?php print($_KARTINA_TV[$row][1]); ?>', '<?php print($_KARTINA_TV[$row][2]); ?>', '<?php print($_KARTINA_TV[$row][3]); ?>', '<?php print($_KARTINA_TV[$row][4]); ?>', '<?php print($_KARTINA_TV[$row][5]); ?>', '<?php print($_KARTINA_TV[$row][6]); ?>', '<?php print($_KARTINA_TV[$row][7]); ?>');" title="Редактировать"><img src="/images/edit.png" alt="edit" /></a></td>
												<td style="background: #FFFFFF;"><a class="edit-delete" href="javascript:;" onclick="modalWindow.show_delete(300, '<?php print($_KARTINA_TV[$row][0]); ?>');" title="Удалить"><img src="/images/delete.png" alt="delete" /></a></td>
											</tr>
											<tr>
												<?php 
													}
													$expired = 0; $used = 0; $actived = 0;
													foreach( $_KARTINA_TV as $col=>$val ) if($val['status']=='#fee') $expired++;
													foreach( $_KARTINA_TV as $col=>$val ) if($val['status']=='#ffd') $used++;
													foreach( $_KARTINA_TV as $col=>$val ) if(!$val['status']) $actived++;
													if( 0 < ($actived-1) ){
												?>
												<th colspan="10"><div id="result"><font color="darkgreen">Результаты: &nbsp; всего <?php print((count($_KARTINA_TV)-1)); ?>-запись(ей); &nbsp; <u><?php print($expired); ?></u>-просрочено; &nbsp; <u><?php print($used); ?></u>-используется; &nbsp; <u><?php print(($actived-1)); ?></u>-доступно;</font></div></th>
												<?php }else{ ?>
												<th colspan="10"><div id="result"><font color="red">Результаты: &nbsp; ненайдено доступных записей</font></div></th>
												<?php } ?>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<script type="text/javascript">
					<!--
					<?php if($_POST["receiver-email"]){ if(filter_var($available_new_record[0], FILTER_VALIDATE_INT) !== false){ if(0 < $_search){ ?>
                        document.getElementById('result').innerHTML = '<font color="red">Найдена доступная запись <u>№<?php print( $available_new_record[0] ); ?></u> для рассылки на почту клиентам. Заказчик: <u><?php print( $_receiver_name ); ?></u> - мошейник!!!</font>';<?php
                    }else{ ?>
                        document.getElementById('result').innerHTML = '<font color="darkgreen">Найдена доступная запись <u>№<?php print( $available_new_record[0] ); ?></u> для рассылки на почту клиентам. Заказчик: <u><?php print( $_receiver_name ); ?></u></font>';
					<?php }}else{ ?>
                        document.getElementById('result').innerHTML = '<font color="red">Ненайдено доступных записей</font>';
					<?php }} ?>
					
					/*
					 * URL:  http://habrahabr.ru/sandbox/54323/
					 */
					var modalWindow = {
						_block: null,
						_win: null,

						initBlock: function() {
							_block = document.getElementById('blockscreen'); // Получаем наш блокирующий фон по ID

							// Если он не определен, то создадим его
							if (!_block) {
								var parent = document.getElementsByTagName('body')[0]; // Получим первый элемент тега body
								var obj = parent.firstChild;                           // Для того, чтобы вставить наш блокирующий фон в самое начало тега body
								_block = document.createElement('div');                // Создаем элемент div
								_block.id = 'blockscreen';                             // Присваиваем ему наш ID
								parent.insertBefore(_block, obj);                      // Вставляем в начало
								_block.onclick = function() { modalWindow.close(); }   // Добавим обработчик события по нажатию на блокирующий экран - закрыть модальное окно.
							}
							_block.style.display = 'inline';                               // Установим CSS-свойство        
						},

						initWin: function(width, html) {
							_win = document.getElementById('modalwindow'); // Получаем наше диалоговое окно по ID
							// Если оно не определено, то также создадим его по аналогии
							if (!_win) {
								var parent = document.getElementsByTagName('body')[0];
								var obj = parent.firstChild;
								_win = document.createElement('div');
								_win.id = 'modalwindow';
								parent.insertBefore(_win, obj);
							}
							_win.style.width = width + 'px'; // Установим ширину окна
							_win.style.display = 'inline';   // Зададим CSS-свойство

							_win.innerHTML = html; // Добавим нужный HTML-текст в наше диалоговое окно

							// Установим позицию по центру экрана
							_win.style.left = '50%'; // Позиция по горизонтали
							_win.style.top  = '50%'; // Позиция по вертикали

							// Выравнивание по центру путем задания отрицательных отступов
							_win.style.marginTop = -(_win.offsetHeight / 2) + 'px'; 
							_win.style.marginLeft = -(width / 2) + 'px';
						},

						close: function() {
							document.getElementById('blockscreen').style.display = 'none';
							document.getElementById('modalwindow').style.display = 'none';        
						},

						show_edit: function(width, id, login, password, activation, name, email, phone, datatime) {
							html = '<form method="POST" action="<?php $_PHP_SELF ?>"> <table border="0" width="100%"> <tr><td width="40%"></td><td width="60%"></td></tr> <tr><th colspan="2">№ '+id+'<input type="hidden" name="edit-id" value="'+id+'"></th></tr> <tr><td align="right">Логин:</td><td><input name="edit-login" placeholder="Логин" autofocus="" value="'+login+'" type="text" /></td></tr> <tr><td align="right">Пароль:</td><td><input name="edit-password" placeholder="Пароль" value="'+password+'" type="password" /></td></tr> <tr><td align="right">Дата активации:</td><td><input name="edit-activation" placeholder="dd.mm.yyyy" value="'+activation+'" type="text" /></td></tr> <tr><td align="right">Имя/Фамилия:</td><td><input name="edit-name" placeholder="Имя/Фамилия" value="'+name+'" type="text" /></td></tr> <tr><td align="right">E-mail:</td><td><input name="edit-email" placeholder="email@example.com" value="'+email+'" type="text" /></td></tr> <tr><td align="right">Телефон <label id="descr" style="color: #525252; float: none; margin: 0;"></label>:</td><td> <input placeholder="+_(___)___-____" maxlength="30" name="edit-phone" id="edit-phone" value="'+phone+'" size="25" type="text"></td></tr> <tr><td align="right">DateTime:</td><td><input name="edit-datatime" placeholder="dd.mm.yyyy" value="'+datatime+'" type="text" /></td></tr> <tr><td colspan="2" align="center" style="border-top: 1px solid #ddd; background: #f6f6f6;"><br /><input type="submit" value="Сохранить" /> <input value="Отмена" onclick="modalWindow.close();" type="button" /><br />&nbsp;</td></tr> </table> </form>';
							modalWindow.initBlock();
							modalWindow.initWin(width, html);
							// URL: https://jqueryui.com/datepicker/
							//    ( http://stackoverflow.com/questions/3054758/jquery-ui-datepicker-can-you-format-a-date-and-allow-multiple-seperator-charact )
							$(function() {
								$("[name='edit-activation']").datepicker({ 
									dateFormat: 'dd.mm.yy',
									constrainInput: false
								});
								$("[name='edit-datatime']").datepicker({ 
									dateFormat: 'dd.mm.yy',
									constrainInput: false
								});
							});
							
							// URL: http://habrahabr.ru/post/162537/
							//    ( https://github.com/andr-04/inputmask-multi )
							//    ( http://andr-04.github.io/inputmask-multi/ru.html )
							var maskList = $.masksSort($.masksLoad("phone-codes.json"), ['#'], /[0-9]|#/, "mask");
							var maskOpts = {
									inputmask: {
											definitions: {
													'#': {
															validator: "[0-9]",
															cardinality: 1
													}
											},
											showMaskOnHover: false,
											autoUnmask: true
									},
									match: /[0-9]/,
									replace: '#',
									list: maskList,
									listKey: "mask",
									onMaskChange: function(maskObj, determined) {
											if (determined) {
													var hint = maskObj.name_ru;
													if (maskObj.desc_ru && maskObj.desc_ru != "") {
															hint += " (" + maskObj.desc_ru + ")";
													}
													$("#descr").html("(" + hint + ")");
											} else {
													$("#descr").html("");
											}
											$(this).attr("placeholder", $(this).inputmask("getemptymask"));
									}
							};
							$('#edit-phone').inputmasks(maskOpts);
						},
						
						show_add: function(width) {
// 							html = '<form method="POST" action="<?php $_PHP_SELF ?>"> <table border="0" width="100%"> <tr><td width="40%"></td><td width="60%"></td></tr> <tr><td align="right">логин:</td><td><input name="add-login" placeholder="логин" autofocus="" value="" type="text" /></td></tr> <tr><td align="right">пароль:</td><td><input name="add-password" placeholder="пароль" value="" type="password" /></td></tr> <tr><td align="right">дата активации:</td><td><input name="add-activation" placeholder="dd.mm.yyyy" value="" type="text" /></td></tr> <tr><td align="right">name:</td><td><input name="add-name" placeholder="name" value="" type="text" /></td></tr> <tr><td align="right">email:</td><td><input name="add-email" placeholder="email@example.com" value="" type="text" /></td></tr> <tr><td align="right">phone <label id="descr" style="color: #525252; float: none; margin: 0;"></label>:</td><td> <input placeholder="+_(___)___-____" maxlength="30" name="add-phone" id="add-phone" value="+_(___)___-____" size="25" type="text"></td></tr> <tr><td align="right">DataTime:</td><td><input name="add-datatime" placeholder="dd.mm.yyyy" value="" type="text" /></td></tr> <tr><td colspan="2" align="center" style="border-top: 1px solid #ddd; background: #f6f6f6;"><br /><input type="submit" value="Сохранить" /> <input value="Отмена" onclick="modalWindow.close();" type="button" /><br />&nbsp;</td></tr> </table> </form>';
							html = '<form method="POST" action="<?php $_PHP_SELF ?>"> <table border="0" width="100%"> <tr><td align="right">Логин:</td><td><input name="add-login" placeholder="Логин" autofocus="" value="" type="text" /></td></tr> <tr><td align="right">Пароль:</td><td><input name="add-password" placeholder="Пароль" value="" type="password" /></td></tr> <tr><td align="right">Дата активации:</td><td><input name="add-activation" placeholder="dd.mm.yyyy" value="" type="text" /></td></tr> <tr><td colspan="2" align="center" style="border-top: 1px solid #ddd; background: #f6f6f6;"><br /><input type="submit" value="Сохранить" /> <input value="Отмена" onclick="modalWindow.close();" type="button" /><br />&nbsp;</td></tr> </table> </form>';
							modalWindow.initBlock();
							modalWindow.initWin(width, html);
							$(function() {
								$("[name='add-activation']").datepicker({ 
									dateFormat: 'dd.mm.yy',
									constrainInput: false
								});
								$("[name='add-datatime']").datepicker({ 
									dateFormat: 'dd.mm.yy',
									constrainInput: false
								});
							});
						},
						
						show_delete: function(width, id) {
							html = '<form method="POST" action="<?php $_PHP_SELF ?>"> <table border="0" width="100%"> <input type="hidden" name="delete-id" value="'+id+'"> <tr><td align="center"><table cellpadding="7"><tr><td>Вы уверены что хотите удалить запись <b>№ '+id+'</b></td></tr></table></td></tr> <tr><td align="center" style="border-top: 1px solid #ddd; background: #f6f6f6;"><br /><input type="submit" value="Удалить" /> <input value="Отмена" onclick="modalWindow.close();" type="button" /><br />&nbsp;</td></tr> </table> </form>';
							modalWindow.initBlock();
							modalWindow.initWin(width, html);
						},
						
						show_test: function(width) {
							html = '<form method="POST" action="<?php $_PHP_SELF ?>"> <table border="0" width="100%"> <tr><td width="40%"></td><td width="60%"></td></tr> <tr><td align="right">Имя/Фамилия:</td><td><input name="receiver-name" placeholder="Имя/Фамилия" value="" type="text" /></td></tr> <tr><td align="right">E-mail:</td><td><input name="receiver-email" placeholder="email@example.com" value="" type="text" /></td></tr> <tr><td align="right">Телефон <label id="descr" style="color: #525252; float: none; margin: 0;"></label>:</td><td> <input placeholder="+_(___)___-____" maxlength="30" name="receiver-phone" id="receiver-phone" value="+_(___)___-____" size="25" type="text"></td></tr> <tr><td colspan="2" align="center" style="border-top: 1px solid #ddd; background: #f6f6f6;"><br /><input type="submit" value="Выполнить" /> <input value="Отмена" onclick="modalWindow.close();" type="button" /><br />&nbsp;</td></tr> </table> </form>';
							modalWindow.initBlock();
							modalWindow.initWin(width, html);
                            var maskList = $.masksSort($.masksLoad("phone-codes.json"), ['#'], /[0-9]|#/, "mask");
                            var maskOpts = {
                                inputmask: {
                                    definitions: {
                                        '#': {
                                            validator: "[0-9]",
                                            cardinality: 1
                                        }
                                    },
                                    showMaskOnHover: false,
                                    autoUnmask: true
                                },
                                match: /[0-9]/,
                                replace: '#',
                                list: maskList,
                                listKey: "mask",
                                onMaskChange: function(maskObj, determined) {
                                    if (determined) {
                                        var hint = maskObj.name_ru;
                                        if (maskObj.desc_ru && maskObj.desc_ru != "") {
                                            hint += " (" + maskObj.desc_ru + ")";
                                        }
                                        $("#descr").html("(" + hint + ")");
                                    } else {
                                        $("#descr").html("");
                                    }
                                    $(this).attr("placeholder", $(this).inputmask("getemptymask"));
                                }
                            };
                            $('#receiver-phone').inputmasks(maskOpts);
						}
					}
					//-->
				</script>

<!-- 
<br><hr>
<form name="edit_personal" method="post" action="#">
	<label for="first_name">Имя</label>
	<input type="text" name="first_name" value="first_name">
	<label for="last_name">Фамилия</label>
	<input type="text" name="last_name" value="last_name">
	<label for="tel">Телефон</label>
	<input type="text" name="tel" value="tel">
	<label for="e_mail">E-mail</label>
	<input type="text" name="e_mail" value="e_mail">
	<input name="edit_personal" type="submit" cl="edit_personal" value="ОК">
</form>

<script type="text/javascript">
/*     $(document).ready(function() {
    $("form[name='edit_personal']").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                data: {
                    "first_name": $(':input[name="first_name"]').val(),
                    "last_name": $(':input[name="last_name"]').val(),
                    "tel": $(':input[name="tel"]').val(),
                    "e_mail": $(':input[name="e_mail"]').val()
                },
                dataType: "html",
                url: "#", //url: "/php/edit_personal.php",
                success: function(data) {
					if (data=="1"){
						location.reload();
					} else {
						alert(data);
					}
                }
            });
        });
    }); */
</script>
 -->





