<!doctype html>
<html>
    <head>
        <title>Codeigniter Wizard<?= empty($title) ? '' : ' - ' . $title ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css')?>">
        <script src="<?= base_url('assets/jquery/jquery.min.js') ?>" type="application/javascript"></script>
        <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js')?>" type="application/javascript"></script>

        <style>
            @import url(//fonts.googleapis.com/earlyaccess/notosanstc.css);
            body {
                background-color: #D0D0D0;
                font-family: 'Noto Sans TC', '微軟正黑體', Arial;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Codeigniter Wizard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">專案 <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">匯入/匯出設定檔</a>
                    <a class="nav-item nav-link" href="https://github.com/slps970093/codeigniter-wizard">GitHub</a>
                </div>
            </div>
        </nav>
        <?php $this->load->view($this->router->directory . DIRECTORY_SEPARATOR .
                                $this->router->class . DIRECTORY_SEPARATOR .
                                $this->router->method); ?>
    </body>
</html>