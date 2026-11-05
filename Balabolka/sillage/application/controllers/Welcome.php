<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to //welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
 try 
            
{
     $this->load->database() ;
     $this->load->model("database");
     $var1 = '01-01-2000';
$var2 = '01-09-2019';

$this->database->execute_sp($var1,$var2);
  //echo "okkk";

}
catch(Exception $e)
{
   print_r($e);
}
            
    /*$serverName = "https://93.93.190.241";
    $connectionOptions = array(
        "Database" => "Test_ANPAP",
        "Uid" => "web_sillage",
        "PWD" => "RR77Etet"
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if($conn)
        echo "Connected!";
    else
        echo"Problem!";*/

	}
}
