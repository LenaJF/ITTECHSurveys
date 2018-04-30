<?php
include "application/models/Model_Test.php";
include "application/models/Model_Survey.php";
class Controller_Main extends Controller
{

    function action_index()
    {

        $this->view->render('index','basetemplate', ['data' => Model_Test::getAllSurveys()]);
    }

    function action_testForm(){
        if(isset($_POST['message']))
        {
            $this->view->render('index','basetemplate', [ 'result'=>Model_Test::resultSum($_POST['log'], $_POST['pass']) ]);
        }else{
        $this->view->render('testForm','basetemplate');}
    }

    function action_registerSurvey(){
        $this->view->render('registerSurvey','basetemplate',
            ['typeSurvey'=>Model_Test::getTypeSurvey(), 'typeAnswer'=>Model_Test::getTypeAnswer()]);
    }


    //передача сотрудников
    function action_getEmployees(){
        $result = Model_Test::getEmpl($_POST['name'], $_POST['company']);
        $emplItem = array();
        while($row = $result->fetch_assoc()){
            array_push($emplItem, [ id=>$row['id'], name=>$row['name']]);
        }
        header('Content-Type: application/json');
        echo json_encode($emplItem);

    }

    //добавление опроса
    function action_newSurvey(){
         Model_Test::addSurvey(
            $_POST['password'],
            $_POST['title'],
            $_POST['description'],
           Model_Test::getIdTypeSurvey($_POST['typeSurvey']),
            $_POST['startDate'],
            $_POST['endDate'],
            $_POST['identification']
        );

        $resultSurv = DB::getDb()->query("SELECT MAX(id) as id FROM `survey`");
        $id_survey = 0;
        while($row = $resultSurv->fetch_assoc()){
            $id_survey = $row['id'];
        }

        if($_POST['typeSurvey']=='Restrict Survey'){

             $result = DB::getDb()->query("SELECT * FROM `employees`");

             while($row = $result->fetch_assoc()){
                if(isset($_POST[$row['id']])){
                   Model_Test::addEmployeesAccess($id_survey, $row['id']);
                }
             }
         }

        $name = $_POST['name'];
        foreach ($name as $item){
            Model_Test::addQuestion(
                $id_survey,
                $item['question'],
                Model_Test::getIdTypeAnswer($item['typeAnswer']),
                $item['option']);
        }
        $this->action_index();
    }

    //вывод опроса
    function action_survey(){
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        $survey = Model_Survey::getByIdentity($routes[3]);
        $questions = Model_Survey::getQuestion($routes[3]);

        //проверка на пользователя
        if(isset($_POST['email'])){
           if(Model_Survey::getEmployees($_POST['email'], $routes[3])!= 0){
               $this->view->render('survey','basetemplate',
                   ['survey'=>$survey, 'questions'=>$questions, 'empl'=>$_POST['email'],'surveyIdent'=>$routes[3] ]);
           }else{
               $this->view->render('resctict', 'logintemplate',['error'=>"ACCESS NOT PERMITTED"]);
           }
        }else{

            while ($row = $survey->fetch_assoc()){
                if($row['type']=="Restrict Survey"){
                    $this->view->render('resctict', 'logintemplate');
                }else{
                    $this->view->render('survey','basetemplate', ['survey'=>$survey, 'questions'=>$questions]);
                }
            }

        }

    }

    //добавление в историю
    function action_addHistory(){
      echo  Model_Survey::setHistory($_POST['email'], $_POST['surv']);
    }


}