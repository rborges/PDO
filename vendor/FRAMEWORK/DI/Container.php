<?php

namespace FRAMEWORK\DI;

/**
 * Description of Container
 * Classe responsavel por redução do aclopamento entre  model (acesso a dados) e a view
 * @author Rodrigo Borges
 */
class Container {

    public static function getModel($model) {
        $class = "\\App\\Model\\" . ucfirst($model);

        return new $class();
    }

}
