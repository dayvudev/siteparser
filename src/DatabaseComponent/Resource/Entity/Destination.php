<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use App\Repository\DestinationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *      name="destination", 
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="unique_destination", 
 *              columns={"name", "handler_namespace"}
 *          )
 *      }
 * )
 * 
 * @ORM\Entity(repositoryClass=DestinationRepository::class)
 */
class Destination extends AbstractEntity
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
     * @ORM\Column(type="datetime")
     */
    protected $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Parameter::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $output;

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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getOutput(): ?Parameter
    {
        return $this->output;
    }

    public function setOutput(?Parameter $output): self
    {
        $this->output = $output;

        return $this;
    }
}
