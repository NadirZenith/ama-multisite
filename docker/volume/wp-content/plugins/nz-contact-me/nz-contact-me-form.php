
<form name="sentMessage" id="contactForm" novalidate>
    <div class="row control-group">
        <div class="form-group col-xs-12 floating-label-form-group controls">
            <label><?php _e('Name', 'nz-contact-me')?></label>
            <input type="text" class="form-control" placeholder="<?php _e('Name', 'nz-contact-me')?>" id="name" required data-validation-required-message="<?php _e('Please enter your name.', 'nz-contact-me')?>">
            <p class="help-block text-danger"></p>
        </div>
    </div>
    <div class="row control-group">
        <div class="form-group col-xs-12 floating-label-form-group controls">
            <label><?php _e('Email Address', 'nz-contact-me')?></label>
            <input type="email" class="form-control" placeholder="<?php _e('Email Address', 'nz-contact-me')?>" id="email" required data-validation-required-message="<?php _e('Please enter your email address.', 'nz-contact-me')?>">
            <p class="help-block text-danger"></p>
        </div>
    </div>
    <?php if (!empty(get_option('nz_contact_me_use_phone'))) : ?>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label><?php _e('Phone Number', 'nz-contact-me')?></label>
                <input type="tel" class="form-control" placeholder="<?php _e('Phone Number', 'nz-contact-me')?>" id="phone" required data-validation-required-message="<?php _e('Please enter your phone number.', 'nz-contact-me')?>">
                <p class="help-block text-danger"></p>
            </div>
        </div>
    <?php endif; ?>
    <div class="row control-group">
        <div class="form-group col-xs-12 floating-label-form-group controls">
            <label><?php _e('Message', 'nz-contact-me')?></label>
            <textarea rows="5" class="form-control" placeholder="<?php _e('Message', 'nz-contact-me')?>" id="message" required data-validation-required-message="<?php _e('Please enter a message.', 'nz-contact-me')?>"></textarea>
            <p class="help-block text-danger"></p>
        </div>
    </div>
    <br>
    <div id="success"></div>
    <div class="row">
        <div class="form-group col-xs-12">
            <button type="submit" class="btn btn-primary"><?php _e('Send', 'nz-contact-me')?></button>
        </div>
    </div>
</form>     