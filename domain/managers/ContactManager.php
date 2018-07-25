<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/5/18
 * Time: 5:47 AM
 */

namespace domain\managers;


use domain\entities\Contact;
use domain\forms\ContactForm;

class ContactManager
{

    public function create(ContactForm $contactForm)
    {
        $contact = Contact::create($contactForm);

        $contact->save(false);

        return $contact->id;
    }

    public function getById($id)
    {
        return Contact::findOne($id);
    }

    public function getAll()
    {
        return Contact::find()->asArray()->all();
    }

    public function update(ContactForm $contactForm)
    {
        /* @var $contact Contact
         */

        $contact = Contact::findOne($contactForm->id);

        $contact->edit($contactForm);

        $contact->save();
    }

    public function remove($id)
    {
        $contact = Contact::findOne($id);
        $contact->delete();
    }

    public function getSocialContacts()
    {
        return Contact::find()
            ->where(['type'=> Contact::CONTACT_TYPE_SOCIAL])
            ->orderBy('position')
            ->asArray()
            ->all();
    }

    public function getPhoneContacts()
    {
        return Contact::find()
            ->where(['type'=> Contact::CONTACT_TYPE_PHONES])
            ->orderBy('position')
            ->asArray()
            ->all();
    }
}