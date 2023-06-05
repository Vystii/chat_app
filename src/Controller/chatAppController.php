<?php

namespace Drupal\chat_app\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\chat_app\Service\chatAppService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Stephane888\Debug\ExceptionExtractMessage;
use Stephane888\DrupalUtility\HttpResponse;

/**
 * main chat_app controller.
 */
class chatAppController extends ControllerBase
{

    /**
     * @var \Drupal\chat_app\Service\chatAppService
     */
    protected $chatManager;


    /**
     * chatAppController constructor.
     *
     * @param \Drupal\chat_app\Service\chatAppService $chatManager
     */
    public function __construct(chatAppService $chatManager)
    {
        $this->chatManager = $chatManager;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('chat_app.manager')
        );
    }

    /**
     *{@inheritdoc}
     */
    public  function test()
    {
        try {
            $data["statut"] = "success";
            $this->chatManager->runRatchetServer();
            return HttpResponse::response($data);
        } catch (\Exception $e) {
            $errors = ExceptionExtractMessage::errorAllToString($e);
            $this->getLogger('booking_system')->critical($e->getMessage() . '<br>' . $errors);
            return HttpResponse::response(ExceptionExtractMessage::errorAll($e), 400, $e->getMessage());
        }
    }
}
