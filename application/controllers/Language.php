<?php
/**
 * 語系
 *
 * Class Language
 *
 * @another 小周
 */

use Symfony\Component\Finder\Finder;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Language extends CI_Controller
{
    /**
     * 專案清單
     * @var array
     */
    private $projectList;

    public function __construct()
    {
        parent::__construct();
        // 讀取精靈的專案設定檔案
        $wizardConfig = APPPATH . 'config' . DIRECTORY_SEPARATOR . 'wizard' . DIRECTORY_SEPARATOR . 'project.json';
        $this->projectList = json_decode(file_get_contents($wizardConfig), true);
    }

    public function index($key)
    {
        $projectConfig = $this->projectList[$key];
        $projectLanguageList = $this->getProjectLanguageDirectoryList($projectConfig['project_path']);
        $projectLanguageFilePath = $this->getProjectLanguageFileList($projectConfig['project_path']);
        $this->load->view('layouts/bootstrap_base', [
            'projectLangList' => $projectLanguageList,
            'projectLangFilePath' => $projectLanguageFilePath,
            'projectKey' => $key
        ]);
    }

    /**
     * 轉換成 Excel
     */
    public function conventExcel($key)
    {
        $inputData = $this->input->get('langPath');
        $project = $this->projectList[$key];

        $langFile = $project['project_path'] . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR .
            'language' . DIRECTORY_SEPARATOR . $inputData;
        if (file_exists($langFile)) {
            include $langFile;
        }
        $tmpFileName = FCPATH . DIRECTORY_SEPARATOR . "export.xlsx";
        if (file_exists($tmpFileName)) {
            unlink($tmpFileName);
        }
        $writer = WriterFactory::create(Type::XLSX); // for XLSX files
        $writer->openToBrowser($tmpFileName);

        $outputData[0][0] = 'CI 識別碼';
        $outputData[0][1] = '語系字串';
        $idx = 1;
        foreach ($lang as $key => $value) {
            $outputData[$idx][0] = $key;
            $outputData[$idx][1] = $value;
            $idx++;
        }
        $writer->addRows($outputData);
        $writer->close();
    }

    public function conventLangCode($key)
    {
        $postData = $this->input->post();
        if ($_FILES['excel_file']['error'] != UPLOAD_ERR_OK) {
            throw new Exception('上傳失敗');
        }
        $project = $this->projectList[$key];
        $filePath = $_FILES['excel_file']['tmp_name'];
        // @see https://github.com/box/spout/blob/2.x-branch/docs/_pages/getting-started.md
        $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
        $reader->open($filePath);
        $count = 0;
        $lang = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                // do stuff with the row
                if ($count == 0) {
                    $count++;
                    continue;
                }
                if (empty($row[0])) {
                    break;
                }
                $lang[$row[0]] = $row[2];
                $count++;
            }
        }
        $reader->close();
        // 產生程式碼
        $content = "<?php\n\n";
        $content .= $this->load->view('code_gen/lang', ['data' => $lang], true);
        $projectLangRoot = $project['project_path'] . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'language' . DIRECTORY_SEPARATOR;
        $saveFilePath = $projectLangRoot . $postData['location'] . DIRECTORY_SEPARATOR . $postData['file_name'] . '_lang.php';
        if (file_exists($saveFilePath)) {
            unlink($saveFilePath);
        }
        file_put_contents($saveFilePath, $content, FILE_APPEND);
        redirect('wizard/language/' . $key . '?status=1');
    }

    /**
     * 取得專案資料夾各語系路徑
     * @param $projectPath
     * @return array
     */
    private function getProjectLanguageDirectoryList($projectPath)
    {
        $finder = new Finder();
        // 取得資料夾清單
        $finder->directories()->in($projectPath . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'language');
        $data = [];
        foreach ($finder as $item) {
            $data[] = $item->getRelativePathname();
        }
        return $data;
    }

    /**
     * 取得翻譯語系檔案
     * @param $projectPath
     * @return array
     */
    private function getProjectLanguageFileList($projectPath)
    {
        $finder = new Finder();
        // 取得資料夾清單
        $finder->files()->name('*_lang.php')->in($projectPath . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'language');
        $data = [];
        foreach ($finder as $item) {
            $data[$item->getRelativePathname()] = $item->getFileInfo();
        }
        return $data;
    }
}