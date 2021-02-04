<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *      name="action", 
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="unique_action", 
 *              columns={"name", "handler_namespace"}
 *          )
 *      }
 * )
 * 
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 */
class Action extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $handlerNamespace;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sortOrder = 0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDisable = false;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $creationDate;

    /**
     * @ORM\OneToMany(targetEntity=ParserActions::class, mappedBy="action", orphanRemoval=true)
     */
    private $parserRelations;

    /**
     * @ORM\ManyToOne(targetEntity=Source::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;

    /**
     * @ORM\ManyToOne(targetEntity=Destination::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    public function __construct()
    {
        $this->parserRelations = new ArrayCollection();

        parent::__construct();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHandlerNamespace(): ?string
    {
        return $this->handlerNamespace;
    }

    public function setHandlerNamespace(string $handlerNamespace): self
    {
        $this->handlerNamespace = $handlerNamespace;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(?int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getIsDisable(): ?bool
    {
        return $this->isDisable;
    }

    public function setIsDisable(?bool $isDisable): self
    {
        $this->isDisable = $isDisable;

        return $this;
    }

    /**
     * @return Collection|ParserActions[]
     */
    public function getParserRelations(): Collection
    {
        return $this->parserRelations;
    }

    public function addParserRelation(ParserActions $parserRelation): self
    {
        if (!$this->parserRelations->contains($parserRelation)) {
            $this->parserRelations[] = $parserRelation;
            $parserRelation->setAction($this);
        }

        return $this;
    }

    public function removeParserRelation(ParserActions $parserRelation): self
    {
        if ($this->parserRelations->removeElement($parserRelation)) {
            // set the owning side to null (unless already changed)
            if ($parserRelation->getAction() === $this) {
                $parserRelation->setAction(null);
            }
        }

        return $this;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }
}
