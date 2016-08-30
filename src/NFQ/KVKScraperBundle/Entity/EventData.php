<?php

namespace NFQ\KVKScraperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventData
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="NFQ\KVKScraperBundle\Entity\EventDataRepository")
 */
class EventData
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="NFQ\KVKScraperBundle\Entity\EventCategory", inversedBy="events")
     * @ORM\JoinColumn(name="event_category_id", referencedColumnName="eventCategoryid")
     */
    private $eventCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="event_name", type="text")
     */
    private $eventName;

    /**
     * @var string
     *
     * @ORM\Column(name="event_url", type="string", length=255)
     */
    private $eventUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="event_image_url", type="string", length=255)
     */
    private $eventImageUrl;

    /**
     * @var bigint
     *
     * @ORM\OneToOne(targetEntity="NFQ\KVKScraperBundle\Entity\FacebookEvent", cascade={"all"})
     * @ORM\JoinColumn(name="facebook_event_id", referencedColumnName="id")
     */
    private $facebookEvent;

    /**
     * @var boolean
     *
     * @ORM\OneToMany(targetEntity="NFQ\KVKScraperBundle\Entity\UserEvent", mappedBy="events")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $goingUsers;

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
     * Set eventCategory
     *
     * @param EventCategory $eventCategory
     *
     * @return EventData
     */
    public function setEventCategory($eventCategory)
    {
        $this->eventCategory = $eventCategory;

        return $this;
    }

    /**
     * Get eventCategory
     *
     * @return integer
     */
    public function getEventCategory()
    {
        return $this->eventCategory;
    }

    /**
     * Set eventName
     *
     * @param string $eventName
     *
     * @return EventData
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get eventName
     *
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set eventUrl
     *
     * @param string $eventUrl
     *
     * @return EventData
     */
    public function setEventUrl($eventUrl)
    {
        $this->eventUrl = $eventUrl;

        return $this;
    }

    /**
     * Get eventUrl
     *
     * @return string
     */
    public function getEventUrl()
    {
        return $this->eventUrl;
    }

    /**
     * Set eventImageUrl
     *
     * @param string $eventImageUrl
     *
     * @return EventData
     */
    public function setEventImageUrl($eventImageUrl)
    {
        $this->eventImageUrl = $eventImageUrl;

        return $this;
    }

    /**
     * Get eventImageUrl
     *
     * @return string
     */
    public function getEventImageUrl()
    {
        return $this->eventImageUrl;
    }

    /**
     * Set facebookEvent
     *
     * @param \NFQ\KVKScraperBundle\Entity\FacebookEvent $facebookEvent
     *
     * @return EventData
     */
    public function setFacebookEvent(FacebookEvent $facebookEvent = null)
    {
        $this->facebookEvent = $facebookEvent;

        return $this;
    }

    /**
     * Get facebookEvent
     *
     * @return \NFQ\KVKScraperBundle\Entity\FacebookEvent
     */
    public function getFacebookEvent()
    {
        return $this->facebookEvent;
    }

    /**
     * @return boolean
     */
    public function getGoingUsers()
    {
        return $this->goingUsers;
    }

}
