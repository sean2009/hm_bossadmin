
<?php 
if($errors){
	foreach($errors as $key => $val){
		echo '<span class="red">'.$val[0].'</span><br>';
	}
}
?>

<form method="post" action="">
用户名<input type="text" name="Reg[username]">
<span class="red"><?php echo $errors['username'][0]?></span>
<br>
密码<input type="password" name="Reg[password]"><br>
邮箱<input type="text" name="Reg[email]">
<span class="red"><?php echo $errors['email'][0]?></span><br>
手机<input type="text" name="Reg[mobile]"><br>
<input type="submit" value="提交">
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
</form>