<?

class Qcm
{
    protected $_questions = [];
    protected $_appreciations;
    
    public function ajouterQuestion(object $tab){
        
        if(!is_object($tab)){
            trigger_error('La question doit etre un tableau ', E_USER_WARNING);
            return;
        }
        array_push($this->_questions,$tab);
    }

    public function setAppreciation(array $notes){
        if(!is_array($question)){
            trigger_error("L'appreciation doit être un tableau ", E_USER_WARNING);
            return;
        }
        $this->_appreciations = $notes;
    }
    public function generer(){

        //Code HTML pour afficher les questions
         echo '<div>';
        for($i = 0; $i < count($this->_questions) ; $i++){
            echo '<div class="shadow p-4 rounded cadre'.$i.'">
                 <form action="" method="post">';
            echo '<h3 style="text-align:center" class="mb-4">'.$this->_questions[$i]->getQuestion().'</h3>';
            echo '<ul style="list-style:none">';
           foreach ($this->_questions[$i]->getReponse() as $key) {
           echo '<li><div class="form-check radio'.$i.'">
                    <input class="form-check-input" type="radio" name="question'.$i.'" value="option'.$i.'" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                    '.$key->_reponse.'
                    </label>
                </div></li>';
            }
          echo '</ul>';

            echo '<div style="text-align:center"><input type="submit" value="valider" name="question'.$i.'" class="buttonValid'.$i.' btn btn-primary valid"></div>
            </div></form>
            <br><br>';

        } 
        echo '</div>';

    }

    public function getJson(){

        //Création du fichier Json
        $json = "{ 'listeQuestion' : [ ";
        for($i = 0; $i < count($this->_questions) ; $i++){
            if($i == 0){
               $json .= "{'question". $i ."' : '". $this->_questions[$i]->getQuestion() ."', reponse : [{ ";
            }else{
                $json .= "]},{'question". $i ."' : '". $this->_questions[$i]->getQuestion() ."', reponse : [{";
            }
            $j = 1;
           foreach ($this->_questions[$i]->getReponse() as $key) {
            $result = true;
            if($key->_result !== true){ $result = 0;};
            $json .=  "'".$key->_reponse ."' : ". $result .",";;
            $j++;
            }
            $json .= " }";
            if($i+1 == count($this->_questions)){
                $json .= '] }';
            }
        } 
        $json .= '] }';
       
        
       return $json;
    }
        

    

}

class Question 
{
    protected $_question;
    protected $_reponse = [];
    protected $_explication;

    public function __construct($question){
        $this->setQuestion($question);
    }

    public function setQuestion(string $question){
        if(!is_string($question)){
        trigger_error('La question doit être une chaine de caractères ', E_USER_WARNING);
        return;
        }
        $this->_question = $question;
    }

    public function getQuestion(){
        return $this->_question;
    }

    public function getReponse(){
        return $this->_reponse;
    }
    
    public function ajouterReponse($reponse){
         array_push($this->_reponse,$reponse);
    }

    public function setExplication($explication){
        if(!is_string($explication)){
            trigger_error("L'explication doit être une chaine de caractères ", E_USER_WARNING);
            return;
        }
        $this->_explication = $explication;
    }

    
}

class Reponse 
{
    public $_reponse;
    public $_result;
    const BONNE_REPONSE = true;
    const MAUVAISE_REPONSE = false;

    public function __construct($reponse,$result){
        $this->setReponse($reponse);
        $this->setResult($result);
    }

    private function setReponse(string $reponse){
        
        if(!is_string($reponse)){

            trigger_error('La réponse doit être une chaine de caractères ', E_USER_WARNING);
            return;

        }
        $this->_reponse = $reponse;    
    }

    private function setResult($result){
        $this->_result = $result;    
    }
}


/* $qcm = new Qcm;
$test = new Question('Quel est le contraire de bien?');
$test->ajouterReponse(new Reponse('Pas Bien', Reponse::BONNE_REPONSE));
$test->ajouterReponse(new Reponse('correct', Reponse::MAUVAISE_REPONSE));
$test->ajouterReponse(new Reponse('probablement', Reponse::MAUVAISE_REPONSE));
$test->ajouterReponse(new Reponse('certainement', Reponse::MAUVAISE_REPONSE));
$test->setExplication('Et oui la reponse est "Pas bien"');

$test2 = new Question('Quelle était la couleur du cheval blanc de Henry 4 ?');
$test2->ajouterReponse(new Reponse('Blanc', Reponse::BONNE_REPONSE));
$test2->ajouterReponse(new Reponse('Noir', Reponse::MAUVAISE_REPONSE));
$test2->ajouterReponse(new Reponse('Rouge', Reponse::MAUVAISE_REPONSE));
$test2->ajouterReponse(new Reponse('Marron', Reponse::MAUVAISE_REPONSE));
$test2->setExplication('Et oui la reponse est "Blanc" comme indiqué dans la question ^^');

$test3 = new Question('Comment fait-on de la polenta ?');
$test3->ajouterReponse(new Reponse('Avec des patates',Reponse::MAUVAISE_REPONSE ));
$test3->ajouterReponse(new Reponse('Avec du riz', Reponse::MAUVAISE_REPONSE));
$test3->ajouterReponse(new Reponse('Avec du maïs',Reponse::BONNE_REPONSE ));
$test3->ajouterReponse(new Reponse('Avec du navet', Reponse::MAUVAISE_REPONSE));
$test3->setExplication('Et oui la reponse est "Avec du maïs"');

$qcm->ajouterQuestion($test);
$qcm->ajouterQuestion($test2);
$qcm->ajouterQuestion($test3);
 */





