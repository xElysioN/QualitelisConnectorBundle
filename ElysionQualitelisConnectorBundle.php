<?php

/*
 * This file is part of the Qualitelis Connector Bundle
 *
 * (c) Maxime Cornet <https://github.com/xelysion/qualitelis-connector-bundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elysion\QualitelisConnectorBundle;

use Elysion\QualitelisConnectorBundle\DependencyInjection\ElysionQualitelisConnectorExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ElysionQualitelisConnectorBundle.
 *
 * @author  Maxime Cornet <mcornet@altima-agency.com>
 */
class ElysionQualitelisConnectorBundle extends Bundle
{
    /**
     * @return ElysionQualitelisConnectorExtension
     */
    public function getContainerExtension()
    {
        return new ElysionQualitelisConnectorExtension();
    }
}
