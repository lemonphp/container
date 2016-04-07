<?php
/**
 * This file is part of `lemonphp/container` project.
 *
 * (c) 2015-2016 LemonPHP Team
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lemon\Container;

use Interop\Container\ContainerInterface;
use Pimple\Container as PimpleContainer;
use Lemon\Container\Exception\ContainerException;
use Lemon\Container\Exception\NotFoundException;

/**
 * class Container
 *
 * It must extend Pimple container and implement Interop Container interface
 */
class Container extends PimpleContainer implements ContainerInterface
{
    /**
     * Finds an entry of the container by its identifier and returns it
     *
     * @param string $id    Identifier of the entry to look for
     * @return mixed        Entry
     * @throws NotFoundException  No entry was found for this identifier
     * @throws ContainerException Error while retrieving the entry
     */
    public function get($id)
    {
        if (!$this->offsetExists($id)) {
            throw new NotFoundException();
        }

        try {
            return $this->offsetGet($id);
        } catch (ContainerException $e) {
            throw new ContainerException;
        }
    }

    /**
     * Returns true if the container can return an entry for the given identifier
     * Returns false otherwise
     *
     * @param string $id    Identifier of the entry to look for
     * @return boolean
     */
    public function has($id)
    {
        return $this->offsetExists($id);
    }
}
