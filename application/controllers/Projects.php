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

    private $wizardConfigFilePath;

    public function __construct()
    {
        parent::__construct();
        $this->wizardConfigFilePath = APPPATH  . 'config' . DIRECTORY_SEPARATOR . 'wizard' . DIRECTORY_SEPARATOR . 'project.json';
    }

    public function index()
    {
        $data['projectList'] = [];
        if (file_exists($this->wizardConfigFilePath)) {
            $data['projectList'] = json_decode(file_get_contents($this->wizardConfigFilePath),true);
        }
        $this->load->view('layouts/bootstrap_base',$data);
    }

    public function append()
    {
        $postData = $this->security->xss_clean($this->input->post());

        $projectRoot = $postData['projectPath'];
        // 檢查專案根目錄 是否存在 application
        if (!is_dir($projectRoot . DIRECTORY_SEPARATOR . 'application')) {
            throw new Exception("專案不存在");
        }
        // 讀檔
        if (is_file($this->wizardConfigFilePath)) {
            $data = json_decode(file_get_contents($this->wizardConfigFilePath),true);
        }
        // 新增設定檔案
        $data[ time() ] = [
            'project_name' => $postData['projectName'],
            'project_path' => $postData['projectPath']
        ];

        // 格式轉 JSON
        if (file_exists($this->wizardConfigFilePath)) {
            unlink($this->wizardConfigFilePath);
        }
        file_put_contents($this->wizardConfigFilePath,json_encode($data),FILE_WRITE_MODE);
        // 存檔
        $this->output->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['status' => true]));
    }

    public function modify($id)
    {

    }

    public function remove($id)
    {

    }
}