<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use App\Repository\ParameterTreeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParameterTreeRepository::class)
 */
class ParameterTree extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Parameter::class, inversedBy="childrenRelations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parent;

    /**
     * @ORM\ManyToOne(targetEntity=Parameter::class, inversedBy="parentRelations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $child;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $creationDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): ?Parameter
    {
        return $this->parent;
    }

    public function setParent(?Parameter $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChild(): ?Parameter
    {
        return $this->child;
    }

    public function setChild(?Parameter $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }
}
