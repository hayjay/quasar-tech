<template>
    <q-layout>
        <q-page-container>
            <q-page class="home-page window-height window-width row justify-center items-center">
                <div class="q-pa-md">
        <form @submit.prevent.stop="onSubmit" class="q-gutter-md">
            <q-input
            ref="email"
            filled
            v-model="email"
            label="Email Address *"
            hint="Please enter your email."
            lazy-rules
            :rules="[ val => val && val.length > 0 || 'This field is required']"
            ></q-input>
    
            <q-input
            ref="password"
            filled
            v-model="password"
            label="Password *"
            hint="Please enter your password."
            lazy-rules
            :rules="[ val => val && val.length > 0 || 'This field is required']"
            ></q-input>
    
            <div>
            <q-btn label="Submit" type="submit" color="primary" ></q-btn>
            <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm" ></q-btn>
            </div>
        </form>
    </div>
            </q-page>
        </q-page-container>
    </q-layout>
    
</template>

<script>
export default {
    name: 'Add',
    
    data () {
        return {
            email: null,
            password: null,
        }
    },
    methods: {
        onSubmit () {
            this.$refs.email.validate()
            this.$refs.password.validate()

            if (this.$refs.email.hasError || this.$refs.password.hasError ) {
                this.formHasError = true
            }
            else {
                this.$q.notify({
                icon: 'done',
                color: 'positive',
                message: 'Submitted'
                })
            }
        },
    }
}
</script>