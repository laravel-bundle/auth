<?php

namespace LaravelBundle\Auth\Shared\Application\Commands;

/**
 * Interface CommandHandler
 *
 * @package LaravelBundle\Auth\Shared\Application\Commands
 */
interface CommandHandler
{
    /**
     * Handles the command.
     *
     * @param Command $command
     * @return mixed
     */
    public function handle(Command $command);
}
