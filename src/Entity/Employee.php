<?php

namespace App\Entity\Profile;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="profile__employee")
 */
class Employee
{
    const WORKER_TYPE_FULL_TIME = 'full_time';
    const WORKER_TYPE_PART_TIME = 'part_time';
    const DEPARTMENT_TYPE_LAB_EXPERT = 'lab_expert';
    const DEPARTMENT_TYPE_TECHNICAL_TEAM = 'technical_team';
    const DEPARTMENT_TYPE_ADVISER_CONSULTANT = 'colsultant';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qualifications;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $speciality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $worker_type;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status = 1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $department;

    public function __construct()
    {
        //        $email = new \App\Entity\User\Email();
        $user = new User();
        //        $user->addEmail($email);
        $this->user = $user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getQualifications(): ?string
    {
        return $this->qualifications;
    }

    public function setQualifications(?string $qualifications): self
    {
        $this->qualifications = $qualifications;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(?string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getWorkerType(): ?string
    {
        return $this->worker_type;
    }

    public function setWorkerType(?string $worker_type): self
    {
        $this->worker_type = $worker_type;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public static function getEmployeeWorkingType(): array
    {
        return [
            'Full Time' => self::WORKER_TYPE_FULL_TIME,
            'Part Time' => self::WORKER_TYPE_PART_TIME,
        ];
    }

    public static function getEmployeeDepartmentType(): array
    {
        return [
            'Technical Team' => self::DEPARTMENT_TYPE_TECHNICAL_TEAM,
            'Adviser/Consultant' => self::DEPARTMENT_TYPE_ADVISER_CONSULTANT,
            'Lab Expert' => self::DEPARTMENT_TYPE_LAB_EXPERT,
        ];
    }
}
