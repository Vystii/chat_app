<?php

namespace Drupal\chat_app\Service;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\chat_app\chatAppHandler;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;

/**
 * Manage the booking system
 */
class chatAppService extends ControllerBase
{

    protected $currentUser;
    protected $em;
    protected $server;

    // public function __construct(AccountInterface $currentUser, EntityTypeManager $em)
    // {
    //     $this->currentUser = $currentUser;
    //     $this->em = $em;
    // }

    /**
     * 
     * {@inheritdoc}
     * 
     */
    public function runRatchetServer()
    {
        $this->server =
            IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new chatAppHandler()
                    )
                ),
                8080
            );
        $this->server->run();
    }
}