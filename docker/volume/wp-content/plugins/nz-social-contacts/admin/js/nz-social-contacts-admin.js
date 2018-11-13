(function ($, _) {
    'use strict';

    $(document).ready(function () {
        NzSocialContacts.init();
    });

    var NzSocialContacts = {
        fieldTpl: null,
        $cf: null,
        fields: [],
        init: function () {
            this.fieldTpl = _.template($("script.fieldTpl").html());

            this.setElements();
            this.setEvents();

            var fieldsData = this.readJson(this.$cf.val(), []);
            console.log(fieldsData);

            this.buildForm(fieldsData);

        },
        setElements: function () {
            this.$saveForm = $('#social-contacts-save-form');
            this.$cf = $('#contacts-fields-input');

            this.$form = $('#contacts-fields-items');

            this.$cl = $('.contacts-list');
            this.$inputAdd = $('button.add');

        },
        setEvents: function () {
            var self = this;
            //add field
            this.$inputAdd.on('click', function (e) {
                self.addFormField();
            });

            //remove field
            this.$cl.on('click', 'button.remove', function (e) {
                e.preventDefault();
                var $this = $(this);
                var i = self.$cl.find('button.remove').index($this);
                $this.parent('.contact-item').remove();
                self.fields.splice(i, 1);

            });
            this.$cl.on('click', 'button.up', function (e) {
                e.preventDefault();
                var $this = $(this);
                var $parent = $this.parent('.contact-item');
                $parent.insertBefore($parent.prev());

            });

            //prevent submit fields form
            this.$form.on('submit', function (e) {
                e.preventDefault();
            });

            this.$saveForm.on('submit', function (e) {
                var arr = self.$form.serializeArray();

                var form = [], i, j, temparray, chunk = 5;
                for (i = 0, j = arr.length; i < j; i += chunk) {
                    temparray = arr.slice(i, i + chunk);
                    var o = {};
                    for (var x = 0; x < temparray.length; x++) {
                        o[temparray[x].name] = temparray[x].value;
                    }
                    form.push(o);
                }
                self.$cf.val(JSON.stringify(form));

            });

        },
        readJson: function (string, ret) {
            try {

                return JSON.parse(string);
            }
            catch (e) {
                return ret || {};
            }
        },
        addFormField: function (fieldData) {
            if (!fieldData) {

                var fieldData = {
                    link: 'link',
                    class: 'linkclass',
                    icon_class: 'iconclass',
                    icon_content: 'iconcontent',
                    detail: ''
                };
            }
            var fieldTplData = {
                field: fieldData,
                action: 'remove'
            };
            this.$cl.append(this.fieldTpl(fieldTplData));
            console.log('add field', fieldData);
        },
        buildForm: function (fieldsData) {

            if (!fieldsData) {
                //addPrototype
                this.addFormField();
            }

            //addFields
            for (var i = 0; i < fieldsData.length; i++) {
                this.addFormField(fieldsData[i]);

            }

        }
    };


})(jQuery, _);

