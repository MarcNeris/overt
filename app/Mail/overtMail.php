<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\logeml001;

class overtMail extends Mailable //implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $logeml001;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(logeml001 $logeml001)
    {
        $this->logeml001 = $logeml001;

        //dd($this);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->from('overt@overt.com.br', $this->logeml001['NomFta'])
            ->subject($this->logeml001['NomFta'].' | '.$this->logeml001['EmlTit'])
            ->cc('marceloneris@hotmail.com')
            ->with([
                'NomDst' => $this->logeml001['NomDst'],
                'EmlDst' => $this->logeml001['EmlDst'],
                'NomEmt' => $this->logeml001['NomEmt'],
                'EmlEmt' => $this->logeml001['EmlEmt'],
                'EmlTit' => $this->logeml001['EmlTit'],
                'EmlDsc' => $this->logeml001['EmlDsc'],
                'EmlFin' => $this->logeml001['EmlFin'],
                'NomFta' => $this->logeml001['NomFta'],
                'DatEml' => date('d/m/Y')
            ])
            ->view('crm.mail');

    }
}
