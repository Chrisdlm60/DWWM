<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__e13801e280a3454b8197ecea0f321768fd250abecb87be973ec5c7343da7a86e */
class __TwigTemplate_f575f5515710b0340332df886ad0b96d248e67ac6a19b19cb7c99573067e81d7 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'extra_stylesheets' => [$this, 'block_extra_stylesheets'],
            'content_header' => [$this, 'block_content_header'],
            'content' => [$this, 'block_content'],
            'content_footer' => [$this, 'block_content_footer'],
            'sidebar_right' => [$this, 'block_sidebar_right'],
            'javascripts' => [$this, 'block_javascripts'],
            'extra_javascripts' => [$this, 'block_extra_javascripts'],
            'translate_javascripts' => [$this, 'block_translate_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
  <meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=0.75\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"robots\" content=\"NOFOLLOW, NOINDEX\">

<link rel=\"icon\" type=\"image/x-icon\" href=\"/prestarecup/img/favicon.ico\" />
<link rel=\"apple-touch-icon\" href=\"/prestarecup/img/app_icon.png\" />

<title>Produits • VapEnjoy</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminProducts';
    var iso_user = 'fr';
    var lang_is_rtl = '0';
    var full_language_code = 'fr';
    var full_cldr_language_code = 'fr-FR';
    var country_iso_code = 'FR';
    var _PS_VERSION_ = '1.7.7.1';
    var roundMode = 2;
    var youEditFieldFor = '';
        var new_order_msg = 'Une nouvelle commande a été passée sur votre boutique.';
    var order_number_msg = 'Numéro de commande : ';
    var total_msg = 'Total : ';
    var from_msg = 'Du ';
    var see_order_msg = 'Afficher cette commande';
    var new_customer_msg = 'Un nouveau client s\\'est inscrit sur votre boutique';
    var customer_name_msg = 'Nom du client : ';
    var new_msg = 'Un nouveau message a été posté sur votre boutique.';
    var see_msg = 'Lire le message';
    var token = '1298c7c736c7eb8be2a5dc01d69f08ff';
    var token_admin_orders = '09ea5642bc3995bdb592087fcaf69867';
    var token_admin_customers = 'db7cd1341a3119330ddcafc3f4ce53b6';
    var token_admin_customer_threads = 'a7b1866cc600ce8f0421488fa8f5cd9c';
    var currentIndex = 'index.php?controller=AdminProducts';
    var employee_token = '0a7490e404a23fc516c012ddf04ad606';
    var choose_language_translate = 'Choisissez la langue :';
    var default_language = '1';
    var admin_modules_link = '/prestarecup/adminlws/index.php/improve/modules/catalog/recommended?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA';
    var admin_notification_get_link = '/prestarecup/adminlws/index.php/common/notifications?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA';
    var admin_notification_push_link = '/prestarecup/adminlws/index.php/common/notifications/ack?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA';
    var tab_modules_list = '';
    var update_success_msg = 'Mise à jour réussie';
    var errorLogin = 'PrestaShop n\\'a pas pu se connecter à Addons. Veuillez vérifier vos identifiants et votre connexion Internet.';
    var search_product_msg = 'Rechercher un produit';
  </script>

      <link href=\"/prestarecup/adminlws/themes/new-theme/public/theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/prestarecup/js/jquery/plugins/chosen/jquery.chosen.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/prestarecup/js/jquery/plugins/fancybox/jquery.fancybox.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/prestarecup/adminlws/themes/default/css/vendor/nv.d3.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/prestarecup/modules/tntofficiel/views/css/q0y640/global.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/prestarecup/modules/amzpayments/views/css/admin_17.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/prestarecup/modules/colissimo_simplicite/views/css/back.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/prestarecup/modules/tntofficiel/views/css/q0y640/Admin.css\" rel=\"stylesheet\" type=\"text/css\"/>
  
  <script type=\"text/javascript\">
var TNTOfficiel = {\"timestamp\":1615381834432.1521,\"module\":{\"name\":\"tntofficiel\",\"title\":\"TNT\",\"version\":\"1.0.7\",\"context\":false,\"ready\":true},\"config\":{\"google\":{\"map\":{\"url\":\"https:\\/\\/maps.googleapis.com\\/maps\\/api\\/js\",\"data\":{\"v\":\"3.exp\",\"key\":\"\"},\"default\":{\"lat\":46.827742000000001,\"lng\":2.8356439999999998,\"zoom\":6}}}},\"translate\":{\"validateDeliveryAddress\":\"Valider votre adresse de livraison\",\"unknownPostalCode\":\"Code postal inconnu\",\"validatePostalCodeDeliveryAddress\":\"Veuillez &eacute;diter et valider le code postal de votre adresse de livraison.\",\"unrecognizedCity\":\"Ville non reconnue\",\"selectCityDeliveryAddress\":\"Veuillez s&eacute;lectionner la ville de votre adresse de livraison.\",\"postalCode\":\"Code postal\",\"city\":\"Ville\",\"validate\":\"Valider\",\"validateAdditionalCarrierInfo\":\"Veuillez renseigner les informations compl&eacute;mentaires de livraison en cliquant sur &laquo; valider &raquo;.\",\"errorDownloadingHRA\":\"Probl&egrave;me de t&eacute;l&eacute;chargement de la liste des communes en Z.D.A. Veuillez-vous rapprocher de notre service support.\",\"errorInvalidPhoneNumber\":\"Le T&eacute;l&eacute;phone portable doit &ecirc;tre de 10 chiffres et commencer par 06 ou 07\",\"errorInvalidEMail\":\"L'e-mail est invalide\",\"errorNoDeliveryOptionSelected\":\"Aucune option de livraison n'est s&eacute;lectionn&eacute;e.\",\"errorNoDeliveryAddressSelected\":\"Aucune  adresse de livraison n'est s&eacute;lectionn&eacute;e.\",\"errorNoDeliveryPointSelected\":\"Veuillez s&eacute;lectionner un lieu de livraison.\",\"errorUnknow\":\"Une erreur est survenue.\",\"errorTechnical\":\"Une erreur technique est survenue.\",\"errorConnection\":\"Une erreur de communication est survenue.\",\"back\":{\"updateSuccessfulStr\":\"Mise &agrave; jour r&eacute;ussie\",\"updateFailRetryStr\":\"Mise &agrave; jour non effectu&eacute;e, veuillez r&eacute;essayer\",\"deleteStr\":\"Supprimer\",\"updateStr\":\"Mise &agrave; jour\",\"atLeastOneParcelStr\":\"Une commande doit contenir au moins un colis\"}},\"link\":{\"controller\":\"adminlegacylayoutcontrollercore\",\"front\":{\"shop\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/\",\"module\":{\"boxDeliveryPoints\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/module\\/tntofficiel\\/carrier?action=boxDeliveryPoints\",\"saveProductInfo\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/module\\/tntofficiel\\/carrier?action=saveProductInfo\",\"checkPaymentReady\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/module\\/tntofficiel\\/carrier?action=checkPaymentReady\",\"storeReceiverInfo\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/module\\/tntofficiel\\/address?action=storeReceiverInfo\",\"getAddressCities\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/module\\/tntofficiel\\/address?action=getCities\",\"updateAddressDelivery\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/module\\/tntofficiel\\/address?action=updateDeliveryAddress\",\"checkAddressPostcodeCity\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/module\\/tntofficiel\\/address?action=checkPostcodeCity\"},\"page\":{\"order\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/commande\"}},\"back\":{\"module\":{\"addParcelUrl\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=addParcel&ajax=true\",\"removeParcelUrl\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=removeParcel&ajax=true\",\"updateParcelUrl\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=updateParcel&ajax=true\",\"updateOrderStateDeliveredParcels\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=updateOrderStateDeliveredParcels&ajax=true\",\"checkShippingDateValidUrl\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=checkShippingDateValid&ajax=true\",\"storeReceiverInfo\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=storeReceiverInfo&ajax=true\",\"boxDeliveryPoints\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=boxDeliveryPoints&ajax=true\",\"saveProductInfo\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=saveProductInfo&ajax=true\",\"selectPostcodeCities\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=selectPostcodeCities&ajax=true\",\"updateHRA\":\"http:\\/\\/vincentabxy.fr\\/prestarecup\\/adminlws\\/index.php?controller=AdminTNTOrders&token=3c371314ba71e44df66326240a9de3fa&action=updateHRA&ajax=true\"}},\"image\":\"\\/prestarecup\\/modules\\/tntofficiel\\/views\\/img\\/\"},\"country\":{\"list\":{\"8\":{\"id_country\":\"8\",\"id_lang\":\"1\",\"name\":\"France\",\"id_zone\":\"1\",\"id_currency\":\"0\",\"iso_code\":\"FR\",\"call_prefix\":\"33\",\"active\":\"1\",\"contains_states\":\"0\",\"need_identification_number\":\"1\",\"need_zip_code\":\"1\",\"zip_code_format\":\"NNNNN\",\"display_tax_label\":\"1\",\"country\":\"France\",\"zone\":\"Europe\"}}},\"carrier\":{\"list\":[]},\"cart\":{\"isCarrierListDisplay\":false},\"order\":{\"isTNT\":false},\"alert\":{\"error\":[],\"warning\":[],\"success\":[]}};
var baseAdminDir = \"\\/prestarecup\\/adminlws\\/\";
var baseDir = \"\\/prestarecup\\/\";
var changeFormLanguageUrl = \"\\/prestarecup\\/adminlws\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\";
var currency = {\"iso_code\":\"EUR\",\"sign\":\"\\u20ac\",\"name\":\"Euro\",\"format\":null};
var currency_specifications = {\"symbol\":[\",\",\"\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"EUR\",\"currencySymbol\":\"\\u20ac\",\"numberSymbols\":[\",\",\"\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.00\\u00a0\\u00a4\",\"negativePattern\":\"-#,##0.00\\u00a0\\u00a4\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var host_mode = false;
var number_specifications = {\"symbol\":[\",\",\"\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"numberSymbols\":[\",\",\"\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var prestashop = {\"debug\":false};
var show_new_customers = \"1\";
var show_new_messages = false;
var show_new_orders = \"1\";
</script>
<script type=\"text/javascript\" src=\"/prestarecup/adminlws/themes/new-theme/public/main.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/js/jquery/plugins/jquery.chosen.js\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/js/jquery/plugins/fancybox/jquery.fancybox.js\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/js/admin.js?v=1.7.7.1\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/adminlws/themes/new-theme/public/cldr.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/js/tools.js?v=1.7.7.1\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/adminlws/public/bundle.js\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/js/vendor/d3.v3.min.js\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/adminlws/themes/default/js/vendor/nv.d3.min.js\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/modules/tntofficiel/views/js/q0y640/global.js\"></script>
<script type=\"text/javascript\" src=\"/prestarecup/modules/amzpayments/views/js/admin_17.js\"></script>

  

";
        // line 87
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>

<body
  class=\"lang-fr adminproducts\"
  data-base-url=\"/prestarecup/adminlws/index.php\"  data-token=\"t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminDashboard&amp;token=1537f1746571fa8904f14fdbb7da89dd\"></a>
      <span id=\"shop_version\">1.7.7.1</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Accès rapide
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\"
         href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminOrders&amp;token=09ea5642bc3995bdb592087fcaf69867\"
                 data-item=\"Commandes\"
      >Commandes</a>
          <a class=\"dropdown-item\"
         href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=368ba516d9d1d218f3023c11b50a0718\"
                 data-item=\"Évaluation du catalogue\"
      >Évaluation du catalogue</a>
          <a class=\"dropdown-item\"
         href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php/improve/modules/manage?token=30abca7df144a006330954c28d2c2699\"
                 data-item=\"Modules installés\"
      >Modules installés</a>
          <a class=\"dropdown-item\"
         href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=20c06921858ca78961bef34c76c1257a\"
                 data-item=\"Nouveau bon de réduction\"
      >Nouveau bon de réduction</a>
          <a class=\"dropdown-item\"
         href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php/sell/catalog/products/new?token=30abca7df144a006330954c28d2c2699\"
                 data-item=\"Nouveau produit\"
      >Nouveau produit</a>
          <a class=\"dropdown-item\"
         href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminCategories&amp;addcategory&amp;token=e5fb0b07fc42d461d84a6ea95d5f3752\"
                 data-item=\"Nouvelle catégorie\"
      >Nouvelle catégorie</a>
        <div class=\"dropdown-divider\"></div>
          <a
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"83\"
        data-icon=\"icon-AdminCatalog\"
        data-method=\"add\"
        data-url=\"index.php/sell/catalog/products\"
        data-post-link=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminQuickAccesses&token=e909d1bef35f8d2233daa3fa8361eb0a\"
        data-prompt-text=\"Veuillez nommer ce raccourci :\"
        data-link=\"Produits - Liste\"
      >
        <i class=\"material-icons\">add_circle</i>
        Ajouter la page actuelle à l'accès rapide
      </a>
        <a class=\"dropdown-item\" href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminQuickAccesses&token=e909d1bef35f8d2233daa3fa8361eb0a\">
      <i class=\"material-icons\">settings</i>
      Gérez vos accès rapides
    </a>
  </div>
</div>
      </div>
      <div class=\"component\" id=\"header-search-container\">
        <form id=\"header_search\"
      class=\"bo_search_form dropdown-form js-dropdown-form collapsed\"
      method=\"post\"
      action=\"/prestarecup/adminlws/index.php?controller=AdminSearch&amp;token=253db910e92b67db1c79885cfee32812\"
      role=\"search\">
  <input type=\"hidden\" name=\"bo_search_type\" id=\"bo_search_type\" class=\"js-search-type\" />
    <div class=\"input-group\">
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Rechercher (ex. : référence produit, nom du client, etc.) d='Admin.Navigation.Header'\">
    <div class=\"input-group-append\">
      <button type=\"button\" class=\"btn btn-outline-secondary dropdown-toggle js-dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        Partout
      </button>
      <div class=\"dropdown-menu js-items-list\">
        <a class=\"dropdown-item\" data-item=\"Partout\" href=\"#\" data-value=\"0\" data-placeholder=\"Que souhaitez-vous trouver ?\" data-icon=\"icon-search\"><i class=\"material-icons\">search</i> Partout</a>
        <div class=\"dropdown-divider\"></div>
        <a class=\"dropdown-item\" data-item=\"Catalogue\" href=\"#\" data-value=\"1\" data-placeholder=\"Nom du produit, référence, etc.\" data-icon=\"icon-book\"><i class=\"material-icons\">store_mall_directory</i> Catalogue</a>
        <a class=\"dropdown-item\" data-item=\"Clients par nom\" href=\"#\" data-value=\"2\" data-placeholder=\"Nom\" data-icon=\"icon-group\"><i class=\"material-icons\">group</i> Clients par nom</a>
        <a class=\"dropdown-item\" data-item=\"Clients par adresse IP\" href=\"#\" data-value=\"6\" data-placeholder=\"123.45.67.89\" data-icon=\"icon-desktop\"><i class=\"material-icons\">desktop_mac</i> Clients par adresse IP</a>
        <a class=\"dropdown-item\" data-item=\"Commandes\" href=\"#\" data-value=\"3\" data-placeholder=\"ID commande\" data-icon=\"icon-credit-card\"><i class=\"material-icons\">shopping_basket</i> Commandes</a>
        <a class=\"dropdown-item\" data-item=\"Factures\" href=\"#\" data-value=\"4\" data-placeholder=\"Numéro de facture\" data-icon=\"icon-book\"><i class=\"material-icons\">book</i> Factures</a>
        <a class=\"dropdown-item\" data-item=\"Paniers\" href=\"#\" data-value=\"5\" data-placeholder=\"ID panier\" data-icon=\"icon-shopping-cart\"><i class=\"material-icons\">shopping_cart</i> Paniers</a>
        <a class=\"dropdown-item\" data-item=\"Modules\" href=\"#\" data-value=\"7\" data-placeholder=\"Nom du module\" data-icon=\"icon-puzzle-piece\"><i class=\"material-icons\">extension</i> Modules</a>
      </div>
      <button class=\"btn btn-primary\" type=\"submit\"><span class=\"d-none\">RECHERCHE</span><i class=\"material-icons\">search</i></button>
    </div>
  </div>
</form>

<script type=\"text/javascript\">
 \$(document).ready(function(){
    \$('#bo_query').one('click', function() {
    \$(this).closest('form').removeClass('collapsed');
  });
});
</script>
      </div>

      
      
      <div class=\"component\" id=\"header-shop-list-container\">
          <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"http://vincentabxy.fr/prestarecup/\" target= \"_blank\">
      <i class=\"material-icons\">visibility</i>
      Voir ma boutique
    </a>
  </div>
      </div>

              <div class=\"component header-right-component\" id=\"header-notifications-container\">
          <div id=\"notif\" class=\"notification-center dropdown dropdown-clickable\">
  <button class=\"btn notification js-notification dropdown-toggle\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">notifications_none</i>
    <span id=\"notifications-total\" class=\"count hide\">0</span>
  </button>
  <div class=\"dropdown-menu dropdown-menu-right js-notifs_dropdown\">
    <div class=\"notifications\">
      <ul class=\"nav nav-tabs\" role=\"tablist\">
                          <li class=\"nav-item\">
            <a
              class=\"nav-link active\"
              id=\"orders-tab\"
              data-toggle=\"tab\"
              data-type=\"order\"
              href=\"#orders-notifications\"
              role=\"tab\"
            >
              Commandes<span id=\"_nb_new_orders_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"customers-tab\"
              data-toggle=\"tab\"
              data-type=\"customer\"
              href=\"#customers-notifications\"
              role=\"tab\"
            >
              Clients<span id=\"_nb_new_customers_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"messages-tab\"
              data-toggle=\"tab\"
              data-type=\"customer_message\"
              href=\"#messages-notifications\"
              role=\"tab\"
            >
              Messages<span id=\"_nb_new_messages_\"></span>
            </a>
          </li>
                        </ul>

      <!-- Tab panes -->
      <div class=\"tab-content\">
                          <div class=\"tab-pane active empty\" id=\"orders-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Pas de nouvelle commande pour le moment :(<br>
              Et pourquoi pas lancer des promotions de saison ?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Aucun nouveau client pour l'instant :(<br>
              Avez-vous pensé à vendre sur les places de marché ?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"messages-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Pas de nouveau message pour l'instant.<br>
              Pas de nouvelle, bonne nouvelle, n'est-ce pas ?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                        </div>
    </div>
  </div>
</div>

  <script type=\"text/html\" id=\"order-notification-template\">
    <a class=\"notif\" href='order_url'>
      #_id_order_ -
      de <strong>_customer_name_</strong> (_iso_code_)_carrier_
      <strong class=\"float-sm-right\">_total_paid_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"customer-notification-template\">
    <a class=\"notif\" href='customer_url'>
      #_id_customer_ - <strong>_customer_name_</strong>_company_ - enregistré le <strong>_date_add_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"message-notification-template\">
    <a class=\"notif\" href='message_url'>
    <span class=\"message-notification-status _status_\">
      <i class=\"material-icons\">fiber_manual_record</i> _status_
    </span>
      - <strong>_customer_name_</strong> (_company_) - <i class=\"material-icons\">access_time</i> _date_add_
    </a>
  </script>
        </div>
      
      <div class=\"component\" id=\"header-employee-container\">
        <div class=\"dropdown employee-dropdown\">
  <div class=\"rounded-circle person\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">account_circle</i>
  </div>
  <div class=\"dropdown-menu dropdown-menu-right\">
    <div class=\"employee-wrapper-avatar\">
      
      <span class=\"employee_avatar\"><img class=\"avatar rounded-circle\" src=\"http://profile.prestashop.com/vincent.witczak%40gmail.com.jpg\" /></span>
      <span class=\"employee_profile\">Ravi de vous revoir ADMIN</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/prestarecup/adminlws/index.php/configure/advanced/employees/1/edit?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\">
      <i class=\"material-icons\">settings</i>
      Votre profil
    </a>
    </div>
    
    <p class=\"divider\"></p>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/fr/ressources/documentation?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=resources-fr&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">book</i> Documentation</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/fr/formation?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=resources-fr&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">school</i> Formation</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/fr/experts?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=resources-fr&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">person_pin_circle</i> Trouver un expert</a>
    <a class=\"dropdown-item\" href=\"https://addons.prestashop.com/fr/?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=addons-fr&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">extension</i> Place de marché de PrestaShop</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/fr/contact?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=resources-fr&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">help</i> Centre d'assistance</a>
    <p class=\"divider\"></p>
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminLogin&amp;logout=1&amp;token=00b0dddc4d734f8356db9ea1fc68c33f\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Déconnexion</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/prestarecup/adminlws/index.php/configure/advanced/employees/toggle-navigation?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
    <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone \" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminDashboard&amp;token=1537f1746571fa8904f14fdbb7da89dd\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Tableau de Bord</span>
              </a>
            </li>

          
                      
                                          
                    
          
            <li class=\"category-title -active\" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Vendre</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/prestarecup/adminlws/index.php/sell/orders/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\">
                      <i class=\"material-icons mi-shopping_basket\">shopping_basket</i>
                      <span>
                      Commandes
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-3\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"4\" id=\"subtab-AdminOrders\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/orders/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Commandes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/orders/invoices/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Factures
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/orders/credit-slips/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Avoirs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/orders/delivery-slips/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Bons de livraison
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminCarts&amp;token=ac582844674f1e46052df1ed9491fdd6\" class=\"link\"> Paniers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"129\" id=\"subtab-AdminMondialRelay\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminMondialRelay&amp;token=0bf4335222324430b93d3d719179bfd2\" class=\"link\"> Mondial Relay
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"174\" id=\"subtab-AdminTNTOrders\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminTNTOrders&amp;token=3c371314ba71e44df66326240a9de3fa\" class=\"link\"> TNT
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu -active open ul-open\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/prestarecup/adminlws/index.php/sell/catalog/products?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Catalogue
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-9\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo -active\" data-submenu=\"10\" id=\"subtab-AdminProducts\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/catalog/products?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Produits
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/catalog/categories?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Catégories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/catalog/monitoring/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Suivi
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminAttributesGroups&amp;token=0db6abc30cbe0616f76ad132c21a399b\" class=\"link\"> Attributs &amp; caractéristiques
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/catalog/brands/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Marques et fournisseurs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/attachments/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Documents joints
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminCartRules&amp;token=20c06921858ca78961bef34c76c1257a\" class=\"link\"> Promotions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"118\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/stocks/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Stock
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"23\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/prestarecup/adminlws/index.php/sell/customers/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\">
                      <i class=\"material-icons mi-account_circle\">account_circle</i>
                      <span>
                      Clients
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-23\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"24\" id=\"subtab-AdminCustomers\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/customers/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Clients
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"25\" id=\"subtab-AdminAddresses\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/addresses/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Adresses
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"26\" id=\"subtab-AdminOutstanding\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminOutstanding&amp;token=87dd2468a364f48a8906095907dfc9a9\" class=\"link\"> Encours
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"27\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminCustomerThreads&amp;token=a7b1866cc600ce8f0421488fa8f5cd9c\" class=\"link\">
                      <i class=\"material-icons mi-chat\">chat</i>
                      <span>
                      Service client
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-27\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"28\" id=\"subtab-AdminCustomerThreads\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminCustomerThreads&amp;token=a7b1866cc600ce8f0421488fa8f5cd9c\" class=\"link\"> Service client
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"29\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/prestarecup/adminlws/index.php/sell/customer-service/order-messages/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Messages prédéfinis
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"30\" id=\"subtab-AdminReturn\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminReturn&amp;token=9224bd3c3d203aac6b0150d80540f0d2\" class=\"link\"> Retours produits
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"31\" id=\"subtab-AdminStats\">
                    <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminStats&amp;token=368ba516d9d1d218f3023c11b50a0718\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Statistiques
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                                            
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"41\" id=\"tab-IMPROVE\">
                <span class=\"title\">Personnaliser</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"42\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/prestarecup/adminlws/index.php/improve/modules/manage?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Modules
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-42\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"43\" id=\"subtab-AdminModulesSf\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/modules/manage?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Gestionnaire de modules
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"135\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/modules/catalog?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Catalogue de modules
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"46\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/prestarecup/adminlws/index.php/improve/design/themes/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\">
                      <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                      <span>
                      Apparence
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-46\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"47\" id=\"subtab-AdminThemes\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/design/themes/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Thème et logo
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"48\" id=\"subtab-AdminThemesCatalog\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/design/themes-catalog/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Catalogue de thèmes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"182\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/design/mail_theme/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Email Themes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"49\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/design/cms-pages/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"50\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/design/modules/positions/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"51\" id=\"subtab-AdminImages\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminImages&amp;token=3408564a525d6a9ac780dea4c16255e3\" class=\"link\"> Images
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"116\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/prestarecup/adminlws/index.php/modules/link-widget/list?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Link Widget
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"52\" id=\"subtab-AdminParentShipping\">
                    <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminCarriers&amp;token=73d776678f31a206618111d3bd76aac7\" class=\"link\">
                      <i class=\"material-icons mi-local_shipping\">local_shipping</i>
                      <span>
                      Transport
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-52\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"53\" id=\"subtab-AdminCarriers\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminCarriers&amp;token=73d776678f31a206618111d3bd76aac7\" class=\"link\"> Transporteurs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"54\" id=\"subtab-AdminShipping\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/shipping/preferences?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Préférences
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"131\" id=\"subtab-AdminImportChronopost\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminImportChronopost&amp;token=6df2e3e16f5c4296fced96e11d0e7763\" class=\"link\"> Import Chronopost
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"132\" id=\"subtab-AdminExportChronopost\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminExportChronopost&amp;token=dde8b69f1bb3632a587450b817ea3e3b\" class=\"link\"> Export Chronopost
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"133\" id=\"subtab-AdminBordereauChronopost\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminBordereauChronopost&amp;token=95d40e09a21a8c78e916b87dc3fd9fb1\" class=\"link\"> Bordereau de fin de journée
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"175\" id=\"subtab-AdminTNTSetting\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminAccountSetting&amp;token=81e687446dad93917a96d5f1c531f3f3\" class=\"link\"> TNT
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"55\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/prestarecup/adminlws/index.php/improve/payment/payment_methods?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\">
                      <i class=\"material-icons mi-payment\">payment</i>
                      <span>
                      Paiement
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-55\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"56\" id=\"subtab-AdminPayment\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/payment/payment_methods?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Modes de paiement
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"57\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/payment/preferences?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Préférences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"58\" id=\"subtab-AdminInternational\">
                    <a href=\"/prestarecup/adminlws/index.php/improve/international/localization/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\">
                      <i class=\"material-icons mi-language\">language</i>
                      <span>
                      International
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-58\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"59\" id=\"subtab-AdminParentLocalization\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/international/localization/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Localisation
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"64\" id=\"subtab-AdminParentCountries\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminCountries&amp;token=e8ff88145c6a65bb4ca9fbdaed9d9d8d\" class=\"link\"> Zones géographiques
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"68\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/international/taxes/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Taxes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"71\" id=\"subtab-AdminTranslations\">
                                <a href=\"/prestarecup/adminlws/index.php/improve/international/translations/settings?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Traductions
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"72\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configurer</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"73\" id=\"subtab-ShopParameters\">
                    <a href=\"/prestarecup/adminlws/index.php/configure/shop/preferences/preferences?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Paramètres de la boutique
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-73\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"74\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/shop/preferences/preferences?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Général
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"77\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/shop/order-preferences/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Commandes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"80\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/shop/product-preferences/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Produits
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"81\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/shop/customer-preferences/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Clients
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"85\" id=\"subtab-AdminParentStores\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/shop/contacts/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Contact
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"88\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/shop/seo-urls/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Trafic et SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"92\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminSearchConf&amp;token=b1beba97100a24b284d780d9d046f555\" class=\"link\"> Recherche
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"95\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/prestarecup/adminlws/index.php/configure/advanced/system-information/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\">
                      <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                      <span>
                      Paramètres avancés
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-95\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"96\" id=\"subtab-AdminInformation\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/advanced/system-information/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Informations
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"97\" id=\"subtab-AdminPerformance\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/advanced/performance/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Performances
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"98\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/advanced/administration/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"99\" id=\"subtab-AdminEmails\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/advanced/emails/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Emails
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"100\" id=\"subtab-AdminImport\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/advanced/import/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Importer
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"101\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/advanced/employees/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Équipe
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"105\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/advanced/sql-requests/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Base de données
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"108\" id=\"subtab-AdminLogs\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/advanced/logs/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Log
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"109\" id=\"subtab-AdminWebservice\">
                                <a href=\"/prestarecup/adminlws/index.php/configure/advanced/webservice-keys/?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" class=\"link\"> Service web
                                </a>
                              </li>

                                                                                                                                                                                          </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"113\" id=\"tab-DEFAULT\">
                <span class=\"title\">Autres</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"117\" id=\"subtab-AdminSelfUpgrade\">
                    <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminSelfUpgrade&amp;token=4da1df950fa8af0ee22de96fe408c38b\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      1-Click Upgrade
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"151\" id=\"tab-AdminPayPlug\">
                <span class=\"title\">PayPlug</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"152\" id=\"subtab-AdminPayPlugInstallment\">
                    <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminPayPlugInstallment&amp;token=90128959b7c4072cd9bdcf5aefb8481b\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Paiements en plusieurs fois
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                              
          
                  </ul>
  </div>
  
</nav>

<div id=\"main-div\">
          
<div class=\"header-toolbar d-print-none\">
  <div class=\"container-fluid\">

    
      <nav aria-label=\"Breadcrumb\">
        <ol class=\"breadcrumb\">
                      <li class=\"breadcrumb-item\">Catalogue</li>
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/prestarecup/adminlws/index.php/sell/catalog/products?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\" aria-current=\"page\">Produits</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            Produits          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                                                          <a
                  class=\"btn btn-primary  pointer\"                  id=\"page-header-desc-configuration-add\"
                  href=\"/prestarecup/adminlws/index.php/sell/catalog/products/new?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\"                  title=\"Créer un nouveau produit : CTRL+P\"                  data-toggle=\"pstooltip\"
                  data-placement=\"bottom\"                >
                  <i class=\"material-icons\">add_circle_outline</i>                  Nouveau produit
                </a>
                                      
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Aide\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/prestarecup/adminlws/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Ffr%252Fdoc%252FAdminProducts%253Fversion%253D1.7.7.1%2526country%253Dfr/Aide?_token=t4HNq8lxciH2NsFFY5ZelsfDIdiMgoo_y3392sOx0WA\"
                   id=\"product_form_open_help\"
                >
                  Aide
                </a>
                                    </div>
        </div>
      
    </div>
  </div>

  
    
</div>
      
      <div class=\"content-div  \">

        

                                                        
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  ";
        // line 1169
        $this->displayBlock('content_header', $context, $blocks);
        // line 1170
        echo "                 ";
        $this->displayBlock('content', $context, $blocks);
        // line 1171
        echo "                 ";
        $this->displayBlock('content_footer', $context, $blocks);
        // line 1172
        echo "                 ";
        $this->displayBlock('sidebar_right', $context, $blocks);
        // line 1173
        echo "
            
          </div>
        </div>

      </div>
    </div>

  <div id=\"non-responsive\" class=\"js-non-responsive\">
  <h1>Oh non !</h1>
  <p class=\"mt-3\">
    La version mobile de cette page n'est pas encore disponible.
  </p>
  <p class=\"mt-2\">
    En attendant que cette page soit adaptée au mobile, vous êtes invité à la consulter sur ordinateur.
  </p>
  <p class=\"mt-2\">
    Merci.
  </p>
  <a href=\"http://vincentabxy.fr/prestarecup/adminlws/index.php?controller=AdminDashboard&amp;token=1537f1746571fa8904f14fdbb7da89dd\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons\">arrow_back</i>
    Précédent
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    
</div>
  

      <div class=\"bootstrap\">
      <div class=\"modal fade\" id=\"modal_addons_connect\" tabindex=\"-1\">
\t<div class=\"modal-dialog modal-md\">
\t\t<div class=\"modal-content\">
\t\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\"><i class=\"icon-puzzle-piece\"></i> <a target=\"_blank\" href=\"https://addons.prestashop.com/?utm_source=back-office&utm_medium=modules&utm_campaign=back-office-FR&utm_content=download\">PrestaShop Addons</a></h4>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t<!--start addons login-->
\t\t\t<form id=\"addons_login_form\" method=\"post\" >
\t\t\t\t<div>
\t\t\t\t\t<a href=\"https://addons.prestashop.com/fr/login?email=vincent.witczak%40gmail.com&amp;firstname=ADMIN&amp;lastname=ADMIN&amp;website=http%3A%2F%2Fvincentabxy.fr%2Fprestarecup%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-FR&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/prestarecup/adminlws/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
\t\t\t\t\t<h3 class=\"text-center\">Connectez-vous à la place de marché de PrestaShop afin d'importer automatiquement tous vos achats.</h3>
\t\t\t\t\t<hr />
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<h4>Vous n'avez pas de compte ?</h4>
\t\t\t\t\t\t<p class='text-justify'>Les clés pour réussir votre boutique sont sur PrestaShop Addons ! Découvrez sur la place de marché officielle de PrestaShop plus de 3 500 modules et thèmes pour augmenter votre trafic, optimiser vos conversions, fidéliser vos clients et vous faciliter l’e-commerce.</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<h4>Connectez-vous à PrestaShop Addons</h4>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-user\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"username_addons\" name=\"username_addons\" type=\"text\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-key\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"password_addons\" name=\"password_addons\" type=\"password\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<a class=\"btn btn-link float-right _blank\" href=\"//addons.prestashop.com/fr/forgot-your-password\">Mot de passe oublié</a>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"row row-padding-top\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/fr/login?email=vincent.witczak%40gmail.com&amp;firstname=ADMIN&amp;lastname=ADMIN&amp;website=http%3A%2F%2Fvincentabxy.fr%2Fprestarecup%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-FR&amp;utm_content=download#createnow\">
\t\t\t\t\t\t\t\tCréer un compte
\t\t\t\t\t\t\t\t<i class=\"icon-external-link\"></i>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<button id=\"addons_login_button\" class=\"btn btn-primary btn-block btn-lg\" type=\"submit\">
\t\t\t\t\t\t\t\t<i class=\"icon-unlock\"></i> Connexion
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"addons_loading\" class=\"help-block\"></div>

\t\t\t</form>
\t\t\t<!--end addons login-->
\t\t\t</div>


\t\t\t\t\t</div>
\t</div>
</div>

    </div>
  
";
        // line 1280
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>
</html>";
    }

    // line 87
    public function block_stylesheets($context, array $blocks = [])
    {
    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
    }

    // line 1169
    public function block_content_header($context, array $blocks = [])
    {
    }

    // line 1170
    public function block_content($context, array $blocks = [])
    {
    }

    // line 1171
    public function block_content_footer($context, array $blocks = [])
    {
    }

    // line 1172
    public function block_sidebar_right($context, array $blocks = [])
    {
    }

    // line 1280
    public function block_javascripts($context, array $blocks = [])
    {
    }

    public function block_extra_javascripts($context, array $blocks = [])
    {
    }

    public function block_translate_javascripts($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "__string_template__e13801e280a3454b8197ecea0f321768fd250abecb87be973ec5c7343da7a86e";
    }

    public function getDebugInfo()
    {
        return array (  1370 => 1280,  1365 => 1172,  1360 => 1171,  1355 => 1170,  1350 => 1169,  1341 => 87,  1333 => 1280,  1224 => 1173,  1221 => 1172,  1218 => 1171,  1215 => 1170,  1213 => 1169,  127 => 87,  39 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__e13801e280a3454b8197ecea0f321768fd250abecb87be973ec5c7343da7a86e", "");
    }
}
