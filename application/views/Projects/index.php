<style>
    .content {
        background-color: white;
        padding: 30px;
        margin-top: 2%;
    }
</style>

<script type="text/javascript" src="<?= base_url('assets/jquery-validation/jquery.validate.min.js')?>"></script>
<script type="text/javascript" src="<?= base_url('assets/jquery-validation/localization/messages_zh_TW.js') ?>"></script>

<div class="modal" tabindex="-1" role="dialog" id="projectCreateModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">新增專案</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createFrom">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="projectName">專案名稱</label>
                        <input type="text" name="projectName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="projectPath">專案路徑</label>
                        <input type="text" name="projectPath" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                    <button type="submit" class="btn btn-primary">存檔</button>
                </div>
            </form>
        </div>
    </div>
</div>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="content">
                <button type="button" class="btn btn-primary" onclick="modal_create()">新增專案</button>
                <hr />
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>專案名稱</th>
                            <th>專案路徑</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projectList as $key =>  $item) { ?>
                        <tr>
                            <td><?= $item['project_name'] ?></td>
                            <td><?= $item['project_path'] ?></td>
                            <td>
                                <a href="<?= site_url('wizard/language/' . $key)?>" class="btn btn-dark">翻譯精靈</a>
                                <a href="#" class="btn btn-primary">修改設定</a>
                                <a href="#" class="btn btn-danger">刪除</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable();
    });

    function modal_create() {
        $('#projectCreateModal').modal('show');
    }


    $('#createFrom').validate({
        submitHandler: function () {
            $.ajax({
                url: '<?= site_url('projects/append') ?>',
                data: $('#createFrom').serialize(),
                method: 'post',
                success: function () {
                    alert('新增完成');
                    location.reload();
                }
            })
        }
    })
</script>