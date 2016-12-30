<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Add
 *
 * @author Mohamed
 */
namespace Application\Form; 
use Zend\Form\Form,    
    Zend\Form\Element, 
    Application\Module    
        ;

class Add extends Form{
    //put your code here
    public function __construct() {
        parent::__construct('add');
        $module = new Module();
        $config = $module->getConfig();
        $path = $config['console']['router']['routes']['crontabfile']['options']['path'];
        if(file_exists($path)){

            $names=file($path);	
            $i = 0;	
            foreach($names as $name)
            {
            $title = new Element($i);
            $title->setLabel('Heure '.$i);
            $title->setAttribute('class', 'form-control');     
            $title->setValue(preg_replace('/\\\n/m', '', $name));
            $this->add($title);
            $i++;
           }
        }
    }
}
