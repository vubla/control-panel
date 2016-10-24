	<div id="sidebar">
		<h1><?php _e('Tilmeld dig i fire nemme trin');?></h1>
		<ol class="steps">
			<li class="step1"><?php _e('Vælg din pakke.');?><br /><?php _e('(Hvis du ikke allerede har)');?></li>
			<li class="step2"><?php _e('Indtast dine personlige oplysninger.');?></li>
			<li class="step3"><?php _e('Vælg heks e-handel du bruger, og vælge en Vubla kodeord.');?></li>
			<li class="step4"><?php _e('Her har vi brug for dine faktureringsoplysninger. Bare rolig, du har din 30 dage gratis.');?></li>
		</ol>
		<h2><?php _e('Stadig svært?');?></h2>
		<p>
			<?php _e('Send en mail til vores support:');?><br />
			<a href="<?php echo VUBLA_BASE_URL ?>/contact.html">info@vubla.com</a>
		</p>
		
		<h3><?php _e('Ønsker du at tale med en virkelig person?');?></h3>
		<p>
			<?php _e('Vi forsøger at besvare dine spørgsmål, så snart vi kan. Kontakt vores support mellem  8-18 mandag - fredag.');?><br />
			<br />
			<img src="<?php echo VUBLA_BASE_URL ?>/images/phone.png" alt="" />
		</p>
	</div>
	
	
	<h1><?php _e('Tilmeld dig på Vubla');?></h1>
	<p>
		The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
	</p>
	<form id="registration-form" action="<?php echo LOGIN_URL.'/'; ?>" method="post">
		<div class="step step1">Step 1</div>
		<!--Pakke: <input type="radio" name="subscription" value="1" />
		<input type="radio" name="subscription" value="2" />
		<input type="radio" name="subscription" value="3" /><br />-->
		<div class="field">
			<label for="url">Din Webshop-URL:</label><input type="text" id="url" name="url" onblur="validate('url')" />
			<div name="url" class="validation"></div>
		</div>
		
		<div class="step step2">Step 2</div>
		<div class="field">
			<label for="name">Fulde Navn:</label><input type="text" id="name" name="name" onblur="validate('name')" />
			<div name="name" class="validation"></div>
		</div>
		
		<div class="field">
			<label for="company">Firma:</label><input type="text" id="company" name="company" onblur="validate('company')" />
			<div name="company" class="validation"></div>
		</div>
		<div class="field">
			<label for="email">Email:</label><input type="text" id="email" name="email" onblur="validate('email')" />
			<div name="email" class="validation"></div>
		</div>
		
		<div class="step step3">Step 3</div>
		<div class="field">
			<label for="phone">Telefon:</label><input type="text" id="phone" name="phone" onblur="validate('phone')" />
			<div name="phone" class="validation"></div>
		</div>
		<div class="field">
			<label for="address">Adresse:</label><input type="text" id="address" name="address" onblur="validate('address')" />
			<div name="address" class="validation"></div>
		</div>
		<div class="field">
			<label for="postal">Postnr:</label><input type="text" id="postal" name="postal" onblur="validate('postal')" />	<div name="postal" class="validation"></div>
			
			<label for="city">By:</label><input type="text" id="city" name="city" onblur="validate('city')" />
			<div name="city" class="validation"></div><br />
		</div>
		
		<div class="step step4">Step 4</div>
		<div class="field">
			<label for="password">Password:</label><input type="password" id="password" name="password" onblur="validate('password')" /><div name="password" class="validation"></div><br /><br />
			<input type="password" id="password2" name="password2" onblur="validate('password2')" />
			<div name="password2" class="validation"></div>
		</div>
		
		<input type="hidden" name="task" value="register" />
		<input type="hidden" name="controller" value="user" />
		
		<div id="submit-registration-box">
			<input type="submit" name="vubla_register <?php echo Language::get()->getIso() ?>" value="Send oplysninger" />
			
			<h2>Fortvivl ikke!</h2>
			<p>
				Selvfølgelig er vi ikke bruge dine oplysninger forkert, og du bliver nødt til at bruge Vubla gratis i 30 dage.
			</p>
		</div>
	</form>