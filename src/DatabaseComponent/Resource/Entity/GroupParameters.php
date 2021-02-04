<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use App\Repository\GroupParametersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupParametersRepository::class)
 */
class GroupParameters extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ParameterGroup::class, inversedBy="parameters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $group;

    /**
     * @ORM\ManyToOne(targetEntity=Parameter::class, inversedBy="groups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parameter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroup(): ?ParameterGroup
    {
        return $this->group;
    }

    public function setGroup(?ParameterGroup $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getParameter(): ?Parameter
    {
        return $this->parameter;
    }

    public function setParameter(?Parameter $parameter): self
    {
        $this->parameter = $parameter;

        return $this;
    }
}
