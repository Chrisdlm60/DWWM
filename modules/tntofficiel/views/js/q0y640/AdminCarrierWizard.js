/**
 * TNT OFFICIAL MODULE FOR PRESTASHOP.
 *
 * @author    GFI Informatique <www.gfi.world>
 * @copyright 2016-2020 GFI Informatique, 2016-2020 TNT
 * @license   https://opensource.org/licenses/MIT MIT License
 */

// On DOM Ready.
window.document.addEventListener('DOMContentLoaded', function () {

    var $TNTCarrierShopAssoCheckBox = jQuery('body.admincarrierwizard #step_carrier_shops #shop-tree input:checkbox:not(:checked)');
    if ($TNTCarrierShopAssoCheckBox.length > 0) {
        // Get current carrier ID edited in wizard.
        var intCarrierID = jQuery('#id_carrier').val() | 0;
        // If ID is a TNT carrier.
        if (intCarrierID in window.TNTOfficiel.carrier.list) {
            // Disabling Shop Asso checkbox.
            $TNTCarrierShopAssoCheckBox.prop('disabled', true);
        }
    }

});