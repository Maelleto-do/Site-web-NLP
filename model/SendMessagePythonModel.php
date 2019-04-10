<?php

include_once 'DBConnection.php';

class SendMessagePythonModel{

    public function sendMessagePython(){

      $message= $post['MESSAGE'];
      echo 'la chaine de caraactère voulu'.$message;
      $monfichier = fopen('texte_test.txt', 'w+');
      //file_put_contents('texte_test.txt', $message);
      fputs($monfichier, $message);
      fclose($monfichier);

        // $output = shell_exec('python model/python/nltk.py');
        //exec('python3 model/python/doudou.py', $output, $return_val );
      passthru('python3 model/python/doudou.py 2> doudou.log', $return_val );
        //echo $return_val;
        //echo shell_exec('python3 model/python/doudou.py 2> doudou.log');


      return $return_val;

    }



}
