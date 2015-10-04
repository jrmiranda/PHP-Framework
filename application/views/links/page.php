<style>
    .link-img img {
        width: 100%;
    }
    
    .link-container {
        //height: 300px;
    }
    
    .link-desc {
        display: block;
        color: #777;
    }
    
    .link-title {
        font-size: 16px;
        font-weight: bold;
    }
    
    .link-title a {
        color: #555;
    }
    
    .link-title a:hover {
        color: #008;
        text-decoration: none;
    }
</style>

<div class="row row-full">
    <div class="navbar navbar-fixed navbar-dark navbar-auto" style="padding: 10px;">
        <div class="row row-lg">
            <button class="btn btn-blue right" data-modal="#newlink">Enviar link</button>
        </div>
    </div>
</div>
<div class="modal" id="newlink">
    <div class="modal-bg" data-close="modal"></div>
    <div class="modal-container">
        <div class="modal-header">
            Novo Link
            <span class="dismiss">&times;</span>
        </div>
        <div class="modal-body" style="padding: 20px 30px; height: auto;">
            <div class="alert alert-red hide" id="link-error" style="margin-top: -10px;">
                <strong>Ops...</strong>
                <small>Não foi possível adquirir informações sobre a URL informada</small>
            </div>
            <form method="post" action="http://localhost/lab/links/index/post">
                <div class="input-group input-lg">
                    <label for="url">URL</label>
                    <input type="text" name="url" class="input-disabled" id="link">
                    <span class="form-help">Cole aqui o link que será postado</span>
                </div>
                <div id="link-data" class="hide">
                    <div class="input-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="link-title">
                        <span class="form-help">Seja claro :)</span>
                    </div>
                    <div class="input-group">
                        <div class="link-img col-1-4" id="link-img"></div>
                        <div class="col-3-4" style="padding-left: 10px;">
                            <label for="link-im">URL da imagem</label>
                            <input type="text" name="img" id="link-im">
                            <span class="form-help">Informe a URL da imagem a ser postada</span>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="link-description" style="min-height: 100px;"></textarea>
                        <span class="form-help">Máximo de 100 caracteres</span>
                    </div>
                </div>
                <div class="input-group input-lg text-right">
                    <i id="loading" class="fa fa-spinner fa-spin fa-2x hide left"></i>
                    <input type="hidden" name="token" value="<?php echo token(); ?>">
                    <button id="submit-link" class="btn btn-blue btn-disabled btn-lg">Enviar Link</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row row-lg grid-spacing" style="margin-top: 70px;">
    <?php if ($this->links == NULL): ?>
        no links
    <?php else: ?>
        <?php foreach ($this->links as $link): ?>
            <div class="col-1-4 col-xs-1-1">
                <div class="box">
                    <div class="box-body link-container">
                        <div class="link-img">
                            <img src="<?php echo $link['img'];?>">
                        </div>
                        <span class="link-title">
                            <a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                        </span>
                        <span class="link-desc">
                            <?php echo $link['description']; ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
    var t;
    $('#link').on('keyup paste', function() {
        $('#loading').show();

        clearTimeout(t);
        t = setTimeout(function() {
            $.ajax({
                url: "http://localhost/lab/links/index/get",
                method: "POST",
                data: {link: $('#link').val()}

            })
                    .done(function(r) {
                        if (r.success == false) {
                            $('#link-error').show();
                            $('#link').addClass("input-red");
                        } else {
                            $('#link').addClass("input-green");
                        }

                        $('#link-title').val(r.title);
                        $('#link-description').html(r.description);
                        $('#link-im').val(r.image);
                        $('#link-img').empty().append("<img src=\"" + r.image + "\">");
                        $('#loading').hide();
                        $('#submit-link').removeClass("btn-disabled");
                        $('#link-data').show();
                    });
        }, 500);

    });
</script>