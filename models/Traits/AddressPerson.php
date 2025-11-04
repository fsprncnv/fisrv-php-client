<?php

namespace Fisrv\Models\Traits;

use Fisrv\Models\Address;
use Fisrv\Models\Contact;
use Fisrv\Models\Person;

trait AddressPerson
{
    public Person $person;

    public Contact $contact;

    public Address $address;
}
