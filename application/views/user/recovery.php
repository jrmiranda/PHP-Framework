<div class="row row-full">
    <div class="col-1-1" style="background-image: url(http://localhost/cssfw/images/space.jpg); height: auto;">
        <div class="row row-md">
            <div class="col-1-1" style="color: #fff; padding: 10px;">
                <h1 style="color: #fff;" class="left">JuicePHP</h1>
            </div>
        </div>
    </div>
</div>

<div class="row row-sm grid-spacing" style="margin-top: 20px;">
    <div class="box">
        <div class="box-header">
            Recuperação de Senha
        </div>

        <div class="box-content">
            <?php if (isset($this->messages['general'])): ?>
                <div class="alert alert-red" style="margin-bottom: 20px;">
                    <strong>Ops!</strong>
                    <small><?php echo $this->messages['general']; ?></small>
                </div>
            <?php endif; ?>

            <form action="http://localhost/lab/recovery" method="post" class="form-horizontal form-md" style="margin: 10px auto; width: 80%;">
                <div class="input-group">
                    <div class="col-1-4">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="col-3-4">
                        <input type="text" name="email">
                        <span class="form-help">Informe o e-mail para onde será enviado o código de recuperação.</span>
                    </div>
                </div>
                <div class="input-group">
                    <input type="hidden" name="token" value="<?php echo token(); ?>">
                    <div class="col-1-4"></div>
                    <div class="col-3-4">
                        <input type="submit" class="btn right">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
