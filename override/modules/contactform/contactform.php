<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class ContactformOverride extends Contactform
// extends Module implements Contactform
{
    protected $contact;
    protected $customer_thread;

    // Surcharge de la méthode de récupération de variables
    public function getWidgetVariables($hookName = null, array $configuration = [])
    {
        $purl = Tools::getValue('purl'); //- on cherche si purl est renseigné dans l'url
        $notifications = false;
        
        // Appel de la méthode correspondant selon le cas de figure
        if(Tools::isSubmit('submitMessage')){
            $this->sendMessage();

            if (!empty($this->context->controller->errors)) {
                    $notifications['messages'] = $this->context->controller->errors;
                    $notifications['nw_error'] = true;
            } elseif (!empty($this->context->controller->success)) {
                    $notifications['messages'] = $this->context->controller->success;
                    $notifications['nw_error'] = false;
            }
            if (($id_customer_thread = (int)Tools::getValue('id_customer_thread')) && $token = Tools::getValue('token')) {
                $cm = new CustomerThread($id_customer_thread);
                if ($cm->token == $token) {
                    $this->customer_thread = $this->context->controller->objectPresenter->present($cm);
                    $order = new Order((int)$this->customer_thread['id_order']);
                    if (Validate::isLoadedObject($order)) {
                        $customer_thread['reference'] = $order->getUniqReference();
                    }
                }
            }

            $this->contact['telephone'] = html_entity_decode(Tools::getValue('telephone'));
        } //- Message de contact
        if(Tools::isSubmit('submitDevis')){
            $this->sendDevis();

            if (!empty($this->context->controller->errors)) {
                    $notifications['messages'] = $this->context->controller->errors;
                    $notifications['nw_error'] = true;
            } elseif (!empty($this->context->controller->success)) {
                    $notifications['messages'] = $this->context->controller->success;
                    $notifications['nw_error'] = false;
            }
            if (($id_customer_thread = (int)Tools::getValue('id_customer_thread')) && $token = Tools::getValue('token')) {
                $cm = new CustomerThread($id_customer_thread);
                if ($cm->token == $token) {
                    $this->customer_thread = $this->context->controller->objectPresenter->present($cm);
                    $order = new Order((int)$this->customer_thread['id_order']);
                    if (Validate::isLoadedObject($order)) {
                        $customer_thread['reference'] = $order->getUniqReference();
                    }
                }
            }

            $this->contact['telephone'] = html_entity_decode(Tools::getValue('telephone'));
        } //- Message de devis sans installation
        if(Tools::isSubmit('submitFull')) {
            $this->sendFull();

            if (!empty($this->context->controller->errors)) {
                    $notifications['messages'] = $this->context->controller->errors;
                    $notifications['nw_error'] = true;
            } elseif (!empty($this->context->controller->success)) {
                    $notifications['messages'] = $this->context->controller->success;
                    $notifications['nw_error'] = false;
            }
                
            
            if (($id_customer_thread = (int)Tools::getValue('id_customer_thread')) && $token = Tools::getValue('token')) {
                $cm = new CustomerThread($id_customer_thread);
                if ($cm->token == $token) {
                    $this->customer_thread = $this->context->controller->objectPresenter->present($cm);
                    $order = new Order((int)$this->customer_thread['id_order']);
                    if (Validate::isLoadedObject($order)) {
                        $customer_thread['reference'] = $order->getUniqReference();
                    }
                }
            }

            $this->contact['telephone'] = html_entity_decode(Tools::getValue('telephone'));

            // Webbax - 09.09.17 - Tuto 33 - Devis 
            

            if (!empty($purl)) {

                $this->contact['societe'] = $this->getTemplateVarContact();
                $this->contact['adresse'] = $this->getTemplateVarContact();

                if (strpos($purl, "pname=Station+Remix") == true)
                {
                    $this->contact['installation'] = $this->getTemplateVarContact();
                    $this->contact['bouteille'] = $this->getTemplateVarContact();
                    $this->contact['saveurs'] = $this->getTemplateVarContact();
                    
                } elseif (strpos($purl, "bouteille") == true)
                {
                    $this->contact['bouteille'] = $this->getTemplateVarContact();
                    $this->contact['saveurs'] = $this->getTemplateVarContact();
                }
            }
        } //- Message de devis avec installation
        
        //- Récupération des données en base de données
        $this->contact['contacts'] = $this->getTemplateVarContact(); //- le contact pour le mail
    
        // Construction d'un message prédéfini si purl n'est pas vide
        if (!empty($purl)) {
            $message = $this->l('Bonjour,') . "\n" .
                "\n" .
                $this->l('Je suis intéressé par le produit ci-dessous : ') . 
                html_entity_decode(Tools::getValue('pname')) .  "\n\n\n" .

                $this->l('Merci de nous avoir contacter');
        } else {
            $message = Tools::getValue('message');
        }
        $this->contact['message'] = $message;

        // Si l'utilisateur joint un document au message (inutilisé dans notre cas)
        //- $this->contact['allow_file_upload'] = (bool) Configuration::get('PS_CUSTOMER_SERVICE_FILE_UPLOAD');

        if (!(bool)Configuration::isCatalogMode()) {
            $this->contact['orders'] = $this->getTemplateVarOrders();
        } else {
            $this->contact['orders'] = array();
        }

        if ($this->customer_thread['email']) {
            $this->contact['email'] = $this->customer_thread['email'];
        } else {
            $this->contact['email'] = Tools::safeOutput(Tools::getValue('from', 
            ((isset($this->context->cookie) && isset($this->context->cookie->email) 
                && Validate::isEmail($this->context->cookie->email)) ? $this->context->cookie->email : '')));
        }

        return [
            'contact' => $this->contact, //- on retourne le tableau d'objet complété
            'notifications' => $notifications, //- tableau erreur ['message','mw_error']
        ];
    }

    // Surcharge de la méthode d'envoi de message
    public function sendMessage(){
        $message = Tools::getValue('message');
        $telephone = trim(Tools::getValue('telephone'));

        if (!($from = trim(Tools::getValue('from'))) || !Validate::isEmail($from)) {
            $this->context->controller->errors[] = $this->trans('Invalid email address.', array(), 'Shop.Notifications.Error');
        } elseif (empty($message)) {
            $this->context->controller->errors[] = $this->trans('The message cannot be blank.', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($message)) {
            $this->context->controller->errors[] = $this->trans('Invalid message', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($telephone)) {
            $this->context->controller->errors[] = $this->trans('Invalid phone', array(), 'Shop.Notifications.Error');
        } elseif (!($id_contact = (int)Tools::getValue('id_contact')) || !(Validate::isLoadedObject($contact = new Contact($id_contact, $this->context->language->id)))) {
            $this->context->controller->errors[] = $this->trans('Please select a subject from the list provided. ', array(), 'Modules.Contactform.Shop');
        } 

        else {
            $customer = $this->context->customer;
            if (!$customer->id) {
                $customer->getByEmail($from);
            }

            $id_order = (int)Tools::getValue('id_order');

            $id_customer_thread = CustomerThread::getIdCustomerThreadByEmailAndIdOrder($from, $id_order);

            if ($contact->customer_service) {
                if ((int)$id_customer_thread) {
                    $ct = new CustomerThread($id_customer_thread);
                    $ct->status = 'open';
                    $ct->id_lang = (int)$this->context->language->id;
                    $ct->id_contact = (int)$id_contact;
                    $ct->id_order = (int)$id_order;
                    if ($id_product = (int)Tools::getValue('id_product')) {
                        $ct->id_product = $id_product;
                    }
                    $ct->update();
                } else {
                    $ct = new CustomerThread();
                    if (isset($customer->id)) {
                        $ct->id_customer = (int)$customer->id;
                    }
                    $ct->id_shop = (int)$this->context->shop->id;
                    $ct->id_order = (int)$id_order;
                    if ($id_product = (int)Tools::getValue('id_product')) {
                        $ct->id_product = $id_product;
                    }
                    $ct->id_contact = (int)$id_contact;
                    $ct->id_lang = (int)$this->context->language->id;
                    $ct->email = $from;
                    $ct->status = 'open';
                    $ct->token = Tools::passwdGen(12);
                    $ct->add();
                }

                if ($ct->id) {

                    $lastMessage = CustomerMessage::getLastMessageForCustomerThread($ct->id);

                    // if last message is the same as new message (and no file upload), do not consider this contact
                    if ($lastMessage != $message) {
                        $cm = new CustomerMessage();
                        $cm->id_customer_thread = $ct->id;
                        $cm->message = $message;
                        $cm->ip_address = (int)ip2long(Tools::getRemoteAddr());
                        $cm->user_agent = $_SERVER['HTTP_USER_AGENT'];
                        if (!$cm->add()) {
                            $this->context->controller->errors[] = $this->trans('An error occurred while sending the message.', array(), 'Modules.Contactform.Shop');
                        }
                    } else {
                        $mailAlreadySend = true;
                    }
                } else {
                    $this->context->controller->errors[] = $this->trans('An error occurred while sending the message.', array(), 'Modules.Contactform.Shop');
                }
            }

            if (!count($this->context->controller->errors) && empty($mailAlreadySend)) {
                
                $var_list = [
                    '{order_name}' => '-',
                    '{message}' => Tools::nl2br(stripslashes($message)),
                    '{email}' =>  $from,
                    '{product_name}' => '',
                    '{firstname}' => '',
                    '{lastname}' => '',
                    '{telephone}' => Tools::nl2br(stripslashes($telephone)),
                ];

                if (isset($customer->id)) {
                    $var_list['{firstname}'] = $customer->firstname;
                    $var_list['{lastname}'] = $customer->lastname;
                }

                $id_product = (int)Tools::getValue('id_product');

                if (isset($ct) && Validate::isLoadedObject($ct) && $ct->id_order) {
                    $order = new Order((int)$ct->id_order);
                    $var_list['{order_name}'] = $order->getUniqReference();
                    $var_list['{id_order}'] = (int)$order->id;
                }

                if ($id_product) {
                    $product = new Product((int)$id_product);
                    if (Validate::isLoadedObject($product) && isset($product->name[Context::getContext()->language->id])) {
                        $var_list['{product_name}'] = $product->name[Context::getContext()->language->id];
                    }
                }

                if (empty($contact->email)) {
                    Mail::Send(
                        $this->context->language->id,
                        'contact_form',
                        ((isset($ct) && Validate::isLoadedObject($ct)) ?
                            $this->trans(
                                'Your message has been correctly sent #ct%thread_id% #tc%thread_token%',
                                array('%thread_id%' => $ct->id, '%thread_token%' => $ct->token),
                                'Emails.Subject'
                            ) : $this->trans('Your message has been correctly sent', array(), 'Emails.Subject')),
                        $var_list,
                        $from,
                        null,
                        null,
                        null,
                        null
                    );
                } else {
                    
                    if (!Mail::Send(
                        $this->context->language->id,
                        'contact',
                        $this->trans('Message from contact form', array(), 'Emails.Subject') . ' [no_sync]',
                        $var_list,
                        $contact->email,
                        $contact->name,
                        null,
                        null,
                        null,
                        null,
                        _PS_MAIL_DIR_,
                        false,
                        null,
                        null,
                        $from
                    ) || !Mail::Send(
                        $this->context->language->id,
                        'contact_form',
                        ((isset($ct) && Validate::isLoadedObject($ct)) ?
                            $this->trans(
                                'Your message has been correctly sent #ct%thread_id% #tc%thread_token%',
                                array('%thread_id%' => $ct->id, '%thread_token%' => $ct->token),
                                'Emails.Subject'
                            ) : $this->trans('Your message has been correctly sent', array(), 'Emails.Subject')),
                        $var_list,
                        $from,
                        null,
                        null,
                        null,
                        null,
                        null,
                        _PS_MAIL_DIR_,
                        false,
                        null,
                        null,
                        $contact->email
                    )) {
                        $this->context->controller->errors[] = $this->trans('An error occurred while sending the message.', array(), 'Modules.Contactform.Shop');
                    }
                }
            }

            if (!count($this->context->controller->errors)) {
                $this->context->controller->success[] = $this->trans('Your message has been successfully sent to our team.', array(), 'Modules.Contactform.Shop');
            }
        }
    }

    // Méthode d'envoi de message sans installation
    public function sendDevis(){
        $message = Tools::getValue('message');              // Stockage des    
        $telephone = trim(Tools::getValue('telephone'));    // valeurs des champs
        $societe = trim(Tools::getvalue('societe'));        // dans leur variable
        $adresse = trim(Tools::getvalue('adresse'));        // correspondant
        $NbBouteille = Tools::getvalue('bouteille');        // pour l'envoi
        $saveurs = Tools::getvalue('saveurs');              // de mail

        // Contrôle des champs de saisies
        if (!($from = trim(Tools::getValue('from'))) || !Validate::isEmail($from)) {
            $this->context->controller->errors[] = $this->trans('Invalid email address.', array(), 'Shop.Notifications.Error');
        } elseif (empty($message)) {
            $this->context->controller->errors[] = $this->trans('The message cannot be blank.', array(), 'Shop.Notifications.Error');
        
        } elseif(!Validate::isCleanHtml($adresse)) { //- contrôle du champ 'adresse'.
            $this->context->controller->errors[] = $this->trans('adresse invalide', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($societe)) { //- contrôle du champ 'societe'.
            $this->context->controller->errors[] = $this->trans('societe invalide', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($NbBouteille)) { //- contrôle du champ 'nombre de bouteilles'.
            $this->context->controller->errors[] = $this->trans('nombre de bouteilles invalide', array(), 'Shop.Notifications.Error');     
        } elseif (!Validate::isCleanHtml($saveurs)) { //- contrôle du champ 'nombre de saveurs'.
            $this->context->controller->errors[] = $this->trans('nombre de saveurs invalide', array(), 'Shop.Notifications.Error');
        
        } elseif (!Validate::isCleanHtml($message)) {
            $this->context->controller->errors[] = $this->trans('Invalid message', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($telephone)) { //- contrôle du champ 'telephone'.
            $this->context->controller->errors[] = $this->trans('Invalid phone', array(), 'Shop.Notifications.Error');
        } elseif (!($id_contact = (int)Tools::getValue('id_contact')) || !(Validate::isLoadedObject($contact = 
            new Contact($id_contact, $this->context->language->id)))) {
            $this->context->controller->errors[] = $this->trans('Please select a subject from the list provided. ', array(), 'Modules.Contactform.Shop');
        } 

        else {
            $customer = $this->context->customer;
            if (!$customer->id) {
                $customer->getByEmail($from);
            }

            $id_order = (int)Tools::getValue('id_order');

            $id_customer_thread = CustomerThread::getIdCustomerThreadByEmailAndIdOrder($from, $id_order);

            if ($contact->customer_service) {
                if ((int)$id_customer_thread) {
                    $ct = new CustomerThread($id_customer_thread);
                    $ct->status = 'open';
                    $ct->id_lang = (int)$this->context->language->id;
                    $ct->id_contact = (int)$id_contact;
                    $ct->id_order = (int)$id_order;
                    if ($id_product = (int)Tools::getValue('id_product')) {
                        $ct->id_product = $id_product;
                    }
                    $ct->update();
                } else {
                    $ct = new CustomerThread();
                    if (isset($customer->id)) {
                        $ct->id_customer = (int)$customer->id;
                    }
                    $ct->id_shop = (int)$this->context->shop->id;
                    $ct->id_order = (int)$id_order;
                    if ($id_product = (int)Tools::getValue('id_product')) {
                        $ct->id_product = $id_product;
                    }
                    $ct->id_contact = (int)$id_contact;
                    $ct->id_lang = (int)$this->context->language->id;
                    $ct->email = $from;
                    $ct->status = 'open';
                    $ct->token = Tools::passwdGen(12);
                    $ct->add();
                }

                if ($ct->id) {

                    $lastMessage = CustomerMessage::getLastMessageForCustomerThread($ct->id);

                    // if last message is the same as new message (and no file upload), do not consider this contact
                    if ($lastMessage != $message) {
                        $cm = new CustomerMessage();
                        $cm->id_customer_thread = $ct->id;
                        $cm->message = $message;
                        $cm->ip_address = (int)ip2long(Tools::getRemoteAddr());
                        $cm->user_agent = $_SERVER['HTTP_USER_AGENT'];
                        if (!$cm->add()) {
                            $this->context->controller->errors[] = $this->trans('An error occurred while sending the message.', array(), 'Modules.Contactform.Shop');
                        }
                    } else {
                        $mailAlreadySend = true;
                    }
                } else {
                    $this->context->controller->errors[] = $this->trans('An error occurred while sending the message.', array(), 'Modules.Contactform.Shop');
                }
            }

            if (!count($this->context->controller->errors) && empty($mailAlreadySend)) {
                // Stockage dans un tableau d'objet les valeurs des champs saisie pour l'envoi du mail
                $var_list = [
                    '{order_name}' => '-',
                    '{message}' => Tools::nl2br(stripslashes($message)),
                    '{email}' =>  $from,
                    '{product_name}' => '',
                    '{firstname}' => '',
                    '{lastname}' => '',
                    '{telephone}' => Tools::nl2br(stripslashes($telephone)),
                    '{societe}' => Tools::nl2br(stripslashes($societe)),
                    '{adresse}' => Tools::nl2br(stripslashes($adresse)),
                    '{NbBouteille}' => Tools::nl2br(stripslashes($NbBouteille)),
                    '{saveurs}' => Tools::nl2br(stripslashes($saveurs)),
                ];

                if (isset($customer->id)) {
                    $var_list['{firstname}'] = $customer->firstname;
                    $var_list['{lastname}'] = $customer->lastname;
                }

                $id_product = (int)Tools::getValue('id_product');

                if (isset($ct) && Validate::isLoadedObject($ct) && $ct->id_order) {
                    $order = new Order((int)$ct->id_order);
                    $var_list['{order_name}'] = $order->getUniqReference();
                    $var_list['{id_order}'] = (int)$order->id;
                }

                if ($id_product) {
                    $product = new Product((int)$id_product);
                    if (Validate::isLoadedObject($product) && isset($product->name[Context::getContext()->language->id])) {
                        $var_list['{product_name}'] = $product->name[Context::getContext()->language->id];
                    }
                }

                // Envoi du mail 
                if (empty($contact->email)) {
                    Mail::Send(
                        $this->context->language->id,
                        'contact_formdevis', //- expéditeur
                        ((isset($ct) && Validate::isLoadedObject($ct)) ?
                            $this->trans(
                                'Your message has been correctly sent #ct%thread_id% #tc%thread_token%',
                                array('%thread_id%' => $ct->id, '%thread_token%' => $ct->token),
                                'Emails.Subject'
                            ) : $this->trans('Your message has been correctly sent', array(), 'Emails.Subject')),
                        $var_list,
                        $from,
                        null,
                        null,
                        null,
                        null
                    );
                } else {
                    
                    if (!Mail::Send(
                        $this->context->language->id,
                        'contactdevis', //- destinataire
                        $this->trans('Message from contact form', array(), 'Emails.Subject') . ' [no_sync]',
                        $var_list,
                        $contact->email,
                        $contact->name,
                        null,
                        null,
                        null,
                        null,
                        _PS_MAIL_DIR_,
                        false,
                        null,
                        null,
                        $from
                    ) || !Mail::Send(
                        $this->context->language->id,
                        'contact_formdevis', //- expéditeur
                        ((isset($ct) && Validate::isLoadedObject($ct)) ?
                            $this->trans(
                                'Your message has been correctly sent #ct%thread_id% #tc%thread_token%',
                                array('%thread_id%' => $ct->id, '%thread_token%' => $ct->token),
                                'Emails.Subject'
                            ) : $this->trans('Your message has been correctly sent', array(), 'Emails.Subject')),
                        $var_list,
                        $from,
                        null,
                        null,
                        null,
                        null,
                        null,
                        _PS_MAIL_DIR_,
                        false,
                        null,
                        null,
                        $contact->email
                    )) {
                        // Le message n'a pas pu être envoyé
                        $this->context->controller->errors[] = $this->trans('An error occurred while sending the message.', 
                            array(), 'Modules.Contactform.Shop');
                    }
                }
            }

            if (!count($this->context->controller->errors)) {
                // Le message a été envoyé avec succés
                $this->context->controller->success[] = $this->trans('Your message has been successfully sent to our team.', array(), 'Modules.Contactform.Shop');
            }
        }
    }

    // Méthode d'envoi de message avec installation
    public function sendFull()
    {

        $message = Tools::getValue('message');
        $telephone = trim(Tools::getValue('telephone'));

        $societe = trim(Tools::getvalue('societe'));
        $adresse = trim(Tools::getvalue('adresse'));

        $installation = Tools::getvalue('installation');

        $NbBouteille = Tools::getvalue('bouteille');
        $saveurs = Tools::getvalue('saveurs');
        

        if (!($from = trim(Tools::getValue('from'))) || !Validate::isEmail($from)) {
            $this->context->controller->errors[] = $this->trans('Invalid email address.', array(), 'Shop.Notifications.Error');
        } elseif (empty($message)) {
            $this->context->controller->errors[] = $this->trans('The message cannot be blank.', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($message)) {
            $this->context->controller->errors[] = $this->trans('Invalid message', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($telephone)) {
            $this->context->controller->errors[] = $this->trans('Invalid phone', array(), 'Shop.Notifications.Error');
        }

          elseif (!Validate::isCleanHtml($adresse)) { //contrôle de notre champ adresse.
                $this->context->controller->errors[] = $this->trans('adresse invalide', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($societe)) { //contrôle de notre champ societe.
                $this->context->controller->errors[] = $this->trans('societe invalide', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($installation)) { //contrôle de notre champ installation.
                $this->context->controller->errors[] = $this->trans('installation invalide', array(), 'Shop.Notifications.Error');
        } elseif (!Validate::isCleanHtml($NbBouteille)) { //contrôle de notre champ du nombre de bouteilles.
                $this->context->controller->errors[] = $this->trans('nombre de bouteilles invalide', array(), 'Shop.Notifications.Error');     
        } elseif (!Validate::isCleanHtml($saveurs)) { //contrôle de notre champ du nombre de saveurs.
                $this->context->controller->errors[] = $this->trans('nombre de saveurs invalide', array(), 'Shop.Notifications.Error');
            
        }
          elseif (!($id_contact = (int)Tools::getValue('id_contact')) || !(Validate::isLoadedObject($contact = new Contact($id_contact, $this->context->language->id)))) {
                $this->context->controller->errors[] = $this->trans('Please select a subject from the list provided. ', array(), 'Modules.Contactform.Shop');
        } 
        
        
        else {
            $customer = $this->context->customer;
            if (!$customer->id) {
                $customer->getByEmail($from);
            }

            $id_order = (int)Tools::getValue('id_order');

            $id_customer_thread = CustomerThread::getIdCustomerThreadByEmailAndIdOrder($from, $id_order);

            if ($contact->customer_service) {
                if ((int)$id_customer_thread) {
                    $ct = new CustomerThread($id_customer_thread);
                    $ct->status = 'open';
                    $ct->id_lang = (int)$this->context->language->id;
                    $ct->id_contact = (int)$id_contact;
                    $ct->id_order = (int)$id_order;
                    if ($id_product = (int)Tools::getValue('id_product')) {
                        $ct->id_product = $id_product;
                    }
                    $ct->update();
                } else {
                    $ct = new CustomerThread();
                    if (isset($customer->id)) {
                        $ct->id_customer = (int)$customer->id;
                    }
                    $ct->id_shop = (int)$this->context->shop->id;
                    $ct->id_order = (int)$id_order;
                    if ($id_product = (int)Tools::getValue('id_product')) {
                        $ct->id_product = $id_product;
                    }
                    $ct->id_contact = (int)$id_contact;
                    $ct->id_lang = (int)$this->context->language->id;
                    $ct->email = $from;
                    $ct->status = 'open';
                    $ct->token = Tools::passwdGen(12);
                    $ct->add();
                }

                if ($ct->id) {

                    $lastMessage = CustomerMessage::getLastMessageForCustomerThread($ct->id);

                    // if last message is the same as new message (and no file upload), do not consider this contact
                    if ($lastMessage != $message) {
                        $cm = new CustomerMessage();
                        $cm->id_customer_thread = $ct->id;
                        $cm->message = $message;
                        $cm->ip_address = (int)ip2long(Tools::getRemoteAddr());
                        $cm->user_agent = $_SERVER['HTTP_USER_AGENT'];
                        if (!$cm->add()) {
                            $this->context->controller->errors[] = $this->trans('An error occurred while sending the message.', array(), 'Modules.Contactform.Shop');
                        }
                    } else {
                        $mailAlreadySend = true;
                    }
                } else {
                    $this->context->controller->errors[] = $this->trans('An error occurred while sending the message.', array(), 'Modules.Contactform.Shop');
                }
            }

            if (!count($this->context->controller->errors) && empty($mailAlreadySend)) {
                
                $var_list = [
                    '{order_name}' => '-',
                    '{message}' => Tools::nl2br(stripslashes($message)),
                    '{email}' =>  $from,
                    '{product_name}' => '',
                    '{firstname}' => '',
                    '{lastname}' => '',
                    '{telephone}' => Tools::nl2br(stripslashes($telephone)),
                    '{societe}' => Tools::nl2br(stripslashes($societe)),

                    '{installation}' => Tools::nl2br(stripslashes($installation)),

                    '{adresse}' => Tools::nl2br(stripslashes($adresse)),
                    '{NbBouteille}' => Tools::nl2br(stripslashes($NbBouteille)),
                    '{saveurs}' => Tools::nl2br(stripslashes($saveurs)),
                ];

                if($var_list['{installation}'] == 'Choix...')
                    $var_list['{installation}'] = '->sans';
                
                if (isset($customer->id)) {
                    $var_list['{firstname}'] = $customer->firstname;
                    $var_list['{lastname}'] = $customer->lastname;
                }

                $id_product = (int)Tools::getValue('id_product');

                if (isset($ct) && Validate::isLoadedObject($ct) && $ct->id_order) {
                    $order = new Order((int)$ct->id_order);
                    $var_list['{order_name}'] = $order->getUniqReference();
                    $var_list['{id_order}'] = (int)$order->id;
                }

                if ($id_product) {
                    $product = new Product((int)$id_product);
                    if (Validate::isLoadedObject($product) && isset($product->name[Context::getContext()->language->id])) {
                        $var_list['{product_name}'] = $product->name[Context::getContext()->language->id];
                    }
                }

                if (empty($contact->email)) {
                    Mail::Send(
                        $this->context->language->id,
                        'contact_formfull',
                        ((isset($ct) && Validate::isLoadedObject($ct)) ?
                            $this->trans(
                                'Your message has been correctly sent #ct%thread_id% #tc%thread_token%',
                                array('%thread_id%' => $ct->id, '%thread_token%' => $ct->token),
                                'Emails.Subject'
                            ) : $this->trans('Your message has been correctly sent', array(), 'Emails.Subject')),
                        $var_list,
                        $from,
                        null,
                        null,
                        null,
                        null
                    );
                } else {
                    
                    if (!Mail::Send(
                        $this->context->language->id,
                        'contactfull',
                        $this->trans('Message from contact form', array(), 'Emails.Subject') . ' [no_sync]',
                        $var_list,
                        $contact->email,
                        $contact->name,
                        null,
                        null,
                        null,
                        null,
                        _PS_MAIL_DIR_,
                        false,
                        null,
                        null,
                        $from
                    ) || !Mail::Send(
                        $this->context->language->id,
                        'contact_formfull',
                        ((isset($ct) && Validate::isLoadedObject($ct)) ?
                            $this->trans(
                                'Your message has been correctly sent #ct%thread_id% #tc%thread_token%',
                                array('%thread_id%' => $ct->id, '%thread_token%' => $ct->token),
                                'Emails.Subject'
                            ) : $this->trans('Your message has been correctly sent', array(), 'Emails.Subject')),
                        $var_list,
                        $from,
                        null,
                        null,
                        null,
                        null,
                        null,
                        _PS_MAIL_DIR_,
                        false,
                        null,
                        null,
                        $contact->email
                    )) {
                        $this->context->controller->errors[] = $this->trans('An error occurred while sending the message.', array(), 'Modules.Contactform.Shop');
                    }
                }
            }

            if (!count($this->context->controller->errors)) {
                $this->context->controller->success[] = $this->trans('Your message has been successfully sent to our team.', array(), 'Modules.Contactform.Shop');
            }
        }
    }

}
