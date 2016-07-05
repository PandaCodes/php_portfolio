<?php
$sjob_data_0 = array(
		'model[email1]' => $email,
		'model[firstname]'=>$firstname,
		'model[lastname]'=>$lastname,
		'model[middlname]'=>$middlename,
		'model[receive_sms]'=>'1',
		'model[town]'=>'4',
		'model[townName]'=>'Москва',
		'model[address]'=>$area,
		'model[metro][0]'=>'',
		'model[moveable]'=>'',
		''=>'',
		'model[citizenship]'=>'1',
		'model[phone1]'=>'',
		'model[phone2]'=>'',
		'model[timebeg1]'=>'',
		'model[timeend1]'=>'',
		'model[timebeg2]'=>'',
		'model[timeend2]'=>'',
		'model[phones][0][number]'=>'8(916)999-99-99',
		'model[phones][0][notmobile]'=>'false',
		'model[phones][0][mask]'=>'',
		'model[phones][0][timebeg]'=>'',//'01:00', int 0 - 24
		'model[phones][0][timeend]'=>'',//'16:00',
		'model[phones][0][password]'=>'',
		'model[phones][1][number]'=>'+7(911)999-99-99',
		'model[phones][1][notmobile]'=>'false',
		'model[phones][1][hide]'=>'false',
		'model[phones][1][password]'=>'',
		'model[phones][1][timebeg]'=>'',
		'model[phones][1][timeend]'=>'',
		'model[other_contacts]'=>'Доп контакты',
		'model[birthday]'=>$b_day,
		'model[birthmonth]'=>$b_month,
		'model[birthyear]'=>$b_year,
		'model[birthdate]'=>$b_day.'.'.$b_month.'.'.$b_year,
		'model[pol]'=>'2',// м=2 ж=3
		'model[maritalstatus]'=>'',
		''=>'',
		'model[children]'=>'',
		'model[phone_confirm_code_condition][phone]'=>'',  //?????
		'model[phone_confirm_code_condition][old_phone]'=>'',
		'model[phone_confirm_code_condition][send_counter]'=>'0',
		'model[phone_confirm_code_condition][checked]'=>'false',
		'model[phone_confirm_code_condition][good_code]'=>'false',
		'model[phone_confirm_code_condition][code]'=>'',
		'model[phone_confirm_code_condition][confirm_error_text]'=>'',
		''=>'',
		'formname' => 'ResumeFirstBlockForm'
	);
$sjob_url_0 = 'http://www.superjob.ru/resume/create/post';
$sjob_formed_data_0 = http_build_query($sjob_data_0);

$sjob_getjson = post_content($sjob_url_0, $sjob_formed_data_0);	
$sjob_id = json_decode($sjob_getjson['content'])->{'data'}->{'id'};

$sjob_data_1 = array(
		'forms[ResumeKnowledgeFormModel][education]'=>'5', //среднее=5
		/*'forms[ResumeKnowledgeFormModel][base_education_history][0][yearend]:2021',
		'forms[ResumeKnowledgeFormModel][base_education_history][0][institut]:(КВВУ) Краснодарское высшее военное училище имени генерала армии Штеменко С.М., Краснодар',
		'forms[ResumeKnowledgeFormModel][base_education_history][0][fakultet]:Факультет',
		'forms[ResumeKnowledgeFormModel][base_education_history][0][eduform]:10',
		'forms[ResumeKnowledgeFormModel][base_education_history][0][typeed]:2',
		'forms[ResumeKnowledgeFormModel][base_education_history][0][profession]:Специальность',
		'forms[ResumeKnowledgeFormModel][base_education_history][0][id_institute]:3591',
		'forms[ResumeKnowledgeFormModel][base_education_history][0][id]:',
		'forms[ResumeKnowledgeFormModel][base_education_history][1][typeed]:4'',
		'forms[ResumeKnowledgeFormModel][base_education_history][1][id_institute]:3841',
		'forms[ResumeKnowledgeFormModel][base_education_history][1][institut]:Национальный институт моды, Москва',
		'forms[ResumeKnowledgeFormModel][base_education_history][1][eduform]:10',
		'forms[ResumeKnowledgeFormModel][base_education_history][1][yearend]:2016',
		'forms[ResumeKnowledgeFormModel][base_education_history][1][profession]:Специальнсть',
		'forms[ResumeKnowledgeFormModel][education_history][0][yearend]:2011', //курсы
		'forms[ResumeKnowledgeFormModel][education_history][0][institut]:учзаведкурса',
		'forms[ResumeKnowledgeFormModel][education_history][0][town]:Городкурса',
		'forms[ResumeKnowledgeFormModel][education_history][0][name]:Курс',
		'forms[ResumeKnowledgeFormModel][education_history][0][townId]:0',*/
		'forms[ResumeKnowledgeFormModel][langs][0][id_language]'=>'1', //1=английский 2=немецкий 3=французский 4=испанский
		'forms[ResumeKnowledgeFormModel][langs][0][level]'=>'3', //3=базовый 5=технический 7=разговорный 9=свободно владею
		/*'forms[ResumeKnowledgeFormModel][langs][1][id_language]:2',
		'forms[ResumeKnowledgeFormModel][langs][1][level]:5',
		'forms[ResumeKnowledgeFormModel][DRL][0]:A', //ABCDE
		'forms[ResumeKnowledgeFormModel][DRL][1]:C', */
		'forms[ResumeKnowledgeFormModel][best]'=>'',//Ключевые навыки
		'forms[ResumeKnowledgeFormModel][dop]'=>''//Личные качества, и пр.
	);
$sjob_url_1 = $superjob_url_0.'?id='.$sjob_id;
$sjob_formed_data_1 = http_build_query($sjob_data_1);

post_content($sjob_url_1, $sjob_formed_data_1);

$sjob_url_3 = 'http://www.superjob.ru/resume/cv-'.$sjob_id.'.html?published=1';
$result = get_web_page($sjob_url_3); //get it
//+ редактирование: добавить фото, портфолио
