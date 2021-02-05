<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity\ORM;

use App\DatabaseComponent\Resource\Marker\ORMEntityInterface;
use App\Repository\ORMSourceRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use LogicException;

/**
 * @ORM\Table(
 *      name="source", 
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="unique_source", 
 *              columns={"name", "handler_namespace"}
 *          )
 *      }
 * )
 * 
 * @ORM\Entity(repositoryClass=SourceRepository::class)
 */
class Source implements ORMEntityInterface
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
     * @ORM\Column(type="string", length=2000)
     */
    private $handlerNamespace;

    /**
     * @ORM\ManyToOne(targetEntity=Parameter::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $input;

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

    public function getHandlerNamespace(): ?string
    {
        return $this->handlerNamespace;
    }

    public function setHandlerNamespace(string $handlerNamespace): self
    {
        $this->handlerNamespace = $handlerNamespace;

        return $this;
    }

    public function getInput(): ?Parameter
    {
        return $this->input;
    }

    public function setInput(?Parameter $input): self
    {
        $this->input = $input;

        return $this;
    }
}
