<?php

namespace Application\Form;

use Zend\Form\Form;

/**
 * View Helper
 */
class loginform extends Form
{

    public function __construct()
    {
        parent::__construct($name=null);
        parent::setAttribute('method', 'post');
        parent::setAttribute('action', 'home/login');
        
        //fields
        
        $this->add(array(
            'name'=>'username',
            'attributes'=>array(
                'type'=>'text',
                'required'=>'required',
                'placeholder'=>'username',
            ),
           'options'=>array(
               'label'=>'Username:',
               ),
            ));
        
        $this->add(array(
        		'name'=>'password',
        		'attributes'=>array(
        				'type'=>'password',
        				'required'=>'required',
        		),
        		'options'=>array(
        				'label'=>'Passwort:',
        		),
        ));
        
        $this->add(array(
        		'name'=>'submit',
        		'attributes'=>array(
        				'type'=>'submit',
        				'required'=>'required',
        		        'value' => 'Login'
        		),
        ));
        
    }
}
