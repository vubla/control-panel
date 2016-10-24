<?php 


class crawlstatusController extends BaseController {

    function standard()
    {

    }

    function ajax()
    {
        if(!empty($_GET))
        {
            $hostname = $_GET['hostname'];
        }
        else if(!empty($_POST))
        {
            $hostname = $_POST['hostname'];
        }
        
        $status = new CrawlStatus(HttpHandler::resolveWid($hostname));
        $this->vars->steds = $status->steps();
        $this->view = 'ajaxcrawlstatus';
    }
}





