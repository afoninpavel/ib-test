<?php

class ReserveTicketFactoty
{
    public function reserveRandomTicket($event_id)
    {
        if ($event_id % 2 == 0) {
            return new Reservator($event_id);
        }
        return new ReservatorApiPartner($event_id);
    }
}

class Reservator extends ReserveTicketFactoty
{
    const TUPE = "[local]";
    const MAX = 3000;
    const MIN = 99;

    public function __construct($event_id)
    {
        $ticketId = $this->generateId();
        $orderId = $this->generateId();
        echo static::TUPE . " | creating object for event #" . $event_id;
        echo "<br><br>";
        echo static::TUPE . " | reserving ticket #" . $ticketId;
        if (get_called_class() === 'ReservatorApiPartner') {
            echo "<br><br>";
            echo static::TUPE . " | reserving ticket #" . $ticketId . " VIA PARTNER API CALL";
        }
        echo "<br><br>";
        echo static::TUPE . " | orderId #" . $orderId . "created";
        echo "<br><br>";
        echo static::TUPE . " | Sending admin notification: Order #" . $orderId . "created for event #" . $event_id;
    }

    public function generateId()
    {
        return rand(static::MIN, static::MAX);
    }
}

class ReservatorApiPartner extends Reservator
{
    const TUPE = "[partnerApi]";
    const MAX = 80000;
    const MIN = 90000;

}

$eventIds = [33, 44, 55, 677, 77];
foreach ($eventIds as $eventId) {
    $o = new TicketFactoty();
    $o->reserveRandomTicket($eventId);
    echo "<h5>--------------------------------------------------</h5>\n";;
}
