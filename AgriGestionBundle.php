<?php

namespace PiouPiou\AgriGestionBundle;

use PiouPiou\AgriGestionBundle\DependencyInjection\AgriGestionExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AgriGestionBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new AgriGestionExtension();
    }
}
