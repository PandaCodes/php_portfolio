<?php
$url = 'http://www.rabota.ru/v3_anonymousResume.html';
$data = 'wishes%5BcustomPosition%5D=%D0%91%D1%83%D1%85%D0%B3%D0%B0%D0%BB%D1%82%D0%B5%D1%80&person%5Bsurname%5D=%D0%BA%D0%B2%D0%B5%D1%80%D1%82%D0%B8&person%5Bname%5D=%D0%99%D1%86%D1%83%D0%BA%D0%B5%D0%BD%D0%BE%D0%B2&person%5BsecondName%5D=&person%5BbirthDay%5D=15&person%5BbirthMonth%5D=7&person%5BbirthYear%5D=1991&_validBirthDate=true&person%5Bmale%5D=t&person%5Bmail%5D=asd%40qwe.df&person%5Bpass%5D=password&person%5BphoneList%5D%5B0%5D%5BtelephoneId%5D=&person%5BphoneList%5D%5B0%5D%5BtelephoneType%5D=2&person%5BphoneList%5D%5B0%5D%5BtelephoneComment%5D=&person%5BphoneList%5D%5B0%5D%5BtelephoneCountryCode%5D=7&person%5BphoneList%5D%5B0%5D%5BtelephoneCode%5D=876&person%5BphoneList%5D%5B0%5D%5BtelephoneNumber%5D=8765456&person%5BphoneList%5D%5B0%5D%5B_gluedPhone%5D=';
$result = post_content($url, $data);
$p_url = $result['url'];
$pos_id =  strrpos($p_url, '=') + 1;
$id = substr($p_url, $pos_id);
		///////
$data2_1 = 'customPosition=%D0%94%D0%B0%D0%BD%D0%BE%D0%B1%D0%BE%D0%B9%D1%89%D0%B8%D0%BA&tradeIds_length=1&trade%5B41%5D=41&salaryFrom=1000&salaryFrom_formatted=1+000&currencyId=2&isBusinessTrip=t&leavingRegionIds%5B%5D=3&draftId='.$id.'&resumeId=&formName=wishes&id=&validateDraft=on';
$data2_2 = array(
	    "habitsOfWork"=>'ddddddddddddddddddddfs',
        "noExperience"=>'on',
        "draftId"=>$id,
        "resumeId"=>'',
        "formName"=>'work',
        "id"=>'',
	    "validateDraft"=>'on'
    );
$data2_3 = 'offerEducationId=1&languageList%5B0%5D%5Blanguage_id%5D=&languageList%5B0%5D%5Bis_native%5D=t&languageList%5B0%5D%5BofferLanguageLevel%5D=4&languageList%5B0%5D%5BofferLanguage%5D=59&personalQualities=&additionalComment=&draftId='.$id.'&resumeId=&formName=skills&id=&validateDraft=on';
$url2 = 'http://www.rabota.ru/v3_myResume.html?action=save';
	
post_content($url2, $data2_1);
post_content($url2, $data2_2);  
    
$url3 = 'http://www.rabota.ru/v3_myResume.html?action=edit&draftId='.$id;
//$result = get_web_page($url3);
post_content($url2, $data2_3);   //вывести из черновиков??
	
$url4 = 'http://www.rabota.ru/?area=v3_popupResumePublish&id='.$id.'&s=1&edit=1';
$url5 = 'http://www.rabota.ru/?area=v3_myResume&action=edit&resumePublished=1&s=1&id='.$id;
//get_web_page($url4); //видимость
//$result = get_web_page($url5); //опубликовать