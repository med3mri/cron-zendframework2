<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\Add;
use Application\Services\CrontabManager;

class IndexController extends AbstractActionController {

    public function indexAction() {
        return new ViewModel();
    }

    public function cronformAction() {
        $form = new Add();
        return new ViewModel(
                array('form' => $form)
        );
    }

    public function generatecronAction()
    {
        $config = $this->getServiceLocator()->get('Config');
        $path = $config['console']['router']['routes']['crontabfile']['options']['path'];
        $pathcommande = realpath(dirname(__DIR__).'/../../../../public/index.php');        
        $crontab = new CrontabManager();
        $job = $crontab->newJob();
        $job->on('15 * * * *')->doJob("php $pathcommande crontabfile >> $path");
        $crontab->add($job);
        $crontab->save();
    }    
    public function generatefileAction()
    {
           echo date("Y-m-d H:i")."\r\n";
    }    
}
    