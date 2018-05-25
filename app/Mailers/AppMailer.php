<?php

namespace App\Mailers;


use App\Comment;
use App\Ticket;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Database\Eloquent\Builder;

class AppMailer
{
    protected $mailer;
    protected $fromAddress;
    protected $fromName;
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    /**
     * AppMailer constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->fromAddress = env('MAIL_FROM_ADDRESS');
        $this->fromName = env('MAIL_FROM_NAME');
        $this->mailer = $mailer;
    }

    /**
     * @param User $user
     * @param Builder|Ticket $ticket
     */
    public function sendTicketInformations($user, $ticket)
    {
        $this->to = $user->email;
        $this->subject = "[Support Ticket #{$ticket->ticket_id}] {$ticket->title}";
        $this->view = 'emails.ticket_info';
        $this->data = compact('user', 'ticket');
        $this->deliver();
    }

    /**
     * @param User $ticketOwner
     * @param User $user
     * @param Ticket $ticket
     * @param Comment $comment
     */
    public function sendTicketComments(User $ticketOwner, User $user, $ticket, Comment $comment)
    {
        $this->to = $ticketOwner->email;
        $this->subject = "RE: {$ticket->title} (Ticket #{$ticket->ticket_id})";
        $this->view = 'emails.ticket_comments';
        $this->data = compact('ticketOwner', 'user', 'ticket', 'comment');
        $this->deliver();
    }

    /**
     * @param User $ticketOwner
     * @param Ticket|Builder $ticket
     */
    public function sendTicketStatusNotification(User $ticketOwner, $ticket)
    {
        $this->to = $ticketOwner->email;
        $this->subject = "RE: {$ticket->title} (Ticket #{$ticket->ticket_id})";
        $this->view = 'emails.ticket_status';
        $this->data = compact('ticketOwner', 'ticket');
        $this->deliver();
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->fromAddress, $this->fromName)
                ->to($this->to)
                ->subject($this->subject);
        });
    }
}