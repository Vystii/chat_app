<?php

namespace Drupal\chat_app\Commands;

use Drush\Commands\DrushCommands;
use Drupal\chat_app\chatApp;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

/**
 * A drush command file.
 *
 * @package Drupal\drush9_custom_commands\Commands
 */
class chatAppDrushCommands extends DrushCommands
{

    /**
     * Drush command that displays the given text.
     *
     * @param string $port
     *   Argument with message to be displayed.
     * @command chatapp:start-websocket-server
     * @aliases chat_app-run-server ch-run
     * @usage chatapp:start-websocket-server [port]
     */
    public function message($port = '8080')
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new chatApp()
                )
            ),
            8080
        );
        printf("running");
        $server->run();
    }
}
