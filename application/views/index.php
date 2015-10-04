<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');
?>

<div class="row row-full">
    <div class="col-1-1" style="background-image: url(http://localhost/cssfw/images/space.jpg); height: auto;">
        <div class="row row-md">
            <div class="col-1-1" style="color: #fff; padding: 10px;">
                <h1 style="color: #fff;" class="left">JuicePHP</h1>
            </div>
        </div>
    </div>

    <div class="navbar navbar-auto" style="border-bottom: 1px solid #ddd;">
        <div class="row row-md">
            <ul class="menu menu-stripe-bottom icons-left">
                <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="#"><i class="fa fa-book"></i>Documentação</a></li>
                <li><a href="#"><i class="fa fa-download"></i>Downloads</a></li>
                <li><a href="#"><i class="fa fa-phone"></i>Contato</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="row row-m grid-spacing">
    <div class="col-3-4">
        <div class="box">
            <div class="box-header">
                Main Container
            </div>
            <div class="box-content">

                <form action="http://localhost/lab/index/index/upload" enctype="multipart/form-data" method="post" class="form-horizontal form-md" style="margin: 10px auto; width: 80%;">
                    <div class="input-group">
                        <div class="col-1-4">
                            <label for="file">Arquivo</label>
                        </div>
                        <div class="col-3-4">
                            <input type="file" name="file">
                            <span class="form-help">Form for test</span>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="hidden" name="token" value="<?php echo token(); ?>">
                        <div class="col-1-4"></div>
                        <div class="col-3-4">
                            <label class="checkbox"><input type="checkbox" name="keep">Permanecer logado</label>
                            <input type="submit" class="btn right">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-1-4">
        <div class="box">
            <div class="box-content">
                <span class="box-title">SIDEBAR</span>

            </div>
        </div>
    </div>
</div>
