<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\loginForm;
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
      $loginform=new loginForm();
      
      $view=new ViewModel(array('form'=>$loginform));
      
      $request = $this->getRequest();
      
      return $view;
    }
    
    public function loginAction()
    {
        $login=false;
        $first_name='';
        $last_name='';
   
        $username= $this->getRequest()->getPost('username');
        $password= $this->getRequest()->getPost('password');
        

        $record=array(
            'first_name' => array(
                'last_name' => array(
                    'username' => array(
                        'password' => array(),
                        ),
                    ),
                ),
            );
                
        
        if (($handle = fopen("http://". $_SERVER['HTTP_HOST'] ."/logins.csv", "r")) !== FALSE) {
            $row = 0;
        	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        		$num = count($data);
        		$row++;
        		$record['first_name'][]=$data[0];
                $record['last_name'][]=$data[1];
                $record['username'][]=$data[2];
                $record['password'][]=$data[3];
        		}
        		fclose($handle);
        		$key = array_search($username, $record['username']);
        		if($key)
        		    if($password==$record['password'][$key])
        		    {
        		        $login=true;
        		        $first_name=$record['first_name'][$key];
        		        $last_name=$record['last_name'][$key];
        		    }
        		    
        }        
         
        $view=new ViewModel(array('login'=>$login,'first_name'=>$first_name,'last_name'=>$last_name));
        
        return $view;

    }
    	 
}
        
