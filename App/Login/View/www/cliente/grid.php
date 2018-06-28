<table id="table-list" class = "table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($this->view->clientes) > 0  && isset($this->view->clientes))
        {
            foreach ($this->view->clientes as $cliente)
            {
                ?>
                <tr>
                    <td class="td_id"><?php echo $cliente["id_cliente"] ?></td>
                    <td data-nome="<?php echo $cliente["nome"] ?>"><?php echo $cliente["nome"] ?></td>
                    <td data-email="<?php echo $cliente["email"] ?>"><?php echo $cliente["email"] ?></td>
                    <td><a  class="edit" data-toggle="modal" data-target="#modal-form" id="<?= $cliente["id_cliente"] ?>" ><span class="glyphicon glyphicon-edit"></span></a></td>
                    <td><a class="delete" id="<?= $cliente["id_cliente"] ?>"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
else
{
    echo '<hr><h4>Não há registros para listagem</h4><br/><hr> ';
}
?>