<template>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-5 border rounded p-5">
            <!--        <template #logo>-->
            <!--            <jet-authentication-card-logo />-->
            <!--        </template>-->
            <h4 class="text-info text-center">Admin Login</h4>

            <jet-validation-errors class="mb-4" />

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div >
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" v-model="form.email" required autofocus>
                </div>

                <div >
                    <!--                <jet-label for="password" value="Password" />-->
                    <!--                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />-->
                    <label for="password">Email</label>
                    <input type="password" class="form-control" id="password" v-model="form.password" required autocomplete="current-password">
                </div>

                <div class="block mt-2">
                    <label class="flex items-center">
                        <jet-checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600 my-2">Remember me</span>
                    </label>
                </div>

                <div class="d-flex  justify-content-between mt-3">
                    <div>
                        <a v-if="canResetPassword" :href="route('password.request')" >
                            Forgot your password?
                        </a>
                    </div>

                   <div>
                       <button class="btn btn-info"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                           Log in
                       </button>
                   </div>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>

    </div>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
