<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Entity\ORM;

use App\SiteParserCore\Resource\Marker\ORMEntityInterface;
use App\Repository\ORMParserTreeRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use LogicException;

/**
 * @ORM\Entity(repositoryClass=ParserTreeRepository::class)
 */
class ParserTree implements ORMEntityInterface
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
     * @ORM\ManyToOne(targetEntity=Parser::class, inversedBy="childrenTree")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parent;

    /**
     * @ORM\ManyToOne(targetEntity=Parser::class, inversedBy="parentTree")
     * @ORM\JoinColumn(nullable=false)
     */
    private $child;

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
}
