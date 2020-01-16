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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="content">
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
                    <button type="submit">產生程式碼</button>
                </form>

            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>