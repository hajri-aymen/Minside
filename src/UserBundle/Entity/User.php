<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Users
 *
 * @ORM\Table(name="user")
 * @ORM\Entity (repositoryClass="UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;


    /**
     * @var string
     *
     * @ORM\Column(name="balance", type="string", length=100, nullable=true)
     */
    protected $balance;
    /**
     * @var text
     *
     * @ORM\Column(name="picture", type="text",nullable=true)
     */
    protected $picture;
    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer",nullable=true)
     */
    protected $age;
    /**
     * @var string
     *
     * @ORM\Column(name="eyeColor", type="string", length = 100,nullable=true)
     */
    protected $eyeColor;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length = 100, nullable=true)
     */
    protected $name;
    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length = 20, nullable=true)
     */
    protected $gender;
    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length = 100, nullable=true)
     */
    protected $company;
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length = 30, nullable=true)
     */
    protected $phone;
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length = 255, nullable=true)
     */
    protected $address;
    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", nullable=true)
     */
    protected $about;
    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="decimal", precision=14, scale=8, nullable=true)
     */
    protected $latitude;
    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", precision=14, scale=8, nullable=true)
     */
    protected $longitude;
    /**
     * @var string
     *
     * @ORM\Column(name="greeting", type="string", length = 255, nullable=true)
     */
    protected $greeting;
    /**
     * @var string
     *
     * @ORM\Column(name="favoriteFruit", type="string", length = 255, nullable=true)
     */
    protected $favoriteFruit;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set balance
     *
     * @param string $balance
     * @return User
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string 
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return User
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return User
     */
    public function setAge(integer $age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set eyeColor
     *
     * @param string $eyeColor
     * @return User
     */
    public function setEyeColor($eyeColor)
    {
        $this->eyeColor = $eyeColor;

        return $this;
    }

    /**
     * Get eyeColor
     *
     * @return string 
     */
    public function getEyeColor()
    {
        return $this->eyeColor;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set about
     *
     * @param string $about
     * @return User
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return User
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return User
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set greeting
     *
     * @param string $greeting
     * @return User
     */
    public function setGreeting($greeting)
    {
        $this->greeting = $greeting;

        return $this;
    }

    /**
     * Get greeting
     *
     * @return string 
     */
    public function getGreeting()
    {
        return $this->greeting;
    }

    /**
     * Set favoriteFruit
     *
     * @param string $favoriteFruit
     * @return User
     */
    public function setFavoriteFruit($favoriteFruit)
    {
        $this->favoriteFruit = $favoriteFruit;

        return $this;
    }

    /**
     * Get favoriteFruit
     *
     * @return string 
     */
    public function getFavoriteFruit()
    {
        return $this->favoriteFruit;
    }
}
