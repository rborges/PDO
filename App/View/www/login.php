<section>
    <button type="button" class="btn btn-info btn-lg" id="open-form">Novo Usuário</button>
</section>
<hr>

<section>
    <div class="modal fade" id="modal-form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Faça seu cadastro.</h4>
                </div>
                <div class="modal-body">
                    
                    <?php include "cliente/form.php"; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</section>