<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 15/06/17
 * Time: 10:55
 */

namespace MyOrleansBundle\Controller\front;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormulaireController extends NosServicesController
{
    public function Send($mail, $to)
    {
        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername($this->expediteur)
            ->setPassword('myorleans45');
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($mail['sujet'])
            ->setFrom(array($mail['email'] => $mail['nom']))
            ->setSender($mail['email'], $mail['nom'])
            ->setReplyTo($mail['email'])
            ->setTo($to)
            ->addPart('
                <h1>Vous avez reçu un message de ' . $mail['nom'] . ' en tant que ' . $mail['type'] . '</h1> 
                <p>Email : ' . $mail['email'] . '<br/>
                Tel : ' . $mail['tel'] . '</p>
                <p>' . $mail['message'] . '</p>
                ', 'text/html');
        return $mailer->send($message);

    }
}