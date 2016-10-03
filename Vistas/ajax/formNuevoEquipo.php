<?php
?>

<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Administrar Equipo</a></li>
            <li><a href="formNuevoUsuario.php">Agregar Nuevo Equipo</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-5">
        <!-- Form New User -->
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-barcode"></i>
                    <span>Registro de equipo nuevo</span>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <form id="defaultForm" method="POST" action="" class="form-horizontal">
                    <fieldset>
                        <legend>Ingresar datos del equipo</legend>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="nombre" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Descripción</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="descripcion" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Imagen</label>
                            <div class="col-sm-5">
                                <button type="button" class="btn btn-success btn-app-md btn-circle"><i class="fa fa-camera"></i></button>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-15 col-sm-offset-5">
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Run Select2 plugin on elements
    function DemoSelect2(){
        $('#s2_with_tag').select2({placeholder: "Select OS"});
        $('#s2_country').select2();
    }
    // Run timepicker
    function DemoTimePicker(){
        $('#input_time').timepicker({setDate: new Date()});
    }
    $(document).ready(function() {
        // Create Wysiwig editor for textare
        TinyMCEStart('#wysiwig_simple', null);
        TinyMCEStart('#wysiwig_full', 'extreme');
        // Add slider for change test input length
        FormLayoutExampleInputLength($( ".slider-style" ));
        // Initialize datepicker
        $('#input_date').datepicker({setDate: new Date()});
        // Load Timepicker plugin
        LoadTimePickerScript(DemoTimePicker);
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        // Load example of form validation
        LoadBootstrapValidatorScript(DemoFormValidator);
        // Add drag-n-drop feature to boxes
        WinMove();
    });
</script>
<script type="text/javascript">
    // Run Datables plugin and create 3 variants of settings
    function AllTables(){
        TestTable1();
        TestTable2();
        TestTable3();
        LoadSelect2Script(MakeSelect2);
    }
    function MakeSelect2(){
        $('select').select2();
        $('.dataTables_filter').each(function(){
            $(this).find('label input[type=text]').attr('placeholder', 'Search');
        });
    }
    $(document).ready(function() {
        // Load Datatables and run plugin on tables
        LoadDataTablesScripts(AllTables);
        // Add Drag-n-Drop feature
        WinMove();
    });
</script>
