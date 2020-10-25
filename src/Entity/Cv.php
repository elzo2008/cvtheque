<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=CvRepository::class)
 * @Vich\Uploadable()
 */
class Cv
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneesExperience;

    /**
     * @ORM\ManyToOne(targetEntity=Civilite::class, inversedBy="cvs")
     */
    private $civilite;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="cvs")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity=SituationProfessionnelle::class, inversedBy="cvs")
     */
    private $situationProfessionnelle;

    /**
     * @ORM\ManyToOne(targetEntity=Specialiste::class, inversedBy="cvs")
     */
    private $specialiste;

    /**
     * @ORM\ManyToOne(targetEntity=NiveauEtude::class, inversedBy="cvs")
     */
    private $niveauEtude;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $motivation;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="cv_pdf", fileNameProperty="filename")
     */
    private $cvFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(?\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAnneesExperience(): ?int
    {
        return $this->anneesExperience;
    }

    public function setAnneesExperience(int $anneesExperience): self
    {
        $this->anneesExperience = $anneesExperience;

        return $this;
    }

    public function getCivilite(): ?Civilite
    {
        return $this->civilite;
    }

    public function setCivilite(?Civilite $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getSituationProfessionnelle(): ?SituationProfessionnelle
    {
        return $this->situationProfessionnelle;
    }

    public function setSituationProfessionnelle(?SituationProfessionnelle $situationProfessionnelle): self
    {
        $this->situationProfessionnelle = $situationProfessionnelle;

        return $this;
    }

    public function getSpecialiste(): ?Specialiste
    {
        return $this->specialiste;
    }

    public function setSpecialiste(?Specialiste $specialiste): self
    {
        $this->specialiste = $specialiste;

        return $this;
    }

    public function getNiveauEtude(): ?NiveauEtude
    {
        return $this->niveauEtude;
    }

    public function setNiveauEtude(?NiveauEtude $niveauEtude): self
    {
        $this->niveauEtude = $niveauEtude;

        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(?string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }

    /**
     * @return null|string 
     */
    public function getFileName(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Cv 
     */
    public function setFileName(?string $filename): Cv
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @return null|File 
     */
    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    /**
     * @param null|File $cvFile
     * @return Cv 
     */
    public function setCvFile(?File $cvFile): Cv
    {
        $this->cvFile = $cvFile;
        if($this->cvFile instanceof UploadedFile)
        {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
