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
            Nova Conta
        </div>

        <div class="box-content">
            <?php if ($this->success): ?>
                <div class="alert alert-green">
                    <strong>Cadastro efetuado com sucesso!</strong>
                    <small>Agora é só confirmar o e-mail :)</small>
                </div>

            <?php else: ?>

                <?php if (isset($this->messages['general'])): ?>
                    <div class="alert alert-red" style="margin-bottom: 20px;">
                        <strong>Ops!</strong>
                        <small><?php echo $this->messages['general']; ?></small>
                    </div>
                <?php endif; ?>

                <form action="http://localhost/lab/singup" method="post" class="form-horizontal form-md" style="margin: 10px auto; width: 80%;">
                    <div class="input-group">
                        <div class="col-1-4">
                            <label for="user">Usuário</label>
                        </div>
                        <div class="col-3-4">
                            <input type="text" name="user">
                            <span class="form-help">Form for test</span>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="col-1-4">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="col-3-4">
                            <input type="text" name="email">
                            <span class="form-help">Form for test</span>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="col-1-4">
                            <label for="pass">Senha</label>
                        </div>
                        <div class="col-3-4">
                            <input type="password" name="pass">
                            <span class="form-help">Form for test</span>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="col-1-4">
                            <label for="pass2">Repetir Senha</label>
                        </div>
                        <div class="col-3-4">
                            <input type="password" name="pass2">
                            <span class="form-help">Form for test</span>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="hidden" name="token" value="<?php echo token();?>">
                        <input type="submit" class="btn right">
                    </div>
                </form>
            <?php endif; ?>
        </div>

    </div>
</div>
