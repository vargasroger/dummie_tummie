<template>
    <div class="form-group form-group-progress">
        <label :for="id">{{label}}</label>

        <div class="input-group">
            <input
                    v-model="password"
                    :type="inputType"
                    :ref="referenceValue"
                    class="form-control"
                    :name="name"
                    :id="id"
                    :placeholder="placeholder"
                    :required="required"
                    :disabled="disabled"
                    :minlength="secureLength"
                    v-bind:value="value"
                    @input="evt => emitValue('input', evt.target.value)"
                    @blur="evt => emitValue('blur', evt.target.value)"
                    @focus="evt => emitValue('focus', evt.target.value)"
            >

            <div class="input-group-append" @click.prevent="togglePassword()">
                <span class="input-group-text">
                    <svg v-if="this.$data._showPassword" version="1.1" xmlns="http://www.w3.org/2000/svg" width="21"
                         height="21" viewBox="0 0 24 24">
                        <title>{{showPasswordLabel}}</title>
                        <path d="M12 9c1.641 0 3 1.359 3 3s-1.359 3-3 3-3-1.359-3-3 1.359-3 3-3zM12 17.016c2.766 0 5.016-2.25 5.016-5.016s-2.25-5.016-5.016-5.016-5.016 2.25-5.016 5.016 2.25 5.016 5.016 5.016zM12 4.5c5.016 0 9.281 3.094 11.016 7.5-1.734 4.406-6 7.5-11.016 7.5s-9.281-3.094-11.016-7.5c1.734-4.406 6-7.5 11.016-7.5z"></path>
                    </svg>
                    <svg v-else version="1.1" xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                         viewBox="0 0 24 24">
                        <title>{{showPasswordLabel}}</title>
                        <path d="M11.859 9h0.141c1.641 0 3 1.359 3 3v0.188zM7.547 9.797c-0.328 0.656-0.563 1.406-0.563 2.203 0 2.766 2.25 5.016 5.016 5.016 0.797 0 1.547-0.234 2.203-0.563l-1.547-1.547c-0.188 0.047-0.422 0.094-0.656 0.094-1.641 0-3-1.359-3-3 0-0.234 0.047-0.469 0.094-0.656zM2.016 4.266l1.266-1.266 17.719 17.719-1.266 1.266c-1.124-1.11-2.256-2.213-3.375-3.328-1.359 0.563-2.813 0.844-4.359 0.844-5.016 0-9.281-3.094-11.016-7.5 0.797-1.969 2.109-3.656 3.75-4.969-0.914-0.914-1.812-1.844-2.719-2.766zM12 6.984c-0.656 0-1.266 0.141-1.828 0.375l-2.156-2.156c1.219-0.469 2.578-0.703 3.984-0.703 5.016 0 9.234 3.094 10.969 7.5-0.75 1.875-1.922 3.469-3.422 4.734l-2.906-2.906c0.234-0.563 0.375-1.172 0.375-1.828 0-2.766-2.25-5.016-5.016-5.016z"></path>
                    </svg>
                </span>
            </div>

        </div>

        <div class="progress" style="height: 3px;">
            <div :class="progressBarClass" role="progressbar" :aria-valuenow="passwordStrength" aria-valuemin="0"
                 aria-valuemax="100"></div>
        </div>

    </div>
</template>

