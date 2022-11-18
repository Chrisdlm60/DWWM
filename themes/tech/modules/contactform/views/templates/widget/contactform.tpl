<section class="contact-form">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  <form action="{$urls.pages.contact}" method="post" {if $contact.allow_file_upload}enctype="multipart/form-data"{/if}>

    {if $notifications}
      <div class="col-xs-12 alert {if $notifications.nw_error}alert-danger{else}alert-success{/if}">
        <ul>
          {foreach $notifications.messages as $notif}
            <li>{$notif}</li>
          {/foreach}
        </ul>
      </div>
    {/if}

    {if !$notifications || $notifications.nw_error}
      <section class="form-fields">

        {if strpos($urls.current_url,'etablir-un-devis') == true || strpos($urls.current_url,'Dproduct') == true} 
          <h3>{l s="Devis"}</h3>
        {else}
          <div class="form-group row">
            <div class="col-md-9 col-md-offset-3">
              <h3>{l s='Contact us' d='Shop.Theme.Global'}</h3>
            </div>
          </div>
        {/if}

        <div class="form-group row">
          <label class="col-md-3 form-control-label">{l s='Subject' d='Shop.Forms.Labels'}</label>
          <div class="col-md-6">
            <select name="id_contact" class="form-control form-control-select">
              {foreach from=$contact.contacts item=contact_elt}
                <option value="{$contact_elt.id_contact}">{$contact_elt.name}</option>
              {/foreach}
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 form-control-label">{l s='Email address' d='Shop.Forms.Labels'}</label>
          <div class="col-md-6">
            <input
              class="form-control"
              name="from"
              type="email"
              value="{$contact.email}"
              placeholder="{l s='your@email.com' d='Shop.Forms.Help'}"
            >
          </div>
        </div>


      <div class="form-group row">
        <label class="col-md-3 form-control-label">{l s='Numéro de téléphone' d='Shop.Forms.Labels'}</label>
        {if isset($customerThread.telephone)}
          <div class="col-md-6">
          <input type="text" class="form-control" name="telephone" value="{$customerThread.telephone}" readonly="readonly" />
          </div>
        {else}
          <div class="col-md-6">
          <input type="text" class="form-control" name="telephone" value="{$telephone}" required /> 
          </div>
        {/if}
      </div>

      {** 
        Debut ajout champs sur la page "etablir-un-devis"
       *}
      {if strpos($urls.current_url,'purl') == true} 
        {if strpos($urls.current_url,'Dproduct') == true }

            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="Choix">Choisissez votre devis </label>
              <div class="col-md-6">
                
                <input type="button" class="btn btn-primary" name="choix" id="Sans" value="Sans" onclick="myFunction(this.value)">
                
                <input type="button" class="btn btn-primary" name="choix" id="Avec" value="Avec" onclick="myFunction(this.value)">
                <label for="avec">  installation</label>
              
              </div>
            </div>

            <script type="text/javascript">
              function myFunction(el)
              {

                if( el == 'Avec' ) {
                  $('div[id=cache]').show();
                } else {
                  $('div[id=cache]').hide();
                }
              }
                
            </script>

          
        {/if}
        
        {** 
          Societe 
        *}
          <div class="form-group row">
            <label class="col-md-3 form-control-label">{l s='Société' d='Shop.Forms.Labels'}</label>
            {if isset($customerThread.societe)}
              <div class="col-md-6">
              <input type="text" class="form-control" name="societe" value="{$contact.company}" readonly="readonly" />
              </div>
            {else}
              <div class="col-md-6">
              <input type="text" class="form-control" name="societe" value="{$societe}" required /> 
              </div>
            {/if}
          </div>

          {** 
            Adresse 
          *}
        <div class="form-group row">
          <label class="col-md-3 form-control-label">{l s='Adresse' d='Shop.Forms.Labels'}</label>
          {if isset($customerThread.adresse)}
            <div class="col-md-6">
            <input type="text" class="form-control" name="adresse" value="{$customerThread.adresse}" readonly="readonly" />
            </div>
          {else}
            <div class="col-md-6">
            <input type="text" class="form-control" name="adresse" value="{$adresse}" required /> 
            </div>
          {/if}
        </div>

        {if strpos($urls.current_url,'station-remix') == true || strpos($urls.current_url,'Station') == true}

          {** 
            Installation 
          *}
            <div class="form-group row">
              <label class="col-md-3 form-control-label">{l s='Installation sur :' d='Shop.Forms.Labels'}</label>
              
                <div class="col-md-6" >
                    <select class="form-control" name="installation">
                        <option>Choix...</option>
                        <option value="droit">Droit</option>
                        <option value="angle">Angle</option>
                    </select>
                </div>

            </div>
          
        {/if}
        {if strpos($urls.current_url,'Dproduct') == true}
          <div class="form-group row" id="cache" style='display:none;'>
              <label class="col-md-3 form-control-label">{l s='Installation sur :' d='Shop.Forms.Labels'}</label>
              
                <div class="col-md-6" >
                    <select class="form-control" name="installation">
                        <option selected>Choix...</option>
                        <option value="droit">Mur Droit</option>
                        <option value="droit">Angle mur</option>
                    </select>
                </div>

            </div>
        {/if}

         {** 
            Nombre de bouteilles 
          *}
          <div class="form-group row">
            <label class="col-md-3 form-control-label">{l s='Nombre de bouteilles' d='Shop.Forms.Labels'}</label>
              <div class="col-md-6">
              <input type="number" class="form-control" min="0" name="bouteille" value="{$bouteille}" required /> 
              </div>
          </div>

          {** 
            Nombre de saveurs 
            
          *}
          <div class="form-group row">
            <label class="col-md-3 form-control-label">{l s='Nombre de saveurs' d='Shop.Forms.Labels'}</label>
              <div class="col-md-6">
              <input type="number" class="form-control" min="0" name="saveurs" value="{$saveurs}" required /> 
              </div>
          </div>
      
      {/if} 

      {** 
        Fin ajout champs sur la page "etablir-un-devis"
       *}

          <div class="form-group row">
            <label class="col-md-3 form-control-label">{l s='Message' d='Shop.Forms.Labels'}</label>
            <div class="col-md-9">
              <textarea class="form-control" name="message" rows="10">
                {if $contact.message}
                    {$contact.message}
                {/if}
              </textarea>
            </div>
          </div>

        {if isset($id_module)}
          <div class="form-group row">
            <div class="offset-md-3">
              {hook h='displayGDPRConsent' id_module=$id_module}
            </div>
          </div>
        {/if}

      </section>

      <footer class="form-footer text-sm-right">
        
        <style>
          input[name=url] {
            display: none !important;
          }
        </style>
        <input type="text" name="url" value=""/>
        <input type="hidden" name="token" value="{$token}" />
        	{include file="../../../../../../../modules/slidecaptcha/views/templates/front/slidecaptcha.tpl"}
          {if strpos($urls.current_url,'station') == true || strpos($urls.current_url,'Dproduct') == true}
            <input class="btn btn-primary" type="submit" name="submitFull" value="{l s='Send devis' d='Shop.Theme.Actions'}">
          {/if}
          {if strpos($urls.current_url,'bouteille') == true}
            <input class="btn btn-primary" type="submit" name="submitDevis" value="{l s='Send devis' d='Shop.Theme.Actions'}">
          {/if}
          {if strpos($urls.current_url,'purl') == false}
            <input class="btn btn-primary" type="submit" name="submitMessage" value="{l s='Send' d='Shop.Theme.Actions'}">
          {/if}*
          <br>
          <small>* Il se peut que le mail envoyé soit considéré comme indésirable</small>
      </footer>


    {/if}

  </form>
  
</section>
  