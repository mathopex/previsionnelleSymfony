<?php

// src/Serializer/SerializationContextBuilder.php

namespace App\Serializer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SerializationContextBuilder implements ContextAwareNormalizerInterface
{
    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
        
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $this->decorated->supportsNormalization($data, $format, $context);
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        $context['serialize_null'] = true;

        return $this->decorated->normalize($object, $format, $context);
    }
}

