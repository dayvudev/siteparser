<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use App\Repository\ParserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParserRepository::class)
 */
class Parser extends AbstractEntity
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
     * @ORM\OneToMany(targetEntity=ParserTree::class, mappedBy="parent", orphanRemoval=true)
     */
    private $childrenTree;

    /**
     * @ORM\OneToMany(targetEntity=ParserTree::class, mappedBy="child", orphanRemoval=true)
     */
    private $parentTree;

    /**
     * @ORM\OneToMany(targetEntity=Owner::class, mappedBy="parser")
     */
    private $owners;

    /**
     * @ORM\OneToMany(targetEntity=ParserActions::class, mappedBy="parser", orphanRemoval=true)
     */
    private $actions;

    public function __construct()
    {
        $this->childrenTree = new ArrayCollection();
        $this->parentTree = new ArrayCollection();
        $this->owners = new ArrayCollection();
        $this->actions = new ArrayCollection();

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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * @return Collection|ParserTree[]
     */
    public function getChildrenTree(): Collection
    {
        return $this->childrenTree;
    }

    public function addChildrenTree(ParserTree $childrenTree): self
    {
        if (!$this->childrenTree->contains($childrenTree)) {
            $this->childrenTree[] = $childrenTree;
            $childrenTree->setParent($this);
        }

        return $this;
    }

    public function removeChildrenTree(ParserTree $childrenTree): self
    {
        if ($this->childrenTree->removeElement($childrenTree)) {
            // set the owning side to null (unless already changed)
            if ($childrenTree->getParent() === $this) {
                $childrenTree->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ParserTree[]
     */
    public function getParentTree(): Collection
    {
        return $this->parentTree;
    }

    public function addParentTree(ParserTree $parentTree): self
    {
        if (!$this->parentTree->contains($parentTree)) {
            $this->parentTree[] = $parentTree;
            $parentTree->setChild($this);
        }

        return $this;
    }

    public function removeParentTree(ParserTree $parentTree): self
    {
        if ($this->parentTree->removeElement($parentTree)) {
            // set the owning side to null (unless already changed)
            if ($parentTree->getChild() === $this) {
                $parentTree->setChild(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Owner[]
     */
    public function getOwners(): Collection
    {
        return $this->owners;
    }

    public function addOwner(Owner $owner): self
    {
        if (!$this->owners->contains($owner)) {
            $this->owners[] = $owner;
            $owner->setMapper($this);
        }

        return $this;
    }

    public function removeOwner(Owner $owner): self
    {
        if ($this->owners->removeElement($owner)) {
            // set the owning side to null (unless already changed)
            if ($owner->getMapper() === $this) {
                $owner->setMapper(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ParserActions[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(ParserActions $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->setParser($this);
        }

        return $this;
    }

    public function removeAction(ParserActions $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getParser() === $this) {
                $action->setParser(null);
            }
        }

        return $this;
    }
}
