<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>

    <script>
        document.addEventListener('alpine:init', () => {
            const addressInput = ({state, address}) => ({
                state,
                address,
                init: function () {
                    ((container, options, callback) => {

                        if(this.state !== null )
                            this.address = `${this.state.calle} ${this.state.numero}, ${this.state.localidad}, ${this.state.partido}`
                        console.log("container", container)
                        console.log(container.firstElementChild)
                        console.log("options", options)
                        console.log("callback", callback)
                        let autocomplete = new google.maps.places.Autocomplete(
                            container.firstElementChild,
                            {
                                componentRestrictions: { country: "ar" },
                            },
                        )
                        autocomplete.addListener('place_changed', () => {
                            let place = autocomplete.getPlace()

                            console.log("address_componentes", place.address_components)
                            let address = getAddresFromComponents(place.address_components, ['street_address'])
                            address.latitud = place.geometry.location.lat()
                            address.longitud = place.geometry.location.lng()
                            console.log("geometry", place.geometry.location.lat())
                            console.log("domicilio", address)
                            console.log("place", place)

                            return callback(address)
                        })
                    })(this.$el, {}, address => {
                        this.state = address
                        this.address = `${address.calle} ${address.numero}, ${address.localidad}, ${address.partido}`
                    })
                },
            })


            const getAddresFromComponents = (componentes, types, addressText) => {
                let streetNameAndNumber = {
                    calle: '',
                    numero: null
                };
                const isStreetAddress = types.some((x) => x === 'street_address');
                const isPremise = types.some((x) => x === 'premise');
                const isEstablishment = types.some((x) => x === 'establishment');
                if (isStreetAddress || isPremise) {
                    streetNameAndNumber = {
                        calle: buscarTipoEnComponente('route', componentes),
                        numero: buscarTipoEnComponente('street_number', componentes)
                    };
                }
                if (isEstablishment) {
                    streetNameAndNumber = {
                        calle:
                            buscarTipoEnComponente('establishment', componentes) ||
                            addressText.split(',')[0],
                        numero: null
                    };
                }
                if (!isStreetAddress && !isPremise && !isEstablishment) {
                    const matchedType = types
                        .map((type) => buscarTipoEnComponente(type, componentes))
                        .find((component) => component !== undefined);
                    streetNameAndNumber = {
                        calle: matchedType || addressText.split(',')[0],
                        numero: null
                    };
                }
                return {
                    ...streetNameAndNumber,
                    partido: buscarTipoEnComponente('administrative_area_level_2', componentes),
                    localidad:
                        buscarTipoEnComponente('locality', componentes) ||
                        buscarTipoEnComponente('sublocality', componentes),
                    provincia: buscarTipoEnComponente(
                        'administrative_area_level_1',
                        componentes
                    ),
                    pais: buscarTipoEnComponente('country', componentes),
                    codigoPostal: buscarTipoEnComponente('postal_code', componentes)

                };
            };

            const buscarTipoEnComponente = (tipo, componentes) => {
                return componentes.find((c) => c.types.includes(tipo))?.long_name;
            };

            Alpine.data('addressInputComponent', addressInput)
        })
    </script>
    <div
        x-data="addressInputComponent({
            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
            address: ''
        })"
    >

        <input
            type="text"
            wire:ignore
            x-model="address"
            {!! ($autocomplete = $getAutocomplete()) ? "autocomplete=\"{$autocomplete}\"" : null !!}
            {!! $isAutofocused() ? 'autofocus' : null !!}
            {!! $isDisabled() ? 'disabled' : null !!}
            id="{{ $getId() }}"
            {!! ($length = $getMaxLength()) ? "maxlength=\"{$length}\"" : null !!}
            {!! ($value = $getMaxValue()) ? "max=\"{$value}\"" : null !!}
            {!! ($length = $getMinLength()) ? "minlength=\"{$length}\"" : null !!}
            {!! ($value = $getMinValue()) ? "min=\"{$value}\"" : null !!}
            {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!}
            {!! $isRequired() ? 'required' : null !!}
            {{ $attributes->merge($getExtraAttributes())->class([
                'block w-full h-10 transition duration-75 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600',
                'border-gray-300' => ! $errors->has($getStatePath()),
                'border-danger-600 ring-danger-600' => $errors->has($getStatePath()),
            ]) }}
        />
        <input hidden x-model="state" />
    </div>

</x-forms::field-wrapper>

