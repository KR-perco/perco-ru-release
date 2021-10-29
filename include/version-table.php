<table style="width: auto; border: none; margin-left: 20px; margin-top: -10px;">
    <tr>
        <td style="border: none; vertical-align: top;">Версии прошивок:</td>
        <td style="border: none;">
            <p>CT/L04.2, CT03.2, CL05.2, CR01.2 - <span class="color">
                <?php
                $APPLICATION->IncludeFile("/include/vnutrennee-po-kontrollerov-versiya-proshivki.php", Array(), Array(
                    "MODE"      => "html",
                    "NAME"      => "Редактировать версию прошивки внутреннего по контроллеров"
                ));
                ?>
            </span></p>
            <p>CT/L04, CT03, CL05, CL05.1, CR01 - <span class="color">x.x.10.19</span></p>
            <p>CS01, PU01 - <span class="color">x.x.x.8</span></p>
            <p>CT01, CT02, CL01, CL02, CL03 - <span class="color">x.x.x.30</span></p>
            <p>SC-820 - <span class="color">1.0.0.5</span></p>
        </td>
    </tr>
</table>