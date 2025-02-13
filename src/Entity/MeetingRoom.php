<?php

namespace App\Entity;

use App\Enum\Status;
use App\Repository\MeetingRoomRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeetingRoomRepository::class)]
class MeetingRoom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 512)]
    private ?string $description = null;

    #[ORM\Column(type: 'integer')]
    private int $calendar_code;

    #[ORM\Column(length: 512)]
    private ?string $photo_path = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $size = null;

    #[ORM\Column(type: 'string', enumType: Status::class)]
    private ?Status $status = null;

    #[ORM\ManyToOne(targetEntity: Office::class)]
    #[ORM\JoinColumn(name: 'office_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?Office $office = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPhotoPath(): ?string
    {
        return $this->photo_path;
    }

    public function setPhotoPath(string $photo_path): static
    {
        $this->photo_path = $photo_path;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getOffice(): ?Office
    {
        return $this->office;
    }

    public function setOffice(?Office $office): static
    {
        $this->office = $office;

        return $this;
    }
}
