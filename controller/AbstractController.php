<?php

/**
 * Class AbstractController permet de relier les
 * différents controller à une vue et
 * un model.
 */

abstract class AbstractController{
    /*
     * Vue du controller
     */
    protected $view;

    /*
     * Model du controller
     */
    protected $model;
    /**
     * @param $post lance la vue
     */
    public function launch($post){
        $this->view->launch($post);
    }

}
