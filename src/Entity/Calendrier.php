<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\CalendrierRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: CalendrierRepository::class)]
#[ApiResource(
    operations: [ 
        new Patch(denormalizationContext: ['groups' => ['calendrier:post']]),
        new Get(),
        new Post(),
        new GetCollection()
    ],
    normalizationContext: [
        'groups' =>
            [
                'calendrier:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'calendrier:post',
            ],
    ]
    )]
class Calendrier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["calendrier:get", "calendrier:post"])]
    private int $id;

    #[Groups(["calendrier:get", "calendrier:post"])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private \DateTimeInterface $date;

    #[ORM\Column(nullable: true)]
    #[Groups(["calendrier:get", "calendrier:post"])]
    private bool $worked;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function isWorked(): bool
    {
        return $this->worked;
    }

    public function setWorked(bool $worked): static
    {
        $this->worked = $worked;

        return $this;
    }
}
