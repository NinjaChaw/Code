<?php

namespace App\Events;

use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BeforeUserJoinedCompetition
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $competition;
    private $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Competition $competition, User $user)
    {
        $this->competition = $competition;
        $this->user = $user;
    }

    public function competition() {
        return $this->competition;
    }

    public function user() {
        return $this->user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
