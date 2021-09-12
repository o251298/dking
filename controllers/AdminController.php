<?php


class AdminController extends AdminBase
{
    public function actionIndex(){
        self::checkAdmin();
        $file = ROOT.'/logs.txt';
        $logs = file_get_contents($file);

        require_once(ROOT.'/views/admin/index.php');
        return true;
    }
}