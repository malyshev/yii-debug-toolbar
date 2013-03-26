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
        $query = $this->getQuery();
        echo $query;
    }
    
    protected function getQuery()
    {
        return base64_decode(Yii::app()->request->getPost('query'));
    }
}