




# CHANGELOG




## 1.0.1 le 2018-11-20

- `#6660` Suppression des surcharges et sélection du contexte pour une commande TNT (BOOM-4050 et BOOM-5821).
- `#6737` Affichage du 1er numéro de suivi dans le champ "Numéro de suivi" et dans une nouvelle colonne dans la liste des colis (BO).
- `#6738` Amélioration de la gestion du cache (erreurs si le cache est mal installé comme l'extension APCu).
- `#6700` Ajout d'une constante pour le statut permettant de déclencher la création d'expédition.
- `#6739` Désactivation des checkbox pour la sélection des boutiques dans les transporteurs TNT de Prestashop.




## 1.0.2 le 2018-11-21

- `#6874` Poids maximum d'expédition pour DEPOT à 30kg pour ajouter un colis.
- `#6876` :
  - Prévenir les exceptions de BDD si les tables ne sont pas créées à l'installation.
  - Correction du sélecteur pour le format des BT (inversion avec et sans logo).
  - Le champ expéditeur société est limité à 32 caractères au lieu de 128 dans la configuration.
  - SOAP/cURL : Vérification du certificat serveur via le fichier cacert.pem de Prestashop.
- `#6892` MAJ de la documentation et amélioration de la compatibilité pour Prestashop 1.7.5.0.




## 1.0.3 le 2019-01-10

- `#6073` Actualisation automatique du lien de la preuve de livraison sur le détail d'une commande.
- `#5984` Actualisation automatique du statut de suivis des colis en back-office (nouvelle colonne sur la liste des colis).
- `#5984` Actualisation automatique du statut livré de la commande sur la page de commande et via action groupée sur la liste.
- `#6898` Statuts de commande optionnels pour la création d'expédition et la livraison des colis (via constantes).
- `#6913` Ajouter un lien de suivi de l'ensemble des colis pour une commande, disponible pour l'envoi de l'email dès le statut expédiée.
  - {tntofficiel_tracking_url_text} et {tntofficiel_tracking_url_html}
- `#6958` :
  - Amélioration de la création des transporteurs, pour les langues installées sur la boutique (champs delay).
  - Fix sur la méthode isPaymentReady (une erreur de typage).
  - Fix AdminCarrierSettingController->viewAccess (signature incomplète et méthode inutilisée) (compatibilité PHP7.2).
  - Fix Restauration du timeout de connection de sockets SOAP.
- `#7334` Configuration tarifaire : Impossible d'ajouter plus de 10 tranches. Le maximum est maintenant de 128 tranches.
- `#7335` Configuration tarifaire : Aide à la saisie avec auto-correction des virgules (,) en point (.), vérification directe du format des nombres et arrondis automatique.
- Ajout de l'Offre Essentiel.
- Suppression des fonts icon inutilisée.
- Prévenir les conflits PHP pour les pdf.




## 1.0.4 le 2019-05-27

- `#7493` Correction sans affichage de l'erreur si la date de ramassage est invalide (Action groupée, détail d'un commande).
- `#7498` Amélioration du pdf manifeste.




## 1.0.5 le 2019-06-20

- `#7587` Amélioration de la protection contre le downgrade.
- `#7425` Amélioration du suivi des colis.
- `#7631` Amélioration du suivi des colis (suite).
- `#7592` Mise en place des services P* (18h) sur les modules.




## 1.0.6 le 2019-11-27

- `#7653` Amélioration de la compatibilité avec les thèmes.
- `#7699` Fix : Pas de transporteurs affichés pour la destination 78882 ST QUENTIN EN YVELINES CEDEX.
- `#7650` TNECO-117 - BO - Actualisation du couple CP/Ville
- `#7842` Trim sur le code postal, ville, nom de société, etc.
- `#7863` Suppression des avertissements avec chmod.
- `#7864` Fix CSS sur les informations complémentaires en BO.
- `#7865` Corrections des appels avec addJS et addCSS.
- `#8136` MAJ URL ZDA et prise en charge de l'absence du certificat Prestashop pour les requêtes cURL.
- `#8127` Ajout des services ASSU et RP ASSU.




## 1.0.7 le 2019-12-23

- `#8197` Week-end du calendrier non sélectionnable pour la date de ramassage.
- `#8390` Prise en compte la livraison offerte globalement à partir de la configuration Prestashop.
- `#8350` Optimisation avec cache+ttl en BDD pour les appels au Webservice.
- `#8394` Prévenir les appels inutiles au webservice le week-end ou si la dates est passées (pickupdate, shippingdate).
- `#8395` Gestion des dépendances d'appels au webservice lors d'erreurs de communication.
- `#8396` Optimisation des timeouts des requêtes pour limiter l'effet gel si le webservice est en surcharge.
  - 'Error Fetching http headers', 'Service Temporarily Unavailable', 'Internal Server Error'.