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
 * Class ContainerException
 *
 * It must extend Runtime Exception and implement Interop Container Exception interface.
 * It is thrown when factory throw a container exception.
 */
class ContainerException extends \RuntimeException implements \Interop\Container\Exception\ContainerException
{

}
