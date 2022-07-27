<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	
	<span>Категория сотрудников:</span><ul><li><?=$arItem["NAME"]?>
	<ul>	 
	<?foreach($arItem['SOTRUDNICS'] as $item):?>
		<span>Ф.И.О сотрудника:</span><li><?=$item["NAME"]?></li>
		<span>Доступное авто:</span><li><?=$item["PROPS"]["VALUE"]?></li>
	<?endforeach;?>
	</ul>
	</li></ul>
<?endforeach;?>
