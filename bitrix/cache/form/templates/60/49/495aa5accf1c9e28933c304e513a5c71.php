<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001621423157';
$dateexpire = '001624015157';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:3591:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
<style>
	.feedback-form {
		display: flex;
		flex-direction: column;
		align-items: center;
		margin-top: 64px;
		box-sizing: border-box;
	}
	.feedback-form * {
		box-sizing: border-box;
	}
	.feedback-form>label {
		display: block;
		width: 95%;
		font-size: 18px;
		color: #333;
	}
	.feedback-form>label>input, .feedback-form>label>textarea {
		width: 100%;
		margin-top: 4px;
		margin-bottom: 12px;
		padding: 8px 16px;
		border: 1px solid rgba(120, 120, 120, .3);
		outline: none;
		border-radius: 4px;
		color: black;
		font-size: 24px;
	}
	.feedback-form>label>input:focus, .feedback-form>label>textarea:focus {
		border: 1px solid rgba(120, 120, 120, 1);
		outline: none;
	}
	.feedback-form>label>textarea {
		font-size: 20px;
		resize: vertical;
	}
	.feedback-form>.feedback-form__policy {
		margin-bottom: 12px;
	}
	.feedback-form>.feedback-form__policy>input {
		margin: 0;
		width: auto;
		vertical-align: middle;
	}
	.feedback-form>.feedback-form__policy>label {
		line-height:0;
	}
	.feedback-form__star {
		color: #ff2400;
	}
	.feedback-form__captcha {
		display: flex;
		justify-content: space-around;
		width: 100%;
	}
	.feedback-form__captcha-input {
		flex: 1;
		padding-top: 8px;
		padding-right: 32px;
	}
	.feedback-form__captcha-input>input {
		margin: 0;
		width: 100%;
		height: 40px;
		padding: 8px 16px;
		border: 1px solid rgba(80, 80, 80, .3);
		border-radius: 4px;
		color: black;
		font-size: 24px;
	}
	.feedback-form__captcha-input>input:focus {
		border: 1px solid rgba(120, 120, 120, 1);
		outline: none;
	}
	.feedback-form__captcha-img {
		padding-top: 8px;
	}
	.feedback-form__submit {
		margin-top: 8px!important;
		margin-bottom: 0!important;
		padding: 8px 32px!important;
		width: auto!important;
		height: auto!important;
		font-size: 24px!important;
		text-decoration: none!important;
	}
</style>
 
<div class="feedback-form"> 	<?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 	<label> 		Название организации<span class="feedback-form__star">*</span> 		<?=$FORM->ShowInput(\'company_name\')?> 	</label> 	<label> 		Контактное лицо<span class="feedback-form__star">*</span> 		<?=$FORM->ShowInput(\'person\')?> 	</label> 	<label> 		Город 		<?=$FORM->ShowInput(\'city\')?> 	</label> 	<label class="feedback-form__number"> 		Телефон 		<?=$FORM->ShowInput(\'number\')?> 	</label> 	<label> 		Email<span class="feedback-form__star">*</span> 		<?=$FORM->ShowInput(\'email\')?> 	</label> 	<label> 		Сайт 		<?=$FORM->ShowInput(\'website\')?> 	</label> 	<label> 		Содержание запроса<span class="feedback-form__star">*</span> 		<?=$FORM->ShowInput(\'request\')?> 	</label> 	<label class="feedback-form__policy"> 		<?=$FORM->ShowInput(\'policy\')?><span class="feedback-form__star">*</span> 	</label> 	<label> 		Введите код с картинки<span class="feedback-form__star">*</span> 		 
    <div class="feedback-form__captcha"> 			<label class="feedback-form__captcha-input"> 				<?=$FORM->ShowCaptchaField()?> 			</label> 			<label class="feedback-form__captcha-img"> 				<?=$FORM->ShowCaptchaImage()?> 			</label> 		</div>
   	</label> 	<?=$FORM->ShowSubmitButton("Отправить","feedback-form__submit")?> </div>
 
<!--script src="/scripts/jquery.maskedinput.min.js"></script>
<script>
	$(\'.feedback-form__number>input\').mask("+9(999) 999-99 99");
</script-->
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>