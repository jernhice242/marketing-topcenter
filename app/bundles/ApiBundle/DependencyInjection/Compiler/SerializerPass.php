<?php

declare(strict_types=1);

namespace Mautic\ApiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SerializerPass implements CompilerPassInterface
{
    /**
     * Replaces the available metadata drivers (yaml, xml, and annotation)
     * with our metadata driver, as we do not use any of those. There's
     * currently no other way that I can find to get our driver into the
     * chain in front of the rest.
     */
    public function process(ContainerBuilder $container): void
    {
        if ($container->hasDefinition('jms_serializer.metadata.annotation_or_attribute_driver')) {
            $definition = $container->getDefinition('jms_serializer.metadata.annotation_or_attribute_driver');
            $definition->setClass(\Mautic\ApiBundle\Serializer\Driver\ApiMetadataDriver::class);
        }
    }
}
