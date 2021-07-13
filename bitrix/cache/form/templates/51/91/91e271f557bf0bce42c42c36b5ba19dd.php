<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001623603149';
$dateexpire = '001626195149';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:4015:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
<p><?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?></p>
 
<p><strong>Customer\'s details</strong></p>
 
<table> 
  <tbody> 
    <tr><td width="160" style="border-image: initial;">Full name <?=$FORM->ShowRequired()?>&nbsp;</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'company\')?></td></tr>
   
    <tr><td style="border-image: initial;">Legal address&nbsp;</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'address01\')?></td></tr>
   
    <tr><td style="border-image: initial;">Physical address</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'address02\')?></td></tr>
   
    <tr><td style="border-image: initial;">Contact person</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'person\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email\')?></td></tr>
   </tbody>
 </table>
 
<p><strong>Grantee organization details</strong></p>
 
<table> 
  <tbody> 
    <tr><td width="160" style="border-image: initial;">Full name</td><td style="border-image: initial;"> <?=$FORM->ShowInput(\'company_enduser\')?></td></tr>
   
    <tr><td style="border-image: initial;">Physical address</td><td style="border-image: initial;"> <?=$FORM->ShowInput(\'address01_enduser\')?></td></tr>
   
    <tr><td style="border-image: initial;">Contact person</td><td style="border-image: initial;"> <?=$FORM->ShowInput(\'person_enduser\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email_enduser\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;">Address of the site equipped with PERCo-Web system 
        <br />
       (in case it differs from grantee organization details)</td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"> <?=$FORM->ShowInput(\'address02_enduser\')?></td></tr>
   </tbody>
 </table>
 
<p><strong>MAC-address of the controller that is used as an electronic key</strong></p>
 
<p><?=$FORM->ShowInput(\'MAC\')?></p>
 
<p>(Any controller of the system can be used as an electronic protection key. The function of software licence machine verification has no effect on other functions of the controller. Operation of the Software is possible only with the controller whose MAC-address is used as an electronic protection key).</p>
 
<table class="form-table"> 
  <tbody> 
    <tr><td style="border-image: initial;"><strong>List of software modules</strong></td><td align="center" style="border-image: initial;"><strong>Amount</strong></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WB Basic software package</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WB\')?></td></tr>
   
    <tr> <td style="border-image: initial;">PERCo-WS Standard software package</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WS\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WM-01 &laquo;Time and Attendance&raquo; module</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WM01\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WM-02 «Verification» module</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WM02\')?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowInput(\'req\')?> 
<br />
 
<br />
 
<table> 
  <tbody> 
    <tr><td style="border-image: initial;">Enter Verification Code: 
        <br />
       <?=$FORM->ShowCaptchaField()?> 
        <br />
       <?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td style="border-image: initial;"><?=$FORM->ShowSubmitButton("submit","")?></td><td style="border-image: initial;"><?=$FORM->ShowResetButton("clear the form","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>