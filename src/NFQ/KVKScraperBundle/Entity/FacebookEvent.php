<?php

namespace NFQ\KVKScraperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FacebookEvent
 *
 * @ORM\Table(name="facebook_events")
 * @ORM\Entity(repositoryClass="NFQ\KVKScraperBundle\Entity\FacebookEventRepository")
 */
class FacebookEvent
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
     * @ORM\OneToOne(targetEntity="NFQ\KVKScraperBundle\Entity\EventData", mappedBy="facebookEvent")
     */
    private $event;

    /**
     * @ORM\Column(name="facebook_event_id", type="string")
     */
    private $facebookEventId;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime", nullable=true)
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="datetime", nullable=true)
     */
    private $endTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="attending_count", type="integer", nullable=true)
     */
    private $attendingCount;

    /**
     * @var string
     *
     * @ORM\Column(name="ticketUrl", type="string", length=255, nullable=true)
     */
    private $ticketUrl;

    /**
     * Set street
     *
     * @param string $street
     *
     * @return FacebookEvent
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return FacebookEvent
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return FacebookEvent
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return FacebookEvent
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return FacebookEvent
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return FacebookEvent
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set attendingCount
     *
     * @param integer $attendingCount
     *
     * @return FacebookEvent
     */
    public function setAttendingCount($attendingCount)
    {
        $this->attendingCount = $attendingCount;

        return $this;
    }

    /**
     * Get attendingCount
     *
     * @return integer
     */
    public function getAttendingCount()
    {
        return $this->attendingCount;
    }

    /**
     * Set ticketUrl
     *
     * @param string $ticketUrl
     *
     * @return FacebookEvent
     */
    public function setTicketUrl($ticketUrl)
    {
        $this->ticketUrl = $ticketUrl;

        return $this;
    }

    /**
     * Get ticketUrl
     *
     * @return string
     */
    public function getTicketUrl()
    {
        return $this->ticketUrl;
    }

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
     * Set facebookEventId
     *
     * @param string $facebookEventId
     *
     * @return FacebookEvent
     */
    public function setFacebookEventId($facebookEventId)
    {
        $this->facebookEventId = $facebookEventId;

        return $this;
    }

    /**
     * Get facebookEventId
     *
     * @return string
     */
    public function getFacebookEventId()
    {
        return $this->facebookEventId;
    }

    /**
     * Set event
     *
     * @param \NFQ\KVKScraperBundle\Entity\EventData $event
     *
     * @return FacebookEvent
     */
    public function setEvent(\NFQ\KVKScraperBundle\Entity\EventData $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \NFQ\KVKScraperBundle\Entity\EventData
     */
    public function getEvent()
    {
        return $this->event;
    }
}
