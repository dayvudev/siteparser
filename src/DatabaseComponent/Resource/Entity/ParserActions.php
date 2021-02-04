<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use App\Repository\ParserActionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParserActionsRepository::class)
 */
class ParserActions extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Parser::class, inversedBy="actions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parser;

    /**
     * @ORM\ManyToOne(targetEntity=Action::class, inversedBy="parserRelations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $action;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $creationDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParser(): ?Parser
    {
        return $this->parser;
    }

    public function setParser(?Parser $parser): self
    {
        $this->parser = $parser;

        return $this;
    }

    public function getAction(): ?Action
    {
        return $this->action;
    }

    public function setAction(?Action $action): self
    {
        $this->action = $action;

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
}
