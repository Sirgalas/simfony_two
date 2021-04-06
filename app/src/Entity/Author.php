<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 * @property string $family
 * @property string $name
 * @property string $patronic
 * @property string $biograpfy
 * @property Book[] $books
 * @property File[] $file
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=610)
     */
    private $family;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $patronic;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biograpfy;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, mappedBy="author")
     */
    private $books;

    /**
     * @ORM\OneToMany(targetEntity=File::class, mappedBy="book")
     */
    private $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

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

    public function getPatronic(): ?string
    {
        return $this->patronic;
    }

    public function setPatronic(?string $patronic): self
    {
        $this->patronic = $patronic;

        return $this;
    }

    public function getBiograpfy(): ?string
    {
        return $this->biograpfy;
    }

    public function setBiograpfy(?string $biograpfy): self
    {
        $this->biograpfy = $biograpfy;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book=null):? self
    {
        if($book){
            if (!$this->books->contains($book)) {
                $this->books[] = $book;
                $book->addAuthor($this);
            }
            return $this;
        }

    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            $book->removeAuthor($this);
        }

        return $this;
    }

    /**
     * @return Collection|File[]
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setAuthor($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getAuthor() === $this) {
                $file->setAuthor(null);
            }
        }

        return $this;
    }

    public function getFullName()
    {
        return $this->name.' '.$this->patronic.' '.$this->family;
    }

}
