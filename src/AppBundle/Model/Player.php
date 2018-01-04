<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a model of player to use with PlayerType.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class Player
{
    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Este campo es requerido")
     * @Assert\Regex(
     *      pattern = "/([a-zA-ZáéíóúÁÉÍÓÚ]{2,} ?)/",
     *      htmlPattern  = "([a-zA-ZáéíóúÁÉÍÓÚ]{2,} ?)",
     *      message = "Ingrese un nombre Invalido"
     * )
     */
    public $firstName;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Este campo es requerido")
     * @Assert\Regex(
     *      pattern = "/([a-zA-ZáéíóúÁÉÍÓÚ]{2,} ?)/",
     *      htmlPattern  = "([a-zA-ZáéíóúÁÉÍÓÚ]{2,} ?)",
     *      message = "Ingrese un apellido invalido"
     * )
     */
    public $lastName;

    /**
     * @var \DateTime
     *
     * @Assert\Date()
     */
    public $birthday;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Este campo es requerido")
     * @Assert\Email(message = "Ingrese un email valido")
     */
    public $email;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Este campo es requerido")
     */
    public $document;

    /**
     * @var string
     */
    public $phoneNumber;

    /**
     * @var [type]
     */
    public $positions;

    /**
     * @var integer
     *
     * @Assert\Type("int")
     */
    public $shirtNumber;

    /**
     * @var boolean
     *
     * @Assert\Type("bool")
     */
    public $isCaptain;

    /**
     * @var string
     */
    public $image;
}
