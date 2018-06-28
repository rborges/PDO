<section>
    <button type="button" class="btn btn-info btn-lg" id="open-form">Adicionar</button>
</section>
<hr>
<section class = "table-responsive">
    <?php include "cliente/grid.php"; ?>
</section>
<section>
    <div class="modal fade" id="modal-form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
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