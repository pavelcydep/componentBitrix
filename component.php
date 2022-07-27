<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 180;

$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['IBLOCKS_PROP'] = intval($arParams['IBLOCKS_PROP']);

if($arParams['IBLOCK_ID'] > 0 && $arParams['IBLOCKS_PROP'] > 0 && $this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups())))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	//SELECT
	$arSelect = array(
		"*"
	);
	
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCKS"],
	    "ACTIVE"=>"Y",
		"CHECK_PERMISSIONS"=>"Y",
	);
	$rs_Section = CIBlockSection::GetList(array('sort' => 'asc'), $arFilter);  
	while ( $ar_Section = $rs_Section->Fetch() )
    {
		$arResult['ITEMS'][$ar_Section['ID']] = array(  
			'ID' => $ar_Section['ID'],
			'NAME' => $ar_Section['NAME'], 
			); 
    }  



foreach($arResult['ITEMS'] as $arItem) {
    $arFil = Array("IBLOCK_ID"=>$arParams["IBLOCKS"] ,array('SECTION_ID'=>$arItem['ID']));
    $arRes = CIBlockElement::GetList(Array(), $arFil, false, Array());
    while ( $arr = $arRes->GetNextElement() ) {
         $arFields= $arr->GetFields();  
         $arProps = $arr->GetProperties();
         $arFields["PROPS"]= $arProps["CAR"];
         $arResult['ITEMS'][$arItem['ID']]['SOTRUDNICS'][] = $arFields;
     
    }
    
	
}
	   $this->SetResultCacheKeys(array());
	   $this->IncludeComponentTemplate();
	}


?>
