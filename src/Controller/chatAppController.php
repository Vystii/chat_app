<?php

namespace Drupal\chat_app\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * main chat_app controller.
 */
class chatAppController extends ControllerBase
{

    /**
     * Returns a render-able array for a test page.
     */
    public function index()
    {
        $build = [
            '#markup' => $this->t('Hello World!'),
        ];
        return $build;
    }
}