<script>
    import zxcvbn from 'zxcvbn'

    export default {
        props: {
            /**
             * Input field id
             * @type {String}
             */
            id: {
                type: String,
                default: 'password'
            },
            /**
             * Label text
             * @type {String}
             */
            label: {
                type: String,
                default: 'Password',
            },
            /**
             * Input field placeholder text
             * @type {String}
             */
            placeholder: {
                type: String,
                default: 'Please enter your password'
            },
            /**
             * Input field name
             * @type {String}
             */
            name: {
                type: String,
                default: 'password'
            },
            /**
             * Binded value
             * @type {Object}
             */
            value: {
                type: String
            },
            /**
             * Input field required attribute
             * @type {Boolean}
             */
            required: {
                type: Boolean,
                default: true
            },
            /**
             * Input field disabled attribute
             * @type {Boolean}
             */
            disabled: {
                type: Boolean,
                default: false
            },
            /**
             * Password min length.
             * Right now only visual for the badge
             * @type {Number}
             */
            secureLength: {
                type: Number,
                default: 8
            },
            /**
             * Show password toggle:
             * Show icon to toggle
             * the password visibility
             */
            toggle: {
                type: Boolean,
                default: true
            },
            /**
             * Prop to toggle the
             * cleartext password if
             * toggle is disabled
             */
            showPassword: {
                type: Boolean,
                default: false
            },
            /**
             * Prop to change the
             * ref of the input
             */
            referenceValue: {
                type: String,
                default: 'input'
            },

            /**
             * Label for the show password icon
             */
            labelShow: {
                type: String,
                default: 'Ver '
            },
            /**
             * Label for the hide password icon
             */
            labelHide: {
                type: String,
                default: 'Esconder '
            }
        },
        data() {
            return {
                password: null,
                _showPassword: false
            }
        },
        methods: {
            togglePassword() {
                if (this.$data._showPassword) {
                    this.$emit('hide')
                    this.$data._showPassword = false
                } else {
                    this.$emit('show')
                    this.$data._showPassword = true
                }
            },
            emitValue(type, value) {
                this.$emit(type, value)
                this.password = value
            }
        },
        computed: {
            /**
             * passwordStrength is the score calculated by zxcvbn
             * @return {Number} Password Strength Score
             */
            passwordStrength() {
                return this.password ? zxcvbn(this.password).score : null
            },
            /**
             * isSecure checks if the length of the password is longer then
             * the defined `secureLength`
             * @return {Boolean} Password length longer then minLength
             */
            isSecure() {
                return this.password ? this.password.length >= this.secureLength : null
            },
            /**
             * isActive checks if a password is entered.
             * It's required for the password count badge.
             * @return {Boolean} Password entered
             */
            isActive() {
                return this.password && this.password.length > 0
            },
            /**
             * passwordCount holds the character count of the
             * current password. It shows the count up to the `secureLength`.
             * @return {Number} Password Character Count
             */
            passwordCount() {
                return this.password && (this.password.length > this.secureLength ? `${this.secureLength}+` : this.password.length)
            },
            /**
             * Changing the input type from password to text
             * based on the local _showPassword data or the showPassword prop
             */
            inputType() {
                return this.$data._showPassword || this.showPassword ? 'text' : 'password'
            },
            showPasswordLabel() {
                return this.$data._showPassword || this.showPassword ? this.labelHide : this.labelShow
            },
            progressBarClass() {
                var progressBarClass = 'progress-bar ';

                switch (this.passwordStrength) {
                    case 0:
                    case 1:
                        progressBarClass += 'bg-danger progress-strength-20';
                        break;
                    case 2:
                        progressBarClass += 'bg-warning progress-strength-50';
                        break;
                    case 3:
                        progressBarClass += 'bg-warning progress-strength-75';
                        break;
                    case 4:
                        progressBarClass += 'bg-success progress-strength-100';
                        break;
                    default:
                        break;
                }

                return progressBarClass;
            }
        },
        watch: {
            passwordStrength(score) {
                this.$emit('score', score);
                this.$emit('feedback', zxcvbn(this.password).feedback);
            }
        }
    }
</script>

<style lang="scss">
    .form-group-progress {

        >.input-group {
            input {
                border-bottom-left-radius: 0;
            }
            .input-group-text {
                border-bottom-right-radius: 0;
            }
        }

    }

    .progress-strength-20 {
        width: 20%;
    }

    .progress-strength-50 {
        width: 50%;
    }

    .progress-strength-75 {
        width: 75%;
    }

    .progress-strength-100 {
        width: 100%;
    }
</style>*