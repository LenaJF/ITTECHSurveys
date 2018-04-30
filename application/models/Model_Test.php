<?php
class Model_Test extends Model {
    function resultSum($str1, $str2){
        return $str1.'/'.$str2;
    }

    function getTypeSurvey(){
        return $result = DB::getDb()->query("SELECT * FROM `type_survey`");
        //while($row = $result->fetch_assoc()){
          //  $row['id']
        //}
    }

    function getAllSurveys(){
        return $result = DB::getDb()->query("SELECT srv.id as id, srv.title as title, srv.start_date as start, srv.finish_date as end, COUNT(hist.id) as completed, srv.image as img, srv.identification as ident FROM `survey` srv left join history hist on srv.id=hist.id_survey WHERE srv.start_date<NOW() AND srv.finish_date>NOW() GROUP by srv.id, srv.title, srv.start_date, srv.finish_date");
    }

    function getTypeAnswer(){
        return $result = DB::getDb()->query("SELECT * FROM `type_question`");
    }

    //фильтрация сотрудников
    function getEmpl($name, $company){
         return DB::getDb()->query("SELECT empl.id as id, empl.name as name FROM `employees` empl 
          join partners_employees partempl on empl.id=partempl.employees_id 
          join partners prtn on partempl.partners_id=prtn.id 
          WHERE empl.name LIKE '%".$name."%' AND prtn.companyName LIKE '%".$company."%'");
    }

    //получить id типа опроса
    function getIdTypeSurvey($name_survey){
         $id = 0;
         $result= DB::getDb()->query("SELECT id FROM `type_survey` WHERE name='{$name_survey}'");
         while ($row = $result->fetch_assoc()){
             $id = $row['id'];
         }
         return $id;
    }

    //добавление опроса
    function addSurvey($password, $title, $description, $id_type, $start_date, $end_date, $identification){
        $id = 0;
        DB::getDb()->query("INSERT INTO `survey`(`password`, `title`, `description`, `id_type`, `image`, `start_date`, `finish_date`, `identification`) 
            VALUES ('{$password}','{$title}','{$description}','{$id_type}','lololo','{$start_date}','{$end_date}','{$identification}')");
        $result = DB::getDb()->query("SELECT MAX('id') as id FROM `survey`");

        while($row = $result->fetch_assoc()){
            $id = $row['id'];
        }
        return $id;
    }

    //добавление списка сотрудников для опроса
    function addEmployeesAccess($id_survey, $id_empl){
        DB::getDb()->query("INSERT INTO `employees_access`(`id_survey`, `id_employees`) VALUES ('{$id_survey}','{$id_empl}')");
    }

    //получение id типа ответа
    function getIdTypeAnswer($name){
        $result = DB::getDb()->query("SELECT * FROM `type_question` WHERE name='{$name}'");
        while($row = $result->fetch_assoc()){
            return $row['id'];
        }
    }

    //добавление вопросов
    function addQuestion($id_survey, $question, $typeAnswer, $variant){
        DB::getDb()->query("INSERT INTO `questions`(`id_survey`, `question`, `id_type`, `variant_answer`) 
                                            VALUES ('{$id_survey}','{$question}', '{$typeAnswer}' ,'{$variant}')");
    }
}