<?php

namespace  App\Services;  //namespaceはフォルダの場所

class CheckFormService
{
 public static function checkGender($data){

  if($data->gender===0){     
    $gender = '男性'; //contact->genderでidに基づいた情報が取れる
  } else{
    $gender = '女性';
  }
    return $gender;
 }

 public static function checkAge($contact){
  if($contact->age ===1){$age = '~19';}
  if($contact->age ===2){$age = '20~29';}
  if($contact->age ===3){$age = '30~39';}
  if($contact->age ===4){$age = '40~49';}
  if($contact->age ===5){$age = '50~59';}
  if($contact->age ===6){$age = '60~';}
 
  return $age;
 }
}