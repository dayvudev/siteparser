<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use App\Repository\ParserTreeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParserTreeRepository::class)
 */
class ParserTree extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Parser::class, inversedBy="childrenTree")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parent;

    /**
     * @ORM\ManyToOne(targetEntity=Parser::class, inversedBy="parentTree")
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

    public function getParent(): ?Parser
    {
        return $this->parent;
    }

    public function setParent(?Parser $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChild(): ?Parser
    {
        return $this->child;
    }

    public function setChild(?Parser $child): self
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
