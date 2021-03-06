<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Entity\ORM;

use App\SiteParserCore\Resource\Marker\Entity\ORMEntityInterface;
use App\Repository\ORMGroupParametersRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use LogicException;

/**
 * @ORM\Entity(repositoryClass=GroupParametersRepository::class)
 */
class GroupParameters implements ORMEntityInterface
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
     * @ORM\ManyToOne(targetEntity=ParameterGroup::class, inversedBy="parameters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $group;

    /**
     * @ORM\ManyToOne(targetEntity=Parameter::class, inversedBy="groups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parameter;

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
