<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Entity\ORM;

use App\SiteParserCore\Resource\Marker\Entity\ORMEntityInterface;
use App\Repository\ORMParameterRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use LogicException;

/**
 * @ORM\Entity(repositoryClass=ParameterRepository::class)
 */
class Parameter implements ORMEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $creationDate;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Value::class, mappedBy="parameter", orphanRemoval=true)
     */
    private $values;

    /**
     * @ORM\OneToMany(targetEntity=ParameterTree::class, mappedBy="parent", orphanRemoval=true)
     */
    private $childrenRelations;

    /**
     * @ORM\OneToMany(targetEntity=ParameterTree::class, mappedBy="child", orphanRemoval=true)
     */
    private $parentRelations;

    /**
     * @ORM\OneToMany(targetEntity=GroupParameters::class, mappedBy="parameter", orphanRemoval=true)
     */
    private $groups;

    public function __construct()
    {
        $this->values = new ArrayCollection();
        $this->childrenRelations = new ArrayCollection();
        $this->parentRelations = new ArrayCollection();
        $this->groups = new ArrayCollection();
    }

    public function getId(): int
    {
        if (null === $this->id) {
            throw new LogicException(ORMEntityInterface::LOGIC_EXCEPTION_MESSAGE);
        }

        return $this->id;
    }

    public function setId(int $value): ORMEntityInterface
    {
        $this->id = $value;
        
        return $this;
    }

    public function getCreationDate(): DateTimeInterface
    {
        if (null === $this->creationDate) {
            throw new LogicException(ORMEntityInterface::LOGIC_EXCEPTION_MESSAGE);
        }
        
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
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

    /**
     * @return Collection|Value[]
     */
    public function getValues(): Collection
    {
        return $this->values;
    }

    public function addValue(Value $value): self
    {
        if (!$this->values->contains($value)) {
            $this->values[] = $value;
            $value->setParameter($this);
        }

        return $this;
    }

    public function removeValue(Value $value): self
    {
        if ($this->values->removeElement($value)) {
            // set the owning side to null (unless already changed)
            if ($value->getParameter() === $this) {
                $value->setParameter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ParameterTree[]
     */
    public function getChildrenRelations(): Collection
    {
        return $this->childrenRelations;
    }

    public function addChildrenRelation(ParameterTree $childrenRelation): self
    {
        if (!$this->childrenRelations->contains($childrenRelation)) {
            $this->childrenRelations[] = $childrenRelation;
            $childrenRelation->setParent($this);
        }

        return $this;
    }

    public function removeChildrenRelation(ParameterTree $childrenRelation): self
    {
        if ($this->childrenRelations->removeElement($childrenRelation)) {
            // set the owning side to null (unless already changed)
            if ($childrenRelation->getParent() === $this) {
                $childrenRelation->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ParameterTree[]
     */
    public function getParentRelations(): Collection
    {
        return $this->parentRelations;
    }

    public function addParentRelation(ParameterTree $parentRelation): self
    {
        if (!$this->parentRelations->contains($parentRelation)) {
            $this->parentRelations[] = $parentRelation;
            $parentRelation->setChild($this);
        }

        return $this;
    }

    public function removeParentRelation(ParameterTree $parentRelation): self
    {
        if ($this->parentRelations->removeElement($parentRelation)) {
            // set the owning side to null (unless already changed)
            if ($parentRelation->getChild() === $this) {
                $parentRelation->setChild(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupParameters[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(GroupParameters $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $group->setParameter($this);
        }

        return $this;
    }

    public function removeGroup(GroupParameters $group): self
    {
        if ($this->groups->removeElement($group)) {
            // set the owning side to null (unless already changed)
            if ($group->getParameter() === $this) {
                $group->setParameter(null);
            }
        }

        return $this;
    }
}
