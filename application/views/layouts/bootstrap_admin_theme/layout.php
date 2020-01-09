<!DOCTYPE html>
<html>
<head>
    <title>Codeigniter Wizard</title>
    <!-- Bootstrap -->
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" media="screen">
    <link href="<?= base_url('assets/bootstrap/css/bootstrap-responsive.min.css') ?>" rel="stylesheet" media="screen">
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?= base_url('assets/bootstrap_admin_theme/vendors/flot/excanvas.min.js') ?>"></script><![endif]-->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?= base_url('assets/bootstrap_admin_theme/vendors/modernizr-2.6.2-respond-1.1.0.min.js')?>"></script>
    <link href="<?= base_url('assets/bootstrap_admin_theme/vendors/datepicker.css')?>" rel="stylesheet" media="screen">
    <link href="<?= base_url('assets/bootstrap_admin_theme/vendors/uniform.default.css')?>" rel="stylesheet" media="screen">
    <link href="<?= base_url('assets/bootstrap_admin_theme/vendors/chosen.min.css')?>" rel="stylesheet" media="screen">
    <link href="<?= base_url('assets/bootstrap_admin_theme/vendors/wysiwyg/bootstrap-wysihtml5.css')?>" rel="stylesheet" media="screen">
    <script src="<?= base_url('assets/bootstrap_admin_theme/vendors/jquery-1.9.1.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap_admin_theme/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap_admin_theme/vendors/jquery.uniform.min.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap_admin_theme/vendors/chosen.jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap_admin_theme/vendors/bootstrap-datepicker.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap_admin_theme/vendors/wysiwyg/wysihtml5-0.3.0.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap_admin_theme/vendors/wysiwyg/bootstrap-wysihtml5.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap_admin_theme/vendors/wizard/jquery.bootstrap.wizard.min.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/bootstrap_admin_theme/vendors/jquery-validation/dist/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap_admin_theme/js/form-validation.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap_admin_theme/js/scripts.js') ?>"></script>
</head>

<body>
<div class="navbar navbar-fixed-top">
    <?php $this->load->view('layouts/bootstrap_admin_theme/nav') ?>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <?php $this->load->view('layouts/bootstrap_admin_theme/sidebar'); ?>

        <!--/span-->
        <div class="span9" id="content">
            <!-- Content -->
        </div>
    </div>
    <hr>
    <footer>
        <p>&copy; Vincent Gabriel 2013</p>
    </footer>
</div>
<!--/.fluid-container-->

<script>

    jQuery(document).ready(function() {
        FormValidation.init();
    });


    $(function() {
        $(".datepicker").datepicker();
        $(".uniform_on").uniform();
        $(".chzn-select").chosen();
        $('.textarea').wysihtml5();

        $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
        $('#rootwizard .finish').click(function() {
            alert('Finished!, Starting over!');
            $('#rootwizard').find("a[href*='tab1']").trigger('click');
        });
    });
</script>
</body>
</html>