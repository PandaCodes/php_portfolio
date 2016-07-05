<?php
$hh_url_0 = 'http://hh.ru/auth/applicant';
$hh_url_1 = 'http://hh.ru/applicant/resumes/short?resume=';
$hh_reg_data = 'email='.$reg_email.'&password='.$password.'&firstName='.$firstname.'&lastName='.$lastname;
$hh_data = array(
		'publish-short'=>'short',
		'lastName.string'=>$lastname,
		'firstName.string'=>$firstname,
		'birthday.date'=>$b_year.'-'.$b_month.'-'.$b_day,   ////???порядок
		'gender.string'=>'male',  //male/female
		'area.string'=> '1',//area
		'metro.string'=>'',///
		'phone.type'=>'cell',
		'phone.country'=>$phone_country,
		'phone.city'=>$phone_city,
		'phone.number'=>$phone_number,
		'phone.comment'=>'',
		'email.string'=>$email,
		'preferredContact.string'=>'email',
		'citizenship'=>'on',  /////////
		'citizenship.string'=>'113',///
		'workTicket'=>'on',///
		'workTicket.string'=>'113',///
		'relocation.string'=>'no_relocation', //возможен переезд? no_relocation/relocation_possible/relocation_desirable
		'relocationArea.string'=>'',
		'relocationArea.string'=>'',
		'educationLevel.string'=>'secondary',
		/*'primaryEducation.id:',  //если несколько - поля дублируются
		'primaryEducation.name:Московский физико-технический институт (Государственный университет), Москва',
		'primaryEducation.universityId:39223',
		'primaryEducation.facultyId:24882',
		'primaryEducation.organization:Факультет общей и прикладной физики',
		'primaryEducation.result:Астрофизик',
		'primaryEducation.specialtyId:',
		'primaryEducation.year:2016',*/
		'language.id'=>'34',   //родной язык 34 - Русский
		'language.degree'=>'native',
		'language.id'=>'57',  //57 - английский
		'language.degree'=>'can_pass_interview', //level: none/basic/can_read/can_pass_interview/fluent
		/*'language.id:180',
		'language.degree:can_pass_interview',*/
		'someShit'=>'on',
		'title.string'=>$title, //Должность
		'salary.amount'=>$pay,
		'salary.currency'=>'RUR',
		'career_start'=>'on', //если нет опыта работы
		'profarea'=>'15',  //если нет опыта работы: авто profarea 'начало карьеры, студенты'
		'specialization.string'=>'390', ///
		'specialization.string'=>'96',
		'specialization.string'=>'281',
		'employment.string'=>'full',  //занятость.  full/part/project/volunteer/probation(стажировка)
		'workSchedule.string'=>'full_day', // график full_day/shift(сменный)/flexible/remote(удален)
		'accessType.string'=>'everyone',
		'submit'=>'Сохранить и опубликовать резюме'
	);
$hh_formed_data = http_build_query($hh_data);

post_content($hh_url_0, $hh_reg_data);
post_content($hh_url_1, $hh_formed_data);
//Если ес ть опыт работы, то еще одна страница
//'http://hh.ru/applicant/resumes/short?resume=6aefdec1ff01d8223c0039ed1f675563563565' hash

//data 2
//http://hh.ru/applicant/resumes/edit/experience?resume=6aefdec1ff01d8223c0039ed1f675563563565

//http://hh.ru/applicant/resumes/touch
/*resume=6aefdec1ff01d8223c0039ed1f675563563565&publish=first&publish-short=full&createVisibleResume=true*/
//+редактирование, добавить фото, отчество и пр.