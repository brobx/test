import Awesomplete from 'awesomplete';

module.exports = (Vue, options) => {
    // Slider Directive.
    Vue.directive('slider', {
        params: ['min', 'max', 'step', 'span-id', 'input-id', 'value', 'direction', 'units'],
        bind() {
            noUiSlider.create(this.el, {
                start: [ this.params.value || this.params.min ],
                step: this.params.step,
                range: {
                    'min': [  this.params.min ],
                    'max': [ this.params.max ]
                },
                direction: this.params.direction
            });

            const valueInput  = document.getElementById(this.params.inputId);
            const valueSpan  = document.getElementById(this.params.spanId);
            const self = this;
            this.el.noUiSlider.on('update', function( values, handle ) {
                if(valueInput) {
                    valueInput.value = values[handle];
                }

                if(valueSpan) {
                    const commaValue = self.addCommas(parseFloat(values[handle]));
                    if(self.params.units) {
                        valueSpan.innerHTML = `${commaValue} ${self.params.units}`;
                        return;
                    }

                    valueSpan.innerHTML = self.addCommas(parseFloat(values[handle]));
                }
            });
        },

        addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    });

    Vue.directive('selection-slider', {
        params: ['span-id', 'input-id', 'value', 'values'],

        bind() {
            var min = this.params.values[0];
            var max = this.params.values[this.params.values.length - 1];

            var range = {};

            for(var i = 0; i < this.params.values.length; i++) {
                var step = (i / (this.params.values.length - 1)) * 100;

                if(step == 0) {
                    step = "min";
                } else if(step == 100) {
                    step = "max";
                } else {
                    step += "%";
                }

                range[step] = this.params.values[i];
            }

            noUiSlider.create(this.el, {
                start: [ this.params.value || this.params.min ],
                snap: true,
                range
            });

            const valueInput  = document.getElementById(this.params.inputId);
            const valueSpan  = document.getElementById(this.params.spanId);

            this.el.noUiSlider.on('update', function( values, handle ) {
                if(valueInput) {
                    valueInput.value = values[handle];
                }

                if(valueSpan) {
                    valueSpan.innerHTML = parseFloat(values[handle]);
                }
            });
        }
    });

    Vue.directive('clean', {
        onSubmit() {
            $(':input', this).each(function() {
                const value = $(this).val();
                this.disabled = ! (value && parseFloat(value));
            });
        },

        bind() {
            $(this.el).submit(this.onSubmit);
        },

        unbind() {
            $(this.el).unbind('submit', this.onSubmit)
        }
    });

    Vue.directive('star', {
        params: ['displayOnly'],
        bind() {
            $(this.el).rating({ displayOnly: this.params.displayOnly || false, step: 1 });
        }
    });

    Vue.directive('date-picker', {
        bind() {
            $(this.el).datetimepicker({
                locale: 'en',
                format: 'DD-MM-YYYY'
            });
        },
        unbind() {
            $(this.el).data("DateTimePicker").destroy();
        }
    });

    Vue.directive('show-where', {
        params: ['field-name', 'where-value'],
        bind() {
            this.elSelector = $(this.el);
            const radio = this.isRadio();
            if(! radio) {
                $(`:input[name=${this.params.fieldName}]`).change(this.onChange.bind(this));
                this.onChange();
            }
            else {
                $(`:input[name='${this.params.fieldName}']`).change(this.onRadioChange.bind(this));
                this.onRadioChange();
            }
        },

        isRadio() {
            const input = $(`:input[name='${this.params.fieldName}']`);

            return input.length && input[0].type == "radio";
        },

        onRadioChange() {
            this.elSelector.toggleClass(
                'hidden',
                $(`:input[name='${this.params.fieldName}']:checked`).val() != this.params.whereValue
            );

            if(! this.elSelector.is(":visible")) {
                this.reset();
            }
        },

        onChange() {
            this.elSelector.toggleClass(
                'hidden',
                $(`:input[name=${this.params.fieldName}]`).val() != this.params.whereValue
            );

            if(! this.elSelector.is(":visible")) {
                this.reset();
            }
        },

        reset() {
            this.elSelector.find(":input[type=checkbox]").removeAttr('checked');
            this.elSelector.find(":input[type=text]").val('');
            this.elSelector.find("select").val('');
        }
    });

    Vue.directive('comma', {
        cloned: null,
        bind() {
            this.cloned = this.el.cloneNode();
            this.cloned.name = this.cloned.id = '';
            this.el.parentElement.appendChild(this.cloned);
            this.el.classList.add('hidden');
            this.cloned.value = this.addCommas(this.el.value);

            this.cloned.addEventListener('keyup', this.onKeyUp.bind(this));
        },

        onKeyUp() {
            var comma = /,/g;
            var value = this.el.value = this.cloned.value.replace(comma, '');
            this.cloned.value = this.addCommas(value);
        },

        addCommas(nStr) {
            nStr += '';
            var x = nStr.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    });

    // Auto completes international cities.
    Vue.directive('autocomplete', {
        params: ['apiKey'],
        awesomplete: null,
        bind() {
            this.awesomplete = new Awesomplete(this.el, {
                minChars: 2,
                autoFirst: true
            });

            this.el.addEventListener('keyup', this.onKeyUp.bind(this));
        },

        onKeyUp() {
            if(this.el.value <= 2) {
                return;
            }

            const url = `http://where.yahooapis.com/v1/places.q('*${this.el.value}*');count=10?`;
            const lang = window.location.pathname.split('/')[1] == 'en' ? 'en-US' : 'ar-EG';
            this.vm.$http.jsonp(url, { format: 'json', lang, appid: this.params.apiKey }).then(response => {
                this.awesomplete.list = response.data.places.place.map((place) => place.name + ", " + place.country);
            });
        }
    });
};
