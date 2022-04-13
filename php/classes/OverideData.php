<?php
class OverideData{
    private $_pdo;
    function __construct(){
        try {
            $this->_pdo = new PDO('mysql:host='.config::get('mysql/host').';dbname='.config::get('mysql/db'),config::get('mysql/username'),config::get('mysql/password'));
        }catch (PDOException $e){
            $e->getMessage();
        }
    }

    public function emailNotification($emailAddress,$name){
        $to = $emailAddress;
        $subject = 'InfoElimu Password Alert';
        $email = 'support@infoelimu.ac.tz';
        $message = 'Someone is attempting to log in to your account.If your not the one,please change your password immediately';

        $message = <<<EMAIL
Hi $name

$message

From : INFOELIMU
Email Address : $email

EMAIL;
        $header = $email;

        mail($to,$subject,$message,$email,$header);
    }
    public function sortResult($s,$e,$c,$y){$x=0;$array=null;
        foreach($this->getNoRepeat4('results','student_id','school_id',$s,'class_id',$c,'exam_id',$e,'years',$y) as $result) {
            $subjects = $this->selectData4('results', 'student_id', $result['student_id'], 'class_id', $c, 'exam_id', $e, 'years', $y);
            $total=0;$f=0;
            foreach($subjects as $subject) {
                $total += $subject['score'];
                $f +=1;
            }$avg = round(($total/$f),1);
            $array[$x]=array('avg'=>$avg,'id'=>$result['student_id']);
            $x++;
        }
        array_multisort($array,SORT_DESC);
        return $array;
    }
    public function getPosition($id,$e,$s,$c,$y){
        $results = $this->selectData5('results','school_id',$id,'exam_id',$e,'subject_id',$s,'class_id',$c,'years',$y);$x=1;
        foreach($results as $result){
            $array[$x]=array('score'=>$result['score'],'id'=>$result['student_id'],'s_id'=>$s);
            $x++;
        }
        array_multisort($array,SORT_DESC);
        return $array;
    }
    public function studPosition($id,$e,$s,$c,$y){
        $results = $this->getPosition($id,$e,$s,$c,$y);
        return $results;
    }
    public function checkSubject($id,$e,$s,$c,$y){
        $results = $this->selectData5('results','school_id',$id,'exam_id',$e,'subject_id',$s,'class_id',$c,'years',$y);
        return $results;
    }
    public function getNo($table){
        $query = $this->_pdo->query("SELECT * FROM $table");
        $num = $query->rowCount();
        return $num;
    }
    public function getCount($table,$field,$value){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value'");
        $num = $query->rowCount();
        return $num;
    }
    public function countData($table,$field,$value,$field1,$value1){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1'");
        $num = $query->rowCount();
        return $num;
    }
    public function getCounted($table,$field,$value,$field1,$value1,$field2,$value2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $field2 = '$value2'");
        $num = $query->rowCount();
        return $num;
    }
    public function getData($table){
        $query = $this->_pdo->query("SELECT * FROM $table");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get($table,$where,$id){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getOrderBy($table,$where,$id,$value){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' ORDER BY  $value ASC ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getNews($table,$where,$id,$where2,$id2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getNewsOrderBy($table,$where,$id,$where2,$id2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' ORDER BY id DESC ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function updateSubject($table,$where,$id,$where2,$id2,$where3,$id3,$where4,$id4,$where5,$id5){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' AND $where3='$id3' AND $where4='$id4' AND $where5='$id5'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function updateSubjectSort($table,$where,$id,$where2,$id2,$where3,$id3,$where4,$id4,$where5,$id5,$value){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' AND $where3='$id3' AND $where4='$id4' AND $where5='$id5' ORDER BY $value DESC ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function rowCounted($table,$where,$id,$where2,$id2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2'");
        $rowCounted = $query->rowCount();
        return $rowCounted;
    }
    public function rowCount4($table,$where,$id,$where2,$id2,$where3,$id3,$where4,$id4){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' AND $where3='$id3' AND $where4='$id4'");
        $rowCounted = $query->rowCount();
        return $rowCounted;
    }
    public function selectData($table,$field,$value,$field1,$value1,$value2,$field2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function selectDataSort($table,$field,$value,$field1,$value1,$value2,$field2,$value3){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2' ORDER BY $value3 DESC ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function selectDataOrderBy($table,$field,$value,$field1,$value1,$value2,$field2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2' ORDER BY id DESC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function selectData4($table,$field,$value,$field1,$value1,$value2,$field2,$field3,$value3){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2' AND $field3 = '$value3'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function selectData5($table,$field,$value,$field1,$value1,$value2,$field2,$field3,$value3,$field4,$value4){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2' AND $field3 = '$value3' AND $field4 = '$value4'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function delete($table,$field,$value){
        return $this->_pdo->query("DELETE FROM $table WHERE $field = $value");
    }
    public function getSchools($table,$field,$value,$field1,$value1,$value2,$field2,$page,$numRec){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2' limit $page,$numRec");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getCollege($table,$where,$id,$where2,$id2,$page,$numRec){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' limit $page,$numRec");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getExamType($table,$field,$value,$field1,$value1,$value2,$field2){
        $query = $this->_pdo->query("SELECT DISTINCT exam_id FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function search($value,$num){
        $query = $this->_pdo->query("SELECT * FROM schools WHERE name LIKE '%$value%' limit $num,40");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function countSearch($value){
        $query = $this->_pdo->query("SELECT * FROM schools WHERE name LIKE '%$value%'");
        $result = $query->rowCount();
        return $result;
    }
    public function getNoRepeat($table,$param,$where,$id){
        $query = $this->_pdo->query("SELECT DISTINCT $param FROM $table WHERE $where = '$id'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getNoRepeatOrderBy($table,$param,$where,$id){
        $query = $this->_pdo->query("SELECT DISTINCT $param FROM $table WHERE $where = '$id' ORDER BY years DESC ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getNoRepeatD3($table,$param,$param1,$param2,$where,$id){
        $query = $this->_pdo->query("SELECT DISTINCT $param,$param1,$param2 FROM $table WHERE $where = '$id'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getNoRepeat2($table,$param,$param1,$where,$id){
        $query = $this->_pdo->query("SELECT DISTINCT $param,$param1 FROM $table WHERE $where = '$id'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getNoRepeat3($table,$param,$where1,$id1,$where2,$id2,$where3,$id3){
        $query = $this->_pdo->query("SELECT DISTINCT $param FROM $table WHERE $where1 = '$id1' AND $where2 = '$id2' AND $where3 = '$id3'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getNoRepeat4($table,$param,$field,$value,$field1,$value1,$value2,$field2,$field3,$value3){
        $query = $this->_pdo->query("SELECT DISTINCT $param FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2' AND $field3 = $value3");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getSelectNoRepeat($table,$value,$where,$id,$where2,$id2){
        $query = $this->_pdo->query("SELECT DISTINCT $value FROM $table WHERE $where = '$id' AND $where2 = '$id2'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getSelectNoRepeat2($table,$value,$value1,$where,$id,$where2,$id2){
        $query = $this->_pdo->query("SELECT DISTINCT $value,$value1 FROM $table WHERE $where = '$id' AND $where2 = '$id2'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getSelectDataNoRepeat($table,$param,$param2,$param3,$field,$value,$field1,$value1,$value2,$field2,$field3,$value3){
        $query = $this->_pdo->query("SELECT DISTINCT $param,$param2,$param3 FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2' AND $field3 = $value3");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getSelectDataNoRepeat1($table,$param,$field,$value,$field1,$value1,$value2,$field2,$field3,$value3){
        $query = $this->_pdo->query("SELECT DISTINCT $param FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2' AND $field3 = $value3");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getSelectData($table,$param,$field,$value,$field1,$value1,$value2,$field2){
        $query = $this->_pdo->query("SELECT DISTINCT $param FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getStudPosition($table,$where,$id,$where2,$id2,$where3,$id3,$where4,$id4,$where5,$id5){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' AND $where3='$id3' AND $where4='$id4' AND $where5='$id5' ORDER BY score DESC ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function checkRepeatExam($table,$where,$id,$where2,$id2,$where3,$id3,$where4,$id4,$where5,$id5,$where6,$id6){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' AND $where3='$id3' AND $where4='$id4' AND $where5='$id5' AND $where6 = '$id6' ORDER BY score DESC ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getStudAvg($table,$where,$id,$where2,$id2,$where3,$id3,$where4,$id4,$where5,$id5){
        $query = $this->_pdo->query("SELECT AVG(score) FROM $table WHERE $where = '$id' AND $where2 = '$id2' AND $where3='$id3' AND $where4='$id4' AND $where5='$id5' ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getDate($today,$date){
        $query = $this->_pdo->query("SELECT DATEDIFF('$date', '$today') AS endDate FROM contract ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function leaders($table,$field1,$value1,$field2,$value2,$field3,$value3,$field4,$value4,$field5,$value5){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field1 = '$value1' AND $field2 = '$value2' OR $field3='$value3' OR $field4='$value4' OR $field5 = '$value5'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}