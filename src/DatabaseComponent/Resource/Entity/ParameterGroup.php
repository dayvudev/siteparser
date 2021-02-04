<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use App\Repository\ParameterGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParameterGroupRepository::class)
 */
class ParameterGroup extends AbstractEntity
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
     * @ORM\OneToMany(targetEntity=GroupParameters::class, mappedBy="group", orphanRemoval=true)
     */
    private $parameters;

    public function __construct()
    {
        $this->parameters = new ArrayCollection();

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
