<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
abstract class BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"acutalite_administration"})
     */
    private $id;

    /**
     * @var \DateTime $created
     * @ORM\Column(type="datetime")
     * @Groups({"acutalite_administration"})
     */
    private $created;

    /**
     * @var \DateTime $updated
     * @ORM\Column(type="datetime")
     * @Groups({"acutalite_administration"})
     */
    private $updated;

    /**
     * @return \DateTime
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): ?\DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @ORM\PreUpdate()
     * @ORM\PrePersist()
     */
    public function setUpdatedValue(): void
    {
        $this->updated = new \DateTime();
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreatedValue(): void
    {
        $this->created = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }
}
