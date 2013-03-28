<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExplainAction
 *
 * @author malyshev
 */
class YiiDebugExplainAction extends CAction
{
    public function run()
    {
        $query = base64_decode(Yii::app()->request->getPost('query'));
        $connectionId = Yii::app()->request->getPost('connectionId');
        $connection = Yii::app()->getComponent($connectionId);
        $command = $connection->createCommand('EXPLAIN EXTENDED ' . $query);
        $data = $command->queryAll();
        $this->controller->render('sql/_explain', array(
            'results' => $data
        ));
    }
    
    protected function getQuery()
    {
        return base64_decode(Yii::app()->request->getPost('query'));
    }
}