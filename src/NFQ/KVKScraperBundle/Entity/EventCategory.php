<?php

namespace NFQ\KVKScraperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventCategory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NFQ\KVKScraperBundle\Entity\EventCategoryRepository")
 */
class EventCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="eventCategoryid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $eventCategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="categoryName", type="string", length=255)
     */
    private $categoryName;

    /**
     * @var string
     *
     * @ORM\Column(name="categoryUrl", type="string", length=255)
     */
    private $categoryUrl;

    /**
     * @ORM\OneToMany(targetEntity="NFQ\KVKScraperBundle\Entity\EventData",mappedBy="eventCategory")
     */
    private $events;

    /**
     * Get id
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->eventCategoryId;
    }

    /**
     * Set categoryName
     *
     * @param string $categoryName
     *
     * @return EventCategory
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set categoryUrl
     *
     * @param string $categoryUrl
     *
     * @return EventCategory
     */
    public function setCategoryUrl($categoryUrl)
    {
        $this->categoryUrl = $categoryUrl;

        return $this;
    }

    /**
     * Get categoryUrl
     *
     * @return string
     */
    public function getCategoryUrl()
    {
        return $this->categoryUrl;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get eventCategoryId
     *
     * @return integer
     */
    public function getEventCategoryId()
    {
        return $this->eventCategoryId;
    }

    /**
     * Add event
     *
     * @param \NFQ\KVKScraperBundle\Entity\EventData $event
     *
     * @return EventCategory
     */
    public function addEvent(\NFQ\KVKScraperBundle\Entity\EventData $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \NFQ\KVKScraperBundle\Entity\EventData $event
     */
    public function removeEvent(\NFQ\KVKScraperBundle\Entity\EventData $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
