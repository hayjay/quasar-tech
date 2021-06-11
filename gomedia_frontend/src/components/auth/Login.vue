<template>
    <q-layout view="hHh lpR fFf">
        <q-page-container>
            <q-page class="home-page window-height window-width row justify-center items-center ">
                <div class="q-pa-lg">
                    <form @submit.prevent.stop="onSubmit" class="q-gutter-md">
                        <q-input
                        ref="email"
                        filled
                        v-model="userData.email"
                        label="Email Address *"
                        hint="Please enter your email."
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || 'This field is required']"
                        ></q-input>
                
                        <q-input
                        ref="password"
                        filled
                        :type="isPwd ? 'password' : 'text'"
                        v-model="userData.password"
                        label="Password *"
                        hint="Please enter your password."
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || 'This field is required']"
                        ></q-input>
                
                        <div>
                            <q-btn label="Submit" type="submit" color="primary" ></q-btn>
                        </div>
                    </form>
                </div>
            </q-page>
        </q-page-container>
</q-layout>
    
</template>

<script>
import { mapActions } from 'vuex'

export default {
    name: 'Login',
    
    data () {
        return {
            isPwd: true,
            userData : {
                email: null,
                password: null,
            }
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/signIn'
        }),

        async onSubmit () {
            this.$refs.email.validate()
            this.$refs.password.validate()

            if (this.$refs.email.hasError || this.$refs.password.hasError ) {
                this.formHasError = true
            }

            await this.signIn(this.userData).then(response => {
                let data = response[1].data;
                if (data.data == "success") {
                    
                    if(this.$route.params.nextUrl != null){
                        return this.$router.push(this.$route.params.nextUrl)
                    }
                    this.$q.notify({
                        icon: 'done',
                        color: 'positive',
                        message: `Login Successful, Welcome!`
                    });
                    return this.$router.push('dashboard')
                }
                this.$q.notify({
                    icon: 'report_problem',
                    color: 'negative',
                    message: `Invalid Login Credentials`,
                    timeout: 500
                })
            }).catch(error => console.log(error));
            
        },
    }
}

</script>