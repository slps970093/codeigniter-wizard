<?php
/**
 * 專案設定 Controller
 *
 * Class Projects
 *
 * @another 小周
 */

class Projects extends CI_Controller
{

    public function index()
    {
        $this->load->view('layouts/bootstrap_base');
    }

    public function append()
    {
        $postData = $this->security->xss_clean($this->input->post());

        $projectRoot = $postData['projectPath'];
        // 檢查專案根目錄 是否存在 application
        if (!is_dir($projectRoot . DIRECTORY_SEPARATOR . 'application')) {

        }
        // 讀檔

        // 新增設定檔案
        $data[ time() ] = [
            'project_name' => $postData['projectName'],
            'project_path' => $postData['projectPath']
        ];

        // 格式轉 JSON

        // 存檔
    }

    public function modify($id)
    {

    }

    public function remove($id)
    {

    }
}