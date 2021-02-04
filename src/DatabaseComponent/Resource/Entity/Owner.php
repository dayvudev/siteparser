<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use App\Repository\OwnerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *      name="owner", 
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="unique_owner", 
 *              columns={"name"}
 *          )
 *      }
 * )
 * 
 * @ORM\Entity(repositoryClass=OwnerRepository::class)
 */
class Owner extends AbstractEntity
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
     * @ORM\Column(type="text")
     */
    private $url;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Parser::class, inversedBy="owners")
     */
    private $parser;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getParser(): ?Parser
    {
        return $this->parser;
    }

    public function setParser(?Parser $parser): self
    {
        $this->parser = $parser;

        return $this;
    }
}
