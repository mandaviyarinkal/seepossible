/**
 * Custom_Newsletter
 */
define([
    'jquery',
    'mage/translate',
    'jquery/ui',
    'mage/mage'
], function ($, $t) {
    'use strict';

    $.widget('custom.Newsletter', {
        options: {
            defaultSelectors: {
                buttonClass:    '.actions .subscribe'
            }
        },

        /** @inheritdoc */
        _create: function () {
            this._bindSubmit();
        },

        /**
         * @private
         */
        _bindSubmit: function () {
            var self = this;

            this.element.on('submit', function (e) {
                e.preventDefault();
                if ($(this).validation('isValid')) {
                    self.submitAjaxForm($(this));
                }
            });
        },

        /**
         * Handler for the form 'submit' event
         *
         * @param {Object} form
         */
        submitAjaxForm: function (form) {
            var self = this;
            $.ajax({
                url: form.attr('action'),
                data: form.serialize(),
                type: 'post',
                dataType: 'json',
                showLoader: true,
                /** @inheritdoc */
                beforeSend: function () {
                    self.element.parent().find('.messages').remove();
                },
                success: function (response) {
                    if (response.error) {
                        self.element.after('<div class="messages"><div class="message message-error error"><div>'+response.message+'</div></div></div>');
                    } else {
                        self.element.find('input').val('');
                        self.element.after('<div class="messages"><div class="message message-success success"><div>'+response.message+'</div></div></div>');
                    }

                },
                error: function() {
                    self.element.after('<div class="messages"><div class="message message-error error"><div>'+$t('An error occurred, please try again later.')+'</div></div></div>');
                }
            }).done(function(){
               self.element.find(self.options.defaultSelectors.buttonClass).removeAttr('disabled');
          });;
        }
    });

    return $.custom.Newsletter;
});
