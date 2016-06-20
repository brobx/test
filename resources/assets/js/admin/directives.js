import Awesomplete from 'awesomplete';

module.exports = (Vue, options) => {
    Vue.directive('clean', {
        onSubmit() {
            $(':input', this).each(function () {
                this.disabled = !($(this).val());
            });
        },

        bind() {
            $(this.el).submit(this.onSubmit);
        },

        unbind() {
            $(this.el).unbind('submit', this.onSubmit)
        }
    });

    Vue.directive('slider', {
        params: ['step', 'min', 'max'],
        bind() {
            this.slider = $(this.el).slider({
                step: this.params.step,
                min: this.params.min,
                max: this.params.max,
                precision: 2,
                tooltip_position: 'bottom'
            });
        },

        unbind() {
            this.slider.destroy();
        }
    });

    Vue.directive('tinymce', {
        bind() {
            var self = this;
            $(this.el).tinymce({
                theme: 'modern',
                directionality: self.el.dir || 'ltr'
            });
        }
    });

    Vue.directive('disable-after-submit', {
        disableElement() {
            this.el.disabled = true;
            this.el.form.submit();
        },

        bind() {
            this.disableElement = this.disableElement.bind(this);
            this.el.addEventListener('click', this.disableElement);
        },

        unbind() {
            this.el.removeEventListener('click', this.disableElement);
        }
    });

    Vue.directive('star', {
        bind() {
            $(this.el).rating();
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
