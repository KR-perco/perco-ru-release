<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$frame = $this->createFrame()->begin();?>
<?
	$ID_ElQRAltasib = "QR_Altasib_".rand();
?>
<script>

BX.ready(function(){
	BX.bind(BX('<?=$ID_ElQRAltasib?>'), 'click', QR_Altasib.openQr);
	if (BX('<?=$ID_ElQRAltasib?>_big'))
		BX.bind(BX('<?=$ID_ElQRAltasib?>_big'), 'click', QR_Altasib.closeQr);
});

</script>
        <?//=GetMessage("ALTASIB_QRCODE_TITLE");?>
        <?
         if($arParams["QR_COPY"] == "Y")
            $copy = "COPY";
         else
            $copy = "";
        ?>
        <?
        if ($arResult["RESULT"] == "Y"):?>
          <?if($arParams["QR_MINI"]>0):?>
				<div class="alx_QR_altasib_pic">
					<div style="height: <?=$arParams["QR_MINI"]?>" id="<?=$ID_ElQRAltasib?>">
					<img alt="QR_Altasib" class="QR_altasib" src="<?=$arResult["QRCODE"];?>" width="<?=$arParams["QR_MINI"]?>" id="<?=$ID_ElQRAltasib?>_mini"/><?if(strlen($arParams["QR_TEXT"])>0):?><span class="alx_qr_text"><?=htmlspecialcharsBack($arParams["QR_TEXT"])?></span><?endif;?></div>
					<div class="QRBig_altasib" id="<?=$ID_ElQRAltasib?>_big"><img alt="" id="<?=$ID_ElQRAltasib?>_bigimg" src="<?=$arResult["QRCODE_COPY"]?>"></div>
				</div>
          <?else:?>
                  <img src="<?=$arResult["QRCODE"];?>" />
          <?endif;?>
        <?else:?>
                <?=GetMessage("ALTASIB_QRCODE_EMPTY_VAL")?>
        <?endif;?>
    <?$frame->beginStub();?>
    <?$frame->end();?>