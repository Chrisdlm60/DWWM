{**

 * 2007-2016 PrestaShop

 *

 * NOTICE OF LICENSE

 *

 * This source file is subject to the Open Software License (OSL 3.0)

 * that is bundled with this package in the file LICENSE.txt.

 * It is also available through the world-wide-web at this URL:

 * http://opensource.org/licenses/osl-3.0.php

 * If you did not receive a copy of the license and are unable to

 * obtain it through the world-wide-web, please send an email

 * to license@prestashop.com so we can send you a copy immediately.

 *

 * DISCLAIMER

 *

 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer

 * versions in the future. If you wish to customize PrestaShop for your

 * needs please refer to http://www.prestashop.com for more information.

 *

 * @author    PrestaShop SA <contact@prestashop.com>

 * @copyright 2007-2016 PrestaShop SA

 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)

 * International Registered Trademark & Property of PrestaShop SA

 *}

{extends file='page.tpl'}



{block name='page_title'}

  {l s='Vous avez un compte ? Vous pouvez vous connecter ici, ou en créer un' d='Shop.Theme.CustomerAccount'}

{/block}



{block name='page_content'}

    {block name='login_form_container'}

      <section class="login-form">

        {render file='customer/_partials/login-form.tpl' ui=$login_form}

      </section>

      <hr/>

      {block name='display_after_login_form'}

        {hook h='displayCustomerLoginFormAfter'}

      {/block}

      <div class="no-account">
<p>Pas de compte? Créez votre compte, Pour Professionnel :</p>
        <a href="{$urls.pages.register}" data-link-action="display-register-form">
         
          <span style="color: #4faee6; text-decoration: underline;">{l s='Créer mon compte' d='Shop.Theme.CustomerAccount'}</span>

        </a>

      </div>

    {/block}

{/block}

