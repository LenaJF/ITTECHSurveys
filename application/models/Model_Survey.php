<?php
class Model_Survey extends Model {
    function resultSum($str1, $str2){
        return $str1.'/'.$str2;
    }



    function getByIdentity($id){
       return  DB::getDb()->query("SELECT su.title as title, su.description as description, tp.name as type, su.start_date as start, su.finish_date as end FROM `survey` su join type_survey tp on su.id_type=tp.id WHERE su.identification='{$id}' GROUP BY su.title, su.description, tp.name, su.start_date, su.finish_date");
    }

    function getQuestion($id){
       return DB::getDb()->query("SELECT qu.question as question, type_question.name as type, qu.variant_answer as answer FROM questions qu join survey surv on qu.id_survey=surv.id join type_question on qu.id_type=type_question.id WHERE surv.identification='{$id}'");
    }

    function getEmployees($email, $id){
       return DB::getDb()->query("SELECT COUNT(employees.id) as count FROM survey join employees_access on survey.id=employees_access.id_survey join employees on employees_access.id_employees=employees.id WHERE employees.email='{$email}' AND survey.identification='{$id}'")->fetch_assoc()['count'];

    }

    function setHistory($email, $survey){
        $id_empl = DB::getDb()->query("SELECT id  FROM `employees` WHERE email='{$email}'")->fetch_assoc()['id'];
        $id_surv = DB::getDb()->query("SELECT id FROM `survey` WHERE identification='{$survey}'")->fetch_assoc()['id'];
        if(mysqli_query(DB::getDb(),"INSERT INTO `history`(`id_survey`, `id_employees`, `date`, `ip_adres`) VALUES ( '{$id_surv}','{$id_empl}' , '".date("Y-m-d")."' , '".$_SERVER["REMOTE_ADDR"]."')")){
            return "выполнено";
        }else{
            return "не выполнено";
        }

    }

}