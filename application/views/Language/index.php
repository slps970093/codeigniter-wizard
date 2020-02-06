<style>
    .content {
        background-color: white;
        padding: 30px;
        margin-top: 2%;
    }
</style>

<script type="text/javascript" src="<?= base_url('assets/jquery-validation/jquery.validate.min.js')?>"></script>
<script type="text/javascript" src="<?= base_url('assets/jquery-validation/localization/messages_zh_TW.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

            <div class="content">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#code_convent_excel" role="tab" aria-controls="home" aria-selected="true">語系檔案轉換 Excel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="create-lang-file" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Excel 轉換為 程式碼</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="code_convent_excel" role="tabpanel" aria-labelledby="home-tab">
                        <form action="<?= site_url('wizard/language/export/'. $projectKey)?>" method="get">
                            <div class="form-group">語系檔案</div>
                            <select class="form-control" required name="langPath">
                                <?php foreach ($projectLangFilePath as $filePath => $fileInfo) { ?>
                                    <option value="<?= $filePath ?>"><?= $fileInfo->getBasename() ?>&nbsp;(<?= $fileInfo->getPathname() ?>)</option>
                                <?php } ?>
                            </select>
                            <button type="submit" class="btn btn-primary">產生程式碼</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="create-lang-file">

                        <form action="<?= site_url('wizard/language/create/code/'.$projectKey)?>" method="post" enctype="multipart/form-data">
                            <label for="location">存放語系檔案程式碼目錄</label>
                            <select class="form-control" name="location">
                                <?php foreach ($projectLangList as $item) { ?>
                                    <option value="<?= $item ?>"><?= $item?></option>
                                <?php } ?>
                            </select>
                            <label for="file_name">程式碼檔案名稱</label>
                            <input type="text" class="form-control" name="file_name">
                            <label for="excel_file">EXCEL檔案</label>
                            <input type="file" class="form-control" name="excel_file">
                            <button type="submit" class="btn btn-primary">產生程式碼</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>

        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<?php if ($this->input->get('status') == 1) { ?>
<script type="text/javascript">
    Swal.fire(
        '系統訊息',
        '已經產生專案語系程式碼',
        'success'
    )
</script>
<?php } ?>
