<?php


//Ce code permet d’éviter à un individu malveillant d’accéder et d’exécuter ce fichier seul.
if (!defined('_PS_VERSION_')) {
    exit;
}


//Constructeur : Chaque classe dispose d’un constructeur. Qu’elle hérite de celui de sa classe parente ou qu’il soit clairement défini.
class Ns_Contact extends Module
{
    public function __construct()
    {
        $this->name = 'ns_contact';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Witczak Vincent';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.7',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Module Contact');
        $this->description = $this->l('Mon premier module prestashop');

        $this->confirmUninstall = $this->l('Êtes-vous sûr de vouloir désinstaller ce module ?');

        if (!Configuration::get('NS_CONTACT_PAGENAME')) {
            $this->warning = $this->l('Aucun nom fourni');
        }
    }


    // installation : Par défaut, les méthodes install et uninstall appellent celles de la classe parente, 
    // ici donc si ces méthodes ne sont pas spécifiées Prestashop appel celle de la classe Module.
    //Afficher du contenu sur la boutique en utilisant les 2 hooks auxquels le module s'inscrit à l'installation.
    public function install()
    {

        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        if (
            !parent::install() ||
            !$this->registerHook('leftColumn') ||
            !$this->registerHook('header') ||
            !Configuration::updateValue('NS_CONTACT_PAGENAME', 'Mentions légales')
        ) {
            return false;
        }

        return true;
    }
    // désinstallation
    public function uninstall()
    {

        if (
            !parent::uninstall() ||
            !Configuration::deleteByName('NS_CONTACT_PAGENAME')
        ) {
            return false;
        }

        return true;
    }


    //Afficher une page de configuration
    //Pour que Prestashop sache que votre module dispose d’une page de configuration, il faut
    //utiliser la méthode getContent() qui retournera un formulaire accessible par l’utilisateur.
    public function getContent()
    {
        $output = null;

        if (Tools::isSubmit('btnSubmit')) {
            $pageName = strval(Tools::getValue('NS_CONTACT_PAGENAME'));

            if (
                !$pageName ||
                empty($pageName)
            ) {
                $output .= $this->displayError($this->l('Invalid Configuration value'));
            } else {
                Configuration::updateValue('NS_CONTACT_PAGENAME', $pageName);
                $output .= $this->displayConfirmation($this->l('Settings updated'));
            }
        }

        return $output . $this->displayForm();
    }



    // Création du formulaire
    //La méthode getContent() s’occupe de gérer l’affichage de la page de configuration
    //Cette méthode utilisera la classe HelperForm qui met à disposition toute une série de méthodes pour créer 
    //et des formulaires dans le back office.

    public function displayForm()
    {
        // Récupère la langue par défaut
        $defaultLang = (int)Configuration::get('PS_LANG_DEFAULT');

        // Initialise les champs du formulaire dans un tableau
        $form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Configuration value'),
                        'name' => 'NS_CONTACT_PAGENAME',
                        'size' => 20,
                        'required' => true
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'name'  => 'btnSubmit'
                )
            ),
        );

        $helper = new HelperForm();

        // Module, token et currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&amp;configure=' . $this->name;

        // Langue
        $helper->default_form_language = $defaultLang;

        // Charge la valeur de NS_MONMODULE_PAGENAME depuis la base
        $helper->fields_value['NS_CONTACT_PAGENAME'] = Configuration::get('NS_CONTACT_PAGENAME');

        return $helper->generateForm(array($form));
    }



    // Ajout du code suivant pour gérer l’affichage du contenu dans la colonne de gauche avec la méthode hookDisplayLeftColumn. 
    // définit le hook leftColumn

    public function hookDisplayLeftColumn($params)
    {
        $this->context->smarty->assign([
            'ns_page_name' => Configuration::get('NS_CONTACT_PAGENAME'),
            'ns_page_link' => $this->context->link->getModuleLink('ns_contact', 'display')
        ]);

        return $this->display(__FILE__, 'ns_contact.tpl');
    }


    //définit le hook header
    // public function hookDisplayHeader()
    // {
    //     $this->context->controller->registerStylesheet(
    //         'ns_contact',
    //         $this->_path . 'views/css/ns_contact.css',
    //         ['server' => 'remote', 'position' => 'head', 'priority' => 150]
    //     );
    // }
}
