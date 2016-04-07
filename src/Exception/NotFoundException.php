<?php
/**
 * This file is part of `lemonphp/container` project.
 *
 * (c) 2015-2016 LemonPHP Team
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lemon\Container\Exception;

/**
 * Class NotFoundException
 *
 * It must extend Container Exception and implement Interop Container not found value exception.
 * It is thrown when not found value of key in container
 */
class NotFoundException extends ContainerException implements \Interop\Container\Exception\NotFoundException
{

}
