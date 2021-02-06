<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Entity\ORM;

use App\SiteParserCore\Resource\Marker\Entity\ORMEntityInterface;
use App\Repository\ORMParameterGroupRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use LogicException;

/**
 * @ORM\Entity(repositoryClass=ParameterGroupRepository::class)
 */
class ParameterGroup implements ORMEntityInterface
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
     * @ORM\OneToMany(targetEntity=GroupParameters::class, mappedBy="group", orphanRemoval=true)
     */
    private $parameters;

    public function __construct()
    {
        $this->parameters = new ArrayCollection();
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
     * @return Collection|GroupParameters[]
     */
    public function getParameters(): Collection
    {
        return $this->parameters;
    }

    public function addParameter(GroupParameters $parameter): self
    {
        if (!$this->parameters->contains($parameter)) {
            $this->parameters[] = $parameter;
            $parameter->setGroup($this);
        }

        return $this;
    }

    public function removeParameter(GroupParameters $parameter): self
    {
        if ($this->parameters->removeElement($parameter)) {
            // set the owning side to null (unless already changed)
            if ($parameter->getGroup() === $this) {
                $parameter->setGroup(null);
            }
        }

        return $this;
    }
}
