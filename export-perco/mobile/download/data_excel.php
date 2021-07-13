<?
$xls_file = '/home/d/dc178435/public_html/upload/export/'.$current_date.'/data.xls';

$arResult = $elements;

foreach($arResult as $item)
{
	foreach($item as $field)
	{
        $line .='<tr>
			        <td valign="top">'.$field["NAME"].'</td>
                    <td valign="top">'.$field["PREVIEW_TEXT"].'</td>';

        if (!empty($field['~PROPERTY_TEXT_VALUE'])){
            $line .='<td valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="0">';
            foreach($field['~PROPERTY_TEXT_VALUE'] as $text){
                    $line .='<tr><td>'.$text['TEXT'].'</td></tr>';
                }
            $line .='</table></td>';
        }else $line .='<td></td>';

        $line .= '<td valign="top">'.$field['SPECIFICATIONS']['PRICE'].'</td>';
        
        if (!empty($field['SPECIFICATIONS']['CHARACTERISTICS'])){
            $line .='<td valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="0">';
            foreach($field['SPECIFICATIONS']['CHARACTERISTICS'] as $characteristic){
                $line .='<tr><td>'.$characteristic['VALUE'].'</td><td>'.$characteristic['DESCRIPTION'].'</td></tr>';
            }
            $line .='</table></td>';
        }else $line .='<td></td>';

        if (!empty($field['PROPERTY_IMAGE_VALUE'])){
            $line .='<td valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="0">';
            foreach($field['PROPERTY_IMAGE_VALUE'] as $image){
                $line .='<tr><td>'.$image['PREVIEW'].'</td></tr>';
                $line .='<tr><td>'.$image['FULL'].'</td></tr>';
            }
            $line .='</table></td>';
        }else $line .='<td></td>';

        $line .='<td valign="top">'.$field['SPECIFICATIONS']['SHEMA'].'</td>';

        if (!empty($field['SPECIFICATIONS']['DOWNLOAD'])){
            $line .='<td valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="0">';
            foreach($field['SPECIFICATIONS']['DOWNLOAD'] as $document){
                $line .='<tr><td>'.$document.'</td></tr>';
            }
            $line .='</table></td>';
        }else $line .='<td></td>';
	}
    $line .='</tr>';
}




$table = '<table class="field_jurnal" width="100%" border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th valign="top">Товар</th>
                    <th valign="top">Анонс</th>
                    <th valign="top">Описание, Особенности</th>
                    <th valign="top">Стоимость, евро</th>
                    <th valign="top">Характеристики</th>
                    <th valign="top">Фото</th>
                    <th valign="top">Чертеж</th>
                    <th valign="top">Документы</th>
                </tr>
            </thead>
            <tbody>'.$line.'</tbody>
          </table>';
    

//$data = json_encode($elements, JSON_UNESCAPED_UNICODE);
//$data = json_encode($elements);
    
$fp = fopen($xls_file, "w");
fwrite($fp, $table);
fclose($fp);
?>